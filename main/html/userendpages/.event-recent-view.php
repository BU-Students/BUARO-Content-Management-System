<?php
	include '../connection.php';
	include '../../parsedown-master/Parsedown.php';

	$id = $_GET['id'];
	$query = "SELECT * FROM post WHERE post_id='$id'";
	$run = mysqli_query($con,$query);

	$fetch = mysqli_fetch_array($run);
	function decode($string) {
	return htmlspecialchars_decode($string, ENT_HTML5 | ENT_QUOTES);
}

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
			<div class="w3-container w3-padding-jumbo">
				<ul class="breadcrumb">
				  <li><a href="aro3.php">Home</a></li>
				  <li><a href="#" onclick="loadRecent()">Recent Events</a></li>
				  <li><?php echo $fetch['title']?></li>		
				</ul>					
				<h1 class="title"><?php echo $fetch['title']; ?></h1><br>
				<h6><b>Event Date: <?php echo date("Y-M-d",strtotime($fetch['eventdate']))?></b></h6>
				
				<?php
						if($fetch['imglinks']!="none"){
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
												<center><img class="img-rounded" src="../admin/img/'.$links.'" alt="img-'.$links.'"></center>
											</div>
										';
										$q++;
									}
									else{
										echo '
											<div class="item">
											 <center> <img class="img-rounded" src="../admin/img/'.$links.'" alt="img-'.$links.'"></center>
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
										  <center><img src="../admin/img/../img/imgfolders/noslider.jpg" alt="no images"></center>
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
					<center><img style="width: 700px;"  src="../admin/img/<?php echo $fetch['imgbanner'] ?>" ></center>
					<h5 style = "padding:20px;"><?php
						$parsedown = new Parsedown(); 
						echo decode($parsedown->text($fetch['content']));?></h5>
					
			
				
			</div>
</div>
