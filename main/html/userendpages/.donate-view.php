<?php
	include '../connection.php';
	include '../globalincludes/db_handler.php';
	include '../parsedown-master/Parsedown.php';

	$id = $_GET['id'];
	$query = "SELECT * FROM post WHERE post_id='$id'";
	$run = mysqli_query($conn,$query);

	$fetch = mysqli_fetch_array($run);
?>
<!--<style>
.bannerimage {
  width: 100%;
  background-image: url(img/blue.jpg);
  height: 305px;
  background-color: purple;
  background-position: center;
}
</style>-->

<link rel="stylesheet" type="text/css" href="css/breadcrumb.css">
												<!--  T  H  E     C  O  N  T  E  N  T  -->
			<div class="w3-container w3-padding-jumbo">
				<ul class="breadcrumb">
				  <li><a href="aro3.php">Home</a></li>
				  <li><a href="#" onclick="loadDonate()">Donation Link</a></li>
				  <li><?php echo $fetch['title']?></li>
				</ul>
				<?php
					$parsedown = new Parsedown();
					echo '
						<div>					
							<h3 class="title">'.$fetch['title'].'</h1>
							<div class="w3-container w3-padding-jumbo">	
								<div class="bannerimage"></div>		
  								<p class = "gallerytext">'.$parsedown->text($fetch['content']).'</p>		
								<br/>
								<br/>
							</div>
							</div>
						</div>
							'
				?>
			</div>