document.getElementById("editor-tab").className = "active";

//initialize editor
var editor = new SimpleMDE({
	element: document.getElementById("textarea"),
	autofocus: false
});

var param = parseURLParams(window.location.href);

//check for GET request
if(param != undefined) {
	var existing_story_id = parseURLParams(window.location.href).post_id[0];

	document.getElementById("submit").innerHTML = "Update";
	document.getElementById("existing-story-id").value = existing_story_id;

	var http = new XMLHttpRequest();
	var url = "backend/request_handler.php";
	var request_type = "A-1";
	var params = "request-type=" + request_type + "&story-id=" + existing_story_id;

	http.open("POST", url, true);

	//Send the proper header information along with the request
	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	http.onreadystatechange = function() {
		if(http.readyState == 4 && http.status == 200) {
			if(http.responseText != "fail") {
				console.log(http.responseText);
				var content_info = JSON.parse(http.responseText);
				document.getElementById("title").value = content_info.title;
				document.getElementById("radio-" + content_info.post_type).checked = true;

				//added function for replaceing all occurence in string
				String.prototype.replaceAll = function(search, replacement) {
					var target = this;
					return target.replace(new RegExp(search, 'g'), replacement);
				};

				editor.value(content_info.content.replaceAll("<br/>", "\n"));
			}
			else {
				//handle failure here
				console.log(http.responseText);
			}
		}
	}
	http.send(params);
}

//not mine. See https://stackoverflow.com/questions/814613/how-to-read-get-data-from-a-url-using-javascript
function parseURLParams(url) {
	var queryStart = url.indexOf("?") + 1,
		queryEnd   = url.indexOf("#") + 1 || url.length + 1,
		query = url.slice(queryStart, queryEnd - 1),
		pairs = query.replace(/\+/g, " ").split("&"),
		parms = {}, i, n, v, nv;

	if (query === url || query === "") return;

	for (i = 0; i < pairs.length; i++) {
		nv = pairs[i].split("=", 2);
		n = decodeURIComponent(nv[0]);
		v = decodeURIComponent(nv[1]);

		if (!parms.hasOwnProperty(n)) parms[n] = [];
		parms[n].push(nv.length === 2 ? v : null);
	}

	return parms;
}

document.getElementById("submit").addEventListener("click", function() {
	var title = document.getElementById("title").value;
	var content = editor.value();

	//assuming user has chosen a content type
	var content_type = "";
	var checkboxes = document.getElementsByName("content-type");
	for(var i = 0; i < checkboxes.length; ++i) {
		if(checkboxes[i].checked) {
			content_type = checkboxes[i].value;
			break;
		}
	}

	//in cases where a story is being edited
	var story_id = document.getElementById("existing-story-id").value;
	var story_id_param = "";

	if(story_id != -1)
		story_id_param = "&story-id=" + story_id;

	var http = new XMLHttpRequest();
	var url = "backend/request_handler.php";
	var request_type = "A-0";
	var params = "request-type=" + request_type + story_id_param + "&title=" + title + "&content-type=" + content_type + "&content=" + content;

	http.open("POST", url, true);

	//Send the proper header information along with the request
	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	http.onreadystatechange = function() {
		if(http.readyState == 4 && http.status == 200) {
			if(http.responseText == "fail") {
				//notify user that publishing failed
				document.getElementById("notif-img").src = "../img/error-icon.png";
				document.getElementById("notif-content").innerHTML = "Something went wrong. Article not published.";
				document.getElementById("notif-container").classList.add("show-notif");
				setTimeout(function() {
					document.getElementById("notif-container").classList.remove("show-notif");
				}, 5000);
			}
			else {
				var form = document.createElement("form");
				form.method = "POST";
				form.style.display = "none";

				var input = document.createElement("input");
				input.name = "notif-status";

				if(content_type == 1) {
					form.action = "stories.php";
					input.value = "story-";
				}
				else if(content_type == 2) {
					form.action = "events.php";
					input.value = "event-";
				}

				if(story_id == -1)
					input.value += "created";
				else input.value += "updated";


				form.appendChild(input);
				document.body.appendChild(form);

				form.submit();
			}
		}
	}

	http.send(params);
});