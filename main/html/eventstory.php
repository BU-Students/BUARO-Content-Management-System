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
	<link rel="stylesheet" type="text/css" href="../css/eventstory-pagination.css">
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

		

	});
})(jQuery)
</script>

</body>
</html>