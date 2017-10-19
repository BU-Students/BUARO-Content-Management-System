<?php
	include_once('connection.php');
	$id = $_POST['id'];


	if (isset($_POST['sub'])) {
		$email = $_POST['email'];
		$email_database = 'SELECT email FROM comments WHERE email="'.$email.'"';
		$exec_email = mysqli_query($con, $email_database);
		$is_empty = mysqli_num_rows($exec_email);
		if ($is_empty < 1) {
			$insert = "INSERT INTO comments(`mem_id`, `nick`, `content`, `email`) VALUES ('".$id."','".$_POST['nickname']."','".$_POST['comm']."','".$email."')";
			mysqli_query($con, $insert);
		} else {
			$get_nick_from_existing_email = 'SELECT nick FROM comments WHERE email="'.$email.'" LIMIT 1';
			$exec_exist = mysqli_query($con, $get_nick_from_existing_email);
			$fetch_nick = mysqli_fetch_assoc($exec_exist);

			$insert = "INSERT INTO comments(`mem_id`, `nick`, `content`) VALUES ('".$id."','".$fetch_nick['nick']."','".$_POST['comm']."')";
			mysqli_query($con, $insert);
		}

	}
	echo "You are being automatically redirected. Click <a href='e-shop.php'>here</a> to manually redirect.";
	header("Location:e-shop.php");

?>