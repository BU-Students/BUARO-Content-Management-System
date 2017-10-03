document.getElementById("feedback-tab").classList.add("active");

function attemptDelete(element, feedback_id) {
	if(confirm("Are you sure?")) {
		params = "request-type=J-0&&feedback-id=" + feedback_id;

		var http = new XMLHttpRequest();
		http.open("POST", "backend/request_handler.php", true);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		http.onreadystatechange = function() {
			if(http.readyState == 4 && http.status == 200) {
				console.log(http.responseText);
				element.parentNode.parentNode.removeChild(element.parentNode);
			}
		}
		http.send(params);
	}
}