<?php

if(session_status() == PHP_SESSION_NONE)
	session_start();

//if user attemps to access this page without authentication
if(!isset($_SESSION['id'])) {
	$_SESSION['error_msg'] = "Please log in first to continue";
	header("Location: login.php");
	exit;
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Story Statistics</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/sidebar.css" />
		<link rel="stylesheet" href="../css/topbar.css" />
		<link rel="stylesheet" href="../css/scrollbar.css" />
		<link rel="stylesheet" href="../css/post_stat.css" />
	</head>
	<body>
		<!-- topbar and sidebar here -->
		<?php
			require_once "topbar.php";
			require_once "sidebar.php";
		?>
		<div id="content-wrapper">
			<div id="left-side"><div id="post-stat-graph"></div></div>
			<div id="right-side">
<!--			<div id="options">
					<div class="dropdown">
						<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
							Parameter to order
							<span class="caret" style="margin-left: 10px"></span>
						</button>
						<ul class="dropdown-menu">
							<li><a href="#">Total views</a></li>
							<li><a href="#">Unique visitors</a></li>
						</ul>
					</div>
					<div id="order-container">
						<label id="desc-label" class="hide-label" for="order">DESC</label>
						<label class="switch">
							<input type="checkbox" onclick="sort()" id="order" />
							<span class="slider round"></span>
						</label>
						<label id="asc-label" for="order">ASC</label>
					</div>
				</div>
-->				<div id="post-comparison-graph"></div>
			</div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="../js/sidebar.js"></script>
		<script src="../../Highcharts-5.0.14/highcharts.js"></script>
		<script src="../js/post_stat.js"></script>
	</body>
</html>