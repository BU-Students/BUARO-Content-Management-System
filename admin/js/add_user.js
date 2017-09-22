function clickButtonEffect(input) {
	var button_classList = input.parentNode.children[0].classList;
	if(!button_classList.toggle("click-effect")) {
		button_classList.remove("click-effect");
		button_classList.add("click-effect");
	}
	setTimeout(function() { button_classList.remove("click-effect") }, 500);
}

function loadImage(event, id) {
	var output = document.getElementById(id);
	output.src = URL.createObjectURL(event.target.files[0]);
	output.parentNode.children[1].style.display = "block";
}

function unloadImage(button, input_id, preview_id) {
	button.style.display = "none";
	document.getElementById(preview_id).src = "";
	input_id.value = "";
}

document.getElementById("form").onsubmit = function() {
	if(document.getElementById("pass").value === document.getElementById("verify-pass").value) {
		return true;
	}
	else {
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
		return false;
	}
}