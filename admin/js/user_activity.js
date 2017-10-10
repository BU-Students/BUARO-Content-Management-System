 /* check if an event occured each
 * n seconds indicating that user is
 * still online; and update the database
 * if so
 */
var n = 60;
var event_occured = false;
var xhr;

window.onclick = onclickFunction;
window.onmousemove = onmousemoveFunction;
window.onkeydown = onkeydownFunction;

window.setInterval(function() {
	if(event_occured) {
		event_occured = false;

		if(window.XMLHttpRequest) xhr = new XMLHttpRequest();
		else xhr = new ActiveXObject("Microsoft.XMLHTTP");

		xhr.onreadystatechange = function() {
			if(this.readyState == 4 && this.status == 200) {
				click = false;
				mousemove = false;
				keydown = false;
				window.onclick = onclickFunction;
				window.onmousemove = onmousemoveFunction;
				window.onkeydown = onkeydownFunction;
			}
		};
		xhr.open("POST", "backend/request_handler.php", true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhr.send("request-type=K-0");
	}
}, n * 1000);

function onclickFunction() {
	event_occured = true;
	window.onclick = "";
}

function onmousemoveFunction() {
	event_occured = true;
	window.onmousemove = "";
}

function onkeydownFunction() {
	event_occured = true;
	window.onkeydown = "";
}