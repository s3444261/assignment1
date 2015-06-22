<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 *
 * Winedata Class
 * This purpose of this class is to retrieve data from the Winestore database and
 * return it as a string that is suitable for incorporating the results into the
 * search form view.
 */

// Proves access to the the class needed to connect to the database if it is not
// already available.
if (! class_exists ( 'Database' )) {
	require_once '../connect/Database.php';
}

// Winedata Class
class Winedata {
	
	// Returns all regions available in the database in a format suitable to be
	// used in a dropdown form.
	public function regionOptions() {
		$query = "SELECT region_name FROM region";
		$options = '<option></option>';
		
		$db = Database::getInstance ();
		$stmt = $db->prepare ( $query );
		$stmt->execute ();
		while ( $row = $stmt->fetch ( PDO::FETCH_ASSOC ) ) {
			$options = $options . '<option>' . $row ['region_name'] . '</option>';
		}
		return $options;
	}
	
	// Returns all grape varieties available in the database in a format suitable
	// to be used in a dropdown form.
	public function grapeVarietyOptions() {
		$query = "SELECT variety FROM grape_variety";
		$options = '<option></option>';
		
		$db = Database::getInstance ();
		$stmt = $db->prepare ( $query );
		$stmt->execute ();
		while ( $row = $stmt->fetch ( PDO::FETCH_ASSOC ) ) {
			$options = $options . '<option>' . $row ['variety'] . '</option>';
		}
		return $options;
	}
	
	// Returns all years that have a wine listed in the inventory in a format
	// suitable to be used in a dropdown form.
	public function yearOptions() {
		$query = "SELECT year FROM wine GROUP BY year ORDER BY year ASC";
		$options = '<option></option>';
		
		$db = Database::getInstance ();
		$stmt = $db->prepare ( $query );
		$stmt->execute ();
		while ( $row = $stmt->fetch ( PDO::FETCH_ASSOC ) ) {
			$options = $options . '<option>' . $row ['year'] . '</option>';
		}
		return $options;
	}
	
	// Returns the maximum price of any bottle of wine listed in the inventory.
	public function maxPrice() {
		$query = "SELECT MAX(cost) AS maxPrice FROM inventory";
		
		$db = Database::getInstance ();
		$stmt = $db->prepare ( $query );
		$stmt->execute ();
		$row = $stmt->fetch ( PDO::FETCH_ASSOC );
		
		return $row ['maxPrice'];
	}
}
?>