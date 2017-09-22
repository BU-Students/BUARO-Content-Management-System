<?php
	include '../connection.php';
	include '../../parsedown-master/Parsedown.php';

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
				  <li><a href="aro3.php">Home</a></li>
				  <li>Events</li>
				  <li><?php echo $fetch['title']?></li>
				</ul>					
				<h1 class="title"><?php echo $fetch['title']; ?></h1><br>
				<h6><b>Event Date: <?php echo date("Y-M-d",strtotime($fetch['eventdate']))?></b></h6>
				<img src="../admin/img/<?php echo $fetch['imgbanner'] ?>" >
				<h5><?php
						$parsedown = new Parsedown(); 
						echo $parsedown->text( $fetch['content'])?></h5>
			</div>