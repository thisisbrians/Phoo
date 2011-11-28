<?php
/*
This script reads schema data from model files located in the /model/ directory
and automatically updates the configured database to reflect the schema.
*/
if (file_exists('./lib/config.php'))
{
	echo 'config file found...'.PHP_EOL;
	require_once('./lib/config.php');
	echo 'config file included...'.PHP_EOL;
}
else
{
	echo "Your config file is MIA! Please put a config.php file in the /lib/ directory.".PHP_EOL;
	exit;
}

require_once './lib/functions.php';

if ($handle = opendir('./model/'))
{
	echo "Model directory found...\n";
    echo "Model directory handle: $handle\n";
    echo "Model files:\n";

	$models = array();
    while (false !== ($file = readdir($handle)))
	{
		if ($file != '.' && $file != '..' && $file != 'ActiveRecord.php') 
		{
        	echo "$file\n";
			$models[] = $file;
		}
    }

    closedir($handle);
}
printp(dirname(__FILE__));
foreach ($models as $model) {
	$classname = '\\Model\\'.preg_replace('/\.php$/','',$model);
	$$model = new $classname();
}