window.onload = function() {
	var sidebar = document.getElementById("sidebar");

	sidebar.onmouseover = function() {
		document.getElementById("content-wrapper").style.left = "200px";
	}

	sidebar.onmouseout = function() {
		document.getElementById("content-wrapper").style.left = "45px";
	}
}