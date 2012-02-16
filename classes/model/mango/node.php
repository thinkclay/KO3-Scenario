<?php
class Model_Mango_Node extends Mango {

	protected $_fields = array(
		'question'	=> array(
			'type'		=>'string',
			'required' 	=> true,
			'not_empty'	=> true,
			'unique'	=> true,
		),
		'answers'		=> array(
			'type'		=>'array',
			'not_empty' => true,
		),
		'created'		=> array(
			'type'		=> 'string',
			'required'	=> true,
			'rules' => 
			    array( 
			    	array( array(':model', 'check_timestamp')), 
			    )
		),
		'action' => array(
			'type'		=> 'string',
			'not_empty'	=> true,
		),
		'creator'	=> array(
			'type'		=> 'string',
			'required' 	=> true,
			'not_empty'	=> true,
		),
	);

	protected $_db = 'localhost'; //don't use default db config
	
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