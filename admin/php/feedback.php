<?php

if(session_status() == PHP_SESSION_NONE)
	session_start();

//if user attemps to access this page without authentication
if(!isset($_SESSION['id'])) {
	$_SESSION['error_msg'] = "Please log in first to continue";
	header("Location: login.php");
	exit;
}

require_once "backend/connection.php";

if(isset($_POST['search']))
{
	$valueToSearch = $_POST['valueToSearch'];
	// search in all table columns
	// using concat mysql function
	$query = "SELECT * FROM feedback";
	$search_result = $conn->query($query);
    
}
else {
	$query = "SELECT * FROM feedback";
	$search_result = $conn->query($query);
	$totalCount = $search_result->num_rows;
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Alumni Administator</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../../vendor/Bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merriweather">
		<link rel="stylesheet" href="../css/sidebar.css" />
		<link rel="stylesheet" href="../css/topbar.css" />
		<link rel="stylesheet" href="../css/stories.css" />
		<link rel="stylesheet" href="../css/modal.css" />
		<link rel="stylesheet" href="../css/notif.css" />
		<script src="../js/user_activity.js"></script>
	</head>
	<style>
		form { margin: 20px; }
		table {
			margin-bottom: 0px !important;
			border: 1px solid #ccc;
		}
		th, td { text-align: center; }
	</style>
	<body>
		<!-- topbar and sidebar here -->
		<?php
			require_once "topbar.php";
			require_once "sidebar.php";
		?>

		<!-- page content here -->
		<div id="content-wrapper">
			<form action="php_html_table_data_filter.php" method="post">
				<table class="table table-striped table-hover table-bordered">
					<caption>FEEDBACKS</caption>
					<thead>
						<tr>
							<th>Email</th>
							<th>Message</th>
							<th>Delete Feedback</th>
						</tr>
					</thead>
					<tbody id="tbody">
						<!-- populate table from mysql database -->
					</tbody>
				</table>
			</form>
			<nav aria-label="Page navigation" style="text-align:center">
				<ul class="pagination" id="pagination">
				</ul>
			</nav>
		</div>

		<script src="../../vendor/jQuery/jquery-3.2.1.min.js"></script>
		<script src="../../vendor/Bootstrap/js/bootstrap.min.js"></script>
		<script src="../js/feedback.js"></script>
		<script src="../js/sidebar.js"></script>
		<script src="../js/notif.js"></script>
	</body>
</html>