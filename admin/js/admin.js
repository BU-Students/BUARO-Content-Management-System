var http = new XMLHttpRequest();
var url = "backend/request_handler.php";
var request_type = "B-0";
var params = "request-type=" + request_type;

http.open("POST", url, true);

//Send the proper header information along with the request
http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

http.onreadystatechange = function() {
	if(http.readyState == 4 && http.status == 200) {
		handleResponse(http.responseText);
	}
}
http.send(params);

function handleResponse(response) {
	document.getElementById("stories-wrapper").innerHTML = response;
}