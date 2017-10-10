document.getElementById("feedback-tab").classList.add("active");
var curr_page = 1;
var total_pages;
feedbackPagination(1);

function attemptDelete(element, feedback_id) {
	if(confirm("Are you sure?")) {
		var params = "request-type=J-0&&feedback-id=" + feedback_id;

		var http = new XMLHttpRequest();
		http.open("POST", "backend/request_handler.php", true);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		http.onreadystatechange = function() {
			if(http.readyState == 4 && http.status == 200) {
				element.parentNode.parentNode.removeChild(element.parentNode);
			}
		}
		http.send(params);
	}
}
function feedbackPagination(page) {
	if(page < 1 || page > total_pages)
		return;

	const limit = 10;
	var params = "request-type=J-1&&limit=" + limit + "&&offset=" + (page * limit - limit);
	var http = new XMLHttpRequest();
	http.open("POST", "backend/request_handler.php", true);
	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	http.onreadystatechange = function() {
		if(http.readyState == 4 && http.status == 200) {
			console.log(this.responseText);
			var info = JSON.parse(this.responseText);
			total_pages = Math.ceil(info.total_rows / limit);
			document.getElementById("tbody").innerHTML = info.table_content;
			var pagination = document.getElementById("pagination");
			pagination.innerHTML = "";

			var className;
			for(var i = 0, count = 1; i < info.total_rows; i += limit, ++count) {
				if(count == page) {
					className = 'active';
					curr_page = count;
				}
				else className = '';

				pagination.innerHTML +=
					'<li class="' + className + '" onclick="feedbackPagination(' + count + ')">' +
						'<a href="javascript:void(0)">' + count + '</a>' +
					'</li>';
			}

			pagination.innerHTML =
				'<li onclick="feedbackPagination(' + (curr_page - 1) + ')">' +
					'<a href="javascript:void(0)"><span class="glyphicon glyphicon-chevron-left"></span></a>' +
				'</li>' + pagination.innerHTML;

			pagination.innerHTML +=
				'<li onclick="feedbackPagination(' + (curr_page + 1) + ')">' +
					'<a href="javascript:void(0)"><span class="glyphicon glyphicon-chevron-right"></span></a>' +
				'</li>';
		}
	}
	http.send(params);
}