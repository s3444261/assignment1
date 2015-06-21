<?php
if (! class_exists ( 'Database' )) {
	require_once '../connect/Database.php';
}
class Winedata {
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
}
?>