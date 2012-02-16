<?php defined('SYSPATH') or die('No direct script access.');

/**
 * ajax controller - Php handler file for ajax calls
 *
 * @package Decision
 * @author  Winter King & Bryan Galli
 * 
 **/
class Controller_Scenario_Ajax extends Controller
{
	public function action_index()
	{
		echo 'in here somewhere';
		exit;
		$test = array('sometest', 'anothertestvalue');
		echo json_encode($test);
	}
	
	
	public function action_newscenario()
	{
		if ( ! empty($_POST) )//check for no post data
		{
			$_POST['creator'] = 'system';//this will be changed to reflect a log in system
			$the_scenario = Scenario::factory()->create_scenario($_POST);//create the new scenario
			if ( isset($the_scenario->errors) )//check for errors
			{
				echo json_encode(array('success' => false, 'errors' => $the_scenario->errors));//report errors
			} else { echo json_encode(array('success' => true, 'view' => (string)$the_scenario->render('li'))); } //report success	
		} else { echo json_encode(array('success' => false, 'errors' => array('No data was provided!'))); }//report no data provided
	}
	
	
	public function action_newnode()
	{
		if ( ! empty($_POST) )//check for no post data
		{
			$_POST['creator'] = 'system';//this will be changed to reflect a log in system
			$the_node = Scenario::factory()->create_node($_POST);//create the node
			if ( isset($the_node->errors) )//check for errors
			{
				echo json_encode(array('success' => false, 'errors' => $the_node->errors));//report errors
			} else { echo json_encode(array('success' => true, 'data' => $the_node->data)); }//report success
		} else { echo json_encode(array('success' => false, 'errors' => array('No data was provided!'))); }//report no data provided
	}
	
	
	public function action_getscenarios()
	{
		if ( ! empty($_POST) )//check for no post data
		{
			if ( $_POST['all'] == true )
				$the_scenarios = Scenario::factory()->get_scenario(true);//get all the scenarios	
			else 
				$the_scenarios = Scenario::factory()->get_scenario(false, $_POST['scenarios']);//the $_POST['scenarios'] var MUST BE AN ARRAY!!
			if ( isset($the_scenarios->errors) )//check for errors
			{
				echo json_encode(array('success' => false, 'errors' => $the_scenarios->errors));//report errors
			} else { echo json_encode(array('success' => true, 'data' => $the_scenarios->data)); }//report success
			
		} else { echo json_encode(array('success' => false, 'errors' => array('No data was provided!'))); }//report no data provided
	}
	
	
	public function action_getnodes()
	{
		if ( ! empty($_POST) )//check for no post data
		{
			if ( $_POST['all'] == true )//check if the user wants all of the nodes
				$the_nodes = Scenario::factory()->get_node(true);//get all the nodes	
			else 
				$the_nodes = Scenario::factory()->get_node(false, $_POST['nodes']);//the $_POST['nodes'] var MUST BE AN ARRAY!!
			if ( isset($the_nodes->errors) )//check for errors
			{
				echo json_encode(array('success' => false, 'errors' => $the_nodes->errors));//report errors
			} else { echo json_encode(array('success' => true, 'data' => $the_nodes->data)); }//report success
			
		} else { echo json_encode(array('success' => false, 'errors' => array('No data was provided!'))); }//report no data provided
	}
	
	public function action_buildgrid()
	{
		if ( ! empty($_POST) )
		{
			$scenario = Scenario::factory();
			$scenario->data = $_POST['size'];
			echo json_encode(array('success' => true, 'view' => (string)$scenario->render('buildgrid')));
		}
		else 
		{
			echo json_encode(array('success' => false, 'errors' => array('Could not build grid.')));	
		}
	}
	
	public function action_updatescenario()
	{
		echo json_encode(array('message' => 'not currently working'));
	}
	
	
	public function action_updatenode()
	{
		echo json_encode(array('message' => 'not currently working'));
	}
	
	
	public function action_searchscenarios()
	{
		echo json_encode(array('message' => 'not currently working'));
	}
	
	
	public function action_searchnodes()
	{
		echo json_encode(array('message' => 'not currently working'));
	}
	
	
	public function action_deletescenario()
	{
		echo json_encode(array('message' => 'not currently working'));
	}
}