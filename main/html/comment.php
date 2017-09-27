<?php include_once('connection.php');

	$id = $_GET['id'];
	if (empty($_GET['id'])) {
		echo "Empty ID";
		exit();
	}
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
	<link rel="stylesheet" type="text/css" href="../css/e-shop_style.css">
	<link href='https://fonts.googleapis.com/css?family=RobotoDraft' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="../../cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
</head>
<body>
	<nav class="w3-sidenav w3-collapse w3-white w3-animate-left w3-card-8" id="sidebar"> 	<!-- S I D E B A R -->

 		<a href="http://bualumnirelations@bicol-u.edu.ph" class="w3-large" id="top-sidebar">
 		<img src="../img/bulogo.png"></a>
 		<a href="javascript:void(0)" onclick="w3_close()" class="w3-hide-large w3-closenav w3-large">Close &nbsp;&nbsp;&nbsp;&times;</a>
 		<a href=".aro.html" class="w3-light-grey w3-medium">Home</a>	
		<a href=".e-shop.html" class="side" style="background-color: #ababab;">E-shop for Souvenirs and Memorabilla</a>	
		<a href="#" class="side">Donation Link</a>		
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
		<a href="#" class="side">BU Alumni Stories</a>		
		<a href="javascript:void(0)" class="side" onclick="myFunc('side1')">BUARO Events<i class="fa fa-caret-down"></i></a>
			<div id="side1" class="w3-accordion-content w3-animate-left w3-padding">
				<a href="http://bicol-u.edu.ph/alumni/BU2016Alumni.php">BU2017 Outstanding Alumni</a>
				<a href="http://bicol-u.edu.ph/alumni/first_buce_alumni.php">ANS-BTC-BUCE Grand</a>
				<a href="http://bicol-u.edu.ph/alumni/charter.php">47th BU Charter Day</a>
				<a href="http://bicol-u.edu.ph/alumni/alumniday2.php">Alumni Day</a>
				<a href="http://bicol-u.edu.ph/alumni/exemplar.php">Exemplar Awards</a>
				<a href="http://bicol-u.edu.ph/alumni/valentine.php">Valentine Date with Alumni</a>
				<a href="http://bicol-u.edu.ph/alumni/outstandingalumni.php">Search for Outstanding Alumni</a>
			</div>	
		<a href=".about.html" class="side">About BUARO</a>
		<a href=".contact.html" class="side">Contact Us</a>
	</nav>

	<div class="w3-overlay w3-hide-large" onclick="w3_close()" id="close"></div>

	<div class="w3-main">											<!--  T  H  E     M  A  I  N     B  O  D  Y  -->

		<div id="topbar" style="z-index: 100;">
			<h4 id="topbar1">Souvenirs and Memorabilla</h4>
			<a id="toggle" class="w3-hover-black w3-opennav" href="javascript:void(0)" onclick="w3_open()">&#9776;</a>
		</div>

		<header class="w3-container w3-theme w3-padding-64 w3-padding-jumbo">
			<img src="../img/logo.gif" id="aro_logo">
			<h1 class="w3-xxxlarge w3-padding-16 w3-animate-bottom"><span class="highlight">A</span>lumni <span class="highlight">R</span>elations <span class="highlight">O</span>ffice</h1>
		</header>
		
		<div>												<!--  T  H  E     C  O  N  T  E  N  T  -->
			<div class="w3-container w3-padding-jumbo">					
				<div class="w3-container w3-section w3-center">
					<br/>

					<div class="cols">
						<div class="w3-example">
							<form action="data.php" method="POST">
								<input  hidden name="id" value="<?php echo $id; ?>">
								<table>
									<tbody >
										<tr>
											<td><h4>Nickname: </h4></td>
											<td><input type="text" name="nickname" style="width: 100%;"></td>
										</tr>
										<tr>
											<td><h4>Comment: </h4></td>
											<td><textarea rows="4" cols="30" name="comm" style=" width: 100%; margin-right: 20px;"></textarea></td>
										</tr>
										<tr>
											<td>
												<input class="w3-btn w3-teal" style="margin: 10px; float: right;" type="submit" name="sub">
											</td>
										</tr>
										<tr>
											<td style="color: #441cff;">
												<a class="w3-btn w3-teal" href="e-shop.php" style="float: left; margin-top: -45px;"><< Back</a>
											</td>
										</tr>
									</tbody>
								</table>
							</form>
						</div>

						<div class="w3-example" style="margin:10px;text-align: left;">
							<div style="max-height: 500px; overflow-y: scroll;">
								<center><h2>Comments</h2></center>
							<?php


								$sql = "SELECT mem_id,nick,content,timestamp FROM comments WHERE mem_id=".$id." ORDER BY timestamp DESC";
								$exec = mysqli_query($con,$sql);

								while ($data = mysqli_fetch_array($exec)) {
									$nick = $data['nick'];
									$content = $data['content'];
									$timestamp = $data['timestamp'];

									echo "<h5>".$nick."<i style='font-size:10px;'> ".$timestamp."</i>".": ".$content."</h5>";
								}
							?>
							</div>
						</div>




					</div>
			
					<br/><br/><br/>
				</div>
			</div>
			<footer>											<!--  F  O  O  T  E  R  -->
				<div id="bot">
					<h5 class="foot">Copyright &copy;2017.  All Rights Reserved</h5>
				</div>
			</footer>
		</div>
	</div>

<script src="../js/js_1.js"></script>
<script src="../js/js_2.js"></script>
<script src="../js/js_3.js"></script>
<script src="../js/js_4.js"></script>
</body>
</html>