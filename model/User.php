<?php
namespace Model;

class User extends ActiveRecord
{
	protected $name;
	protected $schema = array
	(
		'name' => 'string'
	);
	protected $validate = array
	(
		'name' => array 
		(
			'exists'
		)
	);
	function __construct() 
	{
		parent::__construct();
	}	
}