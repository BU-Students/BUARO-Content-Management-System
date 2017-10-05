<?php

if(session_status() == PHP_SESSION_NONE)
	session_start();

//if user attemps to access this page without authentication
if(!isset($_SESSION['id'])) {
	$_SESSION['error_msg'] = "Please log in first to continue";
	header("Location: login.php");
	exit;
}




if ($_SERVER ["REQUEST_METHOD"] == "POST" && isset($_POST["population"], $_POST['course_id'])) {
	require_once "backend/connection.php";
 	

	$sql = 'INSERT INTO graduates (grad_id, course_id, grad_year, grad_num) '.
				'VALUES ( '.
				'NULL, '.
				$_POST['course_id'] .', "'.
				date("Y").'", '.
				$_POST['population'].'
			)';

    if($conn->query($sql)) {
    	header('Location: '.$_SERVER['PHP_SELF']);
    }
    else echo $conn->error();

    $conn->close();
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>College Information</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../../vendor/Bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/sidebar.css" />
		<link rel="stylesheet" href="../css/topbar.css" />
		<link rel="stylesheet" href="../css/scrollbar.css" />
		<link rel="stylesheet" href="../css/post_stat.css" />
		<link rel="stylesheet" href="../css/unit_college.css" />
	</head>
	<body>
		<!-- topbar and sidebar here -->
		<?php
			require_once "topbar.php";
			require_once "sidebar.php";
		?>

		<div class="notif" id="notif-container">
			<div class="notif-img">
				<img id="notif-img" />
			</div>
			<div class="notif-content" id="notif-content"></div>
		</div>
		<div id="content-wrapper">
			
		<form method="POST">
         Population:<br>
          <input type="number" name="population"><br>
          <select name="course_id">
          <?php
	          require_once "backend/connection.php";

	          $sql = 'SELECT course_id, course.label AS label
	          FROM course, college, admin
	          WHERE course.college_id = college.college_id AND
	          admin.college = college.college_id AND
	          admin.admin_id = '.$_SESSION['id'];

	           if($result = $conn->query($sql)) {
	           	    while($row = $result->fetch_assoc()) {
	           	    	echo '<option value='.$row['course_id'].'>'.$row['label'].'</option>';
	           	    }

	           	    $result->free();
	           }
	           else echo $conn->error;

	           $conn->close();
          ?>
         </select>
                 
           <label> <input type="submit"> </label>
      </form>
      <div id="container"></div>
     </div>
		<script src="../../vendor/jQuery/jquery.min.js"></script>
		<script src="../../vendor/Bootstrap/js/bootstrap.min.js"></script>
		<script src="../js/sidebar.js"></script>
		<script src="../../vendor/Highcharts/highcharts.js"></script>
		<script src="../js/unit_college.js"></script>
	</body>
</html>