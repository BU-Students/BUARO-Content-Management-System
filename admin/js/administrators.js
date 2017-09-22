document.getElementById("admins-tab").classList.add("active");

if(window.location.hash == "#success") {
	document.getElementById("notif-img").src = "../img/check-icon.png";
	document.getElementById("notif-content").innerHTML = "Account successfully created";

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

var selectMode = false;

var url = "backend/request_handler.php";
var params = "request-type=F-0";
var xhr;

var users;
var num_users;
var active_rows_num = 0;

if(window.XMLHttpRequest) xhr = new XMLHttpRequest();
else xhr = new ActiveXObject("Microsoft.XMLHTTP");

if(xhr) {
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			console.log(xhr.responseText);
			var info = JSON.parse(xhr.responseText);
			var curr_user = info.curr_user;
			users = info.users;
			num_users = info.num_users;
			var t_body = document.getElementById("admin-table-body");

			var row;
			for(var i = 0; i < num_users; ++i) {
				row = document.createElement("tr");
				row.setAttribute("onclick", "clickedRowFunction(this)");
				row.innerHTML = 
					'<input type="hidden" value="' + users[i].id + '" />' +
					"<td>" + users[i].f_name + "</td>" +
					"<td>" + users[i].m_name + "</td>" +
					"<td>" + users[i].l_name + "</td>" +
					"<td>" + users[i].college + "</td>" +
					"<td>" + users[i].sex + "</td>" +
					"<td>" + users[i].age + "</td>" +
					'<input type="hidden" value="' + users[i].profile_img + '" />';
				t_body.appendChild(row);
			}

			sortAdminTable(document.getElementById("admin-table-headers").children[0], 0);
		}
	}

	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.send(params);
}
else alert("Unable to communicate to the server. Try reloading the page.");

function sortAdminTable(header, n) {
	var theaders = document.getElementById("admin-table-headers").children;
	for(var i = 0; i < theaders.length; ++i)
		theaders[i].classList.remove("active");
	header.classList.add("active");
	document.getElementById("filter").placeholder = "Filter based on active column (" + header.innerHTML + ")";

	var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
	table = document.getElementById("admin-table-body");
	switching = true;

	//set the sorting direction to ascending
	dir = "asc";

	//loop until no switching has been done
	while (switching) {
		switching = false;
		rows = table.getElementsByTagName("tr");
		//loop through all table rows (except the first, which contains table headers)
		for (i = 0; i < (rows.length - 1); i++) {
			shouldSwitch = false;

			//get the two elements to compare, the current row and the next
			x = rows[i].getElementsByTagName("td")[n];
			y = rows[i + 1].getElementsByTagName("td")[n];
			//check if the two rows should switch place, based on the direction, "asc" or "desc"
			if (dir == "asc") {
				if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
					shouldSwitch = true;
					break;
				}
			}
			else if (dir == "desc") {
				if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
					shouldSwitch = true;
					break;
				}
			}
		}

		if(shouldSwitch) {
			//if a switch has been marked, make the switch and mark that a switch has been made
			rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
			switching = true;

			//increase this count by 1 each time a switch is done
			switchcount++;
		}
		else {
			//If no switching has been done and the direction is "asc", set the direction to "desc" and run the while loop again
			if (switchcount == 0 && dir == "asc") {
				dir = "desc";
				switching = true;
			}
		}
	}
}

function filter(input) {
	//define what is being searched for
	var tab;
	var theaders = document.getElementById("admin-table-headers").children;

	for(var i = 0; i < theaders.length; ++i) {
		if(theaders[i].classList.contains("active")) {
			tab = i;
			break;
		}
	}		

	var input, filter, table, tr, td, i;

	filter = input.value.toUpperCase();
	table = document.getElementById("admin-table-body");
	tr = table.getElementsByTagName("tr");

	//Loop through all table rows, and hide those who don't match the search query
	for(i = 0; i < tr.length; i++) {
		td = tr[i].getElementsByTagName("td")[tab];
		if(td) {
			if(td.innerHTML.toUpperCase().indexOf(filter) > -1) {
				tr[i].style.display = "";
			}
			else tr[i].style.display = "none";
		} 
	}
}

