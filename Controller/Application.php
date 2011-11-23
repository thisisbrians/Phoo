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
	
	protected function _route()
	{
		if (isset($this->route[0]))
		{
			$this->node = $this->route[0];
			$this->route = array_slice($this->route,1);
			if (method_exists($this,$this->node))
			{
				$method = $this->node;
				$this->$method();
			}
			else
			{
				echo 'route not defined!';
			}
			
		}
		else
		{
			$this->_index();
		}
	}
	
	#Define routes down here:
	
	#The default route
	protected function _index()
	{
		echo 'Application: Defaulting to index.';
	}
	
	protected function users() 
	{
		#route to the Users controller
		new Users($this->route);
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