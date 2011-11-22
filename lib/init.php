<?
include 'config.php';

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