function clearActiveRows() {
	var rows = document.getElementById("admin-table-body").children;
	for(var i = 0; i < rows.length; ++i)
		rows[i].classList.remove("active");
	document.getElementById("row-options-panel").style.display = "none";
	document.getElementById("user-info-panel").style.display = "none";
	active_rows_num = 0;
}

function toggleSelectMode(button) {
	selectMode = !selectMode;

	if(!button.classList.toggle("active")) {
		button.innerHTML = "Select Multiple Rows";
		clearActiveRows();
	}
	else button.innerHTML = "Unselect Rows";

	button.blur();
}

function viewUserInfo(row) {
	var rows = row.parentNode.children;
	document.getElementById("f-name").innerHTML = row.children[1].innerHTML;
	document.getElementById("m-name").innerHTML = row.children[2].innerHTML;
	document.getElementById("l-name").innerHTML = row.children[3].innerHTML;
	document.getElementById("college").innerHTML = row.children[4].innerHTML + " Alumni Coordinator";
	document.getElementById("profile-img").src = (row.children[7].value == "")? "../img/default-profile-img.png" : row.children[7].value;
	document.getElementById("profile-link").href = "profile.php?user_id=" + row.children[0].value;
	document.getElementById("user-info-panel").style.display = "block";
}

function clickedRowFunction(row) {
	if(row.classList.contains("active") && active_rows_num == 1) {
		document.getElementById("user-info-panel").style.display = "none";
		row.classList.remove("active");
		--active_rows_num;
	}
	else if(selectMode == true) {
		document.getElementById("user-info-panel").style.display = "none";
		if(row.classList.toggle("active")) {
			++active_rows_num;
			if(active_rows_num == 1) viewUserInfo(row);
		}
		else if(active_rows_num == 2) {
			var rows = row.parentNode.children;
			for(var i = 0; i < rows.length; ++i) {
				if(rows[i].classList.contains("active")) break;
			}
			viewUserInfo(rows[i]);
			--active_rows_num;
		}

		
	}
	else {
		if(!row.classList.contains("active")) {
			clearActiveRows();
			row.classList.add("active");
			active_rows_num = 1;
			document.getElementById("user-info-panel").style.display = "block";
		}
		else clearActiveRows();
		viewUserInfo(row);
	}

	document.getElementById("delete-btn").innerHTML = ((active_rows_num > 1)? "Delete Accounts" : "Delete Account");
	document.getElementById("row-options-panel").style.display = "block";
}

function confirmDeletion() {
	document.getElementById("num-users").innerHTML = active_rows_num + " user account" + ((active_rows_num > 1)? "s" : "");
	$("#confirm-delete").modal("show");
}

function deleteAccounts() {
	params = "request-type=F-1";

	var rows = document.getElementById("admin-table-body").children;
	var idCounter = 0;
	for(var i = 0; i < rows.length; ++i) {
		if(rows[i].classList.contains("active")) {
			params += "&id_" + idCounter + "=" + rows[i].children[0].value;
			++idCounter;
		}
	}
	params += "&id-count=" + idCounter;

	xhr = null;
	if(window.XMLHttpRequest) xhr = new XMLHttpRequest();
	else xhr = new ActiveXObject("Microsoft.XMLHTTP");

	if(xhr) {
		xhr.onreadystatechange = function() {
			if(xhr.readyState == 4 && xhr.status == 200) {
				var notif_img = document.getElementById("notif-img");
				var notif_msg = document.getElementById("notif-content");

				if(xhr.responseText == "") {
					rows = document.getElementById("admin-table-body");
					for(var i = 0; i < rows.children.length; ++i) {
						if(rows.children[i].classList.contains("active")) {
							rows.removeChild(rows.childNodes[i]);
						}
					}

					notif_img.src = "../img/check-icon.png";
					notif_msg.innerHTML = "Selected users permanently deleted.";

					var btn = document.getElementById("row-select-btn");
					btn.innerHTML = "Select Multiple Rows";
					btn.classList.remove("active");
					selectMode = false;
				}
				else {
					notif_img.src = "../img/error-icon.png";
					notif_msg.innerHTML = "A server side error occured. Selection not deleted.";
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

	$("#confirm-delete").modal("hide");
}