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
		<title>Admin Profile</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../../vendor/Bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/sidebar.css" />
		<link rel="stylesheet" href="../css/topbar.css" />
		<link rel="stylesheet" href="../css/account.css" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Quicksand">
		<link href="https://fonts.googleapis.com/css?family=Saira+Condensed" rel="stylesheet">
		<link rel="stylesheet" href="../css/notif.css" />
		<script src="../js/user_activity.js"></script>
	</head>
	</head>
	<body>
		<?php
			require_once "topbar.php";
			require_once "sidebar.php";
		?>

		<div id="content-wrapper">
			<div id="left-side" class="fade-up">
				<img id="profile-img" />
				<div style="padding: 20px;">
					<div id="name">
						<span id="f-name"></span>
						<span id="m-name"></span>
						<span id="l-name"></span>
					</div>
					<span id="college"></span>
				</div>
				<div id="basic-stat">
					<div style="border-right: 1px solid #eee">
						<div class="stat-label">Stories</div>
						<div id="story-count"></div>
					</div>
					<div>
						<div class="stat-label">Views</div>
						<div id="view-count"></div>
					</div>
				</div>

			</div>
			<div id="right-side" class="fade-down">
				<form onsubmit="change('username'); return false;">
					<table class="profile-info">
						<caption>CHANGE USERNAME</caption>
						<tr>
							<th>Change Username:</th>
							<td><input id="new_username" class="inp" type="text" required></td>
						</tr>
						<tr>
							<th>Enter Current Password:</th>
							<td><input id="curr_pass0" class="inp" type="password" required></td>
						</tr>
					</table>
					<button class="btn" id="sub_change_user" type="submit">Submit</button>
				</form>
				<form id="form2" onsubmit="return change('password');">
					<table class="profile-info">
						<caption>CHANGE PASSWORD</caption>
						<tr>
							<th>New Password:</th>
							<td><input id="new_pass" class="inp" type="password" pattern=".{8,}" title="Password must be at least 8 or more characters long" required></td>
						</tr>
						<tr>
							<th>Confirm New Password:</th>
							<td><input id="confirm_pass" class="inp" type="password" required></td>
						</tr>
						<tr>
						<th>Enter Current Password:</th>
							<td><input id="curr_pass1" class="inp" type="password" required></td>
						</tr>
						<hr>
					</table>
				<button class="btn" id="sub_change_pass" type="submit">Submit</button>
				</form>
				<hr>
			</div>
		</div>

		<div class="notif" id="notif-container">
			<div class="notif-img">
				<img id="notif-img" />
			</div>
			<div class="notif-content" id="notif-content"></div>
		</div>

		<script src="../../vendor/jQuery/jquery-3.2.1.min.js"></script>
		<script src="../../vendor/Bootstrap/js/bootstrap.min.js"></script>
		<script src="../js/sidebar.js"></script>
		<script src="../js/account.js"></script>
	</body>
</html>
