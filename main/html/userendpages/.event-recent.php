<?php
	include '../connection.php';
	include '../../../vendor/Parsedown/Parsedown.php';
	require_once '../../../admin/php/backend/input_handler.php';
?>

<style>
.pic img {
  height: 150px;
  width:150px;
  border-radius:50%;

 
  -webkit-transition: all 1s ease;
     -moz-transition: all 1s ease;
       -o-transition: all 1s ease;
      -ms-transition: all 1s ease;
          transition: all 1s ease;

}
 
.pic img:hover {
  width: 200px;
  height: 200px;
  box-shadow: 0px 0px 20px 10px rgba(65, 65, 65, 0.99);
}
</style>

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
						if(!isset($row['imgbanner']) || $row['imgbanner']=="none" || $row['imgbanner']==""){
							$row['imgbanner'] = "../../data/events-stories/noimage.jpg";
						}

						echo '
						<div class = "pic" onclick="viewEvent('.$row['post_id'].')">
							<h4><b>Event Date: '.date("M d, Y",strtotime($row['eventdate'])).'</b></h4>						
							<h3 class="title">'.$row['title'].'</h3>	
							<img src="'.$row['imgbanner'].'" alt = "Avatar">		
  							<p>'.decode($newstring).'</p>
						</div>
						<hr>
							';
						$id++;
					}
					}
				?>
				
			</div>