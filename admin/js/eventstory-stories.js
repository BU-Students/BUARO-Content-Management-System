//Load the content
var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		document.getElementById("menu1").innerHTML = this.responseText;
		document.getElementById("story-cont").innerHTML = document.getElementById("story-page-1").innerHTML;
	}
};
xhttp.open("GET", "eventstory-pages/stories.php", true);
xhttp.send();
//Pagination function for the stories
function change(intval){
	var num = intval;
	storycurpage = num;
	document.getElementById("story-cont").innerHTML = document.getElementById("story-page-"+num).innerHTML;
}
//Function to change the status of the post
function changeStatus(val){
	var current = document.getElementById("status-story-"+val).value;
	var id = val;
	var xhttp2 = new XMLHttpRequest();
	var params = "id=" + id + "&cur-stat="+current;

	xhttp2.open("POST", "backend/update_status.php", true);
	xhttp2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	xhttp2.onreadystatechange = function() {
		if(xhttp2.readyState == 4 && xhttp2.status == 200) {
			document.getElementById("status-story-"+id).className = xhttp2.responseText;
			if(xhttp2.responseText == "btn btn-warning btn-s") {
				document.getElementById("status-story-"+id).innerHTML = "hidden";
				document.getElementById("status-story-"+id).value = "hidden";
			}
			else {
				document.getElementById("status-story-"+id).innerHTML = "shown";
				document.getElementById("status-story-"+id).value = "shown";
				//handle error here
				console.log("SERVER ERROR RESPONSE: " + xhttp2.responseText);
			}
		}
};

	xhttp2.send(params);
}

    
function escapeHtml(text) {
  var map = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#039;'
  };

  return text.replace(/[&<>"']/g, function(m) { return map[m]; });
}