<?php
$driver = Driver::getInstance ();
?>
<div class="container-fluid">
	<div class="row">
		<div
			class="col-md-<?php echo $driver->column(); ?> col-md-offset-<?php echo $driver->offset(); ?>">