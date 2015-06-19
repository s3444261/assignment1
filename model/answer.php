<?php
if(!isset($_SESSION)){
	session_start();
}

$redirect = "http://" . $_SERVER['HTTP_HOST'] . "/index.php?page=results";
$wineName = $_GET['wineName'];
$wineryName = $_GET['wineryName'];
$wineRegion = $_GET['wineRegion'];
$grapeVariety = $_GET['grapeVariety'];
$fromYear = $_GET['fromYear'];
$toYear = $_GET['toYear'];
$minStock = $_GET['minStock'];
$maxStock = $_GET['maxStock'];
$minOrder = $_GET['minOrder'];
$maxOrder = $_GET['maxOrder'];
$minPrice = $_GET['minPrice'];
$maxPrice = $_GET['maxPrice'];


if(isset($_SESSION)){
	$_SESSION['results']['wineName'] = $wineName;
	$_SESSION['results']['wineryName'] = $wineryName;
}

header('Location: ' . $redirect);
die();
?>