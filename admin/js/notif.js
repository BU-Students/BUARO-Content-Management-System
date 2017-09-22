if(document.body.contains(document.getElementById("notif-container"))) {
	window.setTimeout(function() {
		document.getElementById("notif-container").classList.remove("show-notif");
	}, 5000);
}