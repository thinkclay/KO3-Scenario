<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Scenario core 
 *
 * @package Scenario
 * @author  Winter King & Bryan Galli
 * 
 **/
class Scenario_Core
{
	/**
	 * @var  string $scenario var
	 */
	private $_scenario;
	
	/**
	 * @var  string  The view to render
	 */
	private $_view;
	
	
	/**
	 * @var  array  Holds the general data
	 */
	public $data;
	
	/**
	 * @var  array  Holds the error messages;
	 */
	public $errors = null;
	
	/**
     * sets private vars  
     *
     */
	function __construct($scenario)
	{
		$this->_scenario = $scenario;
	}
	
	/**
     * Factory method 
     *
     * @return an instaciated Scenario object
     */
	public static function factory($scenario = null)
    {
		return new Scenario($scenario);	
    }
	
	/**
	 * Creates a new scenario in the DB
	 * 
	 * This method will create a new scenario and then set $this->data as the newly created scenario as an array
	 * @param   array new_scenario the data used to create the new scenario
	 * @return  object
	 */
	public function create_scenario($new_scenario)
	{
		if ( ! empty($new_scenario))//check that the $new_scenario is not empty
		{
			$new_scenario['created'] = time();//get the current timestamp
			$the_scenario = Mango::factory('Mango_Scenario', $new_scenario); //load up a new mango object with the passed in data
			try
			{
				$the_scenario->check(); // check that the scenario conforms to the mango model
			}
			catch (Mango_Validation_Exception $e)
			{
				$this->errors = $e->array->errors('scenario'); // return errors if it does not conform to the mango model
				return $this;//return the scenario object
			}
			$the_scenario->create();//create the new scenario in the db
			$this->data = $the_scenario->as_array();//set the data var with the new scenario
			return $this;//return the scenario object
		} 
		else 
		{
			 $this->errors = array('no_data' => 'You did not provide any data.'); //else return an error message
			 return $this;//return the scenario object
		}
	}
	
	/**
	 * Creates an answer in a specific node
	 * 
	 * This method will create a new answer in the node that you specify
	 * @param 	string new_answer holds theanswer string that you will be using to create
	 * @param   string node_id holds the mongo id of the node that you want to create in
	 * @return  object
	 */
	public function create_answer($new_answer, $node_id)
	{
		if ( ! empty($new_answer))//check that $new_answer is not empty
		{
			if ( ! empty($node_id))//check for no node id
			{
				$the_node_id = array($node_id);//make the node id an array for get_node to work properly
				$this->get_node(false, $the_node_id);//get the original node loaded
				if (isset($this->data[0]['answers']))//check if it has previous answers
				{
					$previous_node_array = $this->data[0];//set the previous node array with the data that is currently in $this->data
					$answer_counter = 0;//reset answer counter
					foreach ($previous_node_array['answers'] as $answer)//loop through answers
					{
						$answer_counter++;//count the answers so that we can dynamically create a unique 'question' for the node we are about to create
					}
					$this->create_node(array('question' => $node_id.' Choice '.$answer_counter, 'creator' => 'system'));//create the new node
					$newly_created_node_id = $this->data['_id'];//set the $newly_created_node_id with the data that was just set with create_node()
					unset($previous_node_array['_id']);//unsite the _id field of the previous array ...it is not needed and will throw the mango model off
					$previous_node_array['answers'][$newly_created_node_id] = $new_answer;//set the next element in the previous nodes answer array
					$this->update_node($previous_node_array, $node_id)->get_node(false, array($newly_created_node_id));//update the previous node and then call get_node so that the data you return will be the newly created node
					return $this;//return the scenario object
				}
				else //if no previous answers
				{
					$previous_node_array = $this->data[0];//set the $previous_node_array var with what is currently in $this->data
					$this->create_node(array('question' => $node_id.' Choice 0', 'creator' => 'system'));//create the new node
					$newly_created_node_id = $this->data['_id'];//set the newly_created_node_id var with what was set in the data array when we called get_node
					unset($previous_node_array['_id']);//unset the _id field of the previous array ...it is not needed and will throw off the mango model
					$previous_node_array['answers'] = array($newly_created_node_id => $new_answer);//create a new array element with key 'answers' in the $previous_node_array and then set the new answer to that element
					$this->update_node($previous_node_array, $node_id)->get_node(false, array($newly_created_node_id));//update the previous node and call get_node to set the newly created node as $this->data
					return $this;//return the scenario object
				}
			}
			else
			{
				$this->errors = array('no_node_id' => 'You did not provide a node id.');//return errors
				return $this; //return scenario object
			}
		}
		else 
		{
			$this->errors = array('no_data' => 'You did not provide any data.'); //else return an error message
			return $this; //return the scenario object
		}
	}
	
