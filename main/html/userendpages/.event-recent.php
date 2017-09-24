<?php
	include '../connection.php';
	include '../../../vendor/parsedown-master/Parsedown.php';
	require_once '../../../admin/php/backend/input_handler.php';
?>
<link rel="stylesheet" type="text/css" href="../css/breadcrumb.css">
<script type="text/javascript" src="userendpages/loadjs/viewS.js"></script>
<div id="content2">												<!--  T  H  E     C  O  N  T  E  N  T  -->
			
			<div class="w3-container w3-padding-jumbo">
				<ul class="breadcrumb">
				  <li><a href="aro3.php">Home</a></li>
				  <li>Recent Events</li>
				</ul>
				<?php
					$parsedown = new Parsedown();
					$getquery = "SELECT * FROM post WHERE post_type = 2  AND status = 'shown'";
					$getquery .= "ORDER BY eventdate DESC";
					$run = mysqli_query($con,$getquery);
					$id = 0;
					$today = date("Y-m-d");
					while($row = mysqli_fetch_array($run)){
						$newstring = decode(substr($parsedown->text($row['content']),0,250));
						if($row['eventdate'] < $today){
						echo '
						<div>					
							<h3 class="title">'.$row['title'].'</h3>		
  							<p>'.$newstring.'</p>
							<a href="#" onclick="viewEvent('.$row['post_id'].')" class="w3-btn w3-large w3-theme w3-margin-bottom"> <h5 class="read">Read More</h5></a>
						</div>
						<hr>
							';
						$id++;
					}
					}
				?>
				<!--<?php
					$parsedown = new Parsedown();
					$getquery = "SELECT * FROM post WHERE post_type = 1";
					$run = mysqli_query($conn,$getquery);
					$id = 0;
					while($row = mysqli_fetch_array($run)){
						echo '
						<div>					
							<h3 class="title">'.$row['title'].'</h1>
							<button onclick="myFunc('.$id.')" class="w3-btn w3-large w3-theme w3-margin-bottom"> <h5 class="read">Read More</h5></button>
							<div id="'.$id.'" class="w3-accordion-content">
							<div class="w3-container w3-padding-jumbo">				
  								<p class = "gallerytext">'.$parsedown->text($row['content']).'</p>		
								<br/>
								<br/>
							</div>
							</div>
						</div>
						<hr>
							';
						$id++;
					}
				?>-->	
			</div>