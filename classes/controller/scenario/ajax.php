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
	
}