<?php include_once('connection.php');?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>BU | Alumni Relations Office</title>
	<link rel="stylesheet" href="../css/w3.css">
	<link rel="stylesheet" href="../css/w3-theme-teal.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link href='https://fonts.googleapis.com/css?family=RobotoDraft' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="../../cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	

	<!-- Add the styles below to the master CSS styles -->
	<style type="text/css">
		a.pages {
			text-decoration: none;
		}

		a.pages:hover {
			color: olive;
			transition: 0.1s;
		}

		#current_page {
			font-size: 18px;
		}

	</style>

</head>
<body>
	<nav class="w3-sidenav w3-collapse w3-white w3-animate-left w3-card-8" id="sidebar"> 	<!-- S I D E B A R -->

 		<a href="http://bualumnirelations@bicol-u.edu.ph" class="w3-large" id="top-sidebar">
 		<img src="../img/bulogo.png"></a>
 		<a href="javascript:void(0)" onclick="w3_close()" class="w3-hide-large w3-closenav w3-large">Close &nbsp;&nbsp;&nbsp;&times;</a>
 		<a href=".aro.html" class="w3-light-grey w3-medium">Home</a>	
		<a href=".e-shop.html" class="side">E-shop for Souvenirs and Memorabilia</a>	
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
		<a href=".about.html" class="side testbtn" id="about" onclick="openCity(event, 'about')">About BUARO</a>
		<a href=".contact.html" class="side">Contact Us</a>
	</nav>

	<div class="w3-overlay w3-hide-large" onclick="w3_close()" id="close"></div>

	<div class="w3-main">											<!--  T  H  E     M  A  I  N     B  O  D  Y  -->

		<div id="topbar">
			<h4 id="topbar1">A.R.O. Introduction</h4>
		</div>

		<div id="topbar2">
			<h4 id="topbar3">Bicol University Alumni</h4>
		</div>

		<div id="topbar4">
			<h4 id="topbar5">Bicol University Alumni</h4>
			<a id="toggle" class="w3-hover-black w3-opennav" href="javascript:void(0)" onclick="w3_open()">&#9776;</a>
		</div>

		<header class="w3-container w3-theme w3-padding-64 w3-padding-jumbo"><!--style="background-image: url('../img/BU_hataw.jpg'); background-size: 100%;"-->
			<img src="../img/logo.gif" id="aro_logo">
			<h1 class="w3-xxxlarge w3-padding-16 w3-animate-bottom"><span class="highlight">A</span>lumni <span class="highlight">R</span>elations <span class="highlight">O</span>ffice</h1>
		</header>
		
		<div>											<!--  T  H  E     C  O  N  T  E  N  T  -->
			<?php
				$sql_count = "SELECT COUNT(*) as total_data FROM post";
				$exec = mysqli_query($con,$sql_count);
				$data = mysqli_fetch_assoc($exec);

				if (empty($_GET['page'])){
					$_GET['page'] = 1;
				}
				//echo  ceil(floatval($data['total_data']) / 10);
				if ($_GET['page'] > ceil(floatval($data['total_data']) / 10)) {
					echo "<center><h1 style='margin-top:5%;'>PAGE NOT FOUND</h1></center>";
					exit();
				}
			?>
			<div id="breadcrumbs" style="margin: 2%;">
				<span><a style='text-decoration: none;' href="aro.php">Home</a>
				<?php
					$num = mysqli_real_escape_string($con,$_GET['page'] + 1);
					for ($page_counter = 1; $page_counter < $num; $page_counter++) { 
						if($page_counter == 0) {
							//Do nothing
						} else {
							echo " >> <a href='?page=$page_counter'>Page $page_counter</a>";
						}
					}
				?> 
					
				
				</span>
			</div>

			<div class="w3-container w3-padding-jumbo">
			<?php 
				$query = 'SELECT post_id,post_type,title,content,timestamp FROM post ORDER BY timestamp DESC';
				$run = mysqli_query($con, $query);
				$check = mysqli_num_rows($run);

				if ($check < 1) {
					echo "<script>window.alert('The Database for the e-shop is empty :(');<script>";
				}

				if ($check > 0) {
					$sql = "SELECT COUNT(*) FROM post";
					$result = mysqli_query($con, $sql) or trigger_error("SQL", E_USER_ERROR);
					$r = mysqli_fetch_row($result);
					$numrows = $r[0];

					$rowsperpage = 10;
					$totalpages = ceil($numrows / $rowsperpage);

					if (isset($_GET['page']) && is_numeric($_GET['page'])) {
					   $currentpage = (int) $_GET['page'];
					} else {
					   $currentpage = 1;
					}

					if ($currentpage > $totalpages) {
					   $currentpage = $totalpages;
					}

					if ($currentpage < 1) {
					   $currentpage = 1;
					}

					$offset = ($currentpage - 1) * $rowsperpage;

					$sql = "SELECT * FROM post ORDER BY timestamp DESC LIMIT $offset, $rowsperpage";
					$result = mysqli_query($con, $sql) or trigger_error("SQL", E_USER_ERROR);

					$count = 0;
					while ($list = mysqli_fetch_assoc($result)) {
					   $post_id = $list['post_id'];
					   $post_type = $list['post_type'];
					   $title = $list['title'];
					   $content = $list['content'];
					   $time = $list['timestamp'];

					   $cut_content = (strlen($content) > 20) ? substr($content, 0, 125) . '...' : $content;   

					   echo '
					         <div class=\'w3-example w3-section\' style="height:100%;" overflow:hidden;">
					            <h3 class=\'title\'>'.$title.'</h3>
					            <center><img src="../img/img35.jpg" style="max-height:200px;"></center>
					            <p>Time Posted: '.$time.'</p>
					   ';

					   if ((strlen($content) > 125)) {	
				   		echo '
				   			<div style="display:inline-block; white-space:nowrap; width:98%; overflow:hidden; text-overflow:ellipsis;">
					               <p>'.$cut_content.'</p>
					        </div>
				            <button onclick="myFunc(\'more'.$count.'\')" class="w3-btn w3-large w3-theme w3-margin-bottom" target="_blank"><h5 class="read">Read More &raquo;</h5></button>
				               <div id="more'.$count.'" class="w3-accordion-content">
				                  <p>'.$content.'</p><br>
				               </div>
					   ';
					   }
					   else {
					   		echo '
				   			<div style="display:inline-block; white-space:nowrap; width:98%; overflow:hidden; text-overflow:ellipsis;">
					               <p>'.$content.'</p>
					        </div>';
					   }
					   echo "</div>";
					   $count++;
					}
					$range = 3;

					if ($currentpage > 1) {
					   echo " <a class='pages' href='{$_SERVER['PHP_SELF']}?page=1'> First </a> ";
					   $prevpage = $currentpage - 1;
					   echo " <a class='pages' href='{$_SERVER['PHP_SELF']}?page=$prevpage'> Previous </a> ";
					}
					for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
					   if (($x > 0) && ($x <= $totalpages)) {
					      if ($x == $currentpage) {
					         echo " <b id='current_page'>$x</b> ";
					      } else {
					         echo " <a class='pages' href='{$_SERVER['PHP_SELF']}?page=$x'>$x</a> ";
					      }
					   }
					}

					if ($currentpage != $totalpages) {
					   $nextpage = $currentpage + 1;
					   echo " <a class='pages' href='{$_SERVER['PHP_SELF']}?page=$nextpage'> Next </a> ";
					   echo " <a class='pages' href='{$_SERVER['PHP_SELF']}?page=$totalpages'> Last </a> ";
					}
				}
			
			?>

				<br/>
					</div>
				</div>
			</div>
			<footer>											<!--  F  O  O  T  E  R  -->
				<div id="bot">
					<h5 class="foot w3-section">Copyright &copy;2017.  All Rights Reserved</h5>
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