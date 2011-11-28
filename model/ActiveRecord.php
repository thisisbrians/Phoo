<?php
namespace Model;

class ActiveRecord
{
	protected $mysqli;
	protected $types = array
	(
		'string' => 'VARCHAR(255) NOT NULL'
	);
	function __construct() 
	{
		// open MySQL database
		$this->mysqli = new \mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	}	
	
	protected function _update_table()
	{
		$sql = "CREATE TABLE IF NOT EXISTS `".DB_NAME."`.`".get_class($this)."` (
			    	`id` INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,"; 
		foreach ($this->schema as $property=>$type)
		{
			$sql .= "`".$property."` ".$this->types[$type].",";
		}
		$sql .= "`created` INT(10) NOT NULL, 
			     `modified` INT(10) NOT NULL
			      ) ENGINE = MyISAM;";
		echo $sql;
		$this->mysqli->query($sql);
	}
	
	public function set($var,$value)
	{
		if (property_exists($this, $var))
		{
			$this->$var = $value;
		}
			else
		{
			error('error: property \''.$var.'\' not defined for class '.get_class());
		}
	}
	
	public function get($var)
	{
		if (property_exists($this, $var))
		{
			$this->$var = $value;
		}
			else
		{
			error('error: property \''.$var.'\' not defined for class '.get_class());
		}
	}
}