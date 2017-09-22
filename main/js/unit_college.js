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

var param = parseURLParams(window.location.href);

//check for GET request
if(param != undefined) {
    param = param.college[0];
    document.title = param;

    if(window.XMLHttpRequest) xhr = new XMLHttpRequest();
    else xhr = new ActiveXObject("Microsoft.XMLHTTP");

    if(xhr) {
        xhr.onreadystatechange = function() {
            if(xhr.readyState == 4 && xhr.status == 200) {
                try {
                    var info = JSON.parse(xhr.responseText);

                    if(info.batch == -1) {
                        window.location = "aro3.html";
                    }
                    else {
                        Highcharts.chart('container', {
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: param + ' Batch ' + info.batch
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
                    }
                }
                catch(e) {
                    window.location = "aro3.php";
                }
            }
            else {}
        };

        xhr.open("POST", "unit_college_request_handler.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("college=" + param);
    }
    else alert("Unable to communicate to the server. Try reloading the page.");
}
else window.location = "aro3.php";