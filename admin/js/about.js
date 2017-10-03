var url = "../php/backend/request_handler.php";
var params = "request-type=G-0";

var xhr;

if(window.XMLHttpRequest)
	xhr = new XMLHttpRequest();
else
	xhr = new ActiveXObject("Microsoft.XMLHTTP");

if(xhr) {
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			alert(xhr.responseText);
			var about = JSON.parse(xhr.responseText);

			//initialize editor
			var editor = new SimpleMDE({
				element: document.getElementById("textarea"),
				autofocus: false
			});

			editor.value(about.content);
			var sring = editor.value();
		}
	}

	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.send(params);
}
else alert("Unable to communicate to the server. Try reloading the page.");