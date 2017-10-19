																					<!--C O N T E N T -->
<div class="container-fluid" id="event-container">
	<div id="event-cont"></div>
<br>
<?php
include '../backend/connection.php';
include '../backend/input_handler.php';
require_once "../../../vendor/Parsedown/Parsedown.php";
	if($_SESSION['admin-type']==1)
		$sql = "SELECT * FROM POST,admin WHERE post.admin_id=admin.admin_id AND admin_type=".$_SESSION['admin-type']." AND post_type=2";
	else	
		$sql = "SELECT * FROM POST,admin WHERE post.admin_id=admin.admin_id AND admin_type=".$_SESSION['admin-type']." AND college=".$_SESSION['college']." AND post_type=2";
	$sql .= " ORDER BY eventdate DESC";
	$result = $conn->query($sql);
	$parser = new Parsedown();
	$showlimit = 4;
	$flag = 1;
	$pagenum = 0;
	$today = date("Y-m-d");
	if($result==true){
		while($row = $result->fetch_assoc()) {
		if(!isset($row['imgbanner']) || $row['imgbanner']=="none" || $row['imgbanner']==""){
			$row['imgbanner'] = "../../data/events-stories/noimage.jpg";
		}
		if($row['status']=="shown")
			$status = "btn btn-default btn-s";
		else
			$status = "btn btn-warning btn-s";
		if($flag==1){
				$pagenum++;
				echo '<div id="event-page-'.$pagenum.'" class="hidden">';
			}
		if($row['eventdate'] > $today){
			$event_type = "Upcoming";
		}
		else{
			$event_type="Recent";
		}
		echo '
			<div class="col-md-6">
				<div class="event">
				<div class="event-header">
					<img src="'.$row['imgbanner'].'" height="50" width="auto">
					<div class="event-options-container">
						<label><i>'.$event_type.'</i></label>
						<button type="button" class="btn btn-default btn-s" data-toggle="modal" data-target="#edit-event-'.$row['post_id'].'" onclick="loadEditor('.$row['post_id'].')"><span class="glyphicon glyphicon-pencil"></span></button>
						<button type="button" class="'.$status.'" id="status-event-'.$row['post_id'].'" value="'.$row['status'].'" onclick="changeStatus_events('.$row['post_id'].',\''.$row['status'].'\')"><span class="glyphicon glyphicon-eye-open" "></span> '.$row['status'].'</button>
					</div>
					<div class="event-title">'.$row['title'].'</div>
					<div class="event-date">Date Posted: '.date('F d, Y | g:i A', strtotime(str_replace('-', '/', $row['timestamp']))).'</div>
					<div class="event-date"><b>Event due: '.date('F d, Y | g:i A', strtotime(str_replace('-', '/', $row['eventdate']))).'</b></div>
					</div>
					<hr>
					<button class="btn btn-default btn-s" data-toggle="modal" data-target="#expanded-event-'.$row['post_id'].'">See More<span class="glyphicon glyphicon-menu-right"></span></button>
					<div class="event-content">
						'.substr(($parser->text(decode($row['content']))),0).'
					</div>
				</div>
			</div>';
		if($flag==$showlimit){
			$flag=0;
			echo '</div>';
		}
		$flag++;
	}
	if($flag!=1){
		echo '</div>';
	}
	}
	else{
		echo "No events posted yet";
	}
	
?>
</div>
<center>
<nav aria-label="Page navigation">
	<ul class="pagination">
		<?php
				$count = 1;
				echo '
					<li>
						<a href="#" aria-label="Previous"onclick="decrpge_event('.$pagenum.')">
							<span aria-hidden="true">&laquo;</span>
						</a>
					</li>
					';
					while($count <= $pagenum){
					echo '
						<li><a href="#" onclick="changeevents('.$count.')">'.$count.'</a></li>	
					';
					$count++;
				}
				echo '
					<li>
					<a href="#" aria-label="Next" onclick="incrpge_event('.$pagenum.')">
						<span aria-hidden="true">&raquo;</span>
					</a>
				</li>
				';
						
		?>
	</ul>
</nav>
</center>

