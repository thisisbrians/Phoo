<?
namespace Controller;

class Application {
	protected $route;
	function __construct($route)
	{
		if (isset($_GET['route']))
		{
			$this->route = explode('/',$_GET['route']);
		}
		$this->_route();
	}
	
	private function _route()
	{
		if (isset($this->route))
		{
			$node = $this->route[0];
			if (method_exists($this,$node))
			{
				$this->$node();
			}
			else
			{
				echo 'Invalid route!';
			}
			
		}
		else
		{
			$this->_index();
		}
	}
	
	#Define route end-points down here:
	
	#The default route
	protected function _index()
	{
		echo 'Defaulting to index.';
	}
	
	protected function sample_dest()
	{
		echo 'You have reached sample_dest. This view is embedded in the controller. There is no model, yet.';
	}
	
	protected function sample_dest_2()
	{
		echo 'You have reached sample_dest_2. This view is embedded in the controller. There is no model, yet.';
	}
}