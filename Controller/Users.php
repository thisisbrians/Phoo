<?
namespace Controller;

class Users extends Application
{
	protected $dynamic = true;
	function __construct($route) {
		# you can modify the route here, if need be
		$this->route = $route;
		$this->_route();
	}
	
	#Define routes down here:
	
	#The default route
	protected function _index()
	{
		echo 'Users: Defaulting to index.';
	}
}