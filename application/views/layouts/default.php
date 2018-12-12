<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?= $title_page ?></title>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>

</head>
<body>
	 <!--Main Navigation-->
	<header>
		<nav class="navbar navbar-dark bg-dark">
		   	<a class="navbar-brand" href="<?= base_url(); ?>">Test Web</a>
		</nav>
	</header>
<div id="container" class="container-fluid">
	<?= $contents ?>
</div>

</body>

</html>

