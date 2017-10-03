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
var params = "request-type=F-0&state=1";
var xhr;

var users;
var num_users;
var active_rows_num = 0;
var state = "1";
var action;

if(window.XMLHttpRequest) xhr = new XMLHttpRequest();
else xhr = new ActiveXObject("Microsoft.XMLHTTP");

if(xhr) {
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			//if there are no rows retrieved
			if(xhr.responseText == "") {
				document.getElementById("row-select-btn").style.display = "none";
				document.getElementById("select-all-btn").style.display = "none";
				document.getElementById("admin-table-body").innerHTML =
					'<tr><td colspan="6" style="text-align: center;">Nothing to display here.</td></tr>';
				return;
			}

			var info = JSON.parse(xhr.responseText);
			users = info.users;
			num_users = info.num_users;
			var t_body = document.getElementById("admin-table-body");

			var row;
			for(var i = 0; i < num_users; ++i) {
				row = document.createElement("tr");
				row.setAttribute("onclick", "clickedRowFunction(this)");
				row.setAttribute("style", "opacity: 0");
				row.innerHTML = 
					'<input type="hidden" value="' + users[i].id + '" />' +
					"<td>" + users[i].f_name + "</td>" +
					"<td>" + users[i].m_name + "</td>" +
					"<td>" + users[i].l_name + "</td>" +
					"<td>" + users[i].college + "</td>" +
					"<td>" + users[i].sex + "</td>" +
					"<td>" + users[i].age + "</td>" +
					'<input type="hidden" value="' + users[i].profile_img + '" />' +
					'<input type="hidden" value="' + users[i].state + '" />';
				t_body.insertBefore(row, t_body.childNodes[0]);

				window.setTimeout(showRow.bind(null, row), i * 50);
			}

			sortAdminTable(document.getElementById("admin-table-headers").children[0], 0);
		}
	}

	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.send(params);
}
else alert("Unable to communicate to the server. Try reloading the page.");

function showRow(row) { row.style.opacity = 1; }

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

	document.getElementById("select-all-btn").style.display = "inline-block";
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
	//if row is disselected
	if(row.classList.contains("active") && active_rows_num == 1) {
		document.getElementById("user-info-panel").style.display = "none";
		row.classList.remove("active");
		--active_rows_num;
	}
	//if multiple rows selection is activated
	else if(selectMode == true) {
		document.getElementById("user-info-panel").style.display = "none";
		if(row.classList.toggle("active")) {
			++active_rows_num;
			if(active_rows_num == 1) viewUserInfo(row);
		}
		else {
			if(active_rows_num == 2) {
				var rows = row.parentNode.children;
				for(var i = 0; i < rows.length; ++i) {
					if(rows[i].classList.contains("active")) break;
				}
				viewUserInfo(rows[i]);
			}
			--active_rows_num;
		}
	}
	//if no rows are selected
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

	var option_button = document.getElementById("activate-deactivate");
	if(row.children[8].value == "1")
		option_button.innerHTML = ((active_rows_num > 1)? "Deactivate Accounts" : "Deactivate Account");
	else
		option_button.innerHTML = ((active_rows_num > 1)? "Activate Accounts" : "Activate Account");
	document.getElementById("row-options-panel").style.display = "block";

	action = (row.children[8].value == "0")? 1 : 0;
}

function confirmAction() {
	var temp = active_rows_num + " user account" + ((active_rows_num > 1)? "s" : "");
	if(action == 1) {
		document.getElementById("confirmation-title").innerHTML = "Account Activation";
		document.getElementById("confirmation-msg").innerHTML = "You're about to activate " + temp + ". Do you want to continue?";
	}
	else {
		document.getElementById("confirmation-title").innerHTML = "Account deactivation";
		document.getElementById("confirmation-msg").innerHTML = "You're about to deactivate " + temp + ". Do you want to continue?";
	}
	$("#confirm-modal").modal("show");
}

function activate_deactivate_accounts() {
	params = "request-type=F-1&new-state=" + action;

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
					if(state == "2") {
						for(var i = 0; i < rows.children.length; ++i) {
							if(rows.children[i].classList.contains("active")) {
								if(rows.children[i].children[8].value == "0") {
									rows.children[i].className = "success";
									rows.children[i].children[8].value = "1";
								}
								else {
									rows.children[i].className = "danger";
									rows.children[i].children[8].value = "0";
								}
							}
						}
					}
					else {
						for(var i = rows.children.length - 1; i >= 0; --i) {
							if(rows.children[i].classList.contains("active")) {
								rows.removeChild(rows.children[i]);
							}
						}
					}

					if(action == 1) {
						notif_img.src = "../img/check-icon.png";
						notif_msg.innerHTML = "Selected user account" + ((active_rows_num > 1)? "s were" : " has been") + " activated.";
					}
					else {
						notif_img.src = "../img/info-icon.png";
						notif_msg.innerHTML = "Selected user account" + ((active_rows_num > 1)? "s were" : " has been") + " deactivated.";
					}

					if(rows.children.length == 0) {
						document.getElementById("row-select-btn").style.display = "none";
						document.getElementById("select-all-btn").style.display = "none";
						document.getElementById("admin-table-body").innerHTML =
							'<tr><td colspan="6" style="text-align: center;">Nothing to display here.</td></tr>';
					}
					else {
						var btn = document.getElementById("row-select-btn");
						btn.innerHTML = "Select Multiple Rows";
						toggleSelectMode(btn);
					}

					active_rows_num = 0;
					document.getElementById("row-options-panel").style.display = "none";
				}
				else {
					console.log(xhr.responseText);
					notif_img.src = "../img/error-icon.png";
					notif_msg.innerHTML = "A server-side error occured. Selection not deleted.";
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

	$("#confirm-modal").modal("hide");
}

