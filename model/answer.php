<?php

$redirect = "http://" . $_SERVER['HTTP_HOST'] . "/index.php?page=results";

header('Location: ' . $redirect);
die();
?>