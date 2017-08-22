<?php

/* TODO: Review security */

if(session_status() == PHP_SESSION_NONE)
	session_start();

//if user attemps to access this page without authentication
if(!isset($_SESSION['id'])) {
	$_SESSION['error_msg'] = "The link you're trying to visit is off-limits";
	header("Location: ../login.php");
	exit;
}

if(session_status() == PHP_SESSION_NONE)
	session_start();

require_once "connection.php";
require_once "input_handler.php";

define("SUCCESS", true);
define("FAILURE", true);

if($_SERVER["REQUEST_METHOD"] == "POST") {
	if(isset($_POST["request-type"])) {
		//see request codes.txt for the list of request types
		switch($_POST["request-type"]) {
			case "A-0":
				$_POST['title'] = encode($_POST['title']);
				$_POST['content'] = encode($_POST['content']);

				$sql = "INSERT INTO post (admin_id, post_type, title, content) VALUES (".$_SESSION['id'].", ".$_POST['content-type'].", '".$_POST['title']."', '".$_POST['content']."');";
				$conn->query($sql);

				echo (!$conn->error)? SUCCESS : FAILURE;
				break;

			case "B-0":
				require_once "../../../parsedown-master/Parsedown.php";
				$parser = new Parsedown();

				$sql = "SELECT post_id, post_type, title, content, timestamp FROM post WHERE admin_id = ".$_SESSION['id'].";";
				$result = $conn->query($sql);

				foreach($result as $row) {
					echo('
						<div class="story" onclick="toggleContent(\'story-content-'.$row['post_id'].'\')">
							<input type="password" class="story-id" id="'.$row['post_id'].'" />
							<div class="story-header">
								<div class="story-options-container">
									<span class="glyphicon glyphicon-pencil" data-toggle="tooltip" title="Edit"></span>
									<span class="glyphicon glyphicon-trash" data-toggle="tooltip" title="Delete"></span>
								</div>
								<div class="story-title">'.$row['title'].'</div>
								<div class="story-date">'.date('F d, Y | g:i A', strtotime(str_replace('-', '/', $row['timestamp']))).'</div>
							</div><hr>
							<div class="story-content hide-content" id="story-content-'.$row['post_id'].'">'
								.$parser->text(decode($row['content'])).
							'</div>
						</div>
					');
				}
				break;
		}
	}
	else echo "Unknown request";
}
else if($_SERVER["REQUEST_METHOD"] == "GET") {

}
else {
	$conn->close();
	header("Location: login.php");
	exit;
}

$conn->close();

?>