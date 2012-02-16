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
	
	private $_scenario;
	
	private $_view;
	
	public $mango_object;
	
	public $data;
	
	public $errors;
	
	function __construct($scenario)
	{
		$this->_scenario = $scenario;
	}
	
	/**
     * Factory method 
     *
     * @return void
     */
	public static function factory($scenario = null)
    {
		return new Scenario($scenario);	
    }
	
	
	function create_scenario($new_scenario)
	{
		if ( ! empty($new_scenario) )//check that the $new_scenario is not empty
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
		} else { $this->errors = array('no_data' => 'You did not provide any data.'); return $this; }//else return an error message
	}
	
	
	function get_scenario($all = true, $scenario_ids = null)//$scenario_ids MUST BE AN ARRAY!!
	{
		if ( $all == true )//if $all is true
		{
			$the_scenarios = Mango::factory('Mango_Scenario')->load(false)->as_array(false); //load all scenarios as an array
			$this->data = $the_scenarios;//set data var to the scenarios array
			return $this;//return the scenario object
		}
		elseif ( $all == false AND is_array($scenario_ids) )//else if you only want one scenario and you have the id
		{
			$mongo_ids = array();//empty a new array
			foreach($scenario_ids as $id)//loop through the array of ids
			{
				$mongo_ids[] = new MongoID($id);//convert each of them to a mongoid
			}
			$the_scenarios = Mango::factory('Mango_Scenario')->load(false, null, 0, array(), array('_id' => array('$in' => $mongo_ids)));//load the wanted scenarios 
			$this->data = $the_scenarios->as_array(false);//set the data var to the single scenario as an array
			return $this;//return the scenario object
		}
		else { $this->errors = array('bad_data' => 'The provided data is no good.'); return $this; }//otherwise return error messages
	}
	
	
	function create_node($new_node)
	{
		if ( ! empty($new_node) )//check that the $new_node is not empty
		{
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
			$this->data = $new_node;//set the data var with the new node
			return $this;//return the scenario object
		} else { $this->errors = array('no_data' => 'You did not provide any data.'); return $this; }//else return an error message
	}
	
	
	function get_node($all = true, $node_ids = null)
	{
		if ( $all == true )//if $all is true
		{
			$the_nodes = Mango::factory('Mango_Node')->load(false)->as_array(false); //load all nodes as an array
			$this->data = $the_nodes;//set data var to the nodes array
			return $this;//return the scenario object
		}
		elseif ( $all == false AND is_array($node_id) )//else if you only want one node and you have the id
		{
			$mongo_ids = array();//empty a new array
			foreach($node_ids as $id)//loop through the array of ids
			{
				$mongo_ids[] = new MongoID($id);//convert each of them to a mongoid
			}
			$the_node = Mango::factory('Mango_Node')->load(false, null, 0, array(), array('_id' => array('$in' => $mongo_ids)))->as_array(false);//load the single node as an array
			$this->data = $the_node;//set the data var to the single node
			return $this;//return the scenario object
		}
		else { $this->errors = array('bad_data' => 'The provided data is no good.'); return $this; }//otherwise return error messages
	}
	
	
	function update_node($update_data = null, $node_id = null)
	{
		if ( $node_id != null AND $update_data != null )
		{
			$the_node = Mango::factory('Mango_Node', array('_id' => (string)$node_id))->load();//load the single node
			foreach($update_data as $update_key => $update_data)//make sure both $scenario_id and $update_data are set
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
		} else { $this->errors = array('bad_data' => 'The provided data is no good.'); return $this; }//otherwise return error messages
	}
	
	
	function update_scenario($update_data = null, $scenario_id = null)
	{
		if ( $scenario_id != null AND $update_data != null )//make sure both $scenario_id and $update_data are set
		{
			$the_scenario = Mango::factory('Mango_Scenario', array('_id' => (string)$scenario_id))->load();//load the single scenario
			foreach($update_data as $update_key => $update_data)//loop through the update data
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
		} else { $this->errors = array('bad_data' => 'The provided data is no good.'); return $this; }//otherwise return error messages
	}
	
	
	function search_scenarios($search_string = null)
	{
		if ( $search_string != null )//make sure $search_string is not null
		{
			$matches = array();//reset $matches 
			$the_scenarios = $this->get_scenario(true)->data;//load the scenarios and set $the_scenarios
			foreach($the_scenarios as $scenario)//loop through the scenarios
			{
				if ( preg_match('/' . $search_string . '/Uis', $scenario['title']) )//check the scenario's title for the search string
				{
					$matches[] = $scenario;//if a match is found set a new element of the $matches array
				}
			}
			$this->data = $matches;//set the data var
			return $this;//return the scenario object
		} else { $this->errors = array('no_string' => 'You did not provide a search string'); return $this; }//error if no search string provided
	}
	
	
	function search_nodes($search_string = null)
	{
		if ( $search_string != null )//make sure $search_string is not null
		{
			$matches = array();//reset $matches 
			$the_nodes = $this->get_node(true)->data;//load the nodes and set $the_nodes
			foreach($the_nodes as $node)//loop through the nodes
			{
				if ( preg_match('/' . $search_string . '/Uis', $node['question']) )//check the node's question for the search string
				{
					$matches[] = $node;//if a match is found set a new element of the $matches array
				}
			}
			$this->data = $matches;//set the data var
			return $this;//return the scenario object
		} else { $this->errors = array('no_string' => 'You did not provide a search string'); return $this; }//error if no search string provided
	}
	
	
	function delete_scenario($scenario_id = null)
	{
		if ( $scenario_id != null )//if $scenario_id is not null
		{
			$the_scenario = Mango::factory('Mango_Scenario')->load(1, null, 0, array(), array('_id' => new MongoID($scenario_id)));//load the scenario by _id
			if ( $the_scenario->loaded() )//check that it's loaded
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
			} else { $this->errors = array('no_scenario_found' => 'We did not find any scenarios to delete'); return $this; }//if it's not loaded pass error messages
			
		} else { $this->errors = array('no_scenario_id' => 'You did not provide a scenario_id'); return $this; }//if no scenario id is provided return errors
	}
	
	
	function delete_nodes()
	{
		//this is not written out yet...obviously
		exit;
	}
	
	
	public function render($view)
	{
		if ($view == 'admin')
		{
			$this->data = $this->get_scenario(true);	
		}
		$this->_view = $view;
		return View::factory('scenario/'.$this->_view)->bind('scenario', $this->data);
	}
}