<!--For the events modal, each events get their own modal-->
<?php
	if($_SESSION['admin-type']==1)
		$sql = "SELECT * FROM POST,admin WHERE post.admin_id=admin.admin_id AND admin_type=".$_SESSION['admin-type']." AND post_type=2";
	else	
		$sql = "SELECT * FROM POST,admin WHERE post.admin_id=admin.admin_id AND admin_type=".$_SESSION['admin-type']." AND college=".$_SESSION['college']." AND post_type=2";
	$sql .= " ORDER BY eventdate DESC";
	$result = $conn->query($sql);
	$parser = new Parsedown();
	if($result==true){
	while($row = $result->fetch_assoc()) {
		if(!isset($row['imgbanner']) || $row['imgbanner']=="none" || $row['imgbanner']==""){
			$row['imgbanner'] = "../../data/events-stories/noimage.jpg";
		}
		if(strlen($row['content'])>1000){
			$stringstrt = strpos($parser->text(decode($row['content'])),".");
			$stringstrt++;
			$stringnow = substr($parser->text(decode($row['content'])),0,$stringstrt);
			$stringdis = substr($parser->text(decode($row['content'])),$stringstrt);
			$read = "Click to read more...";
		}
		else{
			$stringstrt = 0;
			$stringnow = substr($parser->text(decode($row['content'])),0);
			$read="";
			$stringdis = "";
		}
		echo '
			<div class="modal fade" id="expanded-event-'.$row['post_id'].'" role="dialog" tabindex="-1">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title" id="expanded-event-title">'.$row['title'].'</h4>
						<h5>Number of views: '.$row['view_count'].'</h5>
						<h6 id="expanded-event-date">'.$row['timestamp'].'</h6>
						<b><h6>Event due: '.$row['eventdate'].'</h6></b>
					</div>
					<div class="modal-body">
					
					<div class="container-fluid">
						<div class="col-md-5">
							<div id="expanded-event-body">
								<center><img class="img-responsive" src="'.$row['imgbanner'].'"></center><br><br>
								<div class="panel panel-default">
							 		<div class="panel-body">
							 		'.$stringnow.'
							 			<div class="collapse" id="collapse-'.$row['post_id'].'">
											'.$stringdis.'
										</div>
										<b id="readmore-'.$row['post_id'].'" class="omoe_wa_mou_shindeiru" data-toggle="collapse" data-target="#collapse-'.$row['post_id'].'" aria-expanded="false" aria-controls="collapse-'.$row['post_id'].'" onclick="txtchange('.$row['post_id'].')">'.$read.'</b>
							  		</div>
								</div>
							</div>
						</div>

						<div class="col-md-7"><center>';
						//Carousel
						if($row['imglinks']!="" || $row['imglinks']!=NULL || !empty($row['imglinks'])){
							echo '
								<div>
								<div id="myCarousel-'.$row['post_id'].'" class="carousel slide" data-ride="carousel">
								  <!-- Wrapper for slides -->
								  <div class="carousel-inner">
								';
							
							$nostr = explode(";", $row['imglinks']);
							$q=0;
							echo '<ol class="carousel-indicators">';
							foreach($nostr as $z){
									if($q==0)
										echo ' <li data-target="#myCarousel-'.$row['post_id'].'" data-slide-to="'.$q.'" class="active"></li>';
									else
										echo '<li data-target="#myCarousel-'.$row['post_id'].'" data-slide-to="'.$q.'"></li>';
									$q++;
							}
							echo '</ol>';
							
								$strings = explode(";", $row['imglinks']);
								$q=1;
								foreach ($strings as $links) {
									if($q==1){
										echo '
											<div class="item active">
												<center><img class="img-rounded" src="'.$links.'" alt="img-'.$links.'"  style="height:100%;width:100%;"></center>
											</div>
										';
										$q++;
									}
									else{
										echo '
											<div class="item">
											  <center><img class="img-rounded" src="'.$links.'" alt="img-'.$links.'"  style="height:100%;width:100%;"></center>
											</div>
										';
									}

								}
								echo '
									</div>
									  <!-- Left and right controls -->
									  <a class="left carousel-control" href="#myCarousel-'.$row['post_id'].'" data-slide="prev">
										<span class="glyphicon glyphicon-chevron-left"></span>
										<span class="sr-only">Previous</span>
									  </a>
									  <a class="right carousel-control" href="#myCarousel-'.$row['post_id'].'" data-slide="next">
										<span class="glyphicon glyphicon-chevron-right"></span>
										<span class="sr-only">Next</span>
									  </a>
									</div>
									</div>
								';
						}
						else{
							echo '
									<div>
									<div id="emptyCarousel-'.$row['post_id'].'" class="carousel slide" data-ride="carousel">
									  <!-- Indicators -->
									  <ol class="carousel-indicators">
										<li data-target="#emptyCarousel-'.$row['post_id'].'" data-slide-to="0" class="active"></li>
									  </ol>

									  <!-- Wrapper for slides -->
									  <div class="carousel-inner">
										<div class="item active">
										  <center><img src="../../data/events-stories/noslider.jpg" alt="no images"  style="height:100%;width:100%;"></center>
										</div>
									  </div>

									  <!-- Left and right controls -->
									  <a class="left carousel-control" href="#emptyCarousel-'.$row['post_id'].'" data-slide="prev">
										<span class="glyphicon glyphicon-chevron-left"></span>
										<span class="sr-only">Previous</span>
									  </a>
									  <a class="right carousel-control" href="#emptyCarousel-'.$row['post_id'].'" data-slide="next">
										<span class="glyphicon glyphicon-chevron-right"></span>
										<span class="sr-only">Next</span>
									  </a>
									</div>
								</div>
							';
						}		
		echo'
						</center>
						</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		';
	}
}
?>

