document.getElementById("editor-tab").className = "active";

// As of now, line braks are not suported. Client should manually enter <br> tag
// https://github.com/sparksuite/simplemde-markdown-editor/issues/608

var editor = new SimpleMDE({
	element: document.getElementById("textarea"),
	autofocus: true
});

document.getElementById("submit").addEventListener("click", function() {
	var title = document.getElementById("title").value;
	var content = editor.value();

	var content_type = "Content type not specified";
	var checkboxes = document.getElementsByName("content-type");
	for(var i = 0; i < checkboxes.length; ++i) {
		if(checkboxes[i].checked) {
			content_type = checkboxes[i].value;
			break;
		}
	}

	var http = new XMLHttpRequest();
	var url = "backend/request_handler.php";
	var request_type = "A-0";
	var params = "request-type=" + request_type + "&title=" + title + "&content=" + content + "&content-type=" + content_type;

	http.open("POST", url, true);

	//Send the proper header information along with the request
	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	http.onreadystatechange = function() {
		if(http.readyState == 4 && http.status == 200) {
			handleResponse(http.responseText);
		}
	}
	http.send(params);
});

function handleResponse(response) {
	alert(response);
	console.log(response);
}