function displayTable() {
	var newState;
	var states = document.getElementById("state-container").children;
	for(var i = 0; i < states.length; ++i) {
		if(states[i].firstChild.firstChild.checked == true) {
			newState = states[i].firstChild.firstChild.value;
			break;
		}
	}

	if(newState != state) {
		xhr = null;
		params = "request-type=F-0&&state=" + newState;

		if(window.XMLHttpRequest) xhr = new XMLHttpRequest();
		else xhr = new ActiveXObject("Microsoft.XMLHTTP");

		if(xhr) {
			xhr.onreadystatechange = function() {
				if(xhr.readyState == 4 && xhr.status == 200) {
					//if there are no rows retrieved
					if(xhr.responseText == "") {
						document.getElementById("row-select-btn").style.display = "none";
						document.getElementById("select-all-btn").style.display = "none";
						document.getElementById("admin-table-body").innerHTML =
							'<tr><td colspan="6" style="text-align: center;">Nothing to display here.</td></tr>';
						return;
					}
					else try {
						info = JSON.parse(xhr.responseText);
						users = info.users;
						num_users = info.num_users;
						state = newState;
						active_rows_num = 0;

						var t_body = document.getElementById("admin-table-body");
						t_body.innerHTML = "";

						var row;
						for(var i = 0; i < num_users; ++i) {
							row = document.createElement("tr");
							row.setAttribute("onclick", "clickedRowFunction(this)");
							row.setAttribute("style", "opacity: 0");
							row.innerHTML = 
								'<input type="hidden" value="' + users[i].id + '" />' +
								"<td>" + users[i].f_name + "</td>" +
								"<td>" + users[i].m_name + "</td>" +
								"<td>" + users[i].l_name + "</td>" +
								"<td>" + users[i].college + "</td>" +
								"<td>" + users[i].sex + "</td>" +
								"<td>" + users[i].age + "</td>" +
								'<input type="hidden" value="' + users[i].profile_img + '" />' +
								'<input type="hidden" value="' + users[i].state + '" />';
							t_body.insertBefore(row, t_body.children[0]);

							if(state == "2")
								row.classList.add(((users[i].state == 0)? "danger" : "success"));

							window.setTimeout(showRow.bind(null, row), i * 50);
						}

						sortAdminTable(document.getElementById("admin-table-headers").children[0], 0);

						var table_description = document.getElementById("table-description");
						var row_select = document.getElementById("row-select-btn");
						var select_all = document.getElementById("select-all-btn");

						if(state == "2") {
							table_description.innerHTML = 'ACTIVE AND INACTIVE ACCOUNTS';
							row_select.disabled = true;
							row_select.classList.remove("active");
							row_select.innerHTML = "Select Multiple Rows";
							select_all.disabled = true;
							selectMode = false;
						}
						else {
							if(state == "0")
								table_description.innerHTML = 'INACTIVE ACCOUNTS';
							else if(state == "1")
								table_description.innerHTML = 'ACTIVE ACCOUNTS';


							row_select.disabled = false;
							row_select.style.display = "inline-block";
							select_all.disabled = false;
							select_all.style.display = "inline-block";
						}
					}
					catch(e) {
						console.log(xhr.responseText);
					}

					displayColumns();
				}
			}

			xhr.open("POST", url, true);
			xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhr.send(params);
		}
		else alert("Unable to communicate to the server. Try reloading the page.");
	}
	else displayColumns();
}

function displayColumns() {
	var theaders = document.getElementById("admin-table-headers").children;
	table = document.getElementById("admin-table-body").children;

	theaders[0].style.display = (document.getElementById("fname-attr").checked)? "table-cell" : "none";
	theaders[1].style.display = (document.getElementById("mname-attr").checked)? "table-cell" : "none";
	theaders[2].style.display = (document.getElementById("lname-attr").checked)? "table-cell" : "none";
	theaders[3].style.display = (document.getElementById("college-attr").checked)? "table-cell" : "none";
	theaders[4].style.display = (document.getElementById("gender-attr").checked)? "table-cell" : "none";
	theaders[5].style.display = (document.getElementById("age-attr").checked)? "table-cell" : "none";

	for(var i = table.length - 1; i >= 0; --i) {
		table[i].children[1].style.display = (document.getElementById("fname-attr").checked)? "table-cell" : "none";
		table[i].children[2].style.display = (document.getElementById("mname-attr").checked)? "table-cell" : "none";
		table[i].children[3].style.display = (document.getElementById("lname-attr").checked)? "table-cell" : "none";
		table[i].children[4].style.display = (document.getElementById("college-attr").checked)? "table-cell" : "none";
		table[i].children[5].style.display = (document.getElementById("gender-attr").checked)? "table-cell" : "none";
		table[i].children[6].style.display = (document.getElementById("age-attr").checked)? "table-cell" : "none";
	}
}

function selectAllRows(button) {
	table = document.getElementById("admin-table-body").children;
	console.log(table);
	clearActiveRows();

	selectMode = true;

	var btn1 = document.getElementById("row-select-btn");
	if(btn1.classList.add("active")) {
		btn1.innerHTML = "Select Multiple Rows";
		clearActiveRows();
	}
	else btn1.innerHTML = "Unselect Rows";

	for(var i = 0; i < table.length; ++i)
		clickedRowFunction(table[i]);

	button.style.display = "none";
}