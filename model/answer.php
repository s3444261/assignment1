<?php
if(!isset($_SESSION)){
	session_start();
}

include '../connect/config.php';
include '../connect/Database.php';

$redirect = "http://" . $_SERVER['HTTP_HOST'] . "/index.php?page=results";

$wineName = $_GET['wineName'];
$wineryName = $_GET['wineryName'];
$wineRegion = $_GET['wineRegion'];
$grapeVariety = $_GET['grapeVariety'];
$fromYear = $_GET['fromYear'];
$toYear = $_GET['toYear'];
$minStock = $_GET['minStock'];
$minOrder = $_GET['minOrder'];
$minPrice = $_GET['minPrice'];
$maxPrice = $_GET['maxPrice'];
$wineNameLike = '%'.$wineName.'%';
$wineNameField = false;
$conditional = false;
$wineryNameLike = '%'.$wineryName.'%';
$wineryNameField = false;

if(isset($_SESSION))
{
	$_SESSION['message'] = '';
	
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
	
	if(strlen($wineName) > 0)
	{
		if(preg_match('/^[a-zA-Z]+$/', $wineName))
		{
			$query = $query . " WHERE wine.wine_name LIKE :wineName"; 
			$wineNameField = true;
			$conditional = true;
		}
		else
		{
			$_SESSION['message'] = 'Wine name must contain letters only!';
		}
	}
	
	if(strlen($wineryName) > 0)
	{
		if(preg_match('/^[a-zA-Z \']+$/', $wineryName))
		{
			if($conditional)
			{
				$query = $query . " AND winery.winery_name LIKE :wineryName";
			}
			else 
			{
				$query = $query . " WHERE winery.winery_name LIKE :wineryName";
				$conditional = true;
			}
			
			$wineryNameField = true;
		}
		else
		{
			$_SESSION['message'] = 'Winery name must contain letters, spaces & apostrophe\'s only!';
		}
	}
	
	$_SESSION['message'] = $query;
	
	$db = Database::getInstance(); 
	$stmt = $db->prepare($query); 
	if($wineNameField)
	{
		$stmt->bindParam(':wineName', $wineNameLike);
	}
	if($wineryNameField)
	{
		$stmt->bindParam(':wineryName', $wineryNameLike);
	}
	$stmt->execute();
	
	$results = array();
	while($row = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		
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