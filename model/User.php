<?
namespace Model;

class User
{
	function __construct() 
	{
		echo 'User model instantiated.';
		$this->name = 'new user';
	}
	
	function hi() {
		echo 'hi';
	}
	
}