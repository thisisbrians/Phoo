<?php
namespace Controller;

class Users extends Application
{
	protected $dynamic = true;
	function __construct($route)
	{
		$this->user = new \Model\User();
		
		# you can modify the route here, if need be
		$this->route = $route;
		$this->_route();
	}
	
	#Define routes down here:
	
	#The default route
	protected function _index()
	{
		$this->data['users'] = $this->user->get('all');
		$this->_render('index');
	}
	
	protected function sub_node()
	{
		#route to the sub_node controller
		new Sub_node($this->route);
	}
	
	protected function create()
	{
		$this->_render('create');
	}
	
	#If this controller is dynamic, handle that behaviour here
	protected function _dynamic()
	{
		$user = $this->user->get($this->node);
		if ($user)
		{
			$this->data['user'] = $user;
			$this->_render('user');
		}
		else
		{
			$this->_404('user not found!');
		}
	}
}