var li = document.createElement("li");
var parent = document.getElementById("topbar-right");
li.setAttribute("id", "editor-tab");
li.innerHTML = '<a href="editor-eshop.php">Post a Product</a>';
parent.insertBefore(li, parent.firstChild);

function readURL(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function(e) {
			$('#blah').attr('src', e.target.result);
		}

		reader.readAsDataURL(input.files[0]);
	}
}

$("#imgInp").change(function() {
	readURL(this);
});

// show create eshop post

$(document).ready(function() {
	setTimeout(popup, 3000);
	function popup() {
		$("#logindiv").css("display", "block");
	}
	$("#login #cancel").click(function() {
		$(this).parent().parent().hide();
	});
	$("#onclick").click(function() {
		$("#contactdiv").css("display", "block");
	});
	$("#contact #cancel").click(function() {
		$(this).parent().parent().hide();
	});
	// Contact form popup send-button click event.
	$("#send").click(function() {
		var name = $("#name").val();
		var email = $("#email").val();
		var contact = $("#contactno").val();
		var message = $("#message").val();
		if (name == "" || email == "" || contactno == "" || message == "") {
			alert("Please Fill All Fields");
		} else {
			if (validateEmail(email)) {
				$("#contactdiv").css("display", "none");
			} else {
				alert('Invalid Email Address');
			}
			function validateEmail(email) {
				var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
				if (filter.test(email)) {
					return true;
				} else {
					return false;
				}
			}
		}
	});
	// Login form popup login-button click event.
	$("#loginbtn").click(function() {
		var name = $("#username").val();
		var password = $("#password").val();
		if (username == "" || password == "") {
			alert("Username or Password was Wrong");
		} else {
			$("#logindiv").css("display", "none");
		}
	});
});

$(document).ready(function() {
	document.getElementById("eshop-tab").classList.add("active");

	//retrieve stories
	var http = new XMLHttpRequest();
	var url = "backend/request_handler.php";
	var request_type = "H-0";
	var params = "request-type=" + request_type;

	http.open("POST", url, true);

	//Send the proper header information along with the request
	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	http.onreadystatechange = function() {
		if (http.readyState == 4 && http.status == 200) {
			displayStories(http.responseText);
			handleEmptyStories();
		}
	}

	http.send(params);

	//initialize bootstrap tootip utility
	$('[data-toggle="tooltip"]').tooltip({
		trigger: "hover"
	});

	//workaround for scrolling issue with bootstrap's multiple modals
	$(document).on('hidden.bs.modal', '.modal', function() {
		$('.modal:visible').length && $(document.body).addClass('modal-open');
	});
});

function handleEmptyStories() {
	if (document.getElementById("stories-wrapper").innerHTML.replace(/\s/g, "") <= 0) {
		document.getElementById("no-stories-backdrop").style.display = "block";
	}
}

function displayStories(response) {
	var stories_container = document.getElementById("stories-wrapper");
	var stories = stories_container.children;

	stories_container.innerHTML = response;

	//add .overflown to story containers with overlowing content
	//and store their index for DOM reference (for removeChild())
	for (var i = 0; i < stories.length; ++i) {
		stories[i].children[1].value = i;
		if (isOverflown(stories[i])) {
			stories[i].classList.add("overflown");
		}
	}
}

function isOverflown(element) {
	return element.scrollHeight > element.clientHeight || element.scrollWidth > element.clientWidth;
}

function expandStory(story) {
	var db_id = story.children[0].value;
	var dom_index = story.children[1].value;
	var title = story.children[2].children[1].innerHTML;
	//var date = story.children[2].children[2].innerHTML;
	var content = story.children[4].innerHTML;
	//var img_path = story.children[7].innerHTML;

	//load story information to modal
	document.getElementById("story-db-id").value = db_id;
	document.getElementById("story-dom-id").value = dom_index;
	document.getElementById("expanded-story-title").innerHTML = title;
	//   document.getElementById("expanded-story-date").innerHTML = date;
	document.getElementById("expanded-story-body").innerHTML = content;
	//  document.getElementById("expanded-story-img").innerHTML = img_path;
	document.getElementById("edit-story-link").href = "editor-eshop.php?post_id=" + db_id;
	document.getElementById("edit-story-comment").href = "manage_comment.php?post_id=" + db_id;
	//   document.getElementById("story-stat-link").href = "post_stat.php?post_id=" + db_id;

	//show modal
	$("#expanded-story").modal();
}

function deleteStory() {
	var db_id = document.getElementById("story-db-id").value;
	var dom_index = document.getElementById("story-dom-id").value;

	//request for deletion
	var http = new XMLHttpRequest();
	var url = "backend/request_handler.php";
	var request_type = "H-2";
	var params = "request-type=" + request_type + "&story-id=" + db_id;

	http.open("POST", url, true);

	//Send the proper header information along with the request
	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	http.onreadystatechange = function() {
		if (http.readyState == 4 && http.status == 200) {
			if (http.responseText == "failed") {
				alert(http.responseText);
			} else {
				//remove the shild specified by dom_index
				var stories = document.getElementById("stories-wrapper");
				stories.removeChild(stories.children[dom_index]);

				//and update all index information of childrens with greater dom_index values
				for (var i = dom_index; i < stories.children.length; ++i)
					stories.children[i].children[1].value = stories.children[i].children[1].value - 1;

				//notify user that deletion was successful
				document.getElementById("notif-img").src = "../img/delete-icon.png";
				document.getElementById("notif-content").innerHTML = "Item permanently deleted.";
				document.getElementById("notif-container").classList.add("show-notif");

				setTimeout(function() {
					document.getElementById("notif-container").classList.remove("show-notif");
				}, 5000);

				handleEmptyStories();

				$("#confirmation-modal").modal("hide");
				$("#expanded-story").modal("hide");
			}
		}
	}

	http.send(params);
}
