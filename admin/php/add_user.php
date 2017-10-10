<?php

if(session_status() == PHP_SESSION_NONE)
	session_start();

//if user attemps to access this page without authentication
if(!isset($_SESSION['id'])) {
	$_SESSION['error_msg'] = "Please log in first to continue";
	header("Location: login.php");
	exit();
}

//if admin type is of college admins only
if(!isset($_SESSION['admin-type']) || $_SESSION['admin-type'] == 2) {
	$_SESSION['error_msg'] = "Invalid page access";
	header("Location: login.php");
	exit();
}

if($_SERVER['REQUEST_METHOD'] == "POST") {
	require_once "backend/connection.php";
	require_once "backend/input_handler.php";
	require_once "backend/cipher.php";

	if(empty($_POST['profile-img']))
		$_POST['profile-img'] = "null";
	else $_POST['profile-img'] = "'".encode($_POST['profile-img'])."'";

	if(empty($_POST['cover-photo']))
		$_POST['cover-photo'] = "null";
	else $_POST['cover-photo'] = "'".encode($_POST['cover-photo'])."'";

	if(empty($_POST['contact-no']))
		$_POST['contact-no'] = "null";
	else $_POST['contact-no'] = "'".encode($_POST['contact-no'])."'";

	if(empty($_POST['email']))
		$_POST['email'] = "null";
	else $_POST['email'] = "'".encode($_POST['email'])."'";

	//insertion query into `address` table
	$query_1 =
		"INSERT INTO address VALUES (null, ".
			"'".$_POST['barangay']."', ".
			"'".$_POST['municipality']."', ".
			"'".$_POST['province']."'".
		")";

	//insertion query into `admin` table
	$query_2 =
		"INSERT INTO admin VALUES ( null, ".
			"(SELECT admin_type_id FROM admin_type WHERE label = 'COLLEGE_ADMIN'), ".
			"(SELECT address_id FROM address ORDER BY address_id DESC LIMIT 1), ".
			$_POST['college'].", ".
			"'".encode($_POST['f-name'])."', ".
			"'".encode($_POST['m-name'])."', ".
			"'".encode($_POST['l-name'])."', ".
			$_POST['sex'].", ".
			$_POST['contact-no'].", ".
			"'".$_POST['b-date']."', ".
			$_POST['email'].", ".
			"'".encrypt(encode($_POST['username']))."', ".
			"'".encrypt(encode($_POST['password']))."', ".
			$_POST['profile-img'].", ".
			$_POST['cover-photo'].", ".
			"1 ".
		")";

	//insertion query for `user_activity` table
	$query_3 =
		"INSERT INTO admin_activity VALUES( null, ".
			"(SELECT admin_id FROM admin ORDER BY admin_id DESC LIMIT 1), ".
			"null, ".
			"null ".
		")";

	/* maks sure that all three insertions are successfull;
	 * if at least one is unsuccesful, delete all inserted
	 * rows
	 */
	if(!$conn->query($query_1))
		exit($conn->error);

	if(!$conn->query($query_2)) {
		$error = $conn->error;
		$conn->query("DELETE FROM address ORDER BY address_id DESC LIMIT 1");
		exit("Query 2: ".$error);
	}

	if(!$conn->query($query_3)) {
		$error = $conn->error;
		$conn->query("DELETE FROM address ORDER BY address_id DESC LIMIT 1");
		exit("Query 3: ".$error);
	}

	unset($_POST);
	$conn->close();
	header("Location: administrators.php#success");
	exit();
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Alumni Administator</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../../vendor/Bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/sidebar.css" />
		<link rel="stylesheet" href="../css/topbar.css" />
		<link rel="stylesheet" href="../css/scrollbar.css" />
		<link rel="stylesheet" href="../css/notif.css" />
		<link rel="stylesheet" href="../css/add_user.css" />
	</head>
	<body>
		<!-- topbar and sidebar here -->
		<?php
			require_once "topbar.php";
			require_once "sidebar.php";
		?>

		<!-- page content here -->
		<div id="content-wrapper">
			<ul class="breadcrumb">
				<li><a href="administrators.php">Administrators</a></li>
				<li class="active">Add User</li>
			</ul>
			<form method="POST" id="form">
				<div class="section-wrapper">
					<span><b style="color: #555">NOTE:</b> Fields marked with <span style="color: red">*</span> are required.</span>
				</div>
				<div class="section-wrapper">
					<table class="table">
						<caption>BASIC</caption>
						<tr><td colspan="2"><input required name="f-name" type="text" class="form-control" placeholder="* First name" style="width: 100%;"</td></tr>
						<tr><td colspan="2"><input required name="m-name" type="text" class="form-control" placeholder="* Middle name" style="width: 100%;"</td></tr>
						<tr><td colspan="2"><input required name="l-name" type="text" class="form-control" placeholder="* Last name" style="width: 100%;"</td></tr>
						<tr>
							<th class="required"><label for="sex">Gender</label></th>
							<td>
								<select class="form-control" name="sex" id="sex">
									<option value="0">Male</option>
									<option value="1">Female</option>
								</select>
							</td>
						</tr>
						<tr>
							<th class="required"><label for="b-date">Birth date</label></th>
							<td><input required class="form-control" type="date" id="b-date" name="b-date" </td>
						</tr>
					</table>
				</div>
				<div class="section-wrapper">
					<table class="table">
						<caption>PERSONAL</caption>
						<tr><td colspan="2"><input required name="barangay" type="text" class="form-control" placeholder="* Barangay" style="width: 100%;"</td></tr>
						<tr><td colspan="2"><input required name="municipality" type="text" class="form-control" placeholder="* Municipality" style="width: 100%;"</td></tr>
						<tr><td colspan="2"><input required name="province" type="text" class="form-control" placeholder="* Province" style="width: 100%;"</td></tr>
						<tr>
							<th>
								Profile image
								<div class="overlap-helper">
									<button type="button" class="btn btn-default">Pick profile image</button>
									<input type="file" accept="image/x-png,image/gif,image/jpeg" onclick="clickButtonEffect(this)"
									onchange="loadImage(event, 'profile-img-preview')" id="profile-img" name="profile-img" />
								</div>
							</th>
							<th>
								Cover photo
								<div class="overlap-helper">
									<button type="button" class="btn btn-default">Pick cover photo</button>
									<input type="file" accept="image/x-png,image/gif,image/jpeg" onclick="clickButtonEffect(this)"
									onchange="loadImage(event, 'cover-photo-preview')" id="cover-photo" name="cover-photo" />
								</div>
							</th>
						</tr>
					</table>
					<div id="upload-section">
						<div id="profile">
							<img id="profile-img-preview" />
							<button type="button" class="btn btn-default cancel-btn" onclick="unloadImage(this, 'profile-img', 'profile-img-preview')">Cancel</button>
						</div>
						<div id="cover">
							<img id="cover-photo-preview" />
							<button type="button" class="btn btn-default cancel-btn" onclick="unloadImage(this, 'cover-photo', 'cover-photo-preview')">Cancel</button>
						</div>
					</div>
				</div>
				<div class="section-wrapper">
					<table class="table">
						<caption>CONTACT</caption>
						<tr>
							<th>Contact number</th>
							<td><input class="form-control"  name="contact-no" /></td>
						</tr>
						<tr>
							<th>E-mail address</th>
							<td><input class="form-control" type="email" name="email" /></td>
						</tr>
					</table>
				</div>
				<div class="section-wrapper">
					<table class="table">
						<caption>ACCOUNT</caption>
						<tr>
							<th class="required"><label for="college">Assigned college</label></th>
							<td>
								<select class="form-control" name="college" id="colleges">
								<?php
									//get available colleges to administrate from database
									$result = $conn->query("SELECT * FROM college");
									while($college = $result->fetch_assoc())
										echo '<option value="'.$college['college_id'].'">'.$college['label'].'</option>';
									$result->free();
								?>
								</select>
							</td>
						</tr>
						<tr>
							<th class="required">Username</th>
							<td><input required class="form-control" type="text" name="username" </td>
						</tr>
						<tr>
							<th class="required">Password</th>
							<td><input required class="form-control" type="password" pattern=".{8,}" title="Password must be at least 8 or more characters long" id="pass" </td>
						</tr>
						<tr>
							<th class="required">Re-type password</th>
							<td id="pass-container"><input class="form-control" type="password" id="verify-pass" name="password" </td>
						</tr>
					</table>
				</div>
				<button type="submit" class="btn btn-success">Create Account</button>
			</form>
		</div>

		<div class="notif" id="notif-container">
			<div class="notif-img">
				<img id="notif-img" src="../img/error-icon.png" />
			</div>
			<div class="notif-content" id="notif-content">Passwords do not match.</div>
		</div>

		<script src="../../vendor/jQuery/jquery-3.2.1.min.js"></script>
		<script src="../../vendor/Bootstrap/js/bootstrap.min.js"></script>
		<script src="../js/sidebar.js"></script>
		<script src="../js/add_user.js"></script>
	</body>
</html>