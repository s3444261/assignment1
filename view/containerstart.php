<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 *
 * containerstart.php
 * This file is used to incorporate the beginning of the container in the
 * body of the webpage. The base code for the footer was obtained from the Twitter Bootstrap -
 * http://getbootstrap.com/ site. I have used the controller to take advantage of Bootstrap's
 * responsive design and best format it based on the page content that is being displayed.
 * ie. Different column widths and offsets are used depending on whether search.php is being
 * displayed or results.php. The various Bootstrap classes ensure the content is well
 * presented regardless of the width of the browser, be it a mobile phone or a large display.
 */
$driver = Driver::getInstance ();
?>
<div class="container-fluid">
	<div class="row">
		<div
			class="col-lg-<?php echo $driver->column(1); ?> col-md-<?php echo $driver->column(2); ?> col-sm-<?php echo $driver->column(3); ?> col-xs-<?php echo $driver->column(4); ?>
			col-md-offset-<?php echo $driver->offset(1); ?> col-md-offset-<?php echo $driver->offset(2); ?> col-sm-offset-<?php echo $driver->offset(3); ?> col-xs-offset-<?php echo $driver->offset(4); ?>">