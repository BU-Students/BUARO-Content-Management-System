<?php
	include 'connection.php';

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>BU | Alumni Relations Office</title>
	<link rel="stylesheet" href="../css/w3.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link href='https://fonts.googleapis.com/css?family=RobotoDraft' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="../../cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../css/eventstory-carousel.css">
	<link rel="stylesheet" href="../../vendor/Bootstrap/css/bootstrap.min.css">
	<script src="../../vendor/jQuery/jquery-3.2.1.min.js"></script>
	<script src="../../vendor/Bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="userendpages/loadjs/loadContent.js"></script>
	<script type="text/javascript" src="userendpages/loadjs/loadEvent.js"></script>
	<script type="text/javascript" src="userendpages/loadjs/loadStory.js"></script>
</head>
<style>
	@media (max-width: 768px){
		footer{
			margin-right: -130px;
		}
		#sidebar{
			width: 250px;
			display: block;
		}
	}
</style>
<body>
	<?php include_once "sidebar.php"; ?>

	<div class="w3-overlay w3-hide-large" onclick="w3_close()" id="close"></div>

	<div id="main">											<!--  T  H  E     M  A  I  N     B  O  D  Y  -->
																<!-- T H E  C O N T E N T -->
				<div id="content">
					<?php include_once 'userendpages/.arohome.php';?>
				</div>

			<footer>											<!--  F  O  O  T  E  R  -->
				<div id="bot">
					<h5 class="foot w3-section">Copyright &copy;2017.  All Rights Reserved</h5>
				</div>
			</footer>
		</div>
<script>
function loadRecent() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     document.getElementById("content").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "userendpages/.event-recent.php", true);
  xhttp.send();
}

function viewEvent(str) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     document.getElementById("content").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "userendpages/.event-recent-view.php?id="+str, true);
  xhttp.send();
}

//Used in College/Units & BUARO Events toggling
function myFunc(id) {
    document.getElementById(id).classList.toggle("w3-show");
    document.getElementById(id).previousElementSibling.classList.toggle("w3-theme");
}
</script>

</body>
</html>