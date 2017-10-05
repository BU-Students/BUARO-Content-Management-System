<?php
	include_once "connection.php";
?>
<nav class="w3-sidenav w3-animate-left w3-white w3-card-8" id="sidebar" style="width: 0px;"> 	<!-- S I D E B A R -->

 		<a href="http://bualumnirelations@bicol-u.edu.ph" class="w3-large" id="top-sidebar">
 		<img src="../img/bulogo.png"></a>
 		<a href="javascript:void(0)" onclick="w3_close()" class="w3-closenav" style="float:right;">&times;</a>
 		<a href="aro3.php" class="side">Home</a>	
		<a href="e-shop.php" class="side" style="background-color: #ababab;">E-shop for Souvenirs and Memorabilla</a>	
		<a href=".donate.php" class="side">Donation Link</a>		
		<a href="javascript:void(0)" class="side" onclick="myFunc('side')">UNIT/College <i class="fa fa-caret-down"></i></a>
			<div id="side" class="w3-accordion-content w3-animate-left w3-padding">
				<?php
					$sql_side = "SELECT * FROM college";
					$exec_side = $con->query($sql_side);

					while ($rows = $exec_side->fetch_assoc()) {
						echo '<a href="unit_college.php?college='.str_replace(' ', '%20', $rows['label']).'">'.$rows['label'].'</a>';
					}
				?>
        	</div>
		<a href="javascript:void(0)" class="side" onclick="myFunc('side1')">BU Alumni Stories/Events<i class="fa fa-caret-down"></i></a>
			<div id="side1" class="w3-accordion-content w3-animate-left w3-padding">
				<label>Upcoming Events</label>
				<?php
					$getquery = "SELECT * FROM post WHERE post_type = 2 AND status = 'shown'";
					$run = mysqli_query($con ,$getquery);
					$today = date("Y-m-d");
					while($row = mysqli_fetch_array($run)){
						if($row['eventdate'] > $today)
								echo '<a href="#" onclick="loadAroEvent('.$row['post_id'].')"> '.$row['title'].' </a> ';
					}
					
				?>
				<label>Other</label>
				<a href="#" onclick="loadRecent()">Recent Events</a> 
			</div>			
		<a href=".about.html" class="side">About BUARO</a>
		<a href=".contact.php" class="side">Contact Us</a>
	</nav>

<script src="../js/js_2.js"></script>