	/**
	 * Updates a specific answer from a specific node
	 * 
	 * This method will grab a specific node out of the db and update the selected answer in that node
	 * @param 	string new_answer holds the updated answer string that you will be using to update
	 * @param   string node_id holds the mongo id of the node that you want to update in
	 * @param	string answer_key_to_update holds the key of the answer you want to update
	 * @return  object
	 */
	public function update_answer($new_answer = null, $node_id = null, $answer_key_to_update = null)
	{
		if ($new_answer !== null)//make sure $new_answer is set
		{
			if ($node_id !== null)//make sure $node_id is set
			{
				if ($answer_key_to_update !== null)//make sure $answer_key_to_update is set
				{
					$this->get_node(false, array($node_id));//get the node
					$answers = $this->data[0]['answers'];//set answers to the data that was provided with get_node()
					$updated_answers['answers'] = $answers;//set $updated_answers
					$updated_answers['answers'][$answer_key_to_update] = $new_answer;//set the updated data
					$this->update_node($updated_answers, $node_id);//update the node
					return $this;//return the scenario object
				}
				else
				{
					$this->errors = array('no_data' => 'You did not provide an answer key to update.'); //else return an error message
					return $this; //return the scenario object
				}
			}
			else
			{
				$this->errors = array('no_data' => 'You did not provide a node id.'); //else return an error message
				return $this; //return the scenario object
			}
		}
		else 
		{
			$this->errors = array('no_data' => 'You did not provide a new answer string.'); //else return an error message
			return $this; //return the scenario object
		}
	}
	
	/**
	 * Deletes a specific answer from a specific node
	 * 
	 * This method will grab a specific node out of the db and delete the selected answer out of that db
	 * @param   string node_id holds the mongo id of the node that you want to delete from
	 * @param	string answer_key_to_delete holds the key of the answer that you want to delete
	 * @return  object
	 */
	public function delete_answer($node_id = null, $answer_key_to_delete = null)
	{
		if ($node_id !== null)//check for empty node id
		{
			if ($answer_key_to_delete !== null)//check for empty answer key
			{
				$this->get_node(false, array($node_id));//get the node
				$answers = $this->data[0]['answers'];//set the $answers var
				$updated_answers['answers'] = $answers;//set $updated_answers
				unset($updated_answers['answers'][$answer_key_to_delete]);//unset the data you want deleted
				$this->update_node($updated_answers, $node_id);//update the node
				return $this;//return the scenario object
			}
			else 
			{
				$this->errors = array('no_data' => 'You did not provide a answer key.'); //else return an error message
				return $this; //return the scenario object
			}
		}
		else
		{
			$this->errors = array('no_data' => 'You did not provide a node id.'); //else return an error message
			return $this; //return the scenario object
		}
	}
	
	/**
	 * Gets the scenarios out of the DB
	 * 
	 * This method will grab the scenarios out of the database and set $this->data to those scenarios as an array
	 * @param   boolean all used to determine if the user wants all the scenarios or particular ones
	 * @param	array scenario_ids holds a set of mongoIds to query the db for
	 * @return  object
	 */
	public function get_scenario($all = true, $scenario_ids = null)//$scenario_ids MUST BE AN ARRAY!!
	{
		if ($all == true)//if $all is true
		{
			$the_scenarios = Mango::factory('Mango_Scenario')->load(false)->as_array(false); //load all scenarios as an array
			$this->data = $the_scenarios;//set data var to the scenarios array
			return $this;//return the scenario object
		}
		elseif ($all == false AND is_array($scenario_ids))//else if you only want one scenario and you have the id
		{
			$mongo_ids = array();//empty a new array
			foreach ($scenario_ids as $id)//loop through the array of ids
			{
				$mongo_ids[] = new MongoID($id);//convert each of them to a mongoid
			}
			$the_scenarios = Mango::factory('Mango_Scenario')->load(false, null, 0, array(), array('_id' => array('$in' => $mongo_ids)));//load the wanted scenarios 
			$this->data = $the_scenarios->as_array(false);//set the data var to the single scenario as an array
			return $this;//return the scenario object
		}
		else
		{
			$this->errors = array('bad_data' => 'The provided data is no good.');//set the errors
			return $this; //return the object
		}
	}
	
