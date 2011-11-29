<?php
/*
This script reads schema data from model files located in the /model/ directory
and automatically updates the configured database to reflect the schema.
*/

// include the config
if (file_exists('./lib/config.php'))
{
	echo "config file found...\n";
	require_once('./lib/config.php');
}
else
{
	echo "Your config file is MIA! Please put a config.php file in the /lib/ directory.".PHP_EOL;
	exit;
}

// include functions
require_once './lib/functions.php';

// open up the model directory
if ($handle = opendir('./model/'))
{
	echo "Model directory found...\n";
    echo "Model directory handle: $handle\n";

	echo "Instantiating ActiveRecord object...\n";
	$ActiveRecord = new \Model\ActiveRecord();
	
	echo "Fetching database class...\n";
	$mysqli = $ActiveRecord->get_mysqli();
	
	echo "Fetching type definitions...\n";
	$types = $ActiveRecord->get_types();
	print_r($types);
	
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
foreach ($models as $model) {
	$model = preg_replace('/\.php$/','',$model); // nix the '.php' from the end of the filename
	$classname = '\\Model\\'.$model;
	$$model = new $classname();
	
	$sql = "CREATE TABLE IF NOT EXISTS `".DB_NAME."`.`".$model."` (
		    `id` INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,"; 
	foreach ($$model->get_schema() as $property=>$type)
	{
		$sql .= "`".$property."` ".$types[$type].",";
	}
	$sql .= "`created` INT(10) NOT NULL, 
		     `modified` INT(10) NOT NULL
		      ) ENGINE = MyISAM;";
	$mysqli->query($sql);
}