<?php

if(session_status() == PHP_SESSION_NONE)
	session_start();

require_once "input_handler.php";
require_once "connection.php";

$username = encode($_POST['username']);
$password = encode($_POST['password']);

//query to retrieve username and password
$query = "SELECT admin_id FROM admin WHERE username = '$username' AND password = '$password';";
$result = $conn->query($query);

//close database connection
$conn->close();

if($result->num_rows < 1) {
	$_SESSION['error_msg'] = "Invalid username or password";
	header("Location: ../login.php");
	exit;
}
else if($result->num_rows == 1) {
	$row = $result->fetch_assoc();
	$_SESSION['id'] = $row["admin_id"];
	header("Location: ../admin.php");
	exit;
}//else there's something wrong with the database table

?>