<?php
	include 'connection.php';
	include '../../vendor/Parsedown/Parsedown.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>BU | Alumni Relations Office</title>
	<link rel="stylesheet" href="../css/w3.css">
	<link rel="stylesheet" href="../css/w3-theme-teal.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="css/breadcrumb.css">
	<script type="text/javascript" src="userendpages/loadjs/viewS.js"></script>
	<div id="content2">
	<link rel="stylesheet" type="text/css" href="../css/style-Donate.css">
	<link href='https://fonts.googleapis.com/css?family=RobotoDraft' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="../../cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
</head>
<body>
	<nav class="w3-sidenav w3-collapse w3-white w3-card-2" id="sidebar"> 	<!-- S I D E B A R -->

 		<a href="http://bualumnirelations@bicol-u.edu.ph" class="w3-large" id="top-sidebar">
 		<img src="../img/bulogo.png"></a>
 		<a href="aro3.php" class="side">Home</a>	
		<a href="e-shop.php" class="side">E-shop for Souvenirs and Memorabilia</a>	
		<a href=".donate.php" class="side" style="background-color: #ababab;">Donation Link</a>		
		<a href="javascript:void(0)" class="side" onclick="myFunc('side')">UNIT/College <i class="fa fa-caret-down"></i></a>
			<div id="side" class="w3-accordion-content w3-animate-left w3-padding">
				<a href=".ce.html">College of Education</a>
        		<a href=".cs.html">College of Science</a>
        		<a href=".cbem.html">College of Business and Economic Management</a>
        		<a href=".ceng.html">College of Engineering</a>
        		<a href=".cal.html">College of Arts & Letters</a>
        		<a href=".cit.html">College of Industrial Technology</a>
        		<a href=".ia.html">Institute of Architecture</a>
        		<a href=".ipesr.html">Institute of Physical Education, Sports & Recreation</a>
       			<a href=".cn.html">College of Nursing</a>
        		<a href=".cm.html">College of Medicine</a>
        		<a href=".cssp.html">College of Social Science and Philosophy</a>
        	</div>
		<a href="eventstory.php" class="side">BU Alumni Stories/Events</a>
		<a href=".about.html" class="side">About BUARO</a>
		<a href=".contact.php" class="side">Contact Us</a>
	</nav>

	<div class="w3-overlay w3-hide-large" onclick="w3_close()" id="close"></div>

	<div class="w3-main">											<!--  T  H  E     M  A  I  N     B  O  D  Y  -->

		<div id="topbar">
			<h4 id="topbar1">
				<a href="aro3.php">Home</a>
				<a href=".donate.php">/ Donation Link</a>
			</h4>
			<a id="toggle" class="w3-opennav" href="javascript:void(0)" onclick="w3_open()">&#9776;</a>
		</div>
		
		<div>												<!--  T  H  E     C  O  N  T  E  N  T  -->
			<br><br><br>
			<div class="w3-container w3-padding-jumbo">
			<div class=" w3-center">	
					<?php
					$parsedown = new Parsedown();
					$getquery = "SELECT * FROM post, post_type WHERE ".
						"post.post_type = post_type.post_type_id AND post_type.post_type_id = ".
						"(SELECT post_type_id FROM post_type WHERE label = 'DONATION_LINK')";
					$run = mysqli_query($con, $getquery);
					$id = 0;
					while($row = mysqli_fetch_array($run)){
						$newstring = substr($parsedown->text($row['content']),0,250);
						echo '
						<div class="purpose">
							<h3 class="title">'.$row['title'].'</h3>
  							<p>'.$newstring.'</p>
							<a href="#" onclick="viewProjects('.$row['post_id'].')" class="w3-btn w3-large w3-theme w3-margin-bottom"> <h5 class="read">Read More</h5></a>
						</div>
						<hr>
							';
						$id++;
					}
				?>

				<iframe class="form" width="700" height="400" src="../../data/donation/PLEDGE FORM.pdf"></iframe><br>
				 <a href="../../data/donation/PLEDGE FORM.pdf" download="../../data/donation/PLEDGE FORM.pdf">	<button  class="w3-btn btn-full"  style="vertical-align:middle " ><span>DOWNLOAD FORM HERE</span></button></a><br>
				</div>
			</div>	
			<footer style="margin-top: 150px;">											<!--  F  O  O  T  E  R  -->
				<div id="bot">
					<h5 class="foot">Copyright &copy;2017.  All Rights Reserved</h5>
				</div>
			</footer>
		</div>
	</div>
<style>
	@media (max-width: 768px){
		iframe{
			width: 250px;
		}
	}
</style>

<script type="text/javascript" src="../js/js_1.js" ></script>
<script type="text/javascript" src="../js/js_2.js"></script>
<script type="text/javascript" src="../js/js_3.js"></script>
<script type="text/javascript" src="../js/js_3.js"></script>
</body>
</html>