var info;

var url = "../php/backend/request_handler.php";
var params = "request-type=G-1";
var xhr;

if(window.XMLHttpRequest)
	xhr = new XMLHttpRequest();
else
	xhr = new ActiveXObject("Microsoft.XMLHTTP");

if(xhr) {
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try{
                console.log(info);
				info = JSON.parse(xhr.responseText);
                

             Highcharts.chart('container', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: info.college + ' Batch ' + info.batch
                    },
                    xAxis: {
                        categories: info.categories,
                        title: {
                            text: 'COURSES IN YOUR COLLEGE'
                        }
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'NUMBER OF GRADUATES',
                            align: 'middle'
                        },
                        labels: {
                            overflow: 'justify'
                        }
                    },
                    plotOptions: {
                        bar: {
                            dataLabels: {
                                enabled: true
                            }
                        }
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'top',
                        x: -40,
                        y: 80,
                        floating: true,
                        borderWidth: 1,
                        backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
                        shadow: true
                    },
                    credits: {
                        enabled: false
                    },
                    series: info.dataPoints
                });
             
              /*/  Highcharts.chart('container', {
                chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'College of Science Graduates Batch ' + info.batch
                    },
                    xAxis: {
                        categories: ['BSIT', 'BSCS'],
                        title: {
                            text: 'COURSES IN YOUR COLLEGE'
                        }
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'NUMBER OF GRADUATES',
                            align: 'middle'
                        },
                        labels: {
                            overflow: 'justify'
                        }
                    },
                    tooltip: {
                        valueSuffix: ' graduates'
                    },
                    plotOptions: {
                        bar: {
                            dataLabels: {
                                enabled: true
                            }
                        }
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'top',
                        x: -40,
                        y: 80,
                        floating: true,
                        borderWidth: 1,
                        backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
                        shadow: true
                    },
                    credits: {
                        enabled: false
                    },
                    series: info.data
                 });
              /*/
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