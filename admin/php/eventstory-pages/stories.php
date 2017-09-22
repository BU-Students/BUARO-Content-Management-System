																					<!--C O N T E N T -->
<div class="container-fluid" id="story-container">
	<div id="story-cont"></div>
<br>
<?php

include '../backend/connection.php';
include '../backend/input_handler.php';
require_once "../../../parsedown-master/Parsedown.php";
	$sql = "SELECT * FROM POST WHERE post_type=1";
	$sql .= " ORDER BY timestamp DESC";
	$result = $conn->query($sql);
	$parser = new Parsedown();
	$showlimit = 4;
	$flag = 1;
	$pagenum = 0;

	while($row = $result->fetch_assoc()) {
		if($row['status']=="shown")
			$status = "btn btn-default btn-s";
		else
			$status = "btn btn-warning btn-s";
		if($flag==1){
				$pagenum++;
				echo '<div id="story-page-'.$pagenum.'" class="hidden">';
			}
		echo '
			<div class="col-md-6">
				<div class="story">
				<div class="story-header">
					<div class="story-options-container">
						<button type="button" class="btn btn-default btn-s" data-toggle="modal" data-target="#edit-story-'.$row['post_id'].'"><span class="glyphicon glyphicon-pencil"></span></button>
						<button type="button" class="'.$status.'" id="status-story-'.$row['post_id'].'" onclick="changeStatus('.$row['post_id'].',\''.$row['status'].'\')"><span class="glyphicon glyphicon-eye-open" "></span> '.$row['status'].'</button>
					</div>
					<div class="story-title">'.$row['title'].'</div>
					<div class="story-date">Date Posted: '.date('F d, Y | g:i A', strtotime(str_replace('-', '/', $row['timestamp']))).'</div>
					</div>
					<hr>
					<button class="btn btn-default btn-s" data-toggle="modal" data-target="#expanded-story-'.$row['post_id'].'">See More<span class="glyphicon glyphicon-menu-right"></span></button>
					<div class="story-content">
						'.$parser->text(decode($row['content'])).'
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
?>
</div>
<center>
<nav aria-label="Page navigation">
	<ul class="pagination">
		<li>
			<a href="#" aria-label="Previous">
				<span aria-hidden="true">&laquo;</span>
			</a>
		</li>
		<?php
				$count = 1;
				
					while($count <= $pagenum){
					echo '
						<li><a href="#" onclick="change('.$count.')">'.$count.'</a></li>	
					';
					$count++;
				}
		?>
		<li>
			<a href="#" aria-label="Next">
				<span aria-hidden="true">&raquo;</span>
			</a>
		</li>
	</ul>
</nav>
</center>

<!--Each story get their own modal-->
<?php
	$sql = "SELECT * FROM POST WHERE post_type=1";
	$sql .= " ORDER BY timestamp DESC";
	$result = $conn->query($sql);
	$parser = new Parsedown();

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
			$stringdis="";
			$read="";
		}
		echo '
			<div class="modal fade" id="expanded-story-'.$row['post_id'].'" role="dialog" tabindex="-1">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title" id="expanded-story-title">'.$row['title'].'</h4>
						<h6 id="expanded-story-date">'.$row['timestamp'].'</h6>
					</div>
					<div class="modal-body">
					
					<div class="container-fluid">
						<div class="col-md-5">
							<div id="expanded-story-body">
								<center><img class="img-responsive" src="'.$row['imgbanner'].'"></center><br><br>
								<div class="panel panel-default" data-toggle="collapse" data-target="#story-collapse-'.$row['post_id'].'" aria-expanded="false" aria-controls="story-collapse-'.$row['post_id'].'">
							 		<div class="panel-body">
							 		'.$stringnow.'
							 			<div class="collapse" id="story-collapse-'.$row['post_id'].'">
											'.$stringdis.'
										</div>
										<b>'.$read.'</b>
							  		</div>
								</div>
							</div>
						</div>

						<div class="col-md-7">';
						//Carousel
						if($row['imglinks']!="" || $row['imglinks']!=NULL || !empty($row['imglinks'])){
							echo '
								<div class="container">
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
												<img class="img-rounded" src="'.$links.'" alt="img-'.$links.'">
											</div>
										';
										$q++;
									}
									else{
										echo '
											<div class="item">
											  <img class="img-rounded" src="'.$links.'" alt="img-'.$links.'">
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
									<div class="container">
									<div id="emptyCarousel-'.$row['post_id'].'" class="carousel slide" data-ride="carousel" style="width: 600px; height: auto;">
									  <!-- Indicators -->
									  <ol class="carousel-indicators">
										<li data-target="#emptyCarousel-'.$row['post_id'].'" data-slide-to="0" class="active"></li>
									  </ol>

									  <!-- Wrapper for slides -->
									  <div class="carousel-inner">
										<div class="item active">
										  <center><img src="../../data/events-stories/noslider.jpg" alt="no images"></center>
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
?>


<!--Each story get their own edit modal-->
<?php
	$sql = "SELECT * FROM POST WHERE post_type=1";
	$sql .= " ORDER BY timestamp DESC";
	$result = $conn->query($sql);
	$parser = new Parsedown();

	while($row = $result->fetch_assoc()) {
		echo '
			<!-- Modal -->
			<div class="modal fade" id="edit-story-'.$row['post_id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">Edit</h4>
						</div>
						<form id="editor-form" method="POST" action="backend/update_content.php" enctype="multipart/form-data">
							<input class="hidden" name="id" value="'.$row['post_id'].'">
							<div class="modal-body">
								<div>
									<div class="form-group">
										<label for="exampleInputEmail1">Title</label>
										<input type="text" class="form-control" id="post-title" placeholder="Title" name="post-title" value="'.$row['title'].'" required>
									</div>
									<div class="form-group">
										<label>Image Banner</label>
										<input type="file" id="endis-'.$row['post_id'].'" name="img-banner" disabled>
										<input class="hidden" name="curr-banner" value="'.$row['imgbanner'].'">
										<input type="radio" name="replace-banner" value="" onclick="endis2('.$row['post_id'].')" checked><label> Keep Default Banner</label>
										<input type="radio" name="replace-banner" onclick="endis1('.$row['post_id'].')"><label> Change Banner</label>
									</div>
									<div class="form-group">
										<div class="dropdown">
											<button type="button class="btn1 btn-select1" data-toggle="dropdown">Content Type</button>
											<ul class="dropdown-menu dropdown-menu-select">
												<li>
													<label class="dropdown-radio1">
														<input type="radio" value="1" name="content-type" onclick="chng3('.$row['post_id'].')" checked>
														<i>Story</i>
													</label>
												</li>
												<li>
													<label class="dropdown-radio1">
														<input type="radio" value="2" name="content-type" onclick="chng2('.$row['post_id'].')">
														<i>Event</i>
													</label>
												</li>
												<li>
													<label class="dropdown-radio1">
														<input type="radio" value="3" name="content-type" onclick="chng3('.$row['post_id'].')">
														<i>Bulletin Item</i>
													</label>
												</li>
											</ul>
										</div>
										<div id="dateEvent-'.$row['post_id'].'" class="hidden"><label for="event-date"><input type="date" name="event-date" id="event-date">Date of Event</label></div>
									</div>
									<div class="form-group">
										Content: <textarea class="form-control" rows="5" id="textarea2-'.$row['post_id'].'" name="content2">'.substr(($parser->text(decode($row['content']))),0).'</textarea>
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
			</div>';
	}
?>
