 /* check if an event occured each
 * n seconds indicating that user is
 * still online; and update the database
 * if so
 */
var n = 60;

window.onclick = signalEvent;
window.onmousemove = signalEvent;
window.onkeydown = signalEvent;

function signalEvent() {
	window.onclick = "";
	window.onmousemove = "";
	window.onkeydown = "";
	updateDB();
}

function updateDB() {
	//wait for n seconds before allowing the next signal
	window.setTimeout(function() {
		window.onclick = signalEvent;
		window.onmousemove = signalEvent;
		window.onkeydown = signalEvent;
		console.log("ok na");
	}, n * 1000);

	var xhr;
	if(window.XMLHttpRequest) xhr = new XMLHttpRequest();
	else xhr = new ActiveXObject("Microsoft.XMLHTTP");

	xhr.onreadystatechange = function() {
		if(this.readyState == 4 && this.status == 200) {
		}
	};
	xhr.open("POST", "backend/request_handler.php", true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.send("request-type=K-0");
}