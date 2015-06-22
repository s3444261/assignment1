<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 *
 * header.php
 * This file is used to incorporate the header information at the top of the page.
 * The base code for the header was obtained from the Twitter Bootstrap -
 * http://getbootstrap.com/ site and modified by myself. I have added a meta tag
 * to prevent the search engines from indexing the site and added my own css in
 * addition to the bootstrap css.
 */
$title = 'Assignment 1';
$page = 'view/search.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<meta name="robots" content="noindex, nofollow" />
<title><?php echo $title; ?></title>

<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/main.css" rel="stylesheet">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
			      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
			    <![endif]-->
</head>
<body>
<?php
?>