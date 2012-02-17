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
	{/*
		echo 'in here somewhere';
		exit;
		$test = array('sometest', 'anothertestvalue');
		echo json_encode($test);
	 * *
	 */
	}
	
	
	public function action_newscenario()
	{
		if ( ! empty($_POST))//check for no post data
		{
			$_POST['creator'] = 'system';//this will be changed to reflect a log in system
			$the_scenario = Scenario::factory()->create_scenario($_POST);//create the new scenario
			if ($the_scenario->errors === null)//check for errors
			{
				echo json_encode(array('success' => true, 'view' => (string)$the_scenario->render('li')));//report success
			}
			else
			{
				echo json_encode(array('success' => false, 'errors' => $the_scenario->errors));//report errors
			}	
		}
		else
		{
			echo json_encode(array('success' => false, 'errors' => array('No data was provided!')));//report no data provided
		}
	}
	
	
	public function action_newnode()
	{
		if ( ! empty($_POST))//check for no post data
		{
			$_POST['creator'] = 'system';//this will be changed to reflect a log in system
			$the_node = Scenario::factory()->create_node($_POST);//create the node
			if ($the_node->errors === null)//check for errors
			{
				echo json_encode(array('success' => true, 'view' => $the_node->render('newnode')));//report success
			}
			else
			{
				echo json_encode(array('success' => false, 'errors' => $the_node->errors));//report errors
			}
		}
		else
		{
			echo json_encode(array('success' => false, 'errors' => array('No data was provided!')));//report no data provided
		}
	}
	
	
	public function action_getscenarios()
	{
		if ( ! empty($_POST))//check for no post data
		{
			if ($_POST['all'] === true)
			{
				$the_scenarios = Scenario::factory()->get_scenario(true);//get all the scenarios
			}	
			else
			{
				$the_scenarios = Scenario::factory()->get_scenario(false, $_POST['scenarios']);//the $_POST['scenarios'] var MUST BE AN ARRAY!!
			}
			if ($the_scenarios->errors === null)//check for errors
			{
				echo json_encode(array('success' => true, 'view' => $the_scenarios->render('scenarios')));//report errors
			}
			else
			{
				echo json_encode(array('success' => false, 'errors' => $the_scenarios->errors));//report core errors
			}
		}
		else
		{
			echo json_encode(array('success' => false, 'errors' => array('No data was provided!')));//report no data provided
		}
	}
	
	
	public function action_getnodes()
	{
		if ( ! empty($_POST) )//check for no post data
		{
			if ( $_POST['all'] == true )//check if the user wants all of the nodes
				$the_nodes = Scenario::factory()->get_node(true);//get all the nodes	
			else 
				$the_nodes = Scenario::factory()->get_node(false, $_POST['nodes']);//the $_POST['nodes'] var MUST BE AN ARRAY!!
			if ( $the_nodes->errors === null )//check for errors
			{
				echo json_encode(array('success' => true, 'view' => $the_nodes->render('nodes')));//report success
			} else { echo json_encode(array('success' => false, 'errors' => $the_nodes->errors)); }//report core errors
		} else { echo json_encode(array('success' => false, 'errors' => array('No data was provided!'))); }//report no data provided
	}
	
	
	public function action_buildgrid()
	{
		if ( ! empty($_POST) )//check for empty post
		{
			$scenario = Scenario::factory();//load up a scenario object
			$scenario->data = $_POST['size'];//set the object's data var to the size of the grid you want to build
			echo json_encode(array('success' => true, 'view' => (string)$scenario->render('buildgrid')));//render the grid and echo it to the view
		} else { echo json_encode(array('success' => false, 'errors' => array('Could not build grid.'))); }//report no data provided
	}
	
	
	public function action_updatescenario()
	{
		if ( ! empty($_POST) )//check for empty post 
		{
			if ( isset($_POST['scenario_id']) )//check that a scenario id was sent
			{
				$scenario_id = $_POST['scenario_id'];//set $scenario_id to the $_POST['scenario_id']
				$update_data = array();//reset the $update_data var
				foreach($_POST as $post_key => $post_value)//run a foreach on the $_POST
				{
					if ( $post_key != 'scenario_id' )//make sure the current post key is not scenario_id
						$update_data[$post_key] = $post_value;//create the new $update_data array
				}
				$scenario = Scenario::factory()->update_scenario($update_data, $scenario_id);//load up the scenario object and run an update on the scenario
				if ( $scenario->errors === null )
				{
					echo json_encode(array('success' => true, 'view' => (string)$scenario->render('updatescenario')));//report success and send over the view
				} else { echo json_encode(array('success' => false, 'errors' => $node->errors)); }//report core errors
			} else { echo json_encode(array('success' => false, 'errors' => array('You did not provide a scenario id.'))); }//return errors
		} else { echo json_encode(array('success' => false, 'errors' => array('You did not provide any update data.'))); }//return errors
	}
	
	
	public function action_updatenode()
	{
		if ( ! empty($_POST) )//check for empty post 
		{
			if ( isset($_POST['node_id']) )//check that a node id was sent
			{
				$node_id = $_POST['node_id'];//set $node_id to the $_POST['node_id']
				$update_data = array();//reset the $update_data var
				foreach($_POST as $post_key => $post_value)//run a foreach on the $_POST
				{
					if ( $post_key != 'node_id' )//make sure the current post key is not node_id
						$update_data[$post_key] = $post_value;//create the new $update_data array
				}
				$node = Scenario::factory()->update_node($update_data, $node_id);//load up the scenario object and run an update on the node
				if ( $node->errors === null)
				{
					echo json_encode(array('success' => true, 'view' => (string)$node->render('updatenode')));//report success and send over the view
				} else { echo json_encode(array('success' => false, 'errors' => $node->errors)); }//report core errors
			} else { echo json_encode(array('success' => false, 'errors' => array('You did not provide a node id.'))); }//return errors
		} else { echo json_encode(array('success' => false, 'errors' => array('You did not provide any update data.'))); }//return errors
	}
	
	
	public function action_searchscenarios()
	{
		if ( ! empty($_POST) )//check for empty post
		{
			if ( isset($_POST['search_string']) )//make sure that there is a search string
			{
				$scenarios = Scenario::factory()->search_scenarios($_POST['search_string']);//load the scenario object and call search_scenarios()
				if ( $scenarios->errors === null )//make sure there were no errors
				{
					echo json_encode(array('success' => true, 'view' => (string)$scenarios->render('searchscenarios')));//report success and send over the view
				} else { echo json_encode(array('success' => false, 'errors' => $scenarios->errors)); }//return core errors if there were any
			} else { echo json_encode(array('success' => false, 'errors' => array('No search string was sent.'))); }//return errors
		} else { echo json_encode(array('success' => false, 'errors' => array('You did not provide any search data.'))); }//return errors
	}
	
	
	public function action_searchnodes()
	{
		if ( ! empty($_POST) )//check for empty post
		{
			if ( isset($_POST['search_string']) )//make sure that there is a search string
			{
				$nodes = Scenario::factory()->search_nodes($_POST['search_string']);//load the scenario object and call search_nodes()
				if ( $nodes->errors === null )//make sure there were no errors
				{
					echo json_encode(array('success' => true, 'view' => (string)$nodes->render('searchnodes')));//report success and send over the view
				} else { echo json_encode(array('success' => false, 'errors' => $nodes->errors)); }//return core errors if there were any
			} else { echo json_encode(array('success' => false, 'errors' => array('No search string was sent.'))); }//return errors
		} else { echo json_encode(array('success' => false, 'errors' => array('You did not provide any search data.'))); }//return errors
	}
	
	
	public function action_deletescenario()
	{
		if ( ! empty($_POST) )//check for empty post
		{
			if ( isset($_POST['scenario_id']))//check and make sure scenario id is provided
			{
				$scenario_id = $_POST['scenario_id'];//set the $scenario_id var to the posted scenario id
				$scenario = Scenario::factory()->delete_scenario($scenario_id);//load the scenario object and delete the scenario
				if ( $scenario->errors === null )//check for core errors
				{
					echo json_encode(array('success' => true, 'view' => (string)$scenario->render('deletescenario')));//report success and send over the view
				} else { echo json_encode(array('success' => false, 'errors' => $scenario->errors)); }//return core errors if any
			} else { echo json_encode(array('success' => false, 'errors' => array('No scenario_id was sent.'))); }//return errors
		} else { echo json_encode(array('success' => false, 'errors' => array('You did not provide any post data.'))); }//return errors
	}
	
	
	public function action_deletenode()
	{
		echo json_encode(array('success' => false, 'errors' => 'This function is not working!'));
	}
}