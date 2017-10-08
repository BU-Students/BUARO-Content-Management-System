<?php include_once('connection.php');
include_once('../../admin/php/backend/input_handler.php');
include_once('../../vendor/Parsedown/Parsedown.php');
function type_of_event($inp) {
	switch ($inp) {
		case 1:
			$event_name = "STORY";
			break;
		case 2:
			$event_name = "EVENT";
			break;
		case 3:
			$event_name = "BULLETIN ITEM";
			break;
		case 4:
			$event_name = "ABOUT BUARO";
			break;
		default:
			$event_name = 'Error: Unable to determine event type...';
			break;
	}
	return $event_name;
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>BU | Alumni Relations Office</title>
	<link rel="stylesheet" href="../css/w3.css">
	<link rel="stylesheet" href="../css/w3-theme-teal.css">
	<link rel="stylesheet" href="../css/untitled.css">
	<link href='https://fonts.googleapis.com/css?family=RobotoDraft' rel='stylesheet' type='text/css'>
	<!--<link rel="stylesheet" href="../../cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">-->
</head>
<body>
	<div>											<!--  T  H  E     M  A  I  N     B  O  D  Y  -->
		<div id="topbar" style="z-index: 100;">
			<ul class="w3-topnav">
				<li><a href="#home" id="tab" style="color: rgb(255, 152, 0);">Home</a></li>
				<li><a href="#shop" id="tab">E-shop Souvenirs and Memorabilia</a></li>
				<li><a href=".donate.php" id="tab">Donation Link</a></li>
				<li><a href="#college" id="tab">UNIT/College</a></li>
				<li><a href="" id="tab">BU Alumni Coordinators</a></li>
				<li><a href="#stories" id="tab">BU Alumni Stories / Events</a></li>
				<li><a href="#about" id="tab">About BUARO</a></li>
				<li><a href=".contact.php" id="tab">Contact Us</a></li>
			</ul>
		</div>
		<div class="topic">
			<header class="w3-theme w3-container w3-padding-32 w3-padding-jumbo">
				<img src="../img/logo.gif" id="aro_logo">
				<h1 class="w3-xxxlarge w3-padding-32 w3-animate-bottom"><span class="highlight">A</span>lumni <span class="highlight">R</span>elations <span class="highlight">O</span>ffice</h1>
			</header>
		</div>

		<div class="main w3-card-2" id="home">
			<div>
				<div id="middle">
					<figure>
						<?php
							$upcoming_sql = "SELECT title,eventdate,imgbanner FROM post WHERE post_type=2 AND ((imgbanner IS NOT NULL) AND (imgbanner!='none') AND (imgbanner!='')) ORDER BY eventdate DESC LIMIT 5";
							$exec_upcoming = $con->query($upcoming_sql);

							$num_of_imgs = mysqli_num_rows($exec_upcoming);

							if ($num_of_imgs > 4) {
								while ($img_upcoming = $exec_upcoming->fetch_assoc()) {
									$get = $img_upcoming['imgbanner'];
									$title = $img_upcoming['title'];
									$date = $img_upcoming['eventdate']; 
									echo "
										<div class='slides'>
											<center><p style='color:#CCCCCC;text-transform:uppercase; font-size:25px;'>".$title."<br><br><br>Event Date:<br><span style='color:#FFCC00;'>".date('F, j, Y',strtotime($date))."</span></p></center>
											<img src='".$get."'>
										</div>
									";
								}
							} else {
								switch ($num_of_imgs) {
									case 4:
										$upcoming_sql = "SELECT title,eventdate,imgbanner FROM post WHERE post_type=2 AND ((imgbanner IS NOT NULL) AND (imgbanner!='none') AND (imgbanner!='')) ORDER BY eventdate DESC LIMIT 4";
										$exec_upcoming4 = $con->query($upcoming_sql);

										while ($img_upcoming = $exec_upcoming->fetch_assoc()) {
											$get = $img_upcoming['imgbanner'];
											$title = $img_upcoming['title'];
											$date = $img_upcoming['eventdate'];
											echo "
												<div class='slides'>
													<center><p style='color:#CCCCCC;text-transform:uppercase; font-size:25px;'>".$title."<br><br><br>Event Date:<br><span style='color:#FFCC00;'>".date('F, j, Y',strtotime($date))."</span></p></center>
													<img src='".$get."'>
												</div>
											";
											}
											$f_arr = $exec_upcoming4->fetch_assoc();
											$get = $f_arr['imgbanner'];
											$title = $f_arr['title'];
											$date = $f_arr['eventdate'];
											echo "
												<div class='slides'>
													<center><p style='color:#CCCCCC;text-transform:uppercase; font-size:25px;'>".$title."<br><br><br>Event Date:<br><span style='color:#FFCC00;'>".date('F, j, Y',strtotime($date))."</span></p></center>
													<img src='".$get."'>
												</div>
											";

										break;
									case 3:
										$upcoming_sql = "SELECT title,eventdate,imgbanner FROM post WHERE post_type=2 AND ((imgbanner IS NOT NULL) AND (imgbanner!='none') AND (imgbanner!='')) ORDER BY eventdate DESC LIMIT 3";
										$exec_upcoming3 = $con->query($upcoming_sql);

										while ($img_upcoming = $exec_upcoming->fetch_assoc()) {
											$get = $img_upcoming['imgbanner'];
											$title = $img_upcoming['title'];
											$date = $img_upcoming['eventdate'];
											echo "
												<div class='slides'>
													<center><p style='color:#CCCCCC;text-transform:uppercase; font-size:25px;'>".$title."<br><br><br>Event Date:<br><span style='color:#FFCC00;'>".date('F, j, Y',strtotime($date))."</span></p></center>
													<img src='".$get."'>
												</div>
											";
											}
											$f_arr = $exec_upcoming3->fetch_assoc();
											$get = $f_arr['imgbanner'];
											$title = $f_arr['title'];
											$date = $f_arr['eventdate'];

											for ($j=0; $j < 2; $j++) { 
												echo "
													<div class='slides'>
														<center><p style='color:#CCCCCC;text-transform:uppercase; font-size:25px;'>".$title."<br><br><br>Event Date:<br><span style='color:#FFCC00;'>".date('F, j, Y',strtotime($date))."</span></p></center>
														<img src='".$get."'>
													</div>
												";
											}
										break;

									case 2:
										$upcoming_sql = "SELECT title,eventdate,imgbanner FROM post WHERE post_type=2 AND ((imgbanner IS NOT NULL) AND (imgbanner!='none') AND (imgbanner!='')) ORDER BY eventdate DESC LIMIT 2";
										$exec_upcoming2 = $con->query($upcoming_sql);

										while ($img_upcoming = $exec_upcoming->fetch_assoc()) {
											$get = $img_upcoming['imgbanner'];
											$title = $img_upcoming['title'];
											$date = $img_upcoming['eventdate'];
											echo "
												<div class='slides'>
													<center><p style='color:#CCCCCC;text-transform:uppercase; font-size:25px;'>".$title."<br><br><br>Event Date:<br><span style='color:#FFCC00;'>".date('F, j, Y',strtotime($date))."</span></p></center>
													<img src='".$get."'>
												</div>
											";
											}
											$f_arr = $exec_upcoming2->fetch_assoc();
											$get = $f_arr['imgbanner'];
											$title = $f_arr['title'];
											$date = $f_arr['eventdate'];
											for ($j=0; $j < 3; $j++) { 
												echo "
													<div class='slides'>
														<center><p style='color:#CCCCCC;text-transform:uppercase; font-size:25px;'>".$title."<br><br><br>Event Date:<br><span style='color:#FFCC00;'>".date('F, j, Y',strtotime($date))."</span></p></center>
														<img src='".$get."'>
													</div>
												";
											}
			
										break;

										case 1:
											$upcoming_sql = "SELECT title,eventdate,imgbanner FROM post WHERE post_type=2 AND ((imgbanner IS NOT NULL) AND (imgbanner!='none') AND (imgbanner!='')) ORDER BY eventdate DESC LIMIT 1";
											$exec_upcoming = $con->query($upcoming_sql);

											$f_arr = $exec_upcoming->fetch_assoc();

											$get = $f_arr['imgbanner'];
											$title = $f_arr['title'];
											$date = $f_arr['eventdate'];
											for ($j=0; $j < 5; $j++) { 
												echo "
													<div class='slides'>
														<center><p style='color:#CCCCCC;text-transform:uppercase; font-size:25px;'>".$title."<br><br><br>Event Date:<br><span style='color:#FFCC00;'>".date('F, j, Y',strtotime($date))."</span></p></center>
														<img src='".$get."'>
													</div>
												";
											}
											break;
									
									default:
										# code...
										break;
								}
							}
						?>
					</figure>
					<h1> U P C O M I N G &nbsp;&nbsp;&nbsp; E V E N T S</h1>
				</div>
			</div>
																							<!--  T  H  E     C  O  N  T  E  N  T  -->
			<div class="w3-container w3-padding-jumbo" style="height: 100%;">
																							<!--  I  N  T  R  O  D  U  C  T  I  O  N  -->
				<?php
					$parser = new Parsedown();
					$sql = "SELECT title,content,post_type,imgbanner,timestamp FROM post ORDER BY timestamp DESC LIMIT 1";
					$exec = $con->query($sql);
					$fetch = $exec->fetch_assoc();

					$post_type = type_of_event($fetch['post_type']);

					if (is_null($fetch['imgbanner']) || $fetch['imgbanner'] == '' || $fetch['imgbanner'] == 'none') {
						$bnr = '';
					} else {
						$bnr = '<div class="w3-center" style="padding:0;margin:0;height:200px;background-image:url('.'\''.$fetch['imgbanner'].'\''.'); background-size: cover; background-position:center;">
					  									</div>';
					}

					echo "<h1 class='title'>".$fetch['title']."</h1>";
					echo "<hr>";
					echo '<h5 style="margin: 0;padding: 0; font-size: 11px;"><i>Published: '.$fetch['timestamp'].'</i></h5>';
					echo "<h5 style='color:#ff9800;'>".$post_type."</h5>";
					echo $bnr;
					echo "
						<ol type='a' class='w3-leftbar w3-theme-border' style='list-style-type:none;'>
							<li>".$parser->text(decode($fetch['content']))."</li>
						</ol>
					";
					

				?>
			</div>

		</div>
		<br><br><br>

		<div id="about">
			<img id="abt-img1" src="../img/fest.jpg">
			<img id="abt-img2" src="../img/smile.jpg">
			<div>
				<div class="abt_content">					
					<a href=".about.php"><h1 class="title">ABOUT</h1><br></a>
						<?php
							$parse_text = new Parsedown();

							$sql_about = "SELECT title,content FROM post WHERE post_type=4 ORDER BY timestamp DESC";
							$exec_about = $con->query($sql_about);
							$fetch_about = $exec_about->fetch_assoc();

							if (strlen($fetch_about['content']) > 585) {
								echo '<div class="abt_inside" style="height: 400px; overflow-y: scroll;">';
							}
							else {
								echo '<div class="abt_inside" style="height: 80%;">';
							}

						
						 	echo "<h5>".$parse_text->text(decode($fetch_about['title']))."</h5>";
						 	
							echo '<ol type="a" class="w3-leftbar w3-theme-border" style="word-wrap:break-word;list-style-type:none;">'.
								$parse_text->text(decode($fetch_about['content']))
							.'</ol>';
						?>			
				</div>
			</div>
		</div>

		<br/><br/>

		<div class="w3-row-padding w3-padding-32" style="background-color: #003471;">
			<div id="stories"></div>
			<br/><br/>
			<h2 style="color: white;" class="w3-quarter w3-leftbar w3-theme-border" id="stories">RECENT ALUMNI STORIES AND EVENTS</h2>			<!--  A  L  U  M  N  I  -->
			<br/><br/>
			<div class="w3-row-padding">
			<!-- This is for the stories section-->

			<?php
				$sql = "SELECT title,content,post_type,imgbanner,timestamp FROM post ORDER BY timestamp DESC LIMIT 1,3";
				$exec = $con->query($sql);

				$count = 0;
				while ($data = $exec->fetch_assoc()) {
					$title = $data['title'];
					$content = decode($data['content']);
					$time = $data['timestamp'];
					$banner = $data['imgbanner'];

					$type_post = type_of_event($data['post_type']);

					$cut_content = (strlen($content) > 20) ? substr($content, 0, 110) . '...' : $content;

					$filtered_content = '';

					if (strlen($content) > 110) {
						$filtered_content = '<p style="height:90px;width: 100%; overflow: hidden;font-size: 15px;">'.$cut_content.'.<a style="cursor:pointer; color:#441cff;" onclick="document.getElementById('.'\'more'.$count.'\''.').style.display='.'\'block\''.'">  Read More</a></p>';
					} else {
						$filtered_content = '<p style="height:100px;width: 100%;text-align: center; overflow: hidden;font-size: 15px;">'.$content.'</p>';
					}

					if (empty($title)) {
						$title = 'Empty Title';
					} else {
						//Do nothing
					}

					if (empty($content)) {
						$title = '[EMPTY CONTENT]';
					} else {
						//Do nothing
					}

					if (is_null($banner) || $banner=="none") {
						$databanner = '';
					} else {
						$databanner = '<div class="w3-center" style="padding:0;margin:0;height:300px;background-image:url('.'\''.$banner.'\''.'); background-size: cover; background-position:center;">
					  									</div>';
					}

					echo '
						<div class="w3-second">
							<div class="w3-content w3-quarter w3-section w3-example w3-card-16 w3-white" style="height: 270px; margin-top: -70px; overflow: hidden;">
								<h5 style="color:#ff9800; text-align:center;">'.$type_post.'</h5>

								<header><h5>'.$title.'</h5><h5 style="margin: 0;padding: 0; font-size: 11px; text-align: center;"><i>Published: '.$time.'</i></h5></header>
								<section>'.$filtered_content.'

					  					<div id="more'.$count.'" class="w3-modal">
					  						<div class="w3-modal-content w3-card-8 w3-animate-zoom">
					  							<div class="w3-container">
					  								<div class="w3-section">
					  									'.$databanner.'

													    <hr/>
													    <center><h3>'.$title.'</h3></center>
													    <center><i style="font-size: 11px;">Published: '.$time.'</i></center>
													    <center><h5 style="color:#ff9800;">'.$type_post.'</h5></center>
														<hr/>
					  									<p class="w3-animate-opacity">'.$parse_text->text(decode($content)).'</p>
					      								<button onclick="document.getElementById('.'\'more'.$count.'\''.').style.display='.'\'none\''.'" type="button" class="w3-btn">Close</button>
					  								</div>
					  							</div>
					  						</div>
					  					</div>

								</section>

							</div>


						';
						$count++;
				}

			?>

						<a class="w3-btn blu-btn" href="eventstory.php">See More</a>
					</div>
						
					</div>
				</div>
			</div>
		</div>
		<br>
		<div id="shop"></div>
		<div class="shop w3-row-padding">
			<a href="e-shop.php"><h1>Souvenirs and Memorabilia</h1></a> 
			<div class="w3-content" id="shop_img" style="min-height: 500px;">
				<?php 
					$sql = "SELECT img_path FROM memorabilia WHERE img_path IS NOT NULL ORDER BY label DESC LIMIT 5";
					$exec = $con->query($sql);

					while ($images = $exec->fetch_assoc()) {
						$path = $images['img_path'];

						if (empty($path) || is_null($path) || $path == ''  || !file_exists($path)) {
							echo "<img class='mySlides w3-animate-opacity' src='../img/img35.jpg'>";
						} else {
							echo "<img class='mySlides w3-animate-opacity' src='".$path."'>";
						}
					}


				?>

				<a class="w3-btn-floating w3-hover-dark-grey" style="position:absolute;top:45%;left:-20px;" onclick="plusDivs(-1)">&#10094;</a>
				<a class="w3-btn-floating w3-hover-dark-grey" style="position:absolute;top:45%;right:-20px;" onclick="plusDivs(+1)">&#10095;</a>
				<br><br>
			</div>
		</div>

		<div class="w3-container w3-padding-jumbo w3-half" id="college" style="margin-top: ;">	
			<div style="width: 100%;"> 
				<div style="width: 100%;">
					<div class="w3-row-padding w3-center w3-margin-top " id="boxes" >
						<?php
							$result = $con->query("SELECT * FROM college");
							while($row = $result->fetch_assoc()) {
								echo
								'
								<div class="">
									<div class="w3-padding unit">
										<a href="unit_college.php?college='.str_replace(' ', '%20', $row['label']).'"><h4 id="big">'.$row['label'].'</h4><br></a> 
										<i class="fa fa-desktop w3-text-theme"></i>
									</div>
								</div>
								<hr class="college-div">
								';
							}
							$result->free();
							$con->close();
						?>
					</div>
				</div>
			</div>
		</div>
		
		<footer>											<!--  F  O  O  T  E  R  -->
			<div id="bot">
				<h5 class="foot w3-section">Copyright &copy;2017.  All Rights Reserved</h5>
				<a href="#" class="w3-btn-floating">&uparrow;</a>
			</div>
		</footer>
	</div>
<script src="../js/jquery-3.2.1.min.js"></script>
<script src="../js/js_1.js"></script>
<script src="../js/js_4.js"></script>
<script src="../js/js_5.js"></script>
</body>
</html>