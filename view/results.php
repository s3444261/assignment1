<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 *
 * results.php
 * This file is used to display the results of the search in a table.
 * The table is formatted using Twitter Bootstrap - http://getbootstrap.com/.
 * Some slight modifications to the column alignments have been made. The
 * css for this manipulation can be found in src/css/main.css
 */
echo '<h1>Results</h1>';

echo $_SESSION ['message'] . '<br /><br />';

echo '<table class="table table-condensed">';
echo '<tr>';
echo '<th>Year</th>';
echo '<th>Wine</th>';
echo '<th>Type</th>';
echo '<th>Variety</th>';
echo '<th>Winery</th>';
echo '<th>Region</th>';
echo '<th class="tableRight">Stock</th>';
echo '<th class="tableRight">Cost</th>';
echo '<th class="tableRight">Sold</th>';
echo '<th class="tableRight">Revenue</th>';
echo '</tr>';

for($i = 0; $i < count ( $_SESSION ['results'] ); $i ++) {
	echo '<tr>';
	echo '<td>', $_SESSION ['results'] [$i] ['year'] . '</td>';
	echo '<td>', $_SESSION ['results'] [$i] ['name'] . '</td>';
	echo '<td>', $_SESSION ['results'] [$i] ['type'] . '</td>';
	echo '<td>', $_SESSION ['results'] [$i] ['variety'] . '</td>';
	echo '<td>', $_SESSION ['results'] [$i] ['winery'] . '</td>';
	echo '<td>', $_SESSION ['results'] [$i] ['region'] . '</td>';
	echo '<td class="tableRight">', $_SESSION ['results'] [$i] ['onhand'] . '</td>';
	echo '<td class="tableRight">$', $_SESSION ['results'] [$i] ['cost'] . '</td>';
	echo '<td class="tableRight">', $_SESSION ['results'] [$i] ['sold'] . '</td>';
	echo '<td class="tableRight">$', $_SESSION ['results'] [$i] ['revenue'] . '</td>';
	echo '</tr>';
}

echo '</table>';
?>