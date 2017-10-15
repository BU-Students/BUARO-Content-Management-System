<?php

if(session_status() == PHP_SESSION_NONE)
	session_start();

//if user attemps to access this page without forst logging in
if(!isset($_SESSION['id'])) {
	$_SESSION['error_msg'] = "Please log in first to continue";
	header("Location: ../php/login.php");
	exit;
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Admin Profile</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../../vendor/Bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/sidebar.css" />
		<link rel="stylesheet" href="../css/topbar.css" />
		<link rel="stylesheet" href="../css/scrollbar.css" />
		<link rel="stylesheet" href="../css/dashboard.css" />
	</head>
	</head>
	<body>
		<?php
			require_once "topbar.php";
			require_once "sidebar.php";
		?>

		<div id="content-wrapper">
			<div class="item-wrapper"><div id="greeting">
				<span>Good day Christian!</span>
			</div></div>
			<div id="weather">
				<iframe id="forecast_embed" frameborder="0"></iframe>
			</div>
		</div>

		<script src="../../vendor/jQuery/jquery-3.2.1.min.js"></script>
		<script src="../../vendor/Bootstrap/js/bootstrap.min.js"></script>
		<script src="../js/sidebar.js"></script>
		<script src="../js/dashboard.js"></script>
	</body>
</html>