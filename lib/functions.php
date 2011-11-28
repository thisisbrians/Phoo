<?php
/*
automatically includes file for classes that have not yet been included. uses '::' to delimit directory names, i.e. 'new controllers::Product($arg);' would include the file controllers/Product.php
*/
function __autoload($className) 
{
	$file = ABS_PATH.str_replace("\\", DIRECTORY_SEPARATOR, $className) . '.php';
	if(!file_exists($file))
	{
		return false;
	}
	else 
	{
		require_once $file;
	}
}

/*
handles errors
*/
function error($message) {
	if (DEV)
	{
		echo $message;
		exit;
	}
	else
	{
		//email error, or at the very least, log it
	}
}

/*
print variables, arrays, and objects in human readable form using <pre> tags
*/
function printp($var) {
	echo '<pre>';
	print_r($var);
	echo '</pre>';
}