	/**
	 * Creates a new node in the DB
	 * 
	 * This method will create a new node in the database and set $this->data to that newly created node as an array
	 * If the $new_node data contains a scenario_id field then it will also update the scenario linking the new node to it.
	 * @param   array   new_node the data used to create the new node
	 * @return  object
	 */
	public function create_node($new_node)
	{
		$scenario_id = null;
		if ( ! empty($new_node))//check that the $new_node is not empty
		{
			if (isset($new_node['scenario_id']))
			{
				$scenario_id = $new_node['scenario_id'];
				unset($new_node['scenario_id']);
			}
			$new_node['created'] = time();//get the current timestamp
			$the_node = Mango::factory('Mango_Node', $new_node); //load up a new mango object with the passed in data
			try
			{
				$the_node->check(); // check that the node conforms to the mango model
			}
			catch (Mango_Validation_Exception $e)
			{
				$this->errors = $e->array->errors('node'); // return errors if it does not conform to the mango model
				return $this;//return the scenario object
			}
			$the_node->create();//create the new node in the db
			$new_node['_id'] = (string) $the_node->_id;//make sure the array holds the id of the newly created node as well
			if ($scenario_id !== null)
			{
				$the_node->reload();
				$update_data = array('starting_node' => $the_node->_id);
				$this->update_scenario($update_data, $scenario_id);
			}



			$this->data = $new_node;//set the data var with the new node
			return $this;//return the scenario object
		} 
		else 
		{
			$this->errors = array('no_data' => 'You did not provide any data.'); //set errors
			return $this;//return the object
		}
	}
	
	/**
	 * Gets the nodes out of the DB
	 * 
	 * This method will grab the nodes out of the database and set $this->data to those nodes as an array
	 * @param   boolean all used to determine if the user wants all the nodes or particular ones
	 * @param	array node_ids holds a set of mongoIds to query the db for
	 * @return  object
	 */
	public function get_node($all = true, $node_ids = null)
	{
		if ($all == true)//if $all is true
		{
			$the_nodes = Mango::factory('Mango_Node')->load(false)->as_array(false); //load all nodes as an array
			$this->data = $the_nodes;//set data var to the nodes array
			return $this;//return the scenario object
		}
		elseif ($all == false AND is_array($node_ids))//else if you only want one node and you have the id
		{
			$mongo_ids = array();//empty a new array
			foreach ($node_ids as $id)//loop through the array of ids
			{
				$mongo_ids[] = new MongoID($id);//convert each of them to a mongoid
			}
			$the_node = Mango::factory('Mango_Node')->load(false, null, 0, array(), array('_id' => array('$in' => $mongo_ids)))->as_array(false);//load the single node as an array
			$this->data = $the_node;//set the data var to the single node
			return $this;//return the scenario object
		}
		else 
		{
			$this->errors = array('bad_data' => 'The provided data is no good.');//set the error messages
			return $this; //return the scenario object
		}
	}
	
	/**
	 * Updates a particular node
	 * 
	 * This method will update a node and set $this->data to the updated version of the node as an array
	 * @param   array update_data holds the data that will be used in the update
	 * @param	string node_id holds the mongoId for the node that will be updated
	 * @return  object
	 */
	public function update_node($update_data = null, $node_id = null)
	{
		if ($node_id != null AND $update_data != null)
		{
			$the_node = Mango::factory('Mango_Node', array('_id' => (string) $node_id))->load();//load the single node
			foreach ($update_data as $update_key => $update_data)//make sure both $scenario_id and $update_data are set
			{
				$the_node->$update_key = $update_data;//set the node's data to the updated data
			}
			try
			{
				$the_node->check(); // check that the node conforms to the mango model
			}
			catch (Mango_Validation_Exception $e)
			{
				$this->errors = $e->array->errors('node'); // return errors if it does not conform to the mango model
				return $this;//return the scenario object
			}
			$the_node->update();//update the node in the db
			$this->data = $the_node->as_array(false);//set the data var with the updated node array
			return $this;//return the scenario object
		}
		else 
		{
			$this->errors = array('bad_data' => 'The provided data is no good.');//set the error messages
			return $this;//return the scenario object
		}
	}
	
	/**
	 * Updates a particular scenario
	 * 
	 * This method will update a scenario and set $this->data to the updated version of the scenario as an array
	 * @param   array update_data holds the data that will be used in the update
	 * @param	string scenario_id holds the mongoId for the scenario that will be updated
	 * @return  object
	 */
	public function update_scenario($update_data = null, $scenario_id = null)
	{
		if ($scenario_id != null AND $update_data != null)//make sure both $scenario_id and $update_data are set
		{
			$the_scenario = Mango::factory('Mango_Scenario', array('_id' => (string) $scenario_id))->load();//load the single scenario
			foreach ($update_data as $update_key => $update_data)//loop through the update data
			{
				$the_scenario->$update_key = $update_data;//set the scenario's data to the updated data
			}
			try
			{
				$the_scenario->check(); // check that the node conforms to the mango model
			}
			catch (Mango_Validation_Exception $e)
			{
				$this->errors = $e->array->errors('scenario'); // return errors if it does not conform to the mango model
				return $this;//return the scenario object
			}
			$the_scenario->update();//update the scenario in the db
			$this->data = $the_scenario->as_array(false);//set the data var with the updated scenario array
			return $this;//return the scenario object
		} 
		else 
		{
			$this->errors = array('bad_data' => 'The provided data is no good.');//set the error messages
			return $this; //return the scenario object
		}
	}
	
