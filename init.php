<?php defined('SYSPATH') or die('No direct script access.');

Route::set('scenario', 'scenario(/<controller>(/<action>(/<id>)))')
	->defaults(array(
		'directory'		=> 'scenario',
		'action' 		=> 'index' 
	));