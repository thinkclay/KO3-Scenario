<?php defined('SYSPATH') or die('No direct script access.');

Route::set('scenario', 'scenario(/<action>(/<id>))')
	->defaults(array(
		'directory'		=> 'scenario',
		'controller' 	=> 'ajax', 
		'action' 		=> 'index' 
	));