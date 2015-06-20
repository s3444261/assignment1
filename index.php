<?php
if(!isset($_SESSION)){
    session_start();
}

include 'connect/config.php';
include 'connect/Database.php';
include 'controller/Driver.php';

$driver = new Driver();

if(isset($_GET['page'])){
	$driver->page = $_GET['page'];
}
$driver->display();

?>