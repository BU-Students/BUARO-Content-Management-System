document.getElementById("contact-tab").classList.add("active");

var editor = new SimpleMDE({
	element: document.getElementById("contact-content"),
	placeholder: 'It seems you have no "Contact Us" article yet. Create it here...',
	autofocus: true
});
var origContent;

//retrieve stories
var http = new XMLHttpRequest();
var url = "backend/request_handler.php";
var request_type = "G-0";
var params = "request-type=" + request_type + "&&post-label=CONTACT";

http.open("POST", url, true);

//Send the proper header information along with the request
http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

http.onreadystatechange = function() {
	if(http.readyState == 4 && http.status == 200) {
		if(http.responseText != "") {
			editor.value(http.responseText.replaceAll("<br/>", "\n"));
			editor.togglePreview();
			origContent = editor.value();
		}
		else {}
	}
}

http.send(params);

function update() {
	if(editor.value() == origContent) {
		document.getElementById("notif-img").src = "../img/info-icon.png";
		document.getElementById("notif-content").innerHTML = "There is nothing to update";
		var notif = document.getElementById("notif-container");

		if(notif.classList.contains("show-notif")) {
			notif.classList.remove("show-notif");
			void notif.offsetWidth;
			notif.classList.add("show-notif");
		}
		else notif.classList.add("show-notif");

		return;
	}

	var content = editor.value().replaceAll("\n", "<br/>");
	params = "request-type=G-1&&content=" + content + "&&post-label=CONTACT";

	http.open("POST", url, true);
	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	http.onreadystatechange = function() {
		if(http.readyState == 4 && http.status == 200) {
			var notif_img = document.getElementById("notif-img");
			var notif_content = document.getElementById("notif-content");
			var notif = document.getElementById("notif-container");

			if(http.responseText == "") {
				origContent = editor.value();
				notif_img.src = "../img/check-icon.png";
				notif_content.innerHTML = "Contact aticle successfully updated";
			}
			else {
				console.log(http.responseText);
				notif_img.src = "../img/error-icon.png";
				notif_content.innerHTML = "An error occured. Article not updated.";
			}

			if(notif.classList.contains("show-notif")) {
				notif.classList.remove("show-notif");
				void notif.offsetWidth;
				notif.classList.add("show-notif");
			}
			else notif.classList.add("show-notif");
		}
	}

	http.send(params);
}

//added function for replaceing all occurence in string
String.prototype.replaceAll = function(search, replacement) {
	var target = this;
	return target.replace(new RegExp(search, 'g'), replacement);
};