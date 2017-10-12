<?php

if(session_status() == PHP_SESSION_NONE)
	session_start();

//in case user goes here while he/she's still logged in...
if(isset($_SESSION['id'])) {
	//redirect back to homepage
	header("Location: administrators.php");
	exit;
}

$error_msg = "";

if(isset($_SESSION['error_msg'])) {
	$error_msg = '<label class="show_error">'.$_SESSION['error_msg'].'</label>';
	unset($_SESSION['error_msg']);
}

session_unset();
session_destroy();

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Administartor Login</title>
		<link rel="stylesheet" type="text/css" href="../css/login.css" />
	</head>
	<body>
		<form id="login" action="backend/validate.php" method="POST">
			<img id="logo" src="../img/logo.gif" />
			<label for="username">Username</label>
			<input type="text" onkeyup="enableLogin()" id="username" name="username" />
			<label for="username">Password</label>
			<input type="password" onkeyup="enableLogin()" id="password" name="password" />
			<hr>
			<div id="error"><?php echo $error_msg; ?></div>
			<!-- There is a problem with button of type = submit -->
			<button type="submit" id="submit" disabled>Log in</button>
		</form>
		<script type="text/javascript" src="../js/login.js"></script>
	</body>
</html>