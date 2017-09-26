<?php

if(session_status() == PHP_SESSION_NONE)
	session_start();

//if user attempts to access this page without forst logging in
if(!isset($_SESSION['id'])) {
	$_SESSION['error_msg'] = "Please log in first to continue";
	header("Location: ../php/login.php");
	exit;
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Profile Settings</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../../vendor/Bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/sidebar.css" />
		<link rel="stylesheet" href="../css/topbar.css" />
		<link rel="stylesheet" href="../css/profile.css" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Quicksand">
		<link href="https://fonts.googleapis.com/css?family=Saira+Condensed" rel="stylesheet">
		<link rel="stylesheet" href="../css/scrollbar.css" />
		<link rel="stylesheet" href="../css/notif.css" />
	</head>
	</head>
	<body>
		<?php
			require_once "topbar.php";
			require_once "sidebar.php";
		?>


		<div id="content-wrapper">
			<div id="left-side">
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
<!--				<div id="quote-container">
					<q id="quote">We accept the love we think we deserve</q>
				</div>
-->			</div>
			<div id="right-side">
				<div id="cover-photo">
					<img id="cover-photo-img" />
				</div>
				<table class="profile-info">
					<caption>BASIC INFORMATION</caption>
					<tr>
						<th>Birthday:</th>
						<td id="b-date-display"></td>
						<td style="display: none" id="b-date"><input type="date" id="b-date-input" /></td>
					</tr>
					<tr>
						<th>Age:</th>
						<td id="age"></td>
					</tr>
					<tr>
						<th>Gender:</th>
						<td id="sex"></td>
					</tr>
				</table>
				<table class="profile-info">
					<caption>CONTACT INFORMATION</caption>
					<tr>
						<th>Contact no:</th>
						<td id="contact-no-display"><a id="contact-no-link"></a></td>
						<td style="display: none" id="contact-no"><input type="tel" pattern="[0-9]*" id="contact-no-input" /></td>
					</tr>
					<tr>
						<th>Address:</th>
						<td id="address-display"><a target="_blank" id="address-link"></a></td>
						<td style="display: none" id="address">
							<input spellcheck="false" type="text" id="barangay-input" placeholder="Barangay" class="edit-mode" />
							<input spellcheck="false" type="text" id="municipality-input" placeholder="Municipality" class="edit-mode" />
							<input spellcheck="false" type="text" id="province-input" placeholder="Province" class="edit-mode" />
						</td>
					</tr>
					<tr>
						<th>E-mail:</th>
						<td id="email-display"><a id="email-link"></a></td>
						<td style="display: none" id="email"><input spellcheck="false" type="email" id="email-input" /></td>
					</tr>
				</table>
				<div id="profile-options" style="text-align: center;">
					<button class="btn" onclick="editProfile(this)" id="editButton">Edit</button>
				</div>
				<div style="text-align: center; display: none" id="editing-options">
					<button class="btn" onclick="attemptToSave()" id="saveButton">Save</button>
					<button class="btn" onclick="exitEditMode()" id="cancelButton">Cancel</button>
				</div>
				<div style="height: 50px"></div>
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
		<script src="../js/profile.js"></script>
	</body>
</html>