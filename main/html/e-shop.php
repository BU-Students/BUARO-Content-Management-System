<?php include_once('connection.php');?>

<?php
	$data = 'SELECT * FROM memorabilia ORDER BY mem_id';
	$run = mysqli_query($con, $data);
	$check = mysqli_num_rows($run);

	if ($check < 1) {
		echo "<script>window.alert('The Database for the e-shop is empty :(');</script>";
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
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../css/e-shop_style.css">
	<link href='https://fonts.googleapis.com/css?family=RobotoDraft' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="../../cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
</head>
<body>
	<nav class="w3-sidenav w3-animate-left w3-white w3-card-8" id="sidebar" style="width: 0px;"> 	<!-- S I D E B A R -->

 		<a href="http://bualumnirelations@bicol-u.edu.ph" class="w3-large" id="top-sidebar">
 		<img src="../img/bulogo.png"></a>
 		<a href="javascript:void(0)" onclick="w3_close()" class="w3-closenav" style="float:right;">&times;</a>
 		<a href="aro3.php" class="side">Home</a>	
		<a href="e-shop.php" class="side" style="background-color: #ababab;">E-shop for Souvenirs and Memorabilla</a>	
		<a href=".donate.php" class="side">Donation Link</a>		
		<a href="javascript:void(0)" class="side" onclick="myFunc('side')">UNIT/College <i class="fa fa-caret-down"></i></a>
			<div id="side" class="w3-accordion-content w3-animate-left w3-padding">
				<a href=".ce.html">College of Education</a>
        		<a href=".cs.html">College of Science</a>
        		<a href=".cbem.html">College of Business and Economic Management</a>
        		<a href=".ceng.html">College of Engineering</a>
        		<a href=".cal.html">College of Arts & Letters</a>
        		<a href=".cit.html">College of Industrial Technology</a>
        		<a href=".ia.html">Institute of Architecture</a>
        		<a href=".ipesr.html">Institute of Physical Education, Sports & Recreation</a>
       			<a href=".cn.html">College of Nursing</a>
        		<a href=".cm.html">College of Medicine</a>
        		<a href=".cssp.html">College of Social Science and Philosophy</a>
        	</div>
		<a href="eventstory.php" class="side">BU Alumni Stories/Event</a>		
		<a href=".about.html" class="side">About BUARO</a>
		<a href=".contact.php" class="side">Contact Us</a>
	</nav>

<div id="main" class="w3-container">
	<div class="w3-container ">											<!--  T  H  E     M  A  I  N     B  O  D  Y  -->
		<div id="topbar" style="margin-left: -32px;">
			<h4 id="topbar1">
				<a class="w3-padding-16 w3-opennav" href="javascript:void(0)" onclick="w3_open()">&#9776;</a>
				<a href="aro3.php" style="margin-left: 20px;">Home</a>
				<a href="e-shop.php">/ E-shop</a>
			</h4>
		</div>

		<div>												<!--  T  H  E     C  O  N  T  E  N  T  -->
			<div class="w3-container w3-padding-jumbo">			
			<!--<a style="color: blue;" href="aro3.php">HOME</a> >> E-SHOP-->	
				<div class="w3-container w3-section w3-center">
					<div class="cols">
						<?php
							if ($check > 0) {
								$count = 0;
								while ($array_data = mysqli_fetch_array($run)) {
									$path = $array_data['img_path'];
									$desc = $array_data['description'];
									$label = $array_data['label'];
									$memid = $array_data['mem_id'];

									//For Comments
									if (is_null($path)) {
										$path = '../img/img35.jpg';
									}

									$sql_comments = "SELECT nick,content,timestamp FROM comments WHERE comments.mem_id=".$memid." ORDER BY timestamp DESC LIMIT 2";
									$exec = mysqli_query($con,$sql_comments);
									$is_empty = mysqli_num_rows($exec);
									if ($is_empty>0) {
										$comment = "";
										while ($array = mysqli_fetch_array($exec)) {
											$comment .= "<h5 style='font-size: 12px;'>".$array['nick'].' '.date('(d/m/y h:ia)',strtotime($array['timestamp'])).': '.$array['content']."</h5>";
										}
										$comment .= '<button onclick="document.getElementById('.'\'more'.$count.'\''.').style.display='.'\'block\''.'" class="w3-btn" style="background-color:#001e42;"">View More</button>';
									} else {
										$comment = '<h4 style="font-size: 12px;">NO COMMENTS</h4>
													<button onclick="document.getElementById('.'\'more'.$count.'\''.').style.display='.'\'block\''.'"  class="w3-btn" style="background-color:#001e42;margin-left:-10px;"">Add Comment</button>
										';
									}

									$all_comments = "SELECT nick,content,timestamp FROM comments WHERE comments.mem_id=".$memid." ORDER BY timestamp DESC";
									$exec_all_comments = mysqli_query($con,$all_comments);
									$comm_array = '';
									while ($get_comment_array = mysqli_fetch_array($exec_all_comments)) {
										$comm_array .= "<p>".$get_comment_array['nick']."<i style='font-size:10px;'> ".date('(d/m/y h:ia)',strtotime($get_comment_array['timestamp']))."</i>".": <span style='font-size:14px;'>".$get_comment_array['content']."</span></p><br>";
									}

									$dynamic_html = '
										<div style="margin-top:100px;">
											<div class="w3-card-8 section">
												<img src="'.$path.'" alt=" photo">
												<h3>'.$label.'</h3>
												<br><br><br><br>
												<p>'.$desc.'</p>
											</div>
											<div class="w3-container">
												<div class="comm">
													<h3>Comments</h3>
													<p>'.$comment.'</p>
												</div>
											</div>

											<div style="z-index:100;" id="more'.$count.'" class="w3-modal">
												<div class="w3-modal-content w3-card-8 w3-animate-top" style="width:800px; border-radius:5px;">
													<div class="w3-container">
														<form action="data.php" method="POST">
															<input  hidden name="id" value="'.$memid.'">
															<table>
																<div style="margin:10px;text-align:left; border-radius: 5px;" >
																	<center><h2>Comments</h2></center>
																		<div style="max-height: 500px; overflow-y: scroll;">
																			'.$comm_array.'
																		</div>
																</div>
																<hr>
																<tbody >
																	<tr>
																		<td><h4 style="float: left;">Nickname: </h4></td>
																	</tr>
																	<tr>
																		<td><input class="w3-input" placeholder="Enter Your Name" type="text" name="nickname" style="width: 100%; border-radius: 5px; border: 1px solid #ccc;" required></td>
																	</tr>
																	<tr>
																		<td><h4 style="float: left;">Comment: </h4></td>
																	</tr>
																	<tr>
																		<td><textarea class="w3-input" placeholder="Write Something.." rows="4" cols="30" name="comm" style=" width: 100%; margin-right: 20px; border-radius: 5px; border: 1px solid #ccc;" required></textarea></td>
																	</tr>
																	<tr>
																		<td>
																			<input class="w3-btn w3-teal" style="margin: 10px; float: left;" type="submit" name="sub">
																			<button onclick="document.getElementById('.'\'more'.$count.'\''.').style.display='.'\'none\''.'" type="button" class="w3-btn w3-red" style="margin-top: 10px; float:left;">Close</button>
																		</td>
																	</tr>	
																</tbody>
															</table>
														</form>													
													</div>
												</div>
											</div>
										</div>

									';

									echo $dynamic_html;
									$count++;
								}

							}
						?>


						<?php /*
							if ($check > 0) {
								while ($array_data = mysqli_fetch_array($run)) {
									$path = $array_data['img_path'];
									$desc = $array_data['description'];
									$label = $array_data['label'];
									$dynamic_html = '
									<div class="col" ontouchstart="this.classList.toggle(\'hover\');">
										<div class="container">
											<div class="front" style="background-image: url(\''.$path.'\'); overflow:hidden;position:relative;z-index:1;">
												<div class="inner">
													<p>'.$label.'</p>
						              <span>Lorem ipsum</span>
												</div>
											</div>
											<div class="back">
												<div class="inner" style="height:275px;position:absolute; overflow-y:auto;z-index:0;">
												  <p>'.$desc.'</p>
												</div>
											</div>
										</div>
									</div>
							';

									echo $dynamic_html;
								}
							}*/
						?>
					</div>
			
					<br/><br/><br/>
					<button onclick="document.getElementById('modal').style.display='block'" class="w3-btn w3-green w3-large">Get yours now!</button>

					<div id="modal" class="w3-modal">
						<div class="w3-modal-content w3-card-8 w3-animate-zoom" style="max-width:600px;border-radius: 5px;">
							<div class="w3-container">
								<div class="w3-section">
									<label><b>Item</b></label>
										<input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Item Number">
									<label><b>Brand</b></label>
										<input class="w3-input w3-border" type="text" placeholder="Enter Brand Type">
									<label style="float: left; margin-top: 20px;">Quantity<span>&nbsp;&nbsp;</span><input class=" w3-border" type="text"></label>
									<a href="#"><button class="w3-btn w3-btn-block w3-green w3-section">Grab</button></a>
								</div>
							</div>

							<div class="w3-container w3-padding-8 w3-light-grey">
								<button onclick="document.getElementById('modal').style.display='none'" type="button" class="w3-btn w3-red">Cancel</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<footer style="margin-left: -30px; margin-right: -30px;">											<!--  F  O  O  T  E  R  -->
				<div id="bot">
					<h5 class="foot">Copyright &copy;2017.  All Rights Reserved</h5>
				</div>
			</footer>
		</div>
	</div>
</div>
<script>
function w3_open() {
    document.getElementById("sidebar").style.width = "250px";
    document.getElementById("sidebar").classList.add("w3-animate-left");
    document.getElementById("main").style.marginLeft = "200px";
}
function w3_close() {
    document.getElementsByClassName("w3-sidenav")[0].style.width = 0;
    document.getElementById("main").style.marginLeft = 0;
    document.getElementById("sidebar").classList.remove("w3-animate-left");
}
</script>

<script src="../js/js_4.js"></script>
</body>
</html>
<!--
					<?php 
						if ($check > 0) {
							while ($array_data = mysqli_fetch_array($run)) {
								$path = $array_data['img_path'];
								$desc = $array_data['description'];
								$label = $array_data['label'];
								$dynamic_html = '
									<div class="w3-quarter" style="margin-top:20px;">
										<div class="w3-card-2 w3-hover-shadow">
											<img src="../../admin/php/'.$path.'" style="width:100%;">
											<div class="w3-container" style="overflow-y:scroll;height:100px;">
												<h3 style="font-weight:bold;">'.$label.'</h3>
												<h4 style="word-wrap: break-word;">'.$desc.'</h4>
											</div>
										</div>
									</div>';

								echo $dynamic_html;
							}
						}
					?>
					-->
