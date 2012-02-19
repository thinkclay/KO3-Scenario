<?php
class Model_Mango_Scenario extends Mango {

	protected $_fields = array(
	/*
		'description'	=> array(
			'type'		=>'string',
			'required' 	=> true,
			'not_empty'	=> true,
		),*/
		'title'	=> array(
			'type'		=>'string',
			'required' 	=> true,
			'not_empty'	=> true,
			'unique'	=> true,
		),
		'starting_node'		=> array(
			'type'		=>'string',
			'not_empty'	=> true,
		),
		'created'		=> array(
			'type'		=> 'string',
			'required'	=> true,
			'not_empty'	=> true,
			'rules' => 
			    array( 
			    	array( array(':model', 'check_timestamp')), 
			    )
		),
		'creator'	=> array(
			'type'		=> 'string',
			'required'	=> true,
			'not_empty'	=> true,
		),
	);

	protected $_db = 'default'; //don't use default db config
	
	
	public function check_timestamp($val) 
    {
        if (!empty($val))
        {
            if(is_numeric($val))
            {
                if(strlen($val) > 6)
                {
                    return true;    
                } else { return false; }
            } else { return false; }        
        } else { return false; }
    }
}