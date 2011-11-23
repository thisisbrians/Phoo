<?
require_once 'lib/init.php';

if (isset($_GET['route'])) {
	$route = explode('/',$_GET['route']);
	printp($route);
} else {
	echo 'no route specified';
}

$app_controller = new Controller\Application($route);