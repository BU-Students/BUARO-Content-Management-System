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
	<nav class="w3-sidenav w3-collapse w3-white w3-animate-left w3-card-8" id="sidebar"> 	<!-- S I D E B A R -->

 		<a href="http://bualumnirelations@bicol-u.edu.ph" class="w3-large" id="top-sidebar">
 		<img src="../img/bulogo.png"></a>
 		<a href="javascript:void(0)" onclick="w3_close()" class="w3-hide-large w3-closenav w3-large">Close &nbsp;&nbsp;&nbsp;&times;</a>
 		<a href=".aro.html" class="w3-light-grey w3-medium">Home</a>	
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

	<div class="w3-overlay w3-hide-large" onclick="w3_close()" id="close"></div>

	<div class="w3-main">											<!--  T  H  E     M  A  I  N     B  O  D  Y  -->
		
		<div>												<!--  T  H  E     C  O  N  T  E  N  T  -->
			<div class="w3-container w3-padding-jumbo">			
			<a style="color: blue;" href="aro3.php">HOME</a> >> E-SHOP	
				<div class="w3-container w3-section w3-center">
					<div class="w3-tag w3-jumbo w3-red">S</div>
					<div class="w3-tag w3-jumbo">O</div>
					<div class="w3-tag w3-jumbo w3-yellow">U</div>
					<div class="w3-tag w3-jumbo">V</div>
					<div class="w3-tag w3-jumbo w3-green">E</div>
					<div class="w3-tag w3-jumbo">N</div>
					<div class="w3-tag w3-jumbo w3-blue">I</div>
					<div class="w3-tag w3-jumbo">R</div>
					<div class="w3-tag w3-jumbo w3-red">S</div>
					<br/>
					<div class="memorabilia">Memorabilia</div>
					<br/>

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
										$comment .= '<br>
													<button onclick="document.getElementById('.'\'more'.$count.'\''.').style.display='.'\'block\''.'"  class="w3-btn w3-teal" style="margin: 10px;"">View More</button>';
									} else {
										$comment = '<h4 style="font-size: 12px;">NO COMMENTS</h4>
										<br>
													<button onclick="document.getElementById('.'\'more'.$count.'\''.').style.display='.'\'block\''.'"  class="w3-btn w3-teal" style="margin: 10px;"">Add Comment</button>
										';
									}

									$all_comments = "SELECT nick,content,timestamp FROM comments WHERE comments.mem_id=".$memid." ORDER BY timestamp DESC";
									$exec_all_comments = mysqli_query($con,$all_comments);
									$comm_array = '';
									while ($get_comment_array = mysqli_fetch_array($exec_all_comments)) {
										$comm_array .= "<p>".$get_comment_array['nick']."<i style='font-size:10px;'> ".date('(d/m/y h:ia)',strtotime($get_comment_array['timestamp']))."</i>".": <span style='font-size:14px;'>".$get_comment_array['content']."</span></p><br>";
									}

									$dynamic_html = '
										<div >
											<h3>'.$label.'</h3>
											<p class="w3-card-8" style="text-align:left; text-indent:10px;min-height: 180px;">
											<img src="'.$path.'" alt=" photo" style="border-radius: 5px;height:200px;width:200px;float: left;padding: 0 20px 20px 0;">
											'.$desc.'
											</p>
											<div class="w3-container">
												<br/><br/>
												<div style="text-align: left;">
													<h3 style="margin: 0; padding: 0;">Comments</h3>
													'.$comment.'
												</div>
											</div>

											<div style="z-index:100;" id="more'.$count.'" class="w3-modal">
												<div class="w3-modal-content w3-card-8 w3-animate-zoom">
													<div class="w3-container">
														<div class="w3-section">

										<div class="w3-container w3-padding-jumbo">					
														<div class="w3-container w3-section w3-center">
															<br/>

															<div class="cols">
																<div class="w3-example">
																	<form action="data.php" method="POST">
																		<input  hidden name="id" value="'.$memid.'">
																		<center><h2>Add Comment</h2></center>
																		<table>
																			<tbody >
																				<tr>
																					<td><h4>Nickname: </h4></td>
																					<td><input type="text" name="nickname" style="width: 100%;"></td>
																				</tr>
																				<tr>
																					<td><h4>Comment: </h4></td>
																					<td><textarea rows="4" cols="30" name="comm" style=" width: 100%; margin-right: 20px;"></textarea></td>
																				</tr>
																				<tr>
																					<td>
																						<input class="w3-btn w3-teal" style="margin: 10px; float: right;" type="submit" name="sub">
																					</td>
																				</tr>
																			</tbody>
																		</table>
																	</form>
																</div>

																<div class="w3-example" style="margin:10px;text-align: left;">
																	<center><h2>Comments</h2></center>
																	<div style="max-height: 500px; overflow-y: scroll;">
																	'.$comm_array.'
																	</div>
																</div>
															</div>

														</div>
													</div>



															<button onclick="document.getElementById('.'\'more'.$count.'\''.').style.display='.'\'none\''.'" type="button" class="w3-btn">Close</button>
														</div>
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
						<div class="w3-modal-content w3-card-8 w3-animate-zoom" style="max-width:600px">
							<div class="w3-container">
								<div class="w3-section">
									<label><b>Item</b></label>
										<input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Item Number">
									<label><b>Brand</b></label>
										<input class="w3-input w3-border" type="text" placeholder="Enter Brand Type">
									<br/>
									<label style="float: left;">Quantity<span>&nbsp;&nbsp;</span><input class=" w3-border" type="text"></label>	
									<a href="#"><button class="w3-btn w3-btn-block w3-green w3-section">Grab</button></a>
								</div>
							</div>

							<div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
								<button onclick="document.getElementById('modal').style.display='none'" type="button" class="w3-btn w3-red">Cancel</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<footer>											<!--  F  O  O  T  E  R  -->
				<div id="bot">
					<h5 class="foot">Copyright &copy;2017.  All Rights Reserved</h5>
				</div>
			</footer>
		</div>
	</div>

<script src="../js/js_1.js"></script>
<script src="../js/js_2.js"></script>
<script src="../js/js_3.js"></script>
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
