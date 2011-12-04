<?php
namespace View;

class View
{
	function __construct($data)
	{
		$this->view = $data['_view'];
		//echo $this->view.'<br/>';
		foreach ($data as $key=>$datum)
		{
			$$key = $datum;
		}
		require_once($this->view);
	}
}