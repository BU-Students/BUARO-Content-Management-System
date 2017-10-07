function viewProject(id) {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			info = JSON.parse(this.responseText);
			document.getElementById("content-container").innerHTML =
				'<div class="content-view">' +
					'<h2 id="content-title">' + info.title + '</h2>' +
					'<div id="content">' + info.content + '</div>' +
				'</div>';

			var breadcrumb = document.getElementById("breadcrumb");
			breadcrumb.innerHTML +=
				'<li class="disabled"><a href="javascript:void(0)">' + info.title + '</a></li>';
		}
	}

	xhttp.open("GET", "userendpages/.donate-view.php?id=" + id, true);
	xhttp.send();
}