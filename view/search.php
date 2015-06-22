<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 *
 * search.php
 * This file is used to display the form in the web page. The fields are
 * self explantory so I won't comment each one. The form is formatted
 * using Twitter Bootstrap - http://getbootstrap.com/. Methods from the
 * Winedata Class are called in various places throughout the form to
 * populate the form with data from the database.
 */
$wineData = new Winedata ();

?>
<h1>Search</h1>
<form action="model/answer.php" method="get">
	<div class="form-group">
		<label for="wineName">Wine Name</label> <input type="text"
			class="form-control" id="wineName" name="wineName"
			placeholder="Wine Name">
	</div>
	<div class="form-group">
		<label for="wineryName">Winery Name</label> <input type="text"
			class="form-control" id="wineryName" name="wineryName"
			placeholder="Winery Name">
	</div>
	<div class="form-group">
		<label for="wineRegion">Wine Region</label> <select
			class="form-control" id="wineRegion" name="wineRegion">
	  <?php echo $wineData->regionOptions(); ?>
	</select>
	</div>
	<div class="form-group">
		<label for="grapeVariety">Grape Variety</label> <select
			class="form-control" id="grapeVariety" name="grapeVariety">
		<?php echo $wineData->grapeVarietyOptions(); ?>
	</select>
	</div>
	<div class="form-group">
		<label for="fromYear">From Year</label> <select class="form-control"
			id="fromYear" name="fromYear">
		<?php echo $wineData->yearOptions(); ?>
	</select>
	</div>
	<div class="form-group">
		<label for="toYear">To Year</label> <select class="form-control"
			id="toYear" name="toYear">
		<?php echo $wineData->yearOptions(); ?>
	</select>
	</div>
	<div class="form-group">
		<label for="minStock">Minimum Stock</label> <input type="text"
			class="form-control" id="minStock" name="minStock"
			placeholder="Minimum Stock">
	</div>
	<div class="form-group">
		<label for="minOrder">Minimum Sold</label> <input type="text"
			class="form-control" id="minOrder" name="minOrder"
			placeholder="Minimum Order">
	</div>
	<div class="form-group">
		<label for="minPrice">Min Price</label> <input type="text"
			class="form-control" id="minPrice" name="minPrice"
			placeholder="Minimum Price">
	</div>
	<div class="form-group">
		<label for="maxPrice">Max Price</label> <input type="text"
			class="form-control" id="maxPrice" name="maxPrice"
			placeholder="Maximum Price"
			value="<?php echo $wineData->maxPrice(); ?>">
	</div>
	<button type="submit" class="btn btn-default">Submit</button>
</form>
<?php
?>