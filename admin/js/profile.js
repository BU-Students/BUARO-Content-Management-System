//not mine. See https://stackoverflow.com/questions/814613/how-to-read-get-data-from-a-url-using-javascript
function parseURLParams(url) {
	var queryStart = url.indexOf("?") + 1,
		queryEnd   = url.indexOf("#") + 1 || url.length + 1,
		query = url.slice(queryStart, queryEnd - 1),
		pairs = query.replace(/\+/g, " ").split("&"),
		parms = {}, i, n, v, nv;

	if (query === url || query === "") return;

	for (i = 0; i < pairs.length; i++) {
		nv = pairs[i].split("=", 2);
		n = decodeURIComponent(nv[0]);
		v = decodeURIComponent(nv[1]);

		if (!parms.hasOwnProperty(n)) parms[n] = [];
		parms[n].push(nv.length === 2 ? v : null);
	}

	return parms;
}

var urlParam = parseURLParams(window.location.href);
var appendParam = "";

if(urlParam != undefined && typeof urlParam.user_id != "undefined") {
	var url_id = urlParam.user_id[0];
	appendParam = "&user-id=" + url_id;
	document.getElementById("editButton").parentNode.removeChild(document.getElementById("editButton"));
	document.getElementById("profile-options").innerHTML =
		'<a href="profile.php">' +
			'Visit your own profile' +
			'<span class="glyphicon glyphicon-chevron-right" style="margin-left: 10px"></span>' +
		'</a>';
}

var user_info;
var url = "backend/request_handler.php";
var params = "request-type=C-0" + appendParam;

var xhr;

if(window.XMLHttpRequest)
	xhr = new XMLHttpRequest();
else
	xhr = new ActiveXObject("Microsoft.XMLHTTP");

if(xhr) {
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			if(xhr.responseText == "") {
				document.getElementById("content-wrapper").innerHTML =
					'<div id="broken-link-backdrop">' +
					'<img src="../img/broken-page.png" />' +
					'<label>The link is either invalid or expired</label><br>' +
					'<a href="administrators.php">' +
					'<h5>Want to visit your own profile?<span class="glyphicon glyphicon-chevron-right"></span></h5>' +
					'</a>' +
					'</div>';
			}
			else {
				console.log(xhr.responseText);
				try {
					user_info = JSON.parse(xhr.responseText);
					document.getElementById("f-name").innerHTML = user_info.f_name;
					document.getElementById("m-name").innerHTML = user_info.m_name;
					document.getElementById("l-name").innerHTML = user_info.l_name;
					document.getElementById("college").innerHTML = (user_info.college == "")? "Parent Administrator" : user_info.college + " Alumni Coordinator";
					document.getElementById("story-count").innerHTML = user_info.post_count;
					document.getElementById("view-count").innerHTML = user_info.view_count;
					document.getElementById("age").innerHTML = user_info.age + " years old";
					document.getElementById("sex").innerHTML = user_info.sex;
					document.getElementById("profile-img").src = (user_info.profile_img == "")? "../img/default-profile-img.png" : "../../data/admin/profile-image/" + user_info.profile_img;

					document.getElementById("b-date-display").innerHTML = user_info.formatted_bdate;
					document.getElementById("b-date").value = user_info.raw_bdate;

					var address_link = document.getElementById("address-link");
					if(user_info.barangay == user_info.municipality && user_info.municipality == user_info.province && user_info.province == "") {
						address_link.innerHTML = "Not available";
						address_link.style.pointerEvents = "none";
						address_link.style.color = "#555";
					}
					else {
						address_link.href = "https://www.google.com.ph/search?q=" + user_info.barangay + "%2C+" + user_info.municipality + "%2C+" + user_info.province;
						address_link.innerHTML = user_info.barangay + ", " + user_info.municipality + ", " + user_info.province;
					}

					var contact_no_link = document.getElementById("contact-no-link");
					if(user_info.contact_no != "") {
						contact_no_link.href = "tel: " + user_info.contact_no;
						contact_no_link.innerHTML = user_info.contact_no;
					}
					else {
						contact_no_link.innerHTML = "None";
						contact_no_link.style.pointerEvents = "none";
						contact_no_link.style.color = "#555";
					}

					var email_link = document.getElementById("email-link");
					if(user_info.email != "") {
						email_link.href = "mailto: " + user_info.email;
						email_link.innerHTML = user_info.email;
					}
					else {
						email_link.innerHTML = "None";
						email_link.style.pointerEvents = "none";
						email_link.style.color = "#555";
					}

					var coverPhoto = document.getElementById("cover-photo-img");
					var photoURL = (user_info.cover_photo == "")? "../img/default-profile-cover-photo.jpg" : "../../data/admin/cover-photo/" + user_info.cover_photo;

					coverPhoto.src = photoURL;
					if(coverPhoto.addEventListener) {
						coverPhoto.addEventListener("load", function() {
							document.getElementById("left-side").classList.add("fade-up");
							document.getElementById("right-side").classList.add("fade-down");

							if(coverPhoto.height > 300) {
								window.setTimeout(function() {
									$("#right-side").animate({ scrollTop: (coverPhoto.height - 300) + "px" }, 1200);
								}, 500);
							}
						});
					}
					else {
						coverPhoto.attachEvent("onload", function() {
							document.getElementById("left-side").classList.add("fade-up");
							document.getElementById("right-side").classList.add("fade-down");

							if(coverPhoto.height > 300) {
								window.setTimeout(function() {
									$("#right-side").animate({ scrollTop: (coverPhoto.height - 300) + "px" }, 1200);
								}, 500);
							}
						});
					}

					setTimeout(function() {
						document.getElementById("left-side").style.opacity = 1;
						document.getElementById("right-side").style.opacity = 1;
					}, 2000);
				}
				catch(e) {
					document.getElementById("content-wrapper").innerHTML =
						'<div id="broken-link-backdrop">' +
						'<img src="../img/broken-page.png" />' +
						'<label>The link is either invalid or expired</label><br>' +
						'<a href="administrators.php">' +
						'<h5>Want to visit your own profile?<span class="glyphicon glyphicon-chevron-right"></span></h5>' +
						'</a>' +
						'</div>';
				}
			}
		}
	}

	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.send(params);
}
else alert("Unable to communicate to the server. Try reloading the page.");

