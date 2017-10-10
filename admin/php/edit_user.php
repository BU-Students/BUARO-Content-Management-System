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

	if(isset($_POST['user-id'])) {
		$sql =
			"SELECT * FROM admin, address ".
			"WHERE ".
				"address.address_id = admin.address AND ".
				"admin_id = ".$_POST['user-id'];
		if($result = $conn->query($sql)) {
			$user = $result->fetch_assoc();
			$result->free();
		}
		else exit($conn->error);

		unset($_POST);
	}
	else if(isset($_POST['edit-user'])) {
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

		//update user's address
		$query_1 =
			"UPDATE address ".
			"SET barangay = '".encode($_POST['barangay'])."', ".
				"municipality = '".encode($_POST['municipality'])."', ".
				"province = '".encode($_POST['province'])."' ".
			"WHERE ".
				"address_id = ".$_POST['address-id'];

		//update admin info
		$query_2 =
			"UPDATE admin ".
			"SET college = ".$_POST['college'].", ".
				"first_name = '".encode($_POST['f-name'])."', ".
				"middle_name = '".encode($_POST['m-name'])."', ".
				"last_name = '".encode($_POST['l-name'])."', ".
				"sex = ".$_POST['sex'].", ".
				"contact_no = ".$_POST['contact-no'].", ".
				"bdate = '".$_POST['b-date']."', ".
				"email = ".encode($_POST['email']).", ".
				"username = '".encrypt(encode($_POST['username']))."', ".
				"password = '".encrypt(encode($_POST['password']))."', ".
				"profile_img = ".$_POST['profile-img'].", ".
				"cover_photo = ".$_POST['cover-photo']." ".
			"WHERE admin_id = ".$_POST['id'];

		if(!$result_1 = $conn->query($query_1))
			exit($conn->error);
		if(!$result_2 = $conn->query($query_2))
			exit($conn->error);
		if($conn->affected_rows == 0 && $conn->affected_rows == 0)
			$hash = "nochanges";
		else $hash = "modified";

		unset($_POST);
		$conn->close();
		header("Location: administrators.php#".$hash);
	}
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Edit Account</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../../vendor/Bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/sidebar.css" />
		<link rel="stylesheet" href="../css/topbar.css" />
		<link rel="stylesheet" href="../css/scrollbar.css" />
		<link rel="stylesheet" href="../css/notif.css" />
		<link rel="stylesheet" href="../css/add_user.css" />
		<script src="../js/user_activity.js"></script>
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
				<li class="active">Edit Account</li>
			</ul>
			<form method="POST" id="form">
				<input type="hidden" name="id" value="<?php echo $user['admin_id']; ?>" />
				<input type="hidden" name="address-id" value="<?php echo $user['address']; ?>" />
				<div class="section-wrapper" style="text-align: center">
					<h3>
					<?php
						require_once "backend/input_handler.php";
						echo strtoupper(decode($user['first_name'])).' '.strtoupper(decode($user['last_name'])).'\'S ACCOUNT';
					?>
					</h3>
					<span><b style="color: #555">NOTE:</b> Fields marked with <span style="color: red">*</span> are required.</span>
				</div>
				<div class="section-wrapper">
					<table class="table">
						<caption>BASIC</caption>
						<tr><td colspan="2">
							<input name="f-name" value="<?php echo decode($user['first_name']); ?>"
							type="text" class="form-control" placeholder="* First name" style="width: 100%;" required>
						</td></tr>
						<tr><td colspan="2">
							<input name="m-name" value="<?php echo decode($user['middle_name']); ?>"
							type="text" class="form-control" placeholder="* Middle name" style="width: 100%;" required>
						</td></tr>
						<tr><td colspan="2">
							<input name="l-name" value="<?php echo decode($user['last_name']); ?>"
							type="text" class="form-control" placeholder="* Last name" style="width: 100%;" required>
						</td></tr>
						<tr>
							<th class="required"><label for="sex">Gender</label></th>
							<td>
								<select class="form-control" name="sex" id="sex">
									<?php
										if($user['sex'] == '0')
											echo '<option value="0">Male</option><option value="1">Female</option>';
										else echo '<option value="1">Female</option><option value="0">Male</option>';
									?>
								</select>
							</td>
						</tr>
						<tr>
							<th class="required"><label for="b-date">Birth date</label></th>
							<td><input required class="form-control" type="date" id="b-date" value="<?php echo $user['bdate']; ?>" name="b-date"></td>
						</tr>
					</table>
				</div>
				<div class="section-wrapper">
					<table class="table">
						<caption>PERSONAL</caption>
						<tr><td colspan="2">
							<input required name="barangay" value="<?php echo decode($user['barangay']); ?>"
							type="text" class="form-control" placeholder="* Barangay" style="width: 100%;">
						</td></tr>
						<tr><td colspan="2">
							<input required name="municipality" value="<?php echo decode($user['municipality']); ?>"
							type="text" class="form-control" placeholder="* Municipality" style="width: 100%;">
						</td></tr>
						<tr><td colspan="2">
							<input required name="province" value="<?php echo decode($user['province']); ?>"
							type="text" class="form-control" placeholder="* Province" style="width: 100%;">
						</td></tr>
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
							<img id="profile-img-preview" <?php if(!empty($user['profile_img'])) echo 'src="'.decode($user['profile_img']).'"'; ?> />
							<button type="button" class="btn btn-default cancel-btn" onclick="unloadImage(this, 'profile-img', 'profile-img-preview')">Cancel</button>
						</div>
						<div id="cover">
							<img id="cover-photo-preview" <?php if(!empty($user['cover_photo'])) echo 'src="'.decode($user['cover_photo']).'"'; ?> />
							<button type="button" class="btn btn-default cancel-btn" onclick="unloadImage(this, 'cover-photo', 'cover-photo-preview')">Cancel</button>
						</div>
					</div>
				</div>
				<div class="section-wrapper">
					<table class="table">
						<caption>CONTACT</caption>
						<tr>
							<th>Contact number</th>
							<td><input class="form-control" value="<?php echo decode($user['contact_no']) ?>" name="contact-no" /></td>
						</tr>
						<tr>
							<th>E-mail address</th>
							<td><input class="form-control" value="<?php echo decode($user['email']) ?>" type="email" name="email" /></td>
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
									$sql =
									"SELECT ".
									"(SELECT college_id FROM admin, college WHERE admin.college = college.college_id AND admin.admin_id = ".$user['admin_id'].") AS user_college, ".
									"college.* FROM college";
									$result = $conn->query($sql);
									while($college = $result->fetch_assoc())
										echo '<option value="'.$college['college_id'].'"'.
										(($college['user_college'] == $college['college_id'])? " selected" : "").
										'>'.$college['label'].'</option>';
									$result->free();
								?>
								</select>
							</td>
						</tr>
						<tr>
							<th class="required">Username</th>
							<td><input required class="form-control" type="text" name="username" placeholder="New username"></td>
						</tr>
						<tr>
							<th class="required">Password</th>
							<td>
								<input required class="form-control" type="password" pattern=".{8,}" placeholder="New password"
								title="Password must be at least 8 or more characters long" id="pass">
							</td>
						</tr>
						<tr>
							<th class="required">Re-enter password</th>
							<td id="pass-container"><input class="form-control" type="password" id="verify-pass" name="password"></td>
						</tr>
					</table>
				</div>
				<div id="buttons-container">
					<button type="submit" class="button go" name="edit-user">Update Account</button>
					<a class="button cancel" href="administrators.php#nochanges">Cancel</a>
				</div>
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