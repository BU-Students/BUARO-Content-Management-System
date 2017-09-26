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
		<title>Markdown Editor</title>
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
				<input id="title" type="text" name="title" placeholder="Title goes here" /><hr>
				<div class="container-fluid" id="content-type">
					<div class="col-sm-4"><label for="radio-1"><input type="radio" id="radio-1" value="1" name="content-type" />Alumni Story</label></div>
					<div class="col-sm-4"><label for="radio-2"><input type="radio" id="radio-2" value="2" name="content-type" />BUARO Event</label></div>
					<div class="col-sm-4"><label for="radio-3"><input type="radio" id="radio-3" value="3" name="content-type" />Bulletin Item</label></div>
					<div class="col-sm-4"><label for="radio-4"><input type="radio" id="radio-4" value="4" name="content-type" />About Us</label></div>
					<div class="col-sm-4"><label for="radio-5"><input type="radio" id="radio-5" value="5" name="content-type" />Contact Us</label></div>
				</div>
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
