<?php defined('SYSPATH') or die('No direct script access.');
return array(
    'description' => array(
        'required' => 'A Description is required.',
        'not_empty' => 'Description field must not be empty.'
    ),
    'title' => array(
        'required' => 'A Title is required.',
        'not_empty' => 'Title field must not be empty.',
        'unique'	=> 'The Title must be unique'
    ),
    'body' => array(
        'required' => 'A body is required.',
        'not_empty' => 'Body field must not be empty.'
    ),
    'created' => array(
    	'required' => 'Time is required',
		'not_empty' => 'Time must not be empty.',
		'check_timestamp' => 'Time must be a valid timestamp',
	),
	'starting_node' => array(
		'not_empty' => 'The Starting Node must not be empty',
	),
	'creator' => array(
        'required' => 'A Creator is required.',
        'not_empty' => 'Creator field must not be empty.'
    ),
);