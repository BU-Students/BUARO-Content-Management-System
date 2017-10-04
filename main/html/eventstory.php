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
	<link rel="stylesheet" href="../css/w3-theme-teal.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../css/e-shop_style.css">
	<link href='https://fonts.googleapis.com/css?family=RobotoDraft' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="../../cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../css/story.css">
	<link rel="stylesheet" type="text/css" href="../css/eventstory-pagination.css">
	<link rel="stylesheet" href="../../vendor/Bootstrap/css/bootstrap.min.css">
	<script src="../../vendor/jQuery/jquery-3.2.1.min.js"></script>
	<script src="../../vendor/Bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="userendpages/loadjs/loadContent.js"></script>
	<script type="text/javascript" src="userendpages/loadjs/loadEvent.js"></script>
	<script type="text/javascript" src="userendpages/loadjs/loadStory.js"></script>
</head>
<body>
	<nav class="w3-sidenav w3-collapse w3-white w3-animate-left w3-card-8" id="sidebar"> 	<!-- S I D E B A R -->

 		<a href="http://bualumnirelations@bicol-u.edu.ph" class="w3-large" id="top-sidebar">
 		<img src="../img/bulogo.png"></a>
 		<a href="javascript:void(0)" onclick="w3_close()" class="w3-hide-large w3-closenav w3-large">Close &nbsp;&nbsp;&nbsp;&times;</a>
 		<a href="aro3.php" class="w3-light-grey w3-medium">Home</a>	
		<a href="e-shop.php" class="side">E-shop for Souvenirs and Memorabilla</a>	
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
		<a href="#" class="side" onclick="loadStories()">BU Alumni Stories</a>		
		<a href="javascript:void(0)" class="side" onclick="myFunc('side1')">BUARO Events<i class="fa fa-caret-down"></i></a>
			<div id="side1" class="w3-accordion-content w3-animate-left w3-padding">
				<label>Upcoming Events</label>
				<?php
					$getquery = "SELECT * FROM post WHERE post_type = 2 AND status = 'shown'";
					$run = mysqli_query($con ,$getquery);
					$today = date("Y-m-d");
					while($row = mysqli_fetch_array($run)){
						if($row['eventdate'] > $today)
								echo '<a href="#" onclick="loadAroEvent('.$row['post_id'].')"> '.$row['title'].' </a> ';
					}
					
				?>
				<label>Other</label>
				<a href="#" onclick="loadRecent()">Recent Events</a> 
			</div>	
		<a href="#" class="side testbtn" id="about" onclick="loadAbout()">About BUARO</a>
		<a href=".contact.php" class="side">Contact Us</a>
	</nav>

	<div class="w3-overlay w3-hide-large" onclick="w3_close()" id="close"></div>

	<div class="w3-main">											<!--  T  H  E     M  A  I  N     B  O  D  Y  -->

		<div id="topbar" style="z-index: 100;">
			<h4 id="topbar1">Souvenirs and Memorabilla</h4>
			<a id="toggle" class="w3-hover-black w3-opennav" href="javascript:void(0)" onclick="w3_open()">&#9776;</a>
		</div>

		<header class="w3-container w3-theme w3-padding-64 w3-padding-jumbo">
			<img src="../img/logo.gif" id="aro_logo">
			<h1 class="w3-xxxlarge w3-padding-16 w3-animate-bottom"><span class="highlight">A</span>lumni <span class="highlight">R</span>elations <span class="highlight">O</span>ffice</h1>
		</header>
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

<script src="js/js_1.js"></script>
<script src="js/js_2.js"></script>
<script src="js/js_3.js"></script>
<script src="js/js_4.js"></script>
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
<script>
	(function($){
  
  
    $.fn.customPaginate = function(options){
      var paginationContainer = this;
      var itemsToPaginate;


      var defaults = {
        itemsPerPage : 5 
      };
      
      var settings = {}; 
      $.extend(settings, defaults,options);
     
      var itemsPerPage = settings.itemsPerPage ;

      itemsToPaginate = $(settings.itemsToPaginate);
      var numberOfPaginationLinks = Math.ceil((itemsToPaginate.length / itemsPerPage));
      $("<ul></ul>").prependTo(paginationContainer);

      for(var index = 0 ; index < numberOfPaginationLinks; index++){
        paginationContainer.find("ul").append("<li>"+ (index + 1) +"</li>");

      }

      itemsToPaginate.filter(":gt(" + (itemsPerPage - 1) + ")" ).hide();

      paginationContainer.find("ul li").first().addClass(settings.activeClass).end().on('click',function(){
        
        var $this = $(this);
        
        $this.addClass(settings.activeClass);
        $this.siblings().removeClass(settings.activeClass);


        var linkNumber = $this.text();
        
        var itemsToHide = itemsToPaginate.filter(":lt(" + ((linkNumber - 1) * itemsPerPage) + ")" );
        $.merge(itemsToHide,itemsToPaginate.filter(":gt(" + ((linkNumber * itemsPerPage)  - 1 ) + ")" ));
          itemsToHide.hide();

        var itemsToShow = itemsToPaginate.not(itemsToHide);
        itemsToShow.show();

      });


    }
  


}(jQuery));
</script>
<script type="text/javascript">
	(function(){
	$(document).ready(function(){

		$(".pagination").customPaginate({

			itemsToPaginate : ".post",
			activeClass : "active-class"


		});

		$(".pagination-event").customPaginate({

			itemsToPaginate : ".post-event",
			activeClass : "active-class"


		});

	});
})(jQuery)
</script>
<script type="text/javascript">
	(function(){
	$(document).ready(function(){

		

	});
})(jQuery)
</script>
</body>
</html>