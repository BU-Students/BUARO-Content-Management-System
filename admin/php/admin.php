<?php

if(session_status() == PHP_SESSION_NONE)
	session_start();

//if user attemps to access this page without authentication
if(!isset($_SESSION['id'])) {
	$_SESSION['error_msg'] = "Please log in first to continue";
	header("Location: login.php");
	exit;
}

// require_once "../../parsedown-master/Parsedown.php"; see https://github.com/erusev/parsedown

?>

<!DOCTYPE html>
<html>
	<head>
		<title>BUARO Administator</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merriweather">
		<link rel="stylesheet" href="../css/topbar.css" />
		<link rel="stylesheet" href="../css/admin.css" />

		<script src="../js/admin.js"></script>
	</head>
	<body>
		<?php require_once "topbar.php"; ?>

		<div id="content-body" class="container-fluid">
			<div>
 				<div class="option-item">
					<label class="switch">
						<input type="checkbox" id="display-option" />
						<span class="round slider"></span>
					</label>
					<label for="display-option">Recent first</label>
				</div>
				<div class="option-item">
					<label class="switch">
						<input type="checkbox" id="order-option" />
						<span class="round slider"></span>
					</label>
					<label for="order-option">Display as block</label>
				</div>
			</div>
			<div class="row" id="options">
				<div class="col-sm-12"></div>
			</div>
			<div id="stories-wrapper">
			</div>
		</div>

		<script>
			document.getElementById("alumni-stories-tab").className = "active";

			var option = document.getElementsByTagName("input");
			for(var i = 0; i < option.length; ++i) {
				if(option[i].type = "checkbox") {
					option[i].addEventListener("click", function() {
						alert(this);
					});
				}
			}

			$(document).ready(function() {
				$('[data-toggle="tooltip"]').tooltip();   
			});

			function toggleContent(id) {
				document.getElementById(id).classList.toggle("hide-content");
				document.getElementById(id).classList.toggle("show-content");
			}
		</script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</body>
</html>