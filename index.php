<?php
if (! isset ( $_SESSION )) {
	session_start ();
}

include 'connect/config.php';
require_once 'connect/Database.php';
include 'controller/Driver.php';
include 'model/Winedata.php';

$driver = Driver::getInstance ();

if (isset ( $_GET ['page'] )) {
	$driver->page = $_GET ['page'];
}

$driver->display ();

?>