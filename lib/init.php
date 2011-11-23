<?
if (file_exists('lib/config.php')) {
	require_once('lib/config.php');
} else {
	echo "Your config file is MIA! Please put a config.php file in the /lib/ directory.";
}

require_once DOC_ROOT.'lib/functions.php';