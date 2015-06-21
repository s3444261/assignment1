<?php
$wineData = new Winedata ();

?>
<h1>Search</h1>
<form action="model/answer.php" method="get">
	<div class="form-group">
		<label for="wineName">Wine Name or Part Thereof</label> <input
			type="text" class="form-control" id="wineName" name="wineName"
			placeholder="Wine Name">
	</div>
	<div class="form-group">
		<label for="wineryName">Winery Name or Part Thereof</label> <input
			type="text" class="form-control" id="wineryName" name="wineryName"
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
		<label for="fromYear">From Year</label> <input type="text"
			class="form-control" id="fromYear" name="fromYear"
			placeholder="(Range) From Year">
	</div>
	<div class="form-group">
		<label for="toYear">To Year</label> <input type="text"
			class="form-control" id="toYear" name="toYear"
			placeholder="(Range) To Year">
	</div>
	<div class="form-group">
		<label for="minStock">Minimum Number of Bottles in Stock (Per Wine)</label>
		<input type="text" class="form-control" id="minStock" name="minStock"
			placeholder="Minimum Stock">
	</div>
	<div class="form-group">
		<label for="minOrder">Minimum Order (Per Wine)</label> <input
			type="text" class="form-control" id="minOrder" name="minOrder"
			placeholder="Minimum Order">
	</div>
	<div class="form-group">
		<label for="minPrice">Price Range - Lowest Price</label> <input
			type="text" class="form-control" id="minPrice" name="minPrice"
			placeholder="Minimum Price">
	</div>
	<div class="form-group">
		<label for="maxPrice">Price Range - Highest Price</label> <input
			type="text" class="form-control" id="maxPrice" name="maxPrice"
			placeholder="Maximum Price">
	</div>
	<button type="submit" class="btn btn-default">Submit</button>
</form>
<?php
?>