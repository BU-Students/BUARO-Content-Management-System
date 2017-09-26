<?php
	include '../connection.php';
	include '../../../vendor/Parsedown/Parsedown.php';
	function decode($string) {
	return htmlspecialchars_decode($string, ENT_HTML5 | ENT_QUOTES);
	}
?>

<link rel="stylesheet" type="text/css" href="../css/breadcrumb.css">
<script type="text/javascript" src="userendpages/loadjs/viewS.js"></script>
<div id="content2">												<!--  T  H  E     C  O  N  T  E  N  T  -->
			
			<div class="w3-container w3-padding-jumbo">
				<ul class="breadcrumb">
				  <li><a href="aro3.php">Home</a></li>
				  <li>Stories</li>
				</ul>
				<?php
					$parsedown = new Parsedown();
					$getquery = "SELECT * FROM post WHERE post_type = 1 AND status = 'shown'" ;
					$run = mysqli_query($con,$getquery);
					$id = 0;
					while($row = mysqli_fetch_array($run)){
						$newstring = substr($parsedown->text($row['content']),0,250);
						if(!isset($row['imgbanner']) || $row['imgbanner']=="none" || $row['imgbanner']==""){
							$row['imgbanner'] = "../../data/events-stories/noimage.jpg";
						}
						echo '
						<div onclick="viewStory('.$row['post_id'].')">					
							<h3 class="title">'.$row['title'].'</h3>
							<img src="'.$row['imgbanner'].'" style ="width:150px; height:150px; border-radius:50%" alt = "Avatar">		
  							<p>'.decode($newstring).'</p>
							
						</div>
						<hr>
							';
						$id++;
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