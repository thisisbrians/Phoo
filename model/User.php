<?php
namespace Model;

class User extends ActiveRecord
{
	protected $name;
	protected $schema = array
	(
		'name' => 'string'
	);
	function __construct() 
	{
		parent::__construct();
	}	
}