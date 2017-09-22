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
require_once "../../parsedown-master/Parsedown.php";

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Event/Story Manager</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="../../sparksuite-simplemde-markdown-editor-6abda7a/dist/simplemde.min.css">

		<link rel="stylesheet" href="../css/topbar.css" />
		<!--<link rel="stylesheet" href="../css/sidebar.css" />-->
		<link rel="stylesheet" href="../css/dashboard.css" />
		<link rel="stylesheet" href="../css/eventstory-stories.css" />
		<link rel="stylesheet" href="../css/eventstory-events.css" />
		<link rel="stylesheet" href="../css/eventstory-carousel.css" />
		<style type="text/css">
			.modal {
				
			}
			@media screen and (min-width: 992px) {
				.modal-lg {
					width: 100%; /* New width for large modal */
				}
			}
		</style>
	</head>
	</head>
	<body>
		<?php
			require_once "topbar.php";
			//require_once "sidebar.php";
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
							<div class="container-fluid">
								<div class="col-md-6"><canvas id="myChart" width="500px"></canvas><center><h3>Graph report on nos. of view per file</h3></center></div>
								<div class="col-md-6"><canvas id="myChart2"></canvas><center><h3>Graph report on total nos. of posts</h3></center></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="../../sparksuite-simplemde-markdown-editor-6abda7a/dist/simplemde.min.js"></script>
		<script src="../js/sidebar.js"></script>
		<script src="../js/eventstory-editor.js"></script>
		<script src="../js/eventstory-stories.js"></script>
		<script src="../js/eventstory-events.js"></script>
		<script src="../js/editor-event.js"></script>
		<script src="../../chartjs/Chart.bundle.min.js"></script>
		<script>
			var ctx = document.getElementById("myChart").getContext('2d');
			var myChart = new Chart(ctx, {
			    type: 'bar',
			    data: {
			        labels: [<?php
			        	$sql = "SELECT * FROM post ORDER BY timestamp DESC";
			        	$result = $conn->query($sql);
			        	while($row = $result->fetch_assoc()) {
			        		//echo " \"$row['title']\" ,";
			        		echo '"'.$row['title'].'",';
			        	}
			        ?>],
			        datasets: [{
			            label: '# of Views',
			            data: [<?php
			            	$sql = "SELECT * FROM post ORDER BY timestamp DESC";
			        	$result = $conn->query($sql);
			            	while($row = $result->fetch_assoc()) {
			        		//echo " \"$row['title']\" ,";
			        		echo ''.$row['view_count'].',';
			        		}
			            ?>],
			            backgroundColor: [
			                'rgba(255, 99, 132, 0.2)',
			                'rgba(54, 162, 235, 0.2)',
			                'rgba(255, 206, 86, 0.2)',
			                'rgba(75, 192, 192, 0.2)',
			                'rgba(153, 102, 255, 0.2)',
			                'rgba(255, 159, 64, 0.2)'
			            ],
			            borderColor: [
			                'rgba(255,99,132,1)',
			                'rgba(54, 162, 235, 1)',
			                'rgba(255, 206, 86, 1)',
			                'rgba(75, 192, 192, 1)',
			                'rgba(153, 102, 255, 1)',
			                'rgba(255, 159, 64, 1)'
			            ],
			            borderWidth: 1
			        }]
			    },
			    options: {
			        scales: {
			            yAxes: [{
			                ticks: {
			                    beginAtZero:true
			                }
			            }]
			        }
			    }
			});
			var ctx2 = document.getElementById("myChart2").getContext('2d');
			var myChart2 = new Chart(ctx2, {
			    type: 'bar',
			    data: {
			        labels: ["Stories","Events"],
			        datasets: [{
			            label: '# of Posts',
			            data: [<?php
			            	$nostories = 0;
			            	$noevents= 0;
			            	$sql = "SELECT * FROM post WHERE post_type=1";
			        		$result = $conn->query($sql);
			            	while($row = $result->fetch_assoc()) {
			        			$nostories++;
			        		}
			        		$sql = "SELECT * FROM post WHERE post_type=2";
			        		$result = $conn->query($sql);
			            	while($row = $result->fetch_assoc()) {
			        			$noevents++;
			        		}
			        		echo ''.$nostories.',';
			        		echo ''.$noevents.'';
			            ?>],
			            backgroundColor: [
			                'rgba(153, 102, 255, 0.2)',
			                'rgba(255, 159, 64, 0.2)'
			            ],
			            borderColor: [
			                'rgba(153, 102, 255, 1)',
			                'rgba(255, 159, 64, 1)'
			            ],
			            borderWidth: 1
			        }]
			    },
			    options: {
			        scales: {
			            yAxes: [{
			                ticks: {
			                    beginAtZero:true
			                }
			            }]
			        }
			    }
			});
		</script>

	</body>
</html>