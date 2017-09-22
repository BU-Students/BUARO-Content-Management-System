<!DOCTYPE html>
<html>
<head>

<style>
input[type=text], select, textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-top: 6px;
    margin-bottom: 16px;
    resize: vertical;
}

input[type=submit] {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type=submit]:hover {
    background-color: #45a049;
}

.container {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
}
</style>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>BU | Alumni Relations Office</title>
	<link rel="stylesheet" href="../css/w3.css">
	<link rel="stylesheet" href="../css/w3-theme-teal.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link href='https://fonts.googleapis.com/css?family=RobotoDraft' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="../../cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
</head>
<body>
	<nav class="w3-sidenav w3-collapse w3-white w3-card-2" id="sidebar"> 	<!-- S I D E B A R -->

 		<a href="http://bualumnirelations@bicol-u.edu.ph" class="w3-large" id="top-sidebar">
 		<img src="../img/bulogo.png"></a>
 		<a href="javascript:void(0)" onclick="w3_close()" class="w3-hide-large w3-closenav w3-large">Close &nbsp;&nbsp;&nbsp;&times;</a>
 		<a href="aro3.php" class="w3-light-grey w3-medium">Home</a>
		<a href="e-shop.php" class="side">E-shop for Souvenirs and Memorabilla</a>	
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
		<a href="eventstory.php" class="side">BU Alumni Stories/Event</a>
		<a href=".about.html" class="side">About BUARO</a>
		<a href=".contact.php" class="side" style="background-color: #ababab;">Contact Us</a>
	</nav>

	<div class="w3-overlay w3-hide-large" onclick="w3_close()" id="close"></div>

	<div class="w3-main">											<!--  T  H  E     M  A  I  N     B  O  D  Y  -->

		<div id="topbar">
			<h4 id="topbar1">How to Contact Us</h4>
			<a id="toggle" class="w3-hover-black w3-opennav" href="javascript:void(0)" onclick="w3_open()">&#9776;</a>
		</div>

		<header class="w3-container w3-theme w3-padding-64 w3-padding-jumbo">
			<img src="../img/logo.gif" id="aro_logo">
			<h1 class="w3-xxxlarge w3-padding-16 w3-animate-bottom"><span class="highlight">A</span>lumni <span class="highlight">R</span>elations <span class="highlight">O</span>ffice</h1>
		</header>
		
		<div>												<!--  T  H  E     C  O  N  T  E  N  T  -->
			<div class="w3-container w3-padding-jumbo" style="background-image: url('../img/BU.jpg'); background-size: 100%; background-repeat: no-repeat;">					
				<h1 class="title">Contact Us</h1><br>
				<h5>BUREPC Building</h5>
				<h5>Bicol University</h5>
				<h5>Legazpi City, Philippines</h5>
				<h5>Email: <a href="bualumnirelations@bicol-u.edu.ph">bualumnirelations@bicol-u.edu.ph</a></h5>
				<h5>(052) 480-01-79/(052) 483-45-88</h5>
				<h5>Facebook Page <a href="http://wwww.facebook.com/BUAlumniRelations">http://wwww.facebook.com/BUAlumniRelations</a></h5>
				<br/>

				<!--  FEED BACKKKK!!!!!!!!!!!!!!!  -->
				<br><br><h3>Give feedback</h3>
				<h4>Let us know what we can do to help you</h4>

				<div class="container">
				  <form action="feedback.php" method="post">
				   
				    <label for="lname">Email Address</label>
				    <input type="text" id="feedemail" name="feedemail" placeholder="Your Email Address.." required="">

				  

				    <label for="subject">Message</label>
				    <textarea id="feedmessage" name="feedmessage" placeholder="Write something.." style="height:200px" required=""></textarea>


					<input type="submit" value="Submit">
				   
				  </form>
				</div>
			<!--  FEED BACKKKK!!!!!!!!!!!!!!!  -->





			</div>
			<footer>											<!--  F  O  O  T  E  R  -->
				<div id="bot">
					<h5 class="foot">Copyright &copy;2017.  All Rights Reserved</h5>
				</div>
			</footer>
		</div>
	</div>

<script type="text/javascript" src="../js/js_1.js" ></script>
<script type="text/javascript" src="../js/js_2.js"></script>
<script type="text/javascript" src="../js/js_3.js"></script>
<script type="text/javascript" src="../js/js_3.js"></script>
</body>
</html>