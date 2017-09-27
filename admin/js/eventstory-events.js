//Load the content
var xhttp4 = new XMLHttpRequest();
xhttp4.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("menu2").innerHTML = this.responseText;
      document.getElementById("event-cont").innerHTML = document.getElementById("event-page-1").innerHTML;
    }
  };
xhttp4.open("GET", "eventstory-pages/events.php", true);
xhttp4.send();

//Function for the pagination
function changeevents(intval){
    var num = intval;
    document.getElementById("event-cont").innerHTML = document.getElementById("event-page-"+num).innerHTML;
}

//Function to change the status of the events
function changeStatus_events(val,cur_stat){
	var current = document.getElementById("status-event-"+val).value;
	var id = val;
	var xhttp2 = new XMLHttpRequest();
	var params = "id=" + id + "&cur-stat="+current;

	xhttp2.open("POST", "backend/update_status.php", true);
	xhttp2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	xhttp2.onreadystatechange = function() {
		if(xhttp2.readyState == 4 && xhttp2.status == 200) {
			document.getElementById("status-event-"+id).className = xhttp2.responseText;
			if(xhttp2.responseText == "btn btn-warning btn-s") {
				document.getElementById("status-event-"+id).innerHTML = "hidden";
				document.getElementById("status-event-"+id).value = "hidden";
			}
			else {
				document.getElementById("status-event-"+id).innerHTML = "shown";
				document.getElementById("status-event-"+id).value = "shown";
				//handle error here
				console.log("SERVER ERROR RESPONSE: " + xhttp2.responseText);
			}
		}
};

	xhttp2.send(params);
}

  