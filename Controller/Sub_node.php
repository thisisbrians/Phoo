<?
namespace Controller;

class Sub_node extends Application
{
	protected $dynamic = false;
	function __construct($route) {
		# you can modify the route here, if need be
		$this->route = $route;
		$this->_route();
	}
	
	#Define routes down here:
	
	#The default route
	protected function _index()
	{
		$this->_render('This is the sub_node page.');
	}
	
	protected function about() {
		$this->_render('The sub_node is a node one step beyond the user node.');
	}
}