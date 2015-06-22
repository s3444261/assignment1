<?php
$driver = Driver::getInstance ();
?>
<div class="container-fluid">
	<div class="row">
		<div
			class="col-lg-<?php echo $driver->column(1); ?> col-md-<?php echo $driver->column(2); ?> col-sm-<?php echo $driver->column(3); ?> col-xs-<?php echo $driver->column(4); ?>
			col-md-offset-<?php echo $driver->offset(1); ?> col-md-offset-<?php echo $driver->offset(2); ?> col-sm-offset-<?php echo $driver->offset(3); ?> col-xs-offset-<?php echo $driver->offset(4); ?>">