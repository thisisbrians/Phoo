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
		echo 'This is the users page.';
	}
	
	#If this controller is dynamic, handle that behaviour here
	protected function _dynamic()
	{
		$users = array(
			'1' => 'Brian Smith',
			'2' => 'Mr. Nebo'
		);
		if (isset($users[$this->node]))
		{
			$this->_render($users[$this->node]);
		}
		else
		{
			$this->_404('user not found!');
		}
	}
}