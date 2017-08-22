<?php

if(session_status() == PHP_SESSION_NONE)
	session_start();

$server_name = "localhost";
$username = "root";
$password = "";
$db_name = "buaro";

//attemp to establish database connection
$conn = new mysqli($server_name, $username, $password, $db_name);

//check connection
if($conn->connect_error) {
	$_SESSION['error_msg'] = "Database connection failed";
	header("Location: login.php");
	exit;
}

//please close connection after use. Thank you.

?>