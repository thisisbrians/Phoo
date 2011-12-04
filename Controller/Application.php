<?php
namespace Controller;

class Application
{
	protected $route;
	protected $dynamic = false;
	protected $_viewdir;
	function __construct()
	{	
		if (isset($_GET['route']))
		{
			$this->route = explode('/',$_GET['route']);
		}
		$this->_viewdir = '/';
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
	
	protected function _render($_view=null)
	{	
		if (!isset($this->_viewdir))
		{
			// by default, fetch name of view directory from filename
			$classname = get_class($this);
			$this->_viewdir = '/'.preg_replace('/^.*\\\/','',$classname).'/'; // get everthing after 'Controller\'
		}
		
		if(count($this->route))
		{
			// should only render if this is the last node in the route
			$this->_404();
		}
		else
		{
			//construct absolute path of the view
			$this->data['_view'] = ABS_PATH.'view'.$this->_viewdir.$_view.'.php';
			
			// $this->data should be passed to the appropriate view for rendering
			new \view\View($this->data);
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
		$this->data['content'] = 'Welcome to the homepage!';
		$this->_render('index');
	}
	
	protected function users() 
	{
		#route to the Users controller
		new Users($this->route);
	}
	
	protected function sample_page()
	{
		$this->_render('You have reached sample_page. This view is embedded in the controller. There is no model, yet.');
	}
	
	protected function sample_page_2()
	{
		$this->_render('You have reached sample_page_2. This view is embedded in the controller. There is no model, yet.');
	}
	
	#If this controller is dynamic, handle that behaviour here
	protected function _dynamic()
	{
	}
}