<?
namespace Controller;

class Application
{
	protected $route;
	protected $dynamic = false;
	
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
			$this->route = array_slice($this->route,1); // remove the part of the route handled by this controller
			if ($this->node != '_index' && method_exists($this,$this->node))
			{
				$method = $this->node;
				$this->$method();
			}
			elseif ($this->dynamic)
			{
				//remember to perform your own validation for correct URLs in your dynamic routes, and to run _404() when appropriate
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
		header("HTTP/1.0 404 Not Found");
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
		$this->_render('Welcome to the homepage!');
	}
	
	protected function users() 
	{
		#route to the Users controller
		new Users($this->route);
	}
	
	private function sample_page()
	{
		echo 'You have reached sample_page. This view is embedded in the controller. There is no model, yet.';
	}
	
	private function sample_page_2()
	{
		echo 'You have reached sample_page_2. This view is embedded in the controller. There is no model, yet.';
	}
	
	#If this controller is dynamic, handle that behaviour here
	protected function _dynamic()
	{
	}
}