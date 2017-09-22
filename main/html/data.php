<?php
	include_once('connection.php');
	$id = $_POST['id'];


	if (isset($_POST['sub'])) {
		$insert = "INSERT INTO comments(`mem_id`, `nick`, `content`) VALUES ('".$id."','".$_POST['nickname']."','".$_POST['comm']."')";
		$exec = mysqli_query($con, $insert);

	}
	header("Location:comment.php?id=".$id);

?>