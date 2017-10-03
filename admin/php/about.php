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
		<title>Markdown Editor</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../../vendor/Bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="../../vendor/SimpleMDE/dist/simplemde.min.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merriweather">
		<link rel="stylesheet" href="../css/topbar.css" />
		<link rel="stylesheet" href="../css/sidebar.css" />
		<link rel="stylesheet" href="../css/about.css" />
		<link rel="stylesheet" href="../css/notif.css" />
	</head>
	<body>
		<!-- topbar and sidebar here -->
		<?php
			require_once "topbar.php";
			require_once "sidebar.php";
		?>

		<!-- page content here -->
		<div id="content-wrapper">
			<label for="about-content" id="title">About the BU Alumni Relations Office</label>
			<form>
				<div id="about-container">
					<textarea id="about-content" hidden></textarea>
					<div id="options">
						<button class="btn btn-danger" type="submit">Cancel</button>
						<button class="btn btn-success" type="button" onclick="update()">Update</button>
						<div style="clear: both"></div>
					</div>
				</div>
			</div>
		</div>

		<!-- delete confirmation modal here -->
		<div class="modal fade" id="confirmation-modal" role="dialog" tabindex="1">
			<input type="hidden" id="story-dom-id" />
			<input type="hidden" id="story-db-id" />
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Delete story</h4>
					</div>
					<div class="modal-body">
						<span>Are you sure you want to permanently delete this story?</span>
					</div>
					<div class="modal-footer">
						<input type="hidden" />
						<button type="button" class="btn btn-default btn-danger" onclick="deleteStory()">Yes</button>
						<button type="button" class="btn btn-default btn-success" data-dismiss="modal">No</button>
					</div>
				</div>
			</div>
		</div>

		<script src="../../vendor/jQuery/jquery-3.2.1.min.js"></script>
		<script src="../../vendor/Bootstrap/js/bootstrap.min.js"></script>
		<script src="../../vendor/SimpleMDE/dist/simplemde.min.js"></script>
		<script src="../js/about.js"></script>
		<script src="../js/sidebar.js"></script>
	</body>
</html>