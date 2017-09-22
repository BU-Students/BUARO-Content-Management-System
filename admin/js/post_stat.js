getPostStat();

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

function getPostStat() {
	var post_id = parseURLParams(window.location.href).post_id;
	var url = "backend/request_handler.php";
	var params = "request-type=D-0&post-id=" + post_id;
	var xhr;

	if(window.XMLHttpRequest)
		xhr = new XMLHttpRequest();
	else
		xhr = new ActiveXObject("Microsoft.XMLHTTP");

	if(xhr) {
		xhr.onreadystatechange = function() {
			if(xhr.readyState == 4 && xhr.status == 200) {
				try{
					var postData = JSON.parse(xhr.responseText);
					displayPostGraph(postData);
					getAllPostStat(post_id);
				}
				catch(e) {
					console.log(e);
					console.log("\nResponse string: " + xhr.responseText);
				}
			}
		}

		xhr.open("POST", url, true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhr.send(params);
	}
	else alert("Unable to communicate to the server. Try reloading the page.");
}

function displayPostGraph(post) {
	console.log(post);
	Highcharts.chart("post-stat-graph", {
		chart: {
			type: "column"
		},
		title: {
			text: '<span style="font-size: 12px;">STORY TITLE:</span><br>' + post.title
		},
		subtitle: {
			text: '<a href="#">Click here to view story</a>'
		},
		xAxis: {
			categories: [""]
		},
		yAxis: {
			allowDecimals: false,
			min: 0,
			title: {
				text: "Number of People"
			},
			labels: {
				overflow: "justify"
			}
		},
		tooltip: {
			valueSuffix: " people"
		},
		plotOptions: {
			bar: {
				dataLabels: {
					enabled: true
				}
			}
		},
		credits: {
			enabled: false
		},
		series: [{
			name: "Total views",
			data: [post.view_count]
		}, {
			name: "Unique visitors",
			data: [post.unique_visitors]
		}]
	});
}

function getAllPostStat(post_id) {
	var url = "backend/request_handler.php";
	var params = "request-type=D-1&post-id=" + post_id;
	var xhr;

	if(window.XMLHttpRequest)
		xhr = new XMLHttpRequest();
	else
		xhr = new ActiveXObject("Microsoft.XMLHTTP");

	if(xhr) {
		xhr.onreadystatechange = function() {
			if(xhr.readyState == 4 && xhr.status == 200) {
				try {
					var obj = JSON.parse(xhr.responseText);
					displayAllPostGraph(obj.post);
				}
				catch(e) {
					console.log(e);
					console.log("\nResponse string: " + xhr.responseText);
				}
			}
		};

		xhr.open("POST", url, true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhr.send(params);
	}
	else alert("Unable to communicate to the server. Try reloading the page.");
}

function displayAllPostGraph(post_list) {
	var post_titles = [];
	var view_counts = [];
	var unique_visitors = [];
	for(var i = 0; i < post_list.length; ++i) {
		view_counts.push(post_list[i].view_count);
		unique_visitors.push(post_list[i].unique_visitors);
		post_titles.push(post_list[i].title);
	}

	var comparison_chart = Highcharts.chart("post-comparison-graph", {
		chart: {
			type: "bar"
		},
		title: {
			text: "Comparison to Other Alumni Stories In the College"
		},
		xAxis: {
			categories: post_titles,
			title: {
				text: "Story Title"
			},
			labels: {
				rotation: 0,
				style: {
					fontSize: '13px',
					fontFamily: 'Verdana, sans-serif'
				}
			}
		},
		yAxis: {
			allowDecimals: false,
			min: 0,
			title: {
				text: "Number of Visitors"
			},
			labels: {
				overflow: "justify"
			}
		},
		tooltip: {
			valueSuffix: " people"
		},
		plotOptions: {
			bar: {
				dataLabels: {
					enabled: true
				}
			}
		},
		legend: {
			layout: "vertical",
			align: "right",
			verticalAlign: "top",
			x: 0,
			y: 25,
			floating: true,
			borderWidth: 1,
			backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || "#FFFFFF")
		},
		credits: {
			enabled: false
		},
		series: [{
			name: "Total views",
			data: view_counts
		}, {
			name: "Unique visitors",
			data: unique_visitors
		}]
	});
}

function sort() {
	document.getElementById("asc-label").classList.toggle("hide-label");
	document.getElementById("desc-label").classList.toggle("hide-label");

	if(document.getElementById("order").checked == true) {
	}
}