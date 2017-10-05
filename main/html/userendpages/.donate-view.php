<?php
	include '../connection.php';
	include '../../../vendor/Parsedown/Parsedown.php';
	include '../../../admin/php/backend/input_handler.php';

	$id = $_GET['id'];
	$query = "SELECT * FROM post WHERE post_id=$id";
	$run = mysqli_query($con,$query);

	$fetch = mysqli_fetch_array($run);

	$parse = new Parsedown();
	echo '{ "title": "'.$fetch['title'].'", "content": "'.$parse->text(decode($fetch['content'])).'" }';
?>