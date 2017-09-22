<?php
include 'connection.php';


if($_SERVER['REQUEST_METHOD'] == 'POST') {
	if($_POST['cur-stat']=="shown"){
			$sql = "UPDATE post SET status= 'hidden' WHERE post_id=".$_POST['id']."";
			$status = "btn btn-warning btn-s";
	}
	elseif($_POST['cur-stat']=="hidden"){
		$sql = "UPDATE post SET status= 'shown' WHERE post_id=".$_POST['id']."";
		$status = "btn btn-shown btn-s";
	}
	else
		$status="";

	if($conn->query($sql))
		echo $status;
	else echo $conn->error;
}
?>