<!--Each of the events gets their own edit modal-->
<?php
	if($_SESSION['admin-type']==1)
		$sql = "SELECT * FROM POST,admin WHERE post.admin_id=admin.admin_id AND admin_type=".$_SESSION['admin-type']." AND post_type=2";
	else	
		$sql = "SELECT * FROM POST,admin WHERE post.admin_id=admin.admin_id AND admin_type=".$_SESSION['admin-type']." AND college=".$_SESSION['college']." AND post_type=2";
	$sql .= " ORDER BY timestamp DESC";
	$result = $conn->query($sql);
	$parser = new Parsedown();
	if($result==true){
	while($row = $result->fetch_assoc()) {
		echo '
		<!-- Modal -->
		<div class="modal fade" id="edit-event-'.$row['post_id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Edit</h4>
		      </div>
		      <form id="editor-form" method="POST" action="backend/update_content.php" enctype="multipart/form-data">
		      <input class="hidden" name="id" value="'.$row['post_id'].'">
		      <div class="modal-body">
		        <div id="">
						<div class="form-group">
					    <label for="exampleInputEmail1">Title</label>
					    <input type="text" class="form-control" id="post-title" placeholder="Title" name="post-title" value="'.$row['title'].'" required>
					  </div>
					  <div class="form-group">
					    <label>Image Banner</label>
					    <input type="file" id="endis-event-'.$row['post_id'].'" name="img-bannerev" disabled>
					    <input class="hidden" name="curr-banner" value="'.$row['imgbanner'].'">
					    <input type="radio" name="replace-banner" onclick="endis2_event('.$row['post_id'].')" checked><label> Keep Default Banner</label>
					    <input type="radio" name="replace-banner" onclick="endis1_event('.$row['post_id'].')"><label> Change Banner</label>
					  </div>
					  <div class="form-group">
						<div class="dropdown">
						    <button type="button" 
						      class="btn1 btn-select1"
						      data-toggle="dropdown">Content Type</button>
						    <ul class="dropdown-menu dropdown-menu-select">
						    <li><label class="dropdown-radio1">
						        <input type="radio" value="1" name="content-type" onclick="chng3_event('.$row['post_id'].')">
						        <i>Story</i>
						        </label>
						    </li>
						    <li><label class="dropdown-radio1">
						        <input type="radio" value="2" name="content-type" onclick="chng2_event('.$row['post_id'].')" checked>
						        <i>Event</i>
						        </label>
						    </li>
						    <li><label class="dropdown-radio1">
						        <input type="radio" value="3" name="content-type" onclick="chng3_event('.$row['post_id'].')">
						        <i>Bulletin Item</i>
						        </label>
						    </li>
						    </ul>
						  </div>
						<div id="event-dateEvent-'.$row['post_id'].'" class="show"><label for="event-date"><input type="date" name="event-date" id="event-date"  value="'.$row['eventdate'].'">Date of Event</label></div>
						</div>
					  <div class="form-group">
					  		Content:
					    <textarea class="form-control" rows="5" id="textarea2-'.$row['post_id'].'" name="content2">'.decode($row['content']).'</textarea>
					  </div>
				</div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        <button type="submit" class="btn btn-primary">Update</button>
		              </div>
		        </form>
		    </div>
		  </div>
		</div>

		';
	}
}
?>
