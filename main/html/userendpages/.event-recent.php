<?php
	include '../connection.php';
	include '../../../vendor/Parsedown/Parsedown.php';
	require_once '../../../admin/php/backend/input_handler.php';
?>

<style>
.description p{
	max-height: 120px;
}

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
  box-shadow: 0px 0px 15px 5px rgba(65, 65, 65, 0.99);
}
.current {
  color: green;
}

#pagin li {
  display: inline-block;
}

</style>

<link rel="stylesheet" type="text/css" href="../css/breadcrumb.css">
<script type="text/javascript" src="userendpages/loadjs/viewS.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script  src="../js/jquery_pagination.js"></script>
<div id="content2">												<!--  T  H  E     C  O  N  T  E  N  T  -->
		<ul class="breadcrumb">
			<a class="w3-padding-16 w3-opennav" href="javascript:void(0)" onclick="w3_open()" style="text-decoration:none;margin-left:30px;margin-right:10px;font-size:20px;">&#9776;</a>
			<li><a href="aro3.php">Home</a></li>
			<li>Recent Events || <a href="#" onclick="loadStories()">Stories</a></li>
		</ul>	
			<div class="w3-container w3-padding-jumbo">
				
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
						<div class="pic" onclick="viewEvent('.$row['post_id'].')">
							<div class="w3-container w3-half line-content">
									<h5 class="title"><b>Event Date: '.date("M d, Y",strtotime($row['eventdate'])).'</b></h5>						
									<h4>'.$row['title'].'</h4>
									<div class="w3-container w3-half" style="margin-bottom:50px;">	
										<img src="'.$row['imgbanner'].'" alt = "Avatar">
									</div>
									<div class="w3-container description" style="max-width:500px;">		
	  								<p>'.decode($newstring).'<a style="cursor:pointer; color:#441cff;">...Read More</a></p>
	  								</div>
	  								<hr>
	  						</div>
	  						<ul id="pagin">
	  						</ul>
						</div>
							';
						$id++;
					}
					}
				?>
				
			</div>