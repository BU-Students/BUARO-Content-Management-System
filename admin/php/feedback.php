<?php

require_once "backend/connection.php";

if(session_status() == PHP_SESSION_NONE)
	session_start();
//if user attemps to access this page without authentication
if(!isset($_SESSION['id'])) {
	$_SESSION['error_msg'] = "Please log in first to continue";
	header("Location: login.php");
	exit;
}

if(isset($_POST['search']))
{
	$valueToSearch = $_POST['valueToSearch'];
	// search in all table columns
	// using concat mysql function
	$query = "SELECT * FROM feedback";
	$search_result = filterTable($query);
    
}
else {
	$query = "SELECT * FROM feedback";
	if(!($search_result = mysqli_query($conn, $query)))
		mysli_error($conn);
	$totalCount = $search_result->num_rows;
}

?>


<!DOCTYPE html>
<html>
	<head>
		<title>Alumni Administator</title>
		<link href="jqueryui/jquery-ui.css" rel="stylesheet">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../../vendor/Bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/sidebar.css" />
		<link rel="stylesheet" href="../css/topbar.css" />
		<link rel="stylesheet" href="../css/stories.css" />
		<link rel="stylesheet" href="../css/modal.css" />
		<link rel="stylesheet" href="../css/notif.css" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">  

	</head>

	<style>
		form { margin: 20px; }
		table {
			margin-bottom: 0px !important;
			border: 1px solid #ccc;
		}
		th, td { text-align: center; }
	</style>
	<body>
		<!-- topbar and sidebar here -->
		<?php
			require_once "topbar.php";
			require_once "sidebar.php";
		?>



		<!-- page content here -->
		<div id="content-wrapper">
<br>
				<!-- date range -->
				<div class="col-md-3">  
                     <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" />  
                </div>  
                <div class="col-md-3">  
                     <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" />  
                </div>  
                <div class="col-md-5">  
                     <input type="button" name="filter" id="filter" value="Filter" class="btn btn-info" />  
                     <button onclick="myFunction()" class="btn btn-primary">Refresh</button> 

                    <script>
						function myFunction() {
					    location.reload();
					}
					</script>
                </div>  
                <!-- date range -->               
         

			<form action="php_html_table_data_filter.php" method="post" id="feedback_table">
				<table class="table table-striped table-hover table-bordered">
					<caption>FEEDBACKS</caption>
					<thead>
						<tr>
							<th>Email</th>
							<th>Message</th>
							<th>Date and Time</th>
							<th>Delete Feedback</th>
						</tr>
					</thead>
					<tbody id="tbody">
						<!-- populate table from mysql database -->
					</tbody>
					
				</table>
			</form>
			<nav aria-label="Page navigation" style="text-align:center">
				<ul class="pagination" id="pagination">
				</ul>
			</nav>
		</div>

		<script src="../../vendor/jQuery/jquery-3.2.1.min.js"></script>
		<script src="../../vendor/Bootstrap/js/bootstrap.min.js"></script>
		<script src="../js/feedback.js"></script>
		<script src="../js/sidebar.js"></script>
		<script src="../js/notif.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script> 
	</body>
</html>

<!-- this is for the date range -->
 <script>  
      $(document).ready(function(){  
           $.datepicker.setDefaults({
                dateFormat: 'yy-mm-dd'
           });  
           $(function(){  
                $("#from_date").datepicker();  
                $("#to_date").datepicker();  
           });  
           $('#filter').click(function(){  
                var from_date = $('#from_date').val();  
                var to_date = $('#to_date').val();  
                if(from_date != '' && to_date != '')  
                {  
                     $.ajax({  
                          url:"filter.php",  
                          method:"POST",  
                          data:{from_date:from_date, to_date:to_date},  
                          success:function(data)  
                          {  
                               $('#feedback_table').html(data);  
                          }  
                     });  
                }
                else
                {  
                     alert("Please Select Date");  
                }  
           });  
      });  
 </script>
<!-- this is for the date range -->