function editProfile(button) {
	var bdate_input = document.getElementById("b-date-input");
	bdate_input.classList.add("edit-mode");
	bdate_input.value = user_info.raw_bdate;
	document.getElementById("b-date").style.display = "table-cell";
	document.getElementById("b-date-display").style.display = "none";

	var contact_no_input = document.getElementById("contact-no-input");
	contact_no_input.classList.add("edit-mode");
	contact_no_input.value = user_info.contact_no;
	document.getElementById("contact-no").style.display = "table-cell";
	document.getElementById("contact-no-display").style.display = "none";

	var email_input = document.getElementById("email-input");
	email_input.classList.add("edit-mode");
	email_input.value = user_info.email;
	document.getElementById("email").style.display = "table-cell";
	document.getElementById("email-display").style.display = "none";

	document.getElementById("address-display").style.display = "none";
	document.getElementById("address").style.display = "table-cell";
	var barangay = document.getElementById("barangay-input");
	barangay.value = user_info.barangay;
	barangay.classList.add("edit-mode");
	var municipality = document.getElementById("municipality-input");
	municipality.value = user_info.municipality;
	municipality.classList.add("edit-mode");
	var province = document.getElementById("province-input");
	province.value = user_info.province;
	province.classList.add("edit-mode");

	document.getElementById("editing-options").style.display = "block";
	button.style.display = "none";
}

