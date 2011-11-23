<?
if (file_exists('lib/config.php')) {
	require_once('lib/config.php');
} else {
	echo "You don't have a config file! Please put a config.php file in the /lib/ directory.";
}

require_once DOC_ROOT.'lib/functions.php';