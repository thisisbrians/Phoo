<?
include 'lib/init.php';

if (isset($_GET['route'])) {
	$route = explode('/',$_GET['route']);
	print_r($route);
} else {
	echo 'no route specified';
}