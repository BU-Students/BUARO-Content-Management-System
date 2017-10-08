<?php

if(session_status() == PHP_SESSION_NONE)
	session_start();

require_once "input_handler.php";
require_once "connection.php";
require_once "cipher.php";

$username = encode($_POST['username']);
$password = encode($_POST['password']);

$encrypted_password = encrypt($password);
$query = "SELECT admin_id, admin_type, state FROM admin WHERE username = '$username' AND password = '$encrypted_password';";
$result = $conn->query($query);

// close database connection
$conn->close();

if($result->num_rows < 1) {
	$_SESSION['error_msg'] = "Invalid username or password";
	header("Location: ../login.php");
	exit;
}
else if($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	if($row['state'] == 0) {
		$_SESSION['error_msg'] = "The account is currently inactive";
		header("Location: ../login.php");
		exit;
	}

	$_SESSION['id'] = $row["admin_id"];
	$_SESSION['admin-type'] = $row["admin_type"];
	$_SESSION['college'] = $row["college"];
	if($_SESSION['admin-type'] == 1)
		header("Location: ../administrators.php");
	else
		header("Location: ../eventstory.php");
	exit;
}

?>