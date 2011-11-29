<?php
namespace Model;

class ActiveRecord
{
	protected $_table;
	protected $mysqli;
	protected $types = array
	(
		'string' => 'VARCHAR(255) NOT NULL'
	);
	function __construct() 
	{
		// open MySQL database
		$this->mysqli = new \mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		
		// fetch table name from filename
		$classname = get_class($this);
		$this->_table = preg_replace('/^.*\\\/','',$classname); // get everthing after 'Model\'
	}	
	
	// magic setters, adders, and getters. setter and adder are chainable
	public function __call($name, $arguments)
	{
		if (substr($name,0,4) == 'set_')
		{
			$property = substr($name,4);
			$this->$property = $arguments[0];

		}
		elseif (substr($name,0,4) == 'add_')
		{
			$property = substr($name,4);
			array_push($this->$property, $arguments[0]);
		}
		elseif (substr($name,0,4) == 'get_')
		{
			$property = substr($name,4);
			return $this->$property;
		}

		return $this;
	}
	public function create($arguments)
	{
		$arguments['created'] = time();
		$arguments['modified'] = $arguments['created'];
		
		foreach ($arguments as $argument) {
			$prepared_arguments[] = '"'.mysql_real_escape_string($argument).'"';
		}
		
		$sql = "INSERT INTO ".$this->_table." (".implode(',',array_keys($arguments)).") VALUES (".implode(',',$prepared_arguments).")";
		$this->mysqli->query($sql);
		echo $this->mysqli->error;
	}
	
	public function get($id)
	{
		$id = mysql_real_escape_string($id);
		
		if (is_numeric($id))
		{
			$sql = "SELECT * FROM ".$this->_table." WHERE id=".$id." LIMIT 1";
			$result = $this->mysqli->query($sql);
			return $result->fetch_array(MYSQLI_ASSOC);
		}
		elseif ($id == 'all')
		{
			$sql = "SELECT * FROM ".$this->_table;
			$result = $this->mysqli->query($sql);
			while ($row = $result->fetch_array(MYSQLI_ASSOC))
			{
				$return[] = $row;
			}
			return $return;
		}
		else
		{
			return false;
		}
	}
}