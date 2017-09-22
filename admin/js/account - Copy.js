$("#sub_change_pass").click(function() {
	if (($("#confirm_pass").val() != "") && ($("#new_pass").val() != "") && ($("#curr_pass2").val() != "")) {
		if ($("#confirm_pass").val() == $("#new_pass").val()) {	
			var fData = {
				"request-type": "H-2"
			};
			var jsonObj;
			$.ajax({
				url: 'backend/request_handler.php',
				//This is the current doc
				type: "POST",
				dataType: 'json',
				// add json datatype to get json
				data: fData,
				async: true,
				success: function(data) {
					var newData = {
						"request-type": "H-2",
						key: "recieve",
						recievedPass: $("#curr_pass2").val()
					};
					$.ajax({
						url: "backend/request_handler.php",
						type: "POST",
						async: true,
						data: newData,
						dataType: "json",

						success: function(data) {
							jsonObj = data;
							if (jsonObj == "status:success") {
								var formData = {
									"request-type": "H-0",
									npass: $("#new_pass").val()
								};
								$.ajax({
									url: "backend/request_handler.php",
									type: "POST",
									async: true,
									data: formData,
									dataType: "text",

									success: function(data) {
										window.alert("Success");
										$('.inp').val('');
									},
									error: function(xhr, status, error) {
										// check status && error
										window.alert("Error");
									},
								});
							} else {
								window.alert("Incorrect Password!");
								$(".inp").val('');
							}
						},
						error: function(xhr, status, error) {
							// check status && error
							console.log("Error in comparing data" + error);
						}
					});
				},
				error: function(xhr, status, error) {
					console.log("You have an error on sending or recieving data...");
				}
			});
		} else {
			window.alert("Passwords do not match...");
		}
	} else {
		window.alert("Please enter data");
	}
	return;
});

$("#sub_change_user").click(function() {
	var fData = {
		"request-type": "H-2"
	};

	if ($("#new_username").val() != '' && $("#curr_pass").val() != '') {
		var formData = {
			"request-type": "H-1",
			nuser: $("#new_username").val()
		};
		var jsonObj;
		$.ajax({
			url: 'backend/request_handler.php',
			//This is the current doc
			type: "POST",
			dataType: 'json',
			// add json datatype to get json
			data: fData,
			async: true,
			success: function(data) {
				var newData = {
					"request-type": "H-2",
					key: "recieve",
					recievedPass: $("#curr_pass").val()
				};
				$.ajax({
					url: "backend/request_handler.php",
					type: "POST",
					async: true,
					data: newData,
					dataType: "json",

					success: function(data) {
						jsonObj = data;
						if (jsonObj == "status:success") {
							$.ajax({
								url: "backend/request_handler.php",
								type: "POST",
								async: true,
								data: formData,
								dataType: "text",

								success: function(data) {
									window.alert("Successfully changed username!");
									$('.inp').val('');
								},
								error: function(xhr, status, error) {
									// check status && error
									window.alert("Error");
								},
							});
						} else {
							window.alert("Incorrect Password!");
						}
					},
					error: function(xhr, status, error) {
						// check status && error
						console.log("Error in comparing data" + xhr.responseText);
					}
				});
			},
			error: function(xhr, status, error) {
				console.log("You have an error on sending or recieving data...");
			}
		});
	} else {
		window.alert("Please enter all the data that is needed...");
	}
});

var url = "backend/request_handler.php";
var params = "request-type=C-0";
var xhr;

if (window.XMLHttpRequest)
	xhr = new XMLHttpRequest();
else
	xhr = new ActiveXObject("Microsoft.XMLHTTP");

if (xhr) {
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
} else
	alert("Unable to communicate to the server. Try reloading the page.");