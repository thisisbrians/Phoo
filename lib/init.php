<?
/*
automatically includes file for classes that have not yet been included. uses '::' to delimit directory names, i.e. 'new controllers::Product($arg);' would include the file controllers/Product.php
*/
function __autoload($className) 
{
        $file = str_replace('::', DIRECTORY_SEPARATOR, $className) . '.php';

        if(!file_exists($file))
        {
                return false;
        }
        else 
        {
                require_once $file;
        }
}

if (file_exists('lib/config.php')) {
	require_once('lib/config.php');
} else {
	echo "You don't have a config file! Please put a config.php file in the /lib/ directory.";
}