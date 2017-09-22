document.getElementById("editor-tab").className = "active";

//initialize editor
var editor = new SimpleMDE({
	element: document.getElementById("textarea"),
	autofocus: false
});

var param = parseURLParams(window.location.href);

//check for GET request
if (param != undefined) {
	var existing_story_id = parseURLParams(window.location.href).post_id[0];

	document.getElementById("submit").innerHTML = "Update";
	document.getElementById("existing-story-id").value = existing_story_id;

	var http = new XMLHttpRequest();
	var url = "backend/request_handler.php";
	var request_type = "H-3";
	var params = "request-type=" + request_type + "&story-id=" + existing_story_id;

	http.open("POST", url, true);

	//Send the proper header information along with the request
	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	http.onreadystatechange = function() {
		//
		if (http.readyState == 4 && http.status == 200) {

			if (http.responseText != "fail") {

				console.log(http.responseText);

				var content_info = JSON.parse(http.responseText);

				document.getElementById("title").value = content_info.title;
				// document.getElementById("radio-" + content_info.post_type).checked = true;

				document.getElementById("img_path").src = content_info.img_path;

				//added function for replaceing all occurence in string
				String.prototype.replaceAll = function(search, replacement) {
					var target = this;
					return target.replace(new RegExp(search,'g'), replacement);
				}
				;

				editor.value(content_info.content.replaceAll("<br/>", "\n"));
			} else {
				//handle failure here
				console.log(http.responseText);
			}

		}

	}
	http.send(params);

}

//not mine. See https://stackoverflow.com/questions/814613/how-to-read-get-data-from-a-url-using-javascript
function parseURLParams(url) {
	var queryStart = url.indexOf("?") + 1, queryEnd = url.indexOf("#") + 1 || url.length + 1, query = url.slice(queryStart, queryEnd - 1), pairs = query.replace(/\+/g, " ").split("&"), parms = {}, i, n, v, nv;

	if (query === url || query === "")
		return;

	for (i = 0; i < pairs.length; i++) {
		nv = pairs[i].split("=", 2);
		n = decodeURIComponent(nv[0]);
		v = decodeURIComponent(nv[1]);

		if (!parms.hasOwnProperty(n))
			parms[n] = [];
		parms[n].push(nv.length === 2 ? v : null);
	}

	return parms;
}

document.getElementById("submit").addEventListener("click", function() {
	var title = document.getElementById("title").value;
	var content = editor.value();
	var img_path = document.getElementById("img_path").files[0].name;
	console.log(img_path);
 //img_path= img_path.replace(/^.*\\,"");

if (title == null || title == "") {
        alert("title must be filled out");
        return false;
    }
else if (content == null || content == "") {
        alert("Description must be filled out");
        return false;
    }
else if (img_path == null || img_path == "") {
        alert("You must select an Image!!");
        return false;
    }
	//assuming user has chosen a content type
	var content_type = "";
	var checkboxes = document.getElementsByName("content-type");
	for (var i = 0; i < checkboxes.length; ++i) {
		if (checkboxes[i].checked) {
			content_type = checkboxes[i].value;
			break;
		}
	}

	//in cases where a story is being edited
	var story_id = document.getElementById("existing-story-id").value;
	var story_id_param = "";

	if (story_id != -1)
		story_id_param = "&story-id=" + story_id;


	var http = new XMLHttpRequest();
	var url = "backend/request_handler.php";
	var request_type = "H-1";
	var params = "request-type=" + request_type + story_id_param + "&title=" + title + "&content-type=" + content_type + "&content=" + content + "&img_path=" + img_path;

	http.open("POST", url, true);

	//Send the proper header information along with the request
	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	http.onreadystatechange = function() {
		if (http.readyState == 4 && http.status == 200) {

			if (http.responseText == "fail") {
				//notify user that publishing failed
				document.getElementById("notif-img").src = "../img/false-2061131_640-iloveimg-cropped.png";
				document.getElementById("notif-content").innerHTML = "Something went wrong. Article not published.";
				document.getElementById("notif-container").classList.add("show-notif");
				setTimeout(function() {
					document.getElementById("notif-container").classList.remove("show-notif");
				}, 5000);
			} else {

				var form = document.createElement("form");
				form.method = "POST";
				form.style.display = "none";

				var input = document.createElement("input");
				input.name = "notif-status";

				form.action = "eshop.php";
				input.value = "memorabilia_item-";

				if (story_id == -1)
					input.value += "created";
				else
					input.value += "updated";

				form.appendChild(input);
				document.body.appendChild(form);

				form.submit();
			}
		}
	}

	http.send(params);
});

$(function() {
	$('input[name=content-type]').on('click init-post-format', function() {
		$('#show-editor1').toggle($('#radio-1').prop('checked'));

	}).trigger('init-post-format');
}
);

function handleFileSelect(evt) {
	var files = evt.target.files;
	// FileList object

	// Loop through the FileList and render image files as thumbnails.
	for (var i = 0, f; f = files[i]; i++) {

		// Only process image files.
		if (!f.type.match('image.*')) {
			continue;
		}

		var reader = new FileReader();

		// Closure to capture the file information.
		reader.onload = (function(theFile) {
			return function(e) {
				// Render thumbnail.
				var span = document.createElement('span');
				span.innerHTML = ['<img class="thumb" src="', e.target.result, '" title="', escape(theFile.name), '"/>'].join('');
				document.getElementById('list').insertBefore(span, null);
			}
			;
		}
		)(f);

		// Read in the image file as a data URL.
		reader.readAsDataURL(f);
	}
}

document.getElementById('img_path').addEventListener('change', handleFileSelect, false);

$(document).ready(function() {

	var divProgressBar = $("#divProgressBar");
	var status = $("#status");

	$("#uploadForm").ajaxForm({

		dataType: "json",

		beforeSend: function() {
			divProgressBar.css({});
			divProgressBar.width(0);
		},

		uploadProgress: function(event, position, total, percentComplete) {
			var pVel = percentComplete + "%";
			divProgressBar.width(pVel);
		},

		complete: function(data) {
			status.html(data.responseText);
		}
	});
});
