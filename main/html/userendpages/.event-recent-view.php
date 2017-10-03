<?php
	include '../connection.php';
	include '../../../vendor/Parsedown/Parsedown.php';

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
			
				<ul class="breadcrumb">
					<a class="w3-padding-16 w3-opennav" href="javascript:void(0)" onclick="w3_open()" style="text-decoration:none;margin-left:30px;margin-right:10px;font-size:20px;">&#9776;</a>
				  	<li><a href="aro3.php">Home</a></li>
				  	<li><a href="#" onclick="loadRecent()">Recent Events</a></li>
				  	<li><?php echo $fetch['title']?></li>		
				</ul>					
				<div class="w3-container w3-padding-jumbo">
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
												<center><img class="img-rounded" src="'.$links.'" alt="img-'.$links.'" style = "width:950px; height:300px;"></center>
											</div>
										';
										$q++;
									}
									else{
										echo '
											<div class="item">
											 <center> <img class="img-rounded" src="'.$links.'" alt="img-'.$links.'" style = "width:950px; height:300px;"></center>
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
										  <center><img src="../../data/events-stories/noslider.jpg" alt="no images" style = "width:950px; height:300px;"></center>
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
					<center><h1 class="title"><?php echo $fetch['title']; ?></h1><br></center>
					<center><img style="width: 700px;"  src="../admin/img/<?php echo $fetch['imgbanner'] ?>" ></center>
					<h5 style = "padding:20px;"><?php
						$parsedown = new Parsedown(); 
						echo decode($parsedown->text($fetch['content']));?></h5>
						
			</div>
</div>
