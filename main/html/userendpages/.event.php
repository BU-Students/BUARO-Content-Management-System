<?php
	include '../connection.php';
	include '../../../vendor/Parsedown/Parsedown.php';
	require_once '../../../admin/php/backend/input_handler.php';

	$id = $_GET['id'];
	$query = "SELECT * FROM post WHERE post_id='$id'";
	$run = mysqli_query($con,$query);

	$fetch = mysqli_fetch_array($run);
?>
<style>
.carousel {
   width:80%;
   height:100%;
}
</style>
<link rel="stylesheet" type="text/css" href="../css/breadcrumb.css">
<div>	
											<!--  T  H  E     C  O  N  T  E  N  T  -->
			
			<div class="top-b">
				<ul class="breadcrumbs">
					<a class="w3-padding-16 w3-opennav" href="javascript:void(0)" onclick="w3_open()" style="text-decoration:none;margin-left:40px;margin-right:10px;font-size:20px;color:white;">&#9776;</a>
				  <li><a href="aro3.php">Home</a></li>
				  <li>Upcoming Events</li>
				  <li><?php echo $fetch['title']?></li>
				  <li><a href="#" onclick="loadRecent()">Recent Events || </a> <a href="#" onclick="loadStories()">Stories</a>
				  </li>
				</ul>
			</div>
				<div class="w3-container w3-padding-jumbo">
				<h1 class="title"><?php echo $fetch['title']; ?></h1>
				<h4><b>Event Date: <?php echo date("M-d-Y",strtotime($fetch['eventdate']))?></b></h4>
				<?php

					if($fetch['imglinks']!=""){
						echo '
							<div class="container">
							<div id="myCarousel-'.$fetch['post_id'].'" class="carousel slide" data-ride="carousel">
							  <!-- Wrapper for slides -->
							  <div class="carousel-inner">
							';

						$nostr = explode(";", $fetch['imglinks']);
						$q=0;
							echo '<ol class="carousel-indicators">';
						foreach($nostr as $z){
								if($q==0)
									echo ' <li data-target="#myCarousel-'.$fetch['post_id'].'" data-slide-to="'.$q.'" class="active"></li>';
								else
									echo '<li data-target="#myCarousel-'.$fetch['post_id'].'" data-slide-to="'.$q.'"></li>';
								$q++;
						}
						echo '</ol>';
							$strings = explode(";", $fetch['imglinks']);
							$q=1;
							foreach ($strings as $links) {
								if($q==1){
									echo '
										<div class="item active">
										<img class="img-rounded" src=" '.$links.'" alt="img-'.$links.'" " style = "width:950px; height:300px;">
										</div>
									';
									$q++;
								}
									else{
										echo '
											<div class="item">
											 <img class="img-rounded" src=" '.$links.'" alt="img-'.$links.'" " style = "width:950px; height:300px;">
											</div>
										';
									}

								}

								echo '
									</div>
									  <!-- Left and right controls -->
									  <a class="left carousel-control" href="#myCarousel-'.$fetch['post_id'].'" data-slide="prev">
										<span class="glyphicon glyphicon-chevron-left"></span>
										<span class="sr-only">Previous</span>
									  </a>
									  <a class="right carousel-control" href="#myCarousel-'.$fetch['post_id'].'" data-slide="next">
										<span class="glyphicon glyphicon-chevron-right"></span>
										<span class="sr-only">Next</span>
									  </a>
									</div>
									</div>
								';
						}
						else{
							echo '
									<div class="container">
									<div id="emptyCarousel-'.$fetch['post_id'].'" class="carousel slide" data-ride="carousel">
									  <!-- Indicators -->
									  <ol class="carousel-indicators">
										<li data-target="#emptyCarousel-'.$fetch['post_id'].'" data-slide-to="0" class="active"></li>
									  </ol>

									  <!-- Wrapper for slides -->
									  <div class="carousel-inner">
										<div class="item active">
										  <img src="../../data/events-stories/noslider.jpg" alt="no images" " style = "width:950px; height:300px;">
										</div>
									  </div>
									  <!-- Left and right controls -->
									  <a class="left carousel-control" href="#emptyCarousel-'.$fetch['post_id'].'" data-slide="prev">
										<span class="glyphicon glyphicon-chevron-left"></span>
										<span class="sr-only">Previous</span>
									  </a>
									  <a class="right carousel-control" href="#emptyCarousel-'.$fetch['post_id'].'" data-slide="next">
										<span class="glyphicon glyphicon-chevron-right"></span>
										<span class="sr-only">Next</span>
									  </a>
									</div>
								</div>
							';
						}				
					?>	
					<hr>
					<?php
					if(!isset($fetch['imgbanner']) || $fetch['imgbanner']=="none" || $fetch['imgbanner']==""){
							$fetch['imgbanner'] = "../../data/events-stories/noimage.jpg";
						
						}
						echo'
							<center><img src = " '.$fetch['imgbanner'].'" style = "height:20%; width:20%;" class ="w3-round-xxlarge">
							</center>
							';
					?>
					<br>					
				
				<h5><?php
						$parsedown = new Parsedown(); 
						echo decode($parsedown->text( $fetch['content']));?></h5>
</div>
			