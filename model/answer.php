<?php
if(!isset($_SESSION)){
	session_start();
}

include '../connect/config.php';
include '../connect/Database.php';

$redirect = "http://" . $_SERVER['HTTP_HOST'] . "/index.php?page=results";

/*
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
*/
$query = "SELECT wine.year, wine.wine_name, wine_type.wine_type, 
			grape_variety.variety, winery.winery_name, region.region_name, 
			inventory.on_hand, inventory.cost
			FROM wine
			JOIN wine_type ON wine.wine_type = wine_type.wine_type_id
			JOIN wine_variety ON wine.wine_id = wine_variety.wine_id
			JOIN grape_variety ON grape_variety.variety_id = wine_variety.variety_id
			JOIN winery ON wine.winery_id = winery.winery_id
			JOIN region ON winery.region_id = region.region_id
			JOIN inventory ON inventory.wine_id = wine.wine_id";

if(isset($_SESSION)){

	$db = Database::getInstance(); 
	$stmt = $db->prepare($query); 
	$stmt->execute();
	
	$results = array();
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		
		$result = array('year' => $row['year'],
						'name' => $row['wine_name'],
						'type' => $row['wine_type'],
						'variety' => $row['variety'],
						'winery' => $row['winery_name'],
						'region' => $row['region_name'],
						'onhand' => $row['on_hand'],
						'cost' => $row['cost']);
	
		$results[] = $result;
	} 
}

$_SESSION['results'] = $results;
 
header('Location: ' . $redirect);
die();
?>