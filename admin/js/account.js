var url = "backend/request_handler.php";
var params = "request-type=E-0";
var xhr;

if(window.XMLHttpRequest) xhr = new XMLHttpRequest();
else xhr = new ActiveXObject("Microsoft.XMLHTTP");

if(xhr) {
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && xhr.status == 200) {
			var user = JSON.parse(xhr.responseText);
			document.getElementById("f-name").innerHTML = user.f_name;
			document.getElementById("m-name").innerHTML = user.m_name;
			document.getElementById("l-name").innerHTML = user.l_name;
			document.getElementById("college").innerHTML = (user.college == "") ? "Parent admin" : user.college + " Alumni Admin";
			document.getElementById("story-count").innerHTML = user.post_count;
			document.getElementById("view-count").innerHTML = user.view_count;
		}
	}

	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.send(params);
}
else alert("Unable to communicate to the server. Try reloading the page.");

function changePass() {
	if(document.getElementById("confirm_pass").value != document.getElementById("new_pass").value) {
		document.getElementById("notif-img").src = "../img/error-icon.png";
		document.getElementById("notif-content").innerHTML = "Passwords do not match";
		document.getElementById("confirm_pass").style.border = "1px solid red";

		var input_container = document.getElementById("pass-container");
		if(!input_container.classList.contains("has-error"))
			input_container.classList.add("has-error");

		var notif = document.getElementById("notif-container");
		if(notif.classList.contains("show-notif")) {
			notif.classList.remove("show-notif");
			void notif.offsetWidth;
			notif.classList.add("show-notif");
		}
		else {
			notif.classList.add("show-notif");
		}
	} else change('password');
}

function change(toChange) {
	params = "request-type=E-1&to-change=";

	if(toChange == "username")
		params += "username&value=" + document.getElementById("new_username").value +
			"&password=" + document.getElementById("curr_pass1").value;
	else
		params += "password&value=" + document.getElementById("new_pass").value +
			"&password=" + document.getElementById("curr_pass2").value;

	xhr = null;
	if(window.XMLHttpRequest) xhr = new XMLHttpRequest();
	else xhr = new ActiveXObject("Microsoft.XMLHTTP");

	if(xhr) {
		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && xhr.status == 200) {
				if(xhr.responseText == "success") {
					document.getElementById("notif-img").src = "../img/check-icon.png";
					document.getElementById("notif-content").innerHTML = toChange + " successfully changed";
					document.getElementById("new_username").value = "";
					document.getElementById("new_pass").value = "";
					document.getElementById("curr_pass1").value = "";
					document.getElementById("curr_pass2").value = "";
					document.getElementById("confirm_pass").value = "";
				}
				else if(xhr.responseText == "wrong password") {
					document.getElementById("notif-img").src = "../img/error-icon.png";
					document.getElementById("notif-content").innerHTML = "The value you entered for your current password is incorrect";
					var input = document.getElementById("curr_pass" + ((toChange == "username") + 2));
					input.style.border = "1px solid red";
					input.value = "";
				}
				else {
					document.getElementById("notif-img").src = "../img/info-icon.png";
					document.getElementById("notif-content").innerHTML = "An internal error occured. " + toChange + " not changed.";
					console.log(xhr.responseText);
				}

				var notif = document.getElementById("notif-container");
				if(notif.classList.contains("show-notif")) {
					notif.classList.remove("show-notif");
					void notif.offsetWidth;
					notif.classList.add("show-notif");
				}
				else {
					notif.classList.add("show-notif");
				}
			}
		}

		xhr.open("POST", url, true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhr.send(params);
	}
	else alert("Unable to communicate to the server. Try reloading the page.");
}