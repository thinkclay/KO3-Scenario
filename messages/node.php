<?php defined('SYSPATH') or die('No direct script access.');
return array(
    'question' => array(
        'required' => 'A Question is required.',
        'not_empty' => 'Question field must not be empty.',
        'unique' 	=> 'The question must be unique',
    ),
    'answers' => array(
        'not_empty' => 'the Answer field must not be empty.'
    ),
    'created' => array(
    	'required' => 'Created Time is required',
		'not_empty' => 'Created Time must not be empty.',
		'check_timestamp' => 'Created Time must be a valid timestamp',
	),
	'action' => array(
		'not_empty' => 'The Action field must not be empty',
	),
	'creator' => array(
        'required' => 'A Creator is required.',
        'not_empty' => 'Creator field must not be empty.'
    ),
);