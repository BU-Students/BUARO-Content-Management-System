<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>BU | Alumni Relations Office</title>
		<link rel="stylesheet" href="../css/w3.css">
		<link rel="stylesheet" href="../css/unit_college.css">
		<link rel="stylesheet" href="../css/w3-theme-teal.css">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<link href='https://fonts.googleapis.com/css?family=RobotoDraft' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<?php
			include_once 'sidebar.php'; 
		?>
		<div id="right-side">
			<form>
				<select>
					<option value="2012">2012</option>
					<option value="2013">2013</option>
					<option value="2014">2014</option>
					<option value="2015">2015</option>
					<option value="2016">2016</option>
					<option value="2017">2017</option>
				</select>
			</form>
		</div>

		<div id="content-wrapper">
			<div id="container"></div>

		<script src="../../vendor/Highcharts/highcharts.js"></script>
		<script src="../../main/js/unit_college.js"></script>
	</body>
</html>