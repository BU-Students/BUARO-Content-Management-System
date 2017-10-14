<?php

if(session_status() == PHP_SESSION_NONE)
	session_start();

//if user attemps to access this page without authentication
if(!isset($_SESSION['id'])) {
	$_SESSION['error_msg'] = "Please log in first to continue";
	header("Location: login.php");
	exit;
}

//if admin type is of college admins only
if(!isset($_SESSION['admin-type']) || $_SESSION['admin-type'] == 2) {
	$_SESSION['error_msg'] = "Invalid page access";
	header("Location: login.php");
	exit;
}

//get currently active users
require_once 'backend/connection.php';

$sql =
	"SELECT ".
		"admin.admin_id, ".
		"first_name, ".
		"last_name, ".
		"last_login ".
	"FROM admin, admin_activity ".
	"WHERE admin.admin_id = admin_activity.admin_id AND ".
		"admin.admin_id != ".$_SESSION['id']." AND ".
		"TIMESTAMPDIFF(MINUTE, last_active, CURRENT_TIMESTAMP()) <= 1";

if(!$active_users = $conn->query($sql)) {
	exit("Query:<br>".$sql."<br><br>Response:<br>".$conn->error);
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
		<link rel="stylesheet" href="../css/administrators.css" />
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
			<ul class="breadcrumb" style="margin: 0px">
				<li class="active">Administrators</li> 
			</ul>
			<div id="left-side">
				<div class="options">
					<button class="btn btn-default" data-toggle="modal" data-target="#view-options">View Options</button>
					<button class="btn btn-default" onclick="toggleSelectMode(this)" id="row-select-btn">Select Multiple Rows</button>
					<button class="btn btn-default" onclick="selectAllRows(this)" id="select-all-btn">Select All Rows</button>
					<a class="btn btn-default" id="new-admin-btn" href="add_user.php">Add Account
						<span class="glyphicon glyphicon-plus" style="margin-left: 5px;"></span>
					</a>
					<div class="input-group add-on" id="filter-container">
						<input class="form-control" id="filter" onkeyup="filter(this)" type="text">
						<div class="input-group-addon"><i class="glyphicon glyphicon-search"></i></div>
					</div>
				</div>
				<div class="table-wrapper table-responsive">
					<div id="table-description" style="margin: 10px 0px; color: #777">ACTIVE ACCOUNTS</div>
					<table class="table table-bordered table-hover table-striped" id="admins-table">
						<thead>
							<tr id="admin-table-headers">
								<th onclick="sortAdminTable(this, 0)">First Name</th>
								<th onclick="sortAdminTable(this, 1)">Middle Name</th>
								<th onclick="sortAdminTable(this, 2)">Last Name</th>
								<th onclick="sortAdminTable(this, 3)">College</th>
								<th onclick="sortAdminTable(this, 4)">Gender</th>
								<th onclick="sortAdminTable(this, 5)">Age</th>
							</tr>
						</thead>
						<tbody id="admin-table-body"></tbody>
					</table>
				</div>
				<nav aria-label="Page navigation" style="text-align:center">
					<ul class="pagination" id="pagination">
					</ul>
				</nav>
			</div>
			<div id="right-side">
				<div id="row-options-panel">
					<span class="caption">SELECTION OPTIONS</span>
					<div class="options">
						<button class="btn btn-default" id="activate-deactivate" onclick="confirmAction()"></button>
						<button class="btn btn-default" id="edit-account" onclick="editUserAccount()">Edit Info</button>
					</div>
				</div>
				<div id="user-info-panel">
					<div style="padding: 15px">
						<span class="caption">USER INFORMATION</span>
						<img id="profile-img" />
						<div id="name">
							<span id="f-name"></span>
							<span id="m-name"></span>
							<span id="l-name"></span>
						</div>
						<span id="college"></span>
					</div>
					<div style="padding: 15px; text-align: center;">
						<a id="profile-link">
							<span>View profile</span>
							<span class="glyphicon glyphicon-chevron-right"></span>
						</a>
					</div>
				</div>
				<div>
					<div class="table-wrapper table-responsive">
						<table class="table table-striped" id="active-users">
							<caption>ONLINE ACCOUNTS</caption>
							<thead>
								<tr>
									<th>User</th>
									<th>Login Time</th>
								</tr>
							</thead>
							<tbody id="active-users-body">
								<?php
									require_once 'backend/input_handler.php';
									if($active_users->num_rows == 0) {
										echo '<tr><td colspan="2" align="center">None</td></tr>';
									}
									else {
										while($user = $active_users->fetch_assoc()) {
											echo
											'<tr>'.
												'<td><a href="profile.php?user_id='.$user['admin_id'].'">'.decode($user['first_name']).' '.decode($user['last_name']).'</a></td>'.
												'<td align="center">'.date("h:i A", strtotime($user['last_login'])).'</td>'.
											'</tr>';
										}
									}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<!-- view modal here -->
		<div id="view-options" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">VIEW OPTIONS</h4>
					</div>
					<div class="modal-body">
						<div id="view-options-body">
							<h4 class="caption">COLUMNS</h4>
							<h5>Select the attributes you want to see on the table</h5>
							<div class="view-options-group" id="attr-container">
								<div class="view-checkbox"><label for="fname-attr"><input checked type="checkbox" id="fname-attr" />First name</label></div>
								<div class="view-checkbox"><label for="mname-attr"><input checked type="checkbox" id="mname-attr" />Middle name</label></div>
								<div class="view-checkbox"><label for="lname-attr"><input checked type="checkbox" id="lname-attr" />Last name</label></div>
								<div class="view-checkbox"><label for="college-attr"><input checked type="checkbox" id="college-attr" />College</label></div>
								<div class="view-checkbox"><label for="gender-attr"><input checked type="checkbox" id="gender-attr" />Gender</label></div>
								<div class="view-checkbox"><label for="age-attr"><input checked type="checkbox" id="age-attr" />Age</label></div>
							</div>
							<div style="margin-top: 20px;">
								<h4 class="caption">ADMIN STATE</h4>
								<h5>Select admin state you want to see on the table</h5>
								<div class="view-options-group container-fluid" id="state-container">
									<div class="col-sm-4"><label for="active-state"><input name="state" type="radio" value="1"  id="active-state" checked />Active</label></div>
									<div class="col-sm-4"><label for="inactive-state"><input name="state" type="radio" value="0"  id="inactive-state" />Inactive</label></div>
									<div class="col-sm-4"><label for="all-states"><input name="state" type="radio" value="2" id="all-states" />Both</label></div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-success" data-dismiss="modal" onclick="displayTable()" style="width: 70px">Ok</button>
					</div>
				</div>
			</div>
		</div>

		<!-- confirmation modal here -->
		<div id="confirm-modal" class="modal fade" role="dialog" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title" id="confirmation-title"></h4>
					</div>
					<div class="modal-body">
						<p id="confirmation-msg"></p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" onclick="activate_deactivate_accounts()" id="action-btn" style="width: 69.58px">Yes</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					</div>
				</div>
			</div>
		</div>

		<!-- notification here -->
		<div class="notif" id="notif-container">
			<div class="notif-img">
				<img id="notif-img" />
			</div>
			<div class="notif-content" id="notif-content">Passwords do not match.</div>
		</div>

		<script src="../../vendor/jQuery/jquery-3.2.1.min.js"></script>
		<script src="../../vendor/Bootstrap/js/bootstrap.min.js"></script>
		<script src="../js/sidebar.js"></script>
		<script src="../js/administrators.js"></script>
	</body>
</html>