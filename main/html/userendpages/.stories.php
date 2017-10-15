<?php
	include '../connection.php';
	include '../../../vendor/Parsedown/Parsedown.php';
	function decode($string) {
	return htmlspecialchars_decode($string, ENT_HTML5 | ENT_QUOTES);
	}
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
  box-shadow: 0px 0px 15px 5px rgba(65, 65, 65, 0.99);
}
@media (max-width: 768px){
	h3{
		font-size: 15px;
		font-weight: bold;
	}
	p{
		margin-top: 230px;
		max-width: 300px;
	}
}

</style>

<link rel="stylesheet" type="text/css" href="../css/breadcrumb.css">
<div id="content2">												<!--  T  H  E     C  O  N  T  E  N  T  -->
	<div class="top-b">
		<ul class="breadcrumbs">
			<a class="w3-padding-16 w3-opennav" href="javascript:void(0)" onclick="w3_open()" style="text-decoration:none;margin-left:40px;margin-right:10px;font-size:20px;color:white;">&#9776;</a>
			<li><a href="aro3.php">Home</a></li>
			<li>Stories || <a href="#" onclick="loadRecent()">Recent Events</a></li>
		</ul>
	</div>
			<div class="w3-container w3-padding-jumbo">
				<div id="story-cont"></div>
				<?php
					echo '<div class="post">';
					$parsedown = new Parsedown();
					$getquery = "SELECT * FROM post WHERE post_type = 1 AND status = 'shown'" ;
					$run = mysqli_query($con,$getquery);
					$id = 0;
					$showlimit = 4;
					$flag = 1;
					$pagenum = 0;
					while($row = mysqli_fetch_array($run)){
						if($flag==1){
							$pagenum++;
							if($pagenum==1)
								echo '<div id="story-page-'.$pagenum.'" class="">';
							else
								echo '<div id="story-page-'.$pagenum.'" class="hidden">';
						}
						$newstring = substr($parsedown->text($row['content']),0,250);
						if(!isset($row['imgbanner']) || $row['imgbanner']=="none" || $row['imgbanner']==""){
							$row['imgbanner'] = "../../data/events-stories/noimage.jpg";
						}
						echo '
						<div  class = "pic" onclick = "viewStory('.$row['post_id'].')">
							<div class="w3-container w3-half">
								<div style="height:50px;">
									<h3>'.$row['title'].'</h3>
								</div>
								<div class="w3-container w3-half" style="margin-bottom:50px;">
               						<img src="'.$row['imgbanner'].'"alt = "Avatar">
               					</div>
               					<div clss="w3-container" style="min-width:500px;">
									<p>'.decode($newstring).'<a style="cursor:pointer; color:#441cff;">...Read More</a></p>
								</div>
               					<hr>
               				</div>
						</div>
							';
						$id++;
						if($flag==$showlimit){
						$flag=0;
						echo '</div>';
					}
					$flag++;
					}
					if($flag!=1){
						echo '</div>';
					}
					echo '</div>';
				?>
				</div>
				<center>
				<nav aria-label="Page navigation">
					<ul class="pagination">
						<?php
							$count = 1;
							echo '
								<li>
									<a href="#" aria-label="Previous" onclick="decrpge('.$pagenum.')" id="storypage-up" class="">
										<span aria-hidden="true">&laquo;</span>
									</a>
								</li>
							';
								
									while($count <= $pagenum){
									echo '
										<li><a href="#" onclick="change('.$count.')">'.$count.'</a></li>	
									';
									$count++;
								}
							echo '
								<li>
									<a href="#" aria-label="Next"  onclick="incrpge('.$pagenum.')">
										<span aria-hidden="true">&raquo;</span>
									</a>
								</li>
							';
						?>
					</ul>
				</nav>
				</center>
				</div>
				
				