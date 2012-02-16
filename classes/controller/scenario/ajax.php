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
			} else { echo json_encode(array('success' => true, 'data' => $the_scenario->data)); } //report success	
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
}