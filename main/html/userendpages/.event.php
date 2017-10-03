<?php
	include '../connection.php';
	include '../../vendor/Parsedown/Parsedown.php';
	require_once '../../../admin/php/backend/input_handler.php';

	$id = $_GET['id'];
	$query = "SELECT * FROM post WHERE post_id='$id'";
	$run = mysqli_query($con,$query);

	$fetch = mysqli_fetch_array($run);
?>
<link rel="stylesheet" type="text/css" href="../css/breadcrumb.css">
<div>	
											<!--  T  H  E     C  O  N  T  E  N  T  -->
			<div class="w3-container w3-padding-jumbo">
				<ul class="breadcrumb">
					<a class="w3-padding-16 w3-opennav" href="javascript:void(0)" onclick="w3_open()" style="text-decoration:none;margin-left:30px;margin-right:10px;font-size:20px;">&#9776;</a>
				  <li><a href="aro3.php">Home</a></li>
				  <li>Events</li>
				  <li><?php echo $fetch['title']?></li>
				</ul>
				<?php
					if(!isset($fetch['imgbanner']) || $fetch['imgbanner']=="none" || $fetch['imgbanner']==""){
							$fetch['imgbanner'] = "../../data/events-stories/noimage.jpg";
						}	

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
											<img class="img-rounded" src="../admin/img/'.$links.'" alt="img-'.$links.'">
										</div>
									';
									$q++;
								}
									else{
										echo '
											<div class="item">
											  <img class="img-rounded" src="../admin/img/'.$links.'" alt="img-'.$links.'">
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
										  <center><img src="../../data/events-stories/noslider.jpg" alt="no images"></center>
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
				<h1 class="title"><?php echo $fetch['title']; ?></h1><br>
				<h6><b>Event Date: <?php echo date("Y-M-d",strtotime($fetch['eventdate']))?></b></h6>
				<img src="../../data/events-stories/noimage.jpg" >
				<h5><?php
						$parsedown = new Parsedown(); 
						echo decode($parsedown->text( $fetch['content']));?></h5>
			</div>