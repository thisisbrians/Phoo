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
			if ($this->node != '_index' && method_exists($this,$this->node))
			{
				$method = $this->node;
				$this->$method();
			}
			elseif ($this->dynamic)
			{
				#remember to perform your own validation for dynamic routes, and to run _404() when appropriate
				$this->_dynamic();
			}
			else
			{
				$this->_404();
			}
			
		}
		else
		{
			$this->_index();
		}
	}
	
	protected function _render($var)
	{
		if(count($this->route))
		{
			$this->_404();
		}
		else
		{
			echo $var;
		}
	}
	
	# you can overwrite this on a per-controller basis, if you wish
	protected function _404($message = null)
	{
		echo 'Sorry, we couldn\'t find the page your were looking for';
		if (isset($message))
		{
			echo ': '.$message;
		}
		else
		{
			echo '.';
		}
	}
	
	#Define routes down here:
	
	#The default route
	protected function _index()
	{
		$this->_render('Application: Defaulting to index.');
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
	
	#If this controller is dynamic, handle that behaviour here
	protected function _dynamic()
	{
	}
}