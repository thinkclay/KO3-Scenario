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
	
	function __construct($scenario)
	{
		$this->_scenario = $scenario;
	}
	
	/**
     * Factory method used to set $uid and pump out a calendar object
     *
     * @return void
     */
	public static function factory($scenario = null)
    {
		return new Scenario($scenario);	
    }
	
	function create()
	{
		
	}
	
	function read()
	{
		
	}
	
	function update()
	{
		
	}
	
	function delete()
	{
		
	}
	
	public function render($view)
	{
		
	}
}