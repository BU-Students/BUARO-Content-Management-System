<?php

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
    $query = "SELECT * FROM `feedback`";
    $search_result = filterTable($query);
}

// function to connect and execute the query
function filterTable($query)
{
    $connect = mysqli_connect("localhost", "root", "", "buaro");
    $filter_Result = mysqli_query($connect, $query);
    return $filter_Result;
}




?>



<!DOCTYPE html>
<html>
	<head>
		<title>Alumni Administator</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merriweather">
		<link rel="stylesheet" href="../css/sidebar.css" />
		<link rel="stylesheet" href="../css/topbar.css" />
		<link rel="stylesheet" href="../css/stories.css" />
		<link rel="stylesheet" href="../css/modal.css" />
		<link rel="stylesheet" href="../css/notif.css" />

		<!-- table css -->
		 <style> 
           table {
			    width:90%;
			    margin-left: 15px;
			}
			table, th, td {
			    border: 1px solid black;
			    border-collapse: collapse;
			}
			th, td {
			    padding: 5px;
			    text-align: left;
			}
			table#t01 tr:nth-child(even) {
			    background-color: #eee;
			}
			table#t01 tr:nth-child(odd) {
			   background-color:#fff;
			}
			table#t01 th {
			    background-color: black;
			    color: white;
			}
        </style>
	</head>
	<body>
		<!-- topbar and sidebar here -->
		<?php
			require_once "topbar.php";
			require_once "sidebar.php";

		?>

		<!-- page content here -->
		<div id="content-wrapper">
			<form action="php_html_table_data_filter.php" method="post">
            
            <br>
            <table id="t01">
                <tr>
                  
                    <th><center>Email</center></th>
                    <th><center>Message</center></th>
                    <th><center>Delete Feedback</center></th>

                    

                   
                </tr>
      <!-- populate table from mysql database -->
                <?php 
                while($row = mysqli_fetch_array($search_result)):
                ?>
                
                <tr> 
                    <td><?php echo $row['email'];?></td>
                    <td><?php echo $row['message'];?></td>
                    <td><a onclick="return confirm('are you sure?')" href="feedback.php?feedback_id=<?php echo $row ['feedback_id']?>"><center>Delete</center></a></td>
                </tr>
                <?php endwhile;?>


                <?php
                $connect = mysqli_connect("localhost", "root", "", "buaro");
                	if (isset($_GET['feedback_id'])){

                		$feedback_id = $_GET['feedback_id'];
                		$result = "DELETE FROM feedback WHERE feedback_id='$feedback_id'";
                		if ($connect->query($result)){
                		?>
                		<script>
                			alert ("success to delete data ");
                			window.location.href='feedback.php';
                		 </script>
                		 <?php
                			
                		}else {
                		?> 
                		<script>
                			alert ("fail to delete data ");
                			window.location.href='feedback.php';
                		 </script>
                		 <?php                		
                		}
                	}

                 ?>
            </table>
        </form>
        
			
		</div>

	
		

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="../js/feedback.js"></script>
		<script src="../js/sidebar.js"></script>
		<script src="../js/notif.js"></script>
	</body>
</html>
