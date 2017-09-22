<?php

if(session_status() == PHP_SESSION_NONE)
	session_start();

//if user attemps to access this page without fist logging in
if(!isset($_SESSION['id'])) {
	$_SESSION['error_msg'] = "Please log in first to continue";
	header("Location: login.php");
	exit;
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>contact us Editor</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="../../sparksuite-simplemde-markdown-editor-6abda7a/dist/simplemde.min.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merriweather">
		<link rel="stylesheet" href="../css/topbar.css" />
		<link rel="stylesheet" href="../css/sidebar.css" />
		<link rel="stylesheet" href="../css/editor.css" />
		<link rel="stylesheet" href="../css/notif.css" />
	</head>
	<body>
		<?php
			require_once "topbar.php";
			require_once "sidebar.php";
		?>
		<div id="content-wrapper">
			<form id="editor-form">
				<input type="hidden" id="existing-story-id" value="-1" />
				<textarea id="textarea" name="content"></textarea>
				<hr>
				<div class="container-fluid">
					<div class="col-sm-12" style="text-align: center;"><button type="button" class="btn btn-success" id="submit">Publish</button></div>
				</div>
			</form>
		</div>

		<div class="notif" id="notif-container">
			<div class="notif-img">
				<img id="notif-img" />
			</div>
			<div class="notif-content" id="notif-content"></div>
		</div>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="../../sparksuite-simplemde-markdown-editor-6abda7a/dist/simplemde.min.js"></script>
		<script src="../js/editor.js"></script>
		<script src="../js/sidebar.js"></script>
	</body>

</html>