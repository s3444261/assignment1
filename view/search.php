<?php
?>
<form action="model/answer.php" method="get">
  <div class="form-group">
    <label for="wineName">Wine Name or Part Thereof</label>
    <input type="text" class="form-control" id="wineName" placeholder="Wine Name">
  </div>
  <div class="form-group">
    <label for="wineryName">Winery Name or Part Thereof</label>
    <input type="text" class="form-control" id="wineryName" placeholder="Winery Name">
  </div>
  <div class="form-group">
    <label for="wineRegion">Wine Region</label>
    <select class="form-control">
	  <option>1</option>
	  <option>2</option>
	  <option>3</option>
	  <option>4</option>
	  <option>5</option>
	</select>
  </div>
  <div class="form-group">
    <label for="grapeVariety">Grape Variety</label>
    <select class="form-control">
	  <option>1</option>
	  <option>2</option>
	  <option>3</option>
	  <option>4</option>
	  <option>5</option>
	</select>
  </div>
  <div class="form-group">
    <label for="fromYear">From Year</label>
    <input type="text" class="form-control" id="fromYear" placeholder="(Range) From Year">
  </div>
  <div class="form-group">
    <label for="toYear">To Year</label>
    <input type="text" class="form-control" id="toYear" placeholder="(Range) To Year">
  </div>
  <div class="form-group">
    <label for="minStock">Minimum Number of Bottles in Stock (Per Wine)</label>
    <input type="text" class="form-control" id="minStock" placeholder="Minimum Stock">
  </div>
  <div class="form-group">
    <label for="minOrder">Minimum Order (Per Wine)</label>
    <input type="text" class="form-control" id="minOrder" placeholder="Minimum Order">
  </div>
  <div class="form-group">
    <label for="minPrice">Price Range - Lowest Price</label>
    <input type="text" class="form-control" id="minPrice" placeholder="Minimum Price">
  </div>
  <div class="form-group">
    <label for="maxPrice">Price Range - Highest Price</label>
    <input type="text" class="form-control" id="maxPrice" placeholder="Maximum Price">
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>
<?php
?>