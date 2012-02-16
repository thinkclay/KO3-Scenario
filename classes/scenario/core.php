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
			$this->data = $new_scenario;//set the data var with the new scenario
			return $this;//return the scenario object
		} else { $this->errors = array('no_data' => 'You did not provide any data.'); return $this; }//else return an error message
	}
	
	
	function get_scenario($all = true, $scenario_id = null)
	{
		if ( $all == true )//if $all is true
		{
			$the_scenarios = Mango::factory('Mango_Scenario')->load(false)->as_array(false); //load all scenarios as an array
			$this->data = $the_scenarios;//set data var to the scenarios array
			return $this;//return the scenario object
		}
		elseif ( $all == false AND $scenario_id != null )//else if you only want one scenario and you have the id
		{
			$the_scenario = Mango::factory('Mango_Scenario', array('_id' => (string)$scenario_id))->load()->as_array(false);//load the single scenario as an array
			$this->data = $the_scenario;//set the data var to the single scenario
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
	
	
	function get_node($all = true, $node_id = null)
	{
		if ( $all == true )//if $all is true
		{
			$the_nodes = Mango::factory('Mango_Node')->load(false)->as_array(false); //load all nodes as an array
			$this->data = $the_nodes;//set data var to the nodes array
			return $this;//return the scenario object
		}
		elseif ( $all == false AND $node_id != null )//else if you only want one node and you have the id
		{
			$the_node = Mango::factory('Mango_Node', array('_id' => (string)$node_id))->load()->as_array(false);//load the single node as an array
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
			$the_node->update();
			$this->data = $the_node->as_array(false);
			return $this;
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
			$the_scenario->update();
			$this->data = $the_scenario->as_array(false);
			return $this;
		} else { $this->errors = array('bad_data' => 'The provided data is no good.'); return $this; }//otherwise return error messages
	}
	
	function search_scenario()
	{
		
	}
	
	function search_nodes()
	{
		
	}
	
	public function render($view)
	{
		$this->_view = $view;
		return View::factory('scenario/'.$this->_view)->bind('scenario', $this->data);
	}
}