function attemptToSave() {
	var b_date = document.getElementById("b-date-input").value;
	var contact_no = document.getElementById("contact-no-input").value;
	var email = document.getElementById("email-input").value;

	var barangay = document.getElementById("barangay-input").value;
	var municipality = document.getElementById("municipality-input").value;
	var province = document.getElementById("province-input").value;

	params = "";

	if(b_date != user_info.raw_bdate && isValidDate(b_date))
		params += "&b-date=" + b_date;
	if(contact_no != user_info.contact_no) params += "&contact-no=" + contact_no;
	if(email != user_info.email) params += "&email=" + email;
	if(barangay != user_info.barangay) params += "&barangay=" + barangay;
	if(municipality != user_info.municipality) params += "&municipality=" + municipality;
	if(province != user_info.province) params += "&province=" + province;

	if(params != "") {
		params = "request-type=C-1" + params;

		if(window.XMLHttpRequest) xhr = new XMLHttpRequest();
		else xhr = new ActiveXObject("Microsoft.XMLHTTP");

		if(xhr) {
			xhr.onreadystatechange = function() {
				if(xhr.readyState == 4 && xhr.status == 200) {
					var notif_msg = document.getElementById("notif-content");
					var notif_img = document.getElementById("notif-img");

					if(xhr.responseText == "") {
						user_info.raw_bdate = b_date;
						user_info.contact_no = contact_no;
						user_info.barangay = barangay;
						user_info.municipality = municipality;
						user_info.province = province;
						user_info.email = email;

						document.getElementById("b-date-display").innerHTML = readableDate(b_date);
						document.getElementById("address-link").innerHTML = barangay + ", " + municipality + ", " + province;

						var contact_no_link = document.getElementById("contact-no-link");
						if(contact_no != "") {
							contact_no_link.href = "tel: " + contact_no;
							contact_no_link.innerHTML = contact_no;
						}
						else {
							contact_no_link.innerHTML = "None";
							contact_no_link.style.pointerEvents = "none";
							contact_no_link.style.color = "#555";
						}

						var email_link = document.getElementById("email-link");
						if(email != "") {
							email_link.href = "mailto: " + email;
							email_link.innerHTML = email;
						}
						else {
							email_link.innerHTML = "None";
							email_link.style.pointerEvents = "none";
							email_link.style.color = "#555";
						}

						var parts = b_date.split("-");
						var today = new Date();
						var curr_age = today.getFullYear() - parseInt(parts[0]);
						if (today.getMonth() < parts[1] || (today.getMonth() == parts[1] && today.getDate() < parts[2])) curr_age--;
						document.getElementById("age").innerHTML = curr_age + " years old";

						notif_img.src = "../img/check-icon.png";
						notif_msg.innerHTML = "Profile successfully updated";
					}
					else {
						notif_img.src = "../img/error-icon.png";
						notif_msg = "Something went wrong. Some fields may not have been updated.";
						console.log("Server error response: " + xhr.responseText);
					}

					document.getElementById("notif-container").classList.add("show-notif");
					setTimeout(function() {
						document.getElementById("notif-container").classList.remove("show-notif");
					}, 5000);
				}
			}

			xhr.open("POST", url, true);
			xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhr.send(params);
		}
		else alert("Unable to connect to the server. Try reloading the page, then try again.");
	}
	else {
		document.getElementById("notif-img").src = "../img/info-icon.png";
		document.getElementById("notif-content").innerHTML = "Nothing was updated.";
		document.getElementById("notif-container").classList.add("show-notif");
		setTimeout(function() {
			document.getElementById("notif-container").classList.remove("show-notif");
		}, 5000);
	}

	exitEditMode();
	return false;
}

function readableDate(dateString) {
		var month = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
		var parts = dateString.split("-");
		return month[parts[1] - 1] + " " + parts[2] + ", " + parts[0];
}

// Validates that the input string is a valid date formatted as "mm/dd/yyyy"
function isValidDate(dateString) {
	// First check for the pattern
	var regex_date = /^\d{4}\-\d{1,2}\-\d{1,2}$/;

	if(!regex_date.test(dateString))
		return false;

	// Parse the date parts to integers
	var parts = dateString.split("-");
	var day = parseInt(parts[2], 10);
	var month = parseInt(parts[1], 10);
	var year = parseInt(parts[0], 10);

	// Check the ranges of month and year
	if(year < 1000 || year > 3000 || month == 0 || month > 12)
		return false;

	var monthLength = [ 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 ];

	// Adjust for leap years
	if(year % 400 == 0 || (year % 100 != 0 && year % 4 == 0))
		monthLength[1] = 29;

	// Check the range of the day
	return day > 0 && day <= monthLength[month - 1];
}

function exitEditMode() {
	document.getElementById("b-date-input").classList.remove("edit-mode");
	document.getElementById("b-date").style.display = "none";
	document.getElementById("b-date-display").style.display = "table-cell";

	document.getElementById("contact-no-input").classList.remove("edit-mode");
	document.getElementById("contact-no").style.display = "none";
	document.getElementById("contact-no-display").style.display = "table-cell";

	document.getElementById("email-input").classList.remove("edit-mode");
	document.getElementById("email").style.display = "none";
	document.getElementById("email-display").style.display = "table-cell";

	document.getElementById("address-display").style.display = "table-cell";
	document.getElementById("address").style.display = "none";
	document.getElementById("barangay-input").classList.remove("edit-mode");
	document.getElementById("municipality-input").classList.remove("edit-mode");
	document.getElementById("province-input").classList.remove("edit-mode");

	document.getElementById("editButton").style.display = "block";
	document.getElementById("editing-options").style.display = "none";
}