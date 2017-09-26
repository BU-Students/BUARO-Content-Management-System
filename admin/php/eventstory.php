<?php
if(session_status() == PHP_SESSION_NONE)
	session_start();

//if user attemps to access this page without forst logging in
if(!isset($_SESSION['id'])) {
	$_SESSION['error_msg'] = "Please log in first to continue";
	header("Location: ../php/login.php");
	exit;
}

include 'backend/connection.php';
require_once "../../vendor/Parsedown/Parsedown.php";

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Event/Story Manager</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../../vendor/Bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="../../vendor/sparksuite-simplemde-markdown-editor-6abda7a/dist/simplemde.min.css">
		<link rel="stylesheet" href="../../vendor/SimpleMDE/dist/simplemde.min.css">
		<link rel="stylesheet" href="../css/topbar.css" />
		<link rel="stylesheet" href="../css/eventstory-sidebar.css" />
		<link rel="stylesheet" href="../css/eventstory-carousel.css" />
		<link rel="stylesheet" href="../css/eventstory-stories.css" />
		<link rel="stylesheet" href="../css/eventstory-events.css" />
		<style type="text/css">
			.modal {
				
			}
			@media screen and (min-width: 992px) {
				.modal-lg {
					width: 95%; /* New width for large modal */
				}
			}
		</style>
	</head>
	</head>
	<body>
		<?php
			require_once "topbar.php";
			require_once "sidebar.php";
		?>
		<div id="content-wrapper" class="container-fluid">
			<?php require_once 'eventstory-pages/editor.php'; ?>
			<div class="panel panel-default" style="margin-top: 70px;">
				<div class="panel-body">
					<div id="container">
						<ul class="nav nav-tabs">
							<li class="active"><a data-toggle="tab" href="#menu1">Stories</a></li>
							<li><a data-toggle="tab" href="#menu2">Events</a></li>
							<li><a data-toggle="tab" href="#menu3">Reports</a></li>
							<li><a data-toggle="modal" href="#" data-target="#editor">Add Story / Event</a></li>
						</ul>
					<div class="tab-content">
						<div id="menu1" class="tab-pane fade in active">
							<!--For the stories-->
						</div>
						<div id="menu2" class="tab-pane fade out">
							<!--For the Events-->
						</div>
						<div id="menu3" class="tab-pane fade in">
							<!--For the Reports-->
							<?php require_once "eventstory-pages/reports.php"; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>

		<script src="../../vendor/jQuery/jquery-3.2.1.min.js"></script>
		<script src="../../vendor/Bootstrap/js/bootstrap.min.js"></script>
		<script src="../../vendor/SimpleMDE/dist/simplemde.min.js"></script>
		<script src="../js/sidebar.js"></script>
		<script src="../js/eventstory-editor.js"></script>
		<script src="../js/eventstory-stories.js"></script>
		<script src="../js/eventstory-events.js"></script>
		<script src="../js/editor-event.js"></script>
		<script src="../js/eventstory-pagination.js"></script>
		<script src="../js/eventstory-reports.js"></script>
	</body>
</html>