	/**
	 * Searches all scenarios for a match of the search string in the title of each scenario
	 * 
	 * This method will search through all scenarios for the search string and set $this->data to all matching scenarios as an array
	 * @param	string search_string holds the search string to be used
	 * @return  object
	 */
	public function search_scenarios($search_string = null)
	{
		if ($search_string != null)//make sure $search_string is not null
		{
			$matches = array();//reset $matches 
			$the_scenarios = $this->get_scenario(true)->data;//load the scenarios and set $the_scenarios
			foreach ($the_scenarios as $scenario)//loop through the scenarios
			{
				if (preg_match('/' . $search_string . '/Uis', $scenario['title']))//check the scenario's title for the search string
				{
					$matches[] = $scenario;//if a match is found set a new element of the $matches array
				}
			}
			$this->data = $matches;//set the data var
			return $this;//return the scenario object
		} 
		else 
		{
			$this->errors = array('no_string' => 'You did not provide a search string'); //set the error messages
			return $this;//return the scenario object
		}
	}
	
	/**
	 * Searches all nodes for a match of the search string in the question of each node
	 * 
	 * This method will search through all nodes for the search string and set $this->data to all matching nodes as an array
	 * @param	string search_string holds the search string to be used
	 * @return  object
	 */
	public function search_nodes($search_string = null)
	{
		if ($search_string != null)//make sure $search_string is not null
		{
			$matches = array();//reset $matches 
			$the_nodes = $this->get_node(true)->data;//load the nodes and set $the_nodes
			foreach ($the_nodes as $node)//loop through the nodes
			{
				if (preg_match('/' . $search_string . '/Uis', $node['question']))//check the node's question for the search string
				{
					$matches[] = $node;//if a match is found set a new element of the $matches array
				}
			}
			$this->data = $matches;//set the data var
			return $this;//return the scenario object
		} 
		else 
		{
			$this->errors = array('no_string' => 'You did not provide a search string');//set the error messages
			return $this;//return the scenario object
		}
	}
	
	/**
	 * !!WARNING!! THIS FUNCTION WILL KILL THE ENTIRE SCENARIO TREE 
	 * Deletes a particular scenario
	 *
	 * This method will delete a scenario and set $this->data to an array that holds the success message
	 * @param	string scenario_id holds the mongoId of the scenario to be deleted
	 * @return  object
	 */
	public function delete_scenario($scenario_id = null)
	{
		if ($scenario_id != null)//if $scenario_id is not null
		{
			$the_scenario = Mango::factory('Mango_Scenario')->load(1, null, 0, array(), array('_id' => new MongoID($scenario_id)));//load the scenario by _id
			if ($the_scenario->loaded())//check that it's loaded
			{
				try
				{
					$the_scenario->delete(); //delete the scenario
				}
				catch (Mango_Validation_Exception $e)
				{
					$this->errors = array('success' => false, 'message' => 'There was a problem deleting this scenario'); // return errors if it does not delete
					return $this;//return the scenario object
				}
				$this->data = array('success' => true, 'message' => 'The scenario was deleted');//set data var with a message that says 
				return $this;//return the scenario object
			} 
			else 
			{
				$this->errors = array('no_scenario_found' => 'We did not find any scenarios to delete');//set error messages
				return $this;//return the object
			}
		}
		else
		{
			$this->errors = array('no_scenario_id' => 'You did not provide a scenario_id');//set the error messages
			return $this;//return the scenario object
		}
	}
	
	
	public function delete_nodes()
	{
		//this is not written out yet...obviously
		exit;
	}
	
	/**
	 * renders the specific view that the user has requested
	 * 
	 * This method will bind the contents of $this->data to the requested view as $data and will then render that view
	 * @param	string view holds the name of the view to render
	 * @return  string returns the view as a string
	 */
	public function render($view)
	{
		if ($view == 'admin')//check if this is admin view
		{
			$this->get_scenario(true);//if it is admin view call get_scenario to set the data var
		}
		$this->_view = $view;//set the view
		return View::factory('scenario/'.$this->_view)->bind('data', $this->data);//return the view with data bound to it
	}
}