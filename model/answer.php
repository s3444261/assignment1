<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 *
 * answer.php
 * This purpose of this is to retrieve the data sent from the search view by way
 * of HTTP GET, validate it, process it and return it in a format to be used by
 * the results view.
 *
 * The processing procedure works on the premise that all data is displayed unless
 * the various filters are correctly employed in the search form to refine the data
 * to be displayed.
 */

// Start a session if one does not already exist.
if (! isset ( $_SESSION )) {
	session_start ();
}

// Include the required files to process the data.
include '../connect/config.php';
require_once '../connect/Database.php';

// This variable provides the destination of the results view.
$redirect = "http://" . $_SERVER ['HTTP_HOST'] . "/index.php?page=results";

// Variables
$wineName = $_GET ['wineName'];
$wineryName = $_GET ['wineryName'];
$wineRegion = $_GET ['wineRegion'];
$grapeVariety = $_GET ['grapeVariety'];
$fromYear = $_GET ['fromYear'];
$toYear = $_GET ['toYear'];
$fromYearInt = intval ( $_GET ['fromYear'] );
$toYearInt = intval ( $_GET ['toYear'] );
$minStock = $_GET ['minStock'];
$minOrder = $_GET ['minOrder'];
$minPrice = $_GET ['minPrice'];
$maxPrice = $_GET ['maxPrice'];
$minPriceFloat = floatval ( $_GET ['minPrice'] );
$maxPriceFloat = floatval ( $_GET ['maxPrice'] );
$wineNameLike = '%' . $wineName . '%';
$wineNameField = false;
$conditional = false;
$wineryNameLike = '%' . $wineryName . '%';
$wineryNameField = false;
$wineRegionField = false;
$grapeVarietyField = false;
$yearField = false;
$minStockField = false;
$minOrderField = false;
$priceField = false;

// The message session variable will be used to display error mesages to the user
// on the results page in the event that a field recieves an invalid input.
if (isset ( $_SESSION )) {
	$_SESSION ['message'] = '';
	
	// This is the base query that will display all the required data on the results page
	// without any filtering.
	$query = "SELECT wine.year, wine.wine_name, wine_type.wine_type,
			grape_variety.variety, winery.winery_name, region.region_name,
			inventory.on_hand, inventory.cost,
			(SELECT SUM(qty) FROM items WHERE items.wine_id = wine.wine_id) AS sold,
			(SELECT SUM(price) FROM items WHERE items.wine_id = wine.wine_id) AS revenue
			FROM wine
			JOIN wine_type ON wine.wine_type = wine_type.wine_type_id
			JOIN wine_variety ON wine.wine_id = wine_variety.wine_id
			JOIN grape_variety ON grape_variety.variety_id = wine_variety.variety_id
			JOIN winery ON wine.winery_id = winery.winery_id
			JOIN region ON winery.region_id = region.region_id
			JOIN inventory ON inventory.wine_id = wine.wine_id";
	
	// Wine Name Filter
	// The variable is tested to ensure firstly that it is not empty and secondly that is consists
	// of alpha characters only. In the event characters other than alpha characters are used, the
	// filter condition is not added to the base query. An error message is added to the session
	// message.
	if (strlen ( $wineName ) > 0) {
		if (preg_match ( '/^[a-zA-Z]+$/', $wineName )) {
			$query = $query . " WHERE wine.wine_name LIKE :wineName";
			$wineNameField = true;
			$conditional = true;
		} else {
			$_SESSION ['message'] = $_SESSION ['message'] . 'Wine name must contain letters only!<br />';
		}
	}
	
	// Winery Name Filter
	// The variable is tested to ensure firstly that it is not empty and secondly that is consists
	// of alphanuric characters. Apostrophes are also permitted. In the event characters other than alphanumeric
	// characters or apostrophes, the filter condition is not added to the base query. An error message is added
	// to the session message. If the filter condition is to be added, we check to see if it is the first filter
	// added. If it is, it is preceeded with a 'WHERE', if not, it is preceeded with an 'AND'.
	if (strlen ( $wineryName ) > 0) {
		if (preg_match ( '/^[a-zA-Z \']+$/', $wineryName )) {
			if ($conditional) {
				$query = $query . " AND winery.winery_name LIKE :wineryName";
			} else {
				$query = $query . " WHERE winery.winery_name LIKE :wineryName";
				$conditional = true;
			}
			$wineryNameField = true;
		} else {
			$_SESSION ['message'] = $_SESSION ['message'] . 'Winery name must contain letters, spaces & apostrophe\'s only!<br />';
		}
	}
	
	// Wine Region Filter
	// The variable is tested to ensure that it is not empty or set to All, which is the same as not
	// applying the filter. We check to see if it is the first filter added. If it is, it is preceeded with
	// a 'WHERE', if not, it is preceeded with an 'AND'.
	if (strlen ( $wineRegion ) > 0 && $wineRegion != 'All') {
		if ($conditional) {
			$query = $query . " AND region.region_name = :wineRegion";
		} else {
			$query = $query . " WHERE region.region_name = :wineRegion";
			$conditional = true;
		}
		
		$wineRegionField = true;
	}
	
	// Grape Variety Filter
	// The variable is tested to ensure that it is not empty. We check to see if it is the first filter
	// added. If it is, it is preceeded with a 'WHERE', if not, it is preceeded with an 'AND'.
	if (strlen ( $grapeVariety ) > 0) {
		if ($conditional) {
			$query = $query . " AND grape_variety.variety = :grapeVariety";
		} else {
			$query = $query . " WHERE grape_variety.variety = :grapeVariety";
			$conditional = true;
		}
		
		$grapeVarietyField = true;
	}
	
	// The Year Filter
	// The Year Filter takes data from two fields, the fromYear field and the toYear field. As the data is
	// selected from dropdown items in each instance, the data does not have to be validated. However there
	// are various combinations of inputs that need to be taken into account. Those combinations are treated
	// as follows:
	// If data is received from either the fromYear or the toYear, the filter will be applied.
	// If only fromYear has been supplied, all years greater than or equal to that year will be returned.
	// if only toYear has been suppled, all years less than or equal to that year will be returned.
	// If data has been received from both the fromYear and the toYear, all years will be returned that are
	// greater than or equal to the smaller of the two years, and less than or equal to the larger of the
	// two years. We check to see if it is the first filter added. If it is, it is preceeded with a 'WHERE',
	// if not, it is preceeded with an 'AND'.
	if (strlen ( $fromYear ) > 0 || strlen ( $toYear ) > 0) {
		
		$yearQuery = '';
		
		if (strlen ( $fromYear ) > 0 && strlen ( $toYear ) == 0) {
			$yearQuery = "wine.year = :fromYear";
		} else if (strlen ( $fromYear ) == 0 && strlen ( $toYear ) > 0) {
			$yearQuery = "wine.year = :toYear";
		} else if (strlen ( $fromYear ) > 0 && strlen ( $toYear ) > 0) {
			if ($fromYearInt > $toYearInt) {
				$yearQuery = "wine.year >= :toYear AND wine.year <= :fromYear";
			} else if ($fromYearInt < $toYearInt) {
				$yearQuery = "wine.year >= :fromYear AND wine.year <= :toYear";
			} else if ($fromYearInt == $toYearInt) {
				$yearQuery = "wine.year = :fromYear";
			}
		}
		if ($conditional) {
			$query = $query . " AND " . $yearQuery;
		} else {
			$query = $query . " WHERE " . $yearQuery;
			$conditional = true;
		}
		
		$yearField = true;
	}
	
	// The Minimum Stock Filter
	// This filter will only be applied if an integer has been entered into the field.
	// Should an value other than an integer be entered, an error message is added to the
	// session message to be displayed with the results. Should the input be validated,
	// we check to see if it is the first filter added. If it is, it is preceeded with a 'WHERE',
	// if not, it is preceeded with an 'AND'. Only results with stock numbers greater than or
	// equal to the input will be returned.
	if (strlen ( $minStock ) > 0) {
		if (preg_match ( '/^[0-9]+$/', $minStock )) {
			if ($conditional) {
				$query = $query . " AND inventory.on_hand >= :minStock";
			} else {
				$query = $query . " WHERE inventory.on_hand >= :minStock";
				$conditional = true;
			}
			$minStockField = true;
		} else {
			$_SESSION ['message'] = $_SESSION ['message'] . 'Minimum Stock must be an Integer!<br />';
		}
	}
	
	// The Minimum Order Filter
	// This filter will only be applied if an integer has been entered into the field.
	// Should an value other than an integer be entered, an error message is added to the
	// session message to be displayed with the results. Should the input be validated,
	// we check to see if it is the first filter added. If it is, it is preceeded with a 'WHERE',
	// if not, it is preceeded with an 'AND'. Only results with total orders greater than or
	// equal to the input will be returned.
	if (strlen ( $minOrder ) > 0) {
		if (preg_match ( '/^[0-9]+$/', $minOrder )) {
			if ($conditional) {
				$query = $query . " AND (SELECT SUM(qty) FROM items WHERE items.wine_id = wine.wine_id) >= :minOrder";
			} else {
				$query = $query . " WHERE (SELECT SUM(qty) FROM items WHERE items.wine_id = wine.wine_id) >= :minOrder";
				$conditional = true;
			}
			$minOrderField = true;
		} else {
			$_SESSION ['message'] = $_SESSION ['message'] . 'Minimum Order must be an Integer!<br />';
		}
	}
	
	// The Price Filter
	// The Price Filter takes data from two fields, the minPrice field and the maxPrice field. The minPrice field is
	// initially empty. The maxPrice field has been pre-populated with the maximum price of any bottle of wine in
	// the inventory. Any inputs are validated to ensure they are either an integer or a decimal. (The parenthises
	// followed by the question mark in the regex allows for a period followed by numerals to be optional). Where
	// invalid data has been entered, the appropriate error message is appended to the session messages. Once
	// any inputs have been validated, there are various combinations of inputs that need to be taken into account.
	// Those combinations are treated as follows:
	// If data is received from either the minPrice or the maxPrice, the filter will be applied.
	// If only minPrice has been supplied, all prices greater than or equal to that price will be returned.
	// if only maxPrice has been suppled, all prices less than or equal to that price will be returned.
	// If data has been received from both the minPrice and the maxPrice, all prices will be returned that are
	// greater than or equal to the smaller of the two prices, and less than or equal to the larger of the
	// two prices. We check to see if it is the first filter added. If it is, it is preceeded with a 'WHERE',
	// if not, it is preceeded with an 'AND'.
	if ((strlen ( $minPrice ) > 0 && preg_match ( '/^[0-9]+(\.[0-9]+)?$/', $minPrice )) || (strlen ( $minPrice ) == 0)) {
		if ((strlen ( $maxPrice ) > 0 && preg_match ( '/^[0-9]+(\.[0-9]+)?$/', $maxPrice )) || (strlen ( $maxPrice ) == 0)) {
			
			$priceQuery = '';
			
			if (strlen ( $minPrice ) > 0 && strlen ( $maxPrice ) == 0) {
				$priceQuery = "inventory.cost >= :minPrice";
			} else if (strlen ( $minPrice ) == 0 && strlen ( $maxPrice ) > 0) {
				$priceQuery = "inventory.cost <= :maxPrice";
			} else if (strlen ( $minPrice ) > 0 && strlen ( $maxPrice ) > 0) {
				if ($minPriceFloat > $maxPriceFloat) {
					$priceQuery = "inventory.cost >= :maxPrice AND inventory.cost <= :minPrice";
				} else if ($minPriceFloat < $maxPriceFloat) {
					$priceQuery = "inventory.cost >= :minPrice AND inventory.cost <= :maxPrice";
				} else if ($minPriceFloat == $maxPriceFloat) {
					$priceQuery = "inventory.cost = :minPrice";
				}
			}
			if ($conditional) {
				$query = $query . " AND " . $priceQuery;
			} else {
				$query = $query . " WHERE " . $priceQuery;
				$conditional = true;
			}
			
			$priceField = true;
		} else {
			$_SESSION ['message'] = $_SESSION ['message'] . 'Maximum price value must be a Decimal!<br />';
		}
	} else {
		$_SESSION ['message'] = $_SESSION ['message'] . 'Minimum price value must be a Decimal!<br />';
	}
	
	// Where a filter is to be applied the required parameters need to be binded to the statement.
	$db = Database::getInstance ();
	$stmt = $db->prepare ( $query );
	if ($wineNameField) {
		$stmt->bindParam ( ':wineName', $wineNameLike );
	}
	if ($wineryNameField) {
		$stmt->bindParam ( ':wineryName', $wineryNameLike );
	}
	if ($wineRegionField) {
		$stmt->bindParam ( ':wineRegion', $wineRegion );
	}
	if ($grapeVarietyField) {
		$stmt->bindParam ( ':grapeVariety', $grapeVariety );
	}
	if ($yearField) {
		if (strlen ( $fromYear ) > 0 && strlen ( $toYear ) == 0) {
			$stmt->bindParam ( ':fromYear', $fromYear );
		} else if (strlen ( $fromYear ) == 0 && strlen ( $toYear ) > 0) {
			$stmt->bindParam ( ':toYear', $toYear );
		} else if (strlen ( $fromYear ) > 0 && strlen ( $toYear ) > 0) {
			if ($fromYearInt != $toYearInt) {
				$stmt->bindParam ( ':fromYear', $fromYear );
				$stmt->bindParam ( ':toYear', $toYear );
			} else if ($fromYearInt == $toYearInt) {
				$stmt->bindParam ( ':fromYear', $fromYear );
			}
		}
	}
	if ($minStockField) {
		$stmt->bindParam ( ':minStock', $minStock );
	}
	if ($minOrderField) {
		$stmt->bindParam ( ':minOrder', $minOrder );
	}
	if ($priceField) {
		if (strlen ( $minPrice ) > 0 && strlen ( $maxPrice ) == 0) {
			$stmt->bindParam ( ':minPrice', $minPrice );
		} else if (strlen ( $minPrice ) == 0 && strlen ( $maxPrice ) > 0) {
			$stmt->bindParam ( ':maxPrice', $maxPrice );
		} else if (strlen ( $minPrice ) > 0 && strlen ( $maxPrice ) > 0) {
			if ($minPriceFloat != $maxPriceFloat) {
				$stmt->bindParam ( ':minPrice', $minPrice );
				$stmt->bindParam ( ':maxPrice', $maxPrice );
			} else if ($minPriceFloat == $maxPriceFloat) {
				$stmt->bindParam ( ':minPrice', $minPrice );
			}
		}
	}
	
	// Finally the query is executed.
	$stmt->execute ();
	
	// The results are stored in a multidimensional associative array.
	$results = array ();
	while ( $row = $stmt->fetch ( PDO::FETCH_ASSOC ) ) {
		
		$result = array (
				'year' => $row ['year'],
				'name' => $row ['wine_name'],
				'type' => $row ['wine_type'],
				'variety' => $row ['variety'],
				'winery' => $row ['winery_name'],
				'region' => $row ['region_name'],
				'onhand' => $row ['on_hand'],
				'cost' => $row ['cost'],
				'sold' => $row ['sold'],
				'revenue' => $row ['revenue'] 
		);
		
		$results [] = $result;
	}
}

// The results are stored in a session variable that can be used by results.php
// to display the output. A session variable is used so that the results.php
// may be refreshed without having to return to answer.php and require the database
// to be queried again.
$_SESSION ['results'] = $results;

// Finally the user is redirected to the results page to view the results.
header ( 'Location: ' . $redirect );
die ();
?>