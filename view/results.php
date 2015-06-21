<?php
echo '<h1>Results</h1>';

echo $_SESSION['message'] . '<br /><br />';

echo '<table class="table table-condensed">';
echo '<tr>';
echo '<th>Year</th>';
echo '<th>Wine</th>';
echo '<th>Type</th>';
echo '<th>Variety</th>';
echo '<th>Winery</th>';
echo '<th>Region</th>';
echo '<th>On Hand</th>';
echo '<th>Cost</th>';
echo '</tr>';

for($i = 0; $i < count($_SESSION['results']); $i++)
{
	echo '<tr>';
	echo '<td>' , $_SESSION['results'][$i]['year'] . '</td>';
	echo '<td>' , $_SESSION['results'][$i]['name'] . '</td>';
	echo '<td>' , $_SESSION['results'][$i]['type'] . '</td>';
	echo '<td>' , $_SESSION['results'][$i]['variety'] . '</td>';
	echo '<td>' , $_SESSION['results'][$i]['winery'] . '</td>';
	echo '<td>' , $_SESSION['results'][$i]['region'] . '</td>';
	echo '<td>' , $_SESSION['results'][$i]['onhand'] . '</td>';
	echo '<td>' , $_SESSION['results'][$i]['cost'] . '</td>';
	echo '</tr>';
}
echo '</table>';
?>