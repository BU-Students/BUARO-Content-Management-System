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

require_once "connection.php";
require_once "input_handler.php";
require_once "cipher.php";

//macro for defining the parent admin based on `admin_type_id` value in the `admin_type` table
define("PARENT_ADMIN", 1);

if($_SERVER["REQUEST_METHOD"] == "POST") {
	if(isset($_POST["request-type"])) {
		//see request codes.txt for the list of request types
		switch($_POST["request-type"]) {
			case "A-0":
				$_POST['title'] = encode($_POST['title']);
				$_POST['content'] = encode($_POST['content']);

				//if there's a story-id parameter (meaning that the story is existing), update the story
				if(isset($_POST['story-id'])) {
					$sql = "UPDATE post SET title = '".$_POST['title']."', post_type = ".$_POST['content-type'].", content = '".$_POST['content']."' WHERE post_id = ".$_POST['story-id'];
				}
				//else, insert the new story
				else {
					$sql = "INSERT INTO post (admin_id, post_type, title, content) VALUES (".$_SESSION['id'].", ".$_POST['content-type'].", '".$_POST['title']."', '".$_POST['content']."');";
				}

				$conn->query($sql);

				if(!$conn->error) echo "success";
				else echo "fail";

				break;

			case "A-1":
				$sql = "SELECT title, content, post_type FROM post WHERE post_id = '".$_POST['story-id']."';";

				if($result = $conn->query($sql)) {
					$row = $result->fetch_assoc();
					//using JSON for parsing on client side
					echo '{ '.
							'"title": "'.decode($row['title']).'", '.
							'"post_type": '.$row['post_type'].', '.
							'"content": "'.decode($row['content']).'" '.
						' }';

					$result->free();
				}
				else echo "fail";

				break;

			case "B-0":
				require_once "../../../vendor/Parsedown/Parsedown.php";
				$parser = new Parsedown();

				$sql = "SELECT post_id, title, content, timestamp ".
						"FROM post
						WHERE ".
							"post.post_type = (SELECT post_type_id FROM post_type WHERE label = 'DONATION_LINK') ".
							"ORDER BY timestamp DESC";

				$result = $conn->query($sql);

				while($row = $result->fetch_assoc()) {
					echo('
						<div class="story" id="story-id-'.$row['post_id'].'" onclick="expandStory(this)">
							<input type="hidden" value="'.$row['post_id'].'" /> <!-- reference for story deletion in the database; i.e. database ID -->
							<input type="hidden" /> <!-- used to store their DOM index as reference for removeChild() -->
							<div class="story-header">
								<div class="story-options-container">
									<span class="glyphicon glyphicon-resize-full" data-toggle="tooltip" title="Expand"></span>
								</div>
								<div class="story-title">'.$row['title'].'</div>
								<div class="story-date">'.date('F d, Y | g:i A', strtotime(str_replace('-', '/', $row['timestamp']))).'</div>
							</div>
							<hr>
							<div class="story-content">'
								.$parser->text(decode($row['content'])).
							'</div>
						</div>
					');
				}

				$result->free();
				break;

			case "B-1":
				$sql = "DELETE FROM post WHERE post_id = ".$_POST['story-id'].";";
				$conn->query($sql);
				if($conn->affected_rows == 1)
					echo "success";
				else 
					echo "failed";
				break;

			case "C-0":
				$user_id;
				if(isset($_POST['user-id']))
					$user_id = $_POST['user-id'];
				else $user_id = $_SESSION['id'];

				if($_SESSION['admin-type'] == PARENT_ADMIN) {
					$sql = "SELECT ".
								"first_name, middle_name, last_name, username, sex, bdate, TIMESTAMPDIFF(YEAR, bdate, CURDATE()) AS age, contact_no, barangay, ".
								"municipality, province, profile_img, cover_photo, email, COUNT(post_id) AS post_count, SUM(view_count) AS view_count ".
							"FROM ".
								"address, admin, post ".
							"WHERE ".
								"address.address_id = admin.address AND ".
								"post.admin_id = admin.admin_id AND ".
								"admin.admin_id = ".$user_id;
				}
				else {
					$sql = "SELECT ".
								"first_name, middle_name, last_name, username, sex, bdate, TIMESTAMPDIFF(YEAR, bdate, CURDATE()) AS age, contact_no, barangay, ".
								"municipality, province, profile_img, cover_photo, email, COUNT(post_id) AS post_count, SUM(view_count) AS view_count, college.label ".
							"FROM ".
								"address, admin, post, college ".
							"WHERE ".
								"address.address_id = admin.address AND ".
								"post.admin_id = admin.admin_id AND ".
								"admin.college = college.college_id AND ".
								"admin.admin_id = ".$user_id;
				}

				if(($result = $conn->query($sql)) && $result->num_rows == 1) {
					$row = $result->fetch_assoc();

					//since MySQL weirdly returns a row with NULL values when trying to failing to find the requested ID instead of returning a boolean (false)
					if($row['first_name'] != NULL) {
						$row['sex'] = ($row['sex'] == 0)? "Male" : "Female";
						if(empty($row['post_count'])) $row['post_count'] = 0;
						if(empty($row['view_count'])) $row['view_count'] = 0;
						if(!isset($row['label'])) $row['label'] = "";
						$formatted_bdate = date('F d, Y', strtotime(str_replace('-', '/', $row['bdate'])));
						echo
						'{
							"sex": "'.$row['sex'].'",
							"age": '.$row['age'].',
							"email": "'.$row['email'].'",
							"raw_bdate": "'.$row['bdate'].'",
							"formatted_bdate": "'.$formatted_bdate.'",
							"f_name": "'.$row['first_name'].'",
							"m_name": "'.$row['middle_name'].'",
							"l_name": "'.$row['last_name'].'",
							"barangay": "'.$row['barangay'].'",
							"municipality": "'.$row['municipality'].'",
							"province": "'.$row['province'].'",
							"college": "'.$row['label'].'",
							"username": "'.$row['username'].'",
							"post_count": '.$row['post_count'].',
							"view_count": '.$row['view_count'].',
							"contact_no": "'.$row['contact_no'].'",
							"profile_img": "'.$row['profile_img'].'",
							"cover_photo": "'.$row['cover_photo'].'"
						}';
					}

					$result->free();
				}
				else echo $conn->error;
				break;

			case "C-1":
				$query_1 = "";
				$query_2 = "";

				if(isset($_POST['b-date'])) {
					$query_1 .= "bdate = '".$_POST['b-date']."'";
					if(isset($_POST['contact-no']) || isset($_POST['email'])) $query_1 .= ", ";
				}
				if(isset($_POST['contact-no'])) {
					$query_1 .= "contact_no = ".(($_POST['contact-no'] == "")? "NULL" : "'".$_POST['contact-no']."'");
					if(isset($_POST['email'])) $query_1 .= ", ";
				}
				if(isset($_POST['email'])) {
					$query_1 .= "email = ".(($_POST['email'] == "")? "NULL" : "'".$_POST['email']."'");
				}

				if(isset($_POST['barangay'])) {
					$query_2 .= "barangay = '".$_POST['barangay']."'";
					if(isset($_POST['municipality']) || isset($_POST['province'])) $query_2 .= ", ";
				}
				if(isset($_POST['municipality'])) {
					$query_2 .= "municipality = '".$_POST['municipality']."'";
					if(isset($_POST['province'])) $query_2 .= ", ";
				}
				if(isset($_POST['province'])) $query_2 .= "province = '".$_POST['province']."'";

				$query_1 = "UPDATE admin SET ".$query_1;
				if($query_1 == "UPDATE admin SET ") $query_1 = "";
				else {
					$query_1 .= " WHERE admin_id = ".$_SESSION['id'].";";
					$conn->query($query_1);
					if($conn->affected_rows == -1) echo $conn->error;
				}

				$query_2 = "UPDATE address SET ".$query_2;
				if($query_2 == "UPDATE address SET ") $query_2 = "";
				else {
					$query_2 .= " WHERE address_id = (SELECT address FROM admin WHERE admin_id = ".$_SESSION['id'].");";
					$conn->query($query_2);
					if($conn->affected_rows == -1) echo $conn->error;
				}

				break;

			case "D-0":
				$sql =
					"SELECT title, view_count, unique_visitors, timestamp ".
					"FROM post ".
					"WHERE post_id = ".$_POST['post-id'];
				if($result = $conn->query($sql)) {
					$row = $result->fetch_assoc();
					echo
					'{
						"title": "'.$row['title'].'",
						"view_count": '.$row['view_count'].',
						"timestamp": "'.$row['timestamp'].'",
						"unique_visitors": '.$row['unique_visitors'].'
					}';

					$result->free();
				}
				else echo $conn->error;
				break;
			case "D-1":
				$sql =
					"SELECT post_id, title, view_count, unique_visitors, timestamp ".
					"FROM post ".
					"WHERE post.post_type = (".
						"SELECT post_type FROM post WHERE post_id = ".$_POST['post-id'].
					")";

				if($result = $conn->query($sql)) {
					$allPostData = '{ "post": [ ';

					while($row = $result->fetch_assoc()) {
						if($row['post_id'] == $_POST['post-id'])
							$row['title'] = '<span style=\"color: blue;\">'.$row['title'].'</span>';

						$allPostData .=
						'{'.
							'"title": "'.$row['title'].'", '.
							'"view_count": '.$row['view_count'].', '.
							'"unique_visitors": '.$row['unique_visitors'].', '.
							'"timestamp": "'.$row['timestamp'].'"'.
						'}, ';
					}
					$allPostData = substr($allPostData, 0, strlen($allPostData) - 2);
					$allPostData .= " ]}";
					echo $allPostData;

					$result->free();
				}
				else echo $conn->error;
				break;

			case "E-0":
				if($_SESSION['admin-type'] == PARENT_ADMIN) {
					$sql = "SELECT ".
								"first_name, middle_name, last_name, username, LENGTH(password) AS passLen, ".
								"profile_img, COUNT(post_id) AS post_count, SUM(view_count) AS view_count ".
							"FROM ".
								"address, admin, post ".
							"WHERE ".
								"address.address_id = admin.address AND ".
								"post.admin_id = admin.admin_id AND ".
								"admin.admin_id = ".$_SESSION['id'];
				}
				else {
					$sql = "SELECT ".
								"first_name, middle_name, last_name, username, LENGTH(password) AS passLen, ".
								"profile_img, COUNT(post_id) AS post_count, SUM(view_count) AS view_count, label ".
							"FROM ".
								"address, admin, post, college ".
							"WHERE ".
								"address.address_id = admin.address AND ".
								"post.admin_id = admin.admin_id AND ".
								"college.college_id = admin.college AND ".
								"admin.admin_id = ".$_SESSION['id'];
				}

				if(($result = $conn->query($sql)) && ($result->num_rows == 1)) {
					$row = $result->fetch_assoc();
					if(empty($row['post_count'])) $row['post_count'] = 0;
					if(empty($row['view_count'])) $row['view_count'] = 0;
					if(!isset($row['college'])) $row['college'] = "";
					if(!isset($row['label'])) $row['label'] = "";
					echo
					'{
						"f_name": "'.$row['first_name'].'",
						"m_name": "'.$row['middle_name'].'",
						"l_name": "'.$row['last_name'].'",
						"college": "'.$row['label'].'",
						"passLen": '.$row['passLen'].',
						"username": "'.$row['username'].'",
						"post_count": '.$row['post_count'].',
						"view_count": '.$row['view_count'].',
						"profile_img": "'.$row['profile_img'].'"
					}';

					$result->free();
				}
				else echo $conn->error;
				break;

			case "E-1":
				$sql = "SELECT admin_id FROM admin WHERE password = '".encrypt(encode($_POST['password']))."' AND admin_id = ".$_SESSION['id'];
				if($result = $conn->query($sql)) {
					if($result->num_rows == 1) {
						$sql = "UPDATE admin SET ".(($_POST['to-change'] == "username")? "username" : "password").
							" = '".encrypt(encode($_POST['value']))."' WHERE admin_id = ".$_SESSION['id'];
						if($conn->query($sql))
							echo "success";
						else echo $conn->error;
					}
					else echo "wrong password";
					$result->free();
				}
				else echo $conn->error;

				break;

			case "F-0":
				$constraint = "";

				$sql =
					"SELECT ".
						"admin_id, ".
						"first_name, ".
						"middle_name, ".
						"last_name, ".
						"college.label, ".
						"sex, ".
						"bdate, ".
						"profile_img, ".
						"state, ".
						"TIMESTAMPDIFF(YEAR, bdate, CURDATE()) AS age ".
					"FROM admin, address, college ".
					"WHERE ".
						"admin.address = address.address_id AND ".
						"college.college_id = admin.college";

				$result = $conn->query($sql);

				if($result && $result->num_rows > 0) {
					$resultObj = array();
					while($row = $result->fetch_assoc()) {
						array_push($resultObj, $row);
					}
					echo json_encode($resultObj);
					$result->free();
				}
				else echo $conn->error;

				break;
			case "F-1":
				$sql = "UPDATE admin SET state = ".$_POST['new-state']." WHERE admin_id IN (";
				$counter = $_POST['id-count'];
				for($i = 0; $i < $counter; ++$i) {
					$sql .= $_POST['id_'.$i].", ";
				}
				$sql = substr($sql, 0, -2);
				$sql .= ")";

				if($conn->query($sql)) {
					$sql =
						"SELECT ".
							"admin_id, ".
							"first_name, ".
							"middle_name, ".
							"last_name, ".
							"college.label, ".
							"sex, ".
							"bdate, ".
							"profile_img, ".
							"state, ".
							"TIMESTAMPDIFF(YEAR, bdate, CURDATE()) AS age ".
						"FROM admin, address, college ".
						"WHERE ".
							"admin.address = address.address_id AND ".
							"college.college_id = admin.college";

					if($result = $conn->query($sql)) {
						$resultObj = array();
						while($row = $result->fetch_assoc()) {
							array_push($resultObj, $row);
						}
						echo json_encode($resultObj);
						$result->free();
					}
					else echo $conn->error;
				}
				else echo $conn->error;

				break;

			case "G-0":
				if($_SESSION['admin-type'] == PARENT_ADMIN)
					$sql = "SELECT post_id, title, content, timestamp ".
						"FROM post ".
						"WHERE post.admin_id = ".$_SESSION['id']." AND post.post_type = (SELECT post_type_id FROM post_type WHERE label = '".$_POST['post-label']."')";

				if($result = $conn->query($sql)) {
					$row = $result->fetch_assoc();
					echo decode($row['content']);
					$result->free();
				}
				else echo $conn->error();

				break;

			case "G-1":
				$sql = "UPDATE post SET content = '".encode($_POST['content']).
					"' WHERE post_type = (SELECT post_type_id FROM post_type WHERE label = '".$_POST['post-label']."')";
				$conn->query($sql);
				if($conn->affected_rows != 1)
					echo $conn->error();
				break;

			case "H-0":
				define("COLLEGE_ADMIN", 2);

				require_once "../../../vendor/Parsedown/Parsedown.php";
				$parser = new Parsedown();

				if($_SESSION['admin-type'] == COLLEGE_ADMIN)
					$sql = "SELECT label,mem_id, description, img_path FROM memorabilia
							WHERE admin_id = ".$_SESSION['id']." ";
				else if($_SESSION['admin-type'] == PARENT_ADMIN)
					$sql = "SELECT label,mem_id, description, img_path FROM memorabilia";

				$sql .= " ORDER BY mem_id DESC";

				$result = $conn->query($sql);

				while($row = $result->fetch_assoc()) {
					echo('
					<div class="top-story">
						<div class="story" id="story-id-'.$row['mem_id'].'" onclick="expandStory(this)">
							<input type="hidden" value="'.$row['mem_id'].'" /> <!-- reference for story deletion in the database; i.e. database ID -->
							<input type="hidden" /> <!-- used to store their DOM index as reference for removeChild() -->
							<div class="story-header">
								<div class="story-options-container">
									<span class="glyphicon glyphicon-resize-full" data-toggle="tooltip" title="Expand"></span>
								</div>
								<div class="story-title"><img src="'.$row['img_path'].'" height="180px"></div>

							</div>
							<hr>
							<div class="story-title">'
								.$parser->text(decode($row['label'])).
							'</div>
						</div>
					</div>
					');
				}

				$result->free();
				break;

			case "H-1":
				$_POST['title'] = encode($_POST['title']);
				$_POST['content'] = encode($_POST['content']);

				//if there's a story-id parameter (meaning that the story is existing), update the story
				if(isset($_POST['story-id'])) {
					$sql = "UPDATE memorabilia SET label = '".$_POST['title']."',  description = '".$_POST['content']."' WHERE mem_id = ".$_POST['story-id'];
				}
				//else, insert the new story
				else {
					$img =  $_POST['img_path'];
					$imga = $img."";
					$imga = str_replace("C:fakepath","",$imga);
					$sql = "INSERT INTO memorabilia (admin_id,  label, description,img_path) VALUES (".$_SESSION['id'].", '".$_POST['title']."', '".$_POST['content']."', '".
						"../../data/e-shop/".$imga."');";
				}

				$conn->query($sql);

				if(!$conn->error) echo "success";
				else echo "fail";
				break;

			case "H-2":
				$sql = "DELETE FROM memorabilia WHERE mem_id = ".$_POST['story-id'].";";
				$conn->query($sql);
				if($conn->affected_rows == 1)
					echo "success";
				else
					echo "failed";
				break;

			case "H-3":
				$sql = "SELECT mem_id,label, description, img_path FROM memorabilia WHERE mem_id = '".$_POST['story-id']."';";

				if($result = $conn->query($sql)) {
					$row = $result->fetch_assoc();
					//using JSON for parsing on client side
					echo
					'{ '.
							'"title": "'.decode($row['label']).'", '.
							'"img_path": "'.decode($row['img_path']).'", '.
							'"content": "'.decode($row['description']).'" '.
					'}';

					$result->free();
				}
				else echo "fail";
				break;

				case "I-0":
					if($_SESSION['admin-type'] != 1) {
						$sql = "SELECT grad_year, grad_num, course.label AS label ".
							"FROM graduates, college, admin, course ".
							"WHERE college.college_id = admin.college AND ".
								"graduates.course_id = course.course_id AND ".
								"course.college_id = college.college_id AND ".
								"admin_id = ".$_SESSION['id']." AND grad_year = (SELECT grad_year FROM graduates ORDER BY grad_year DESC LIMIT 1) ".
								"ORDER BY grad_year DESC";
					}
					else {
						$sql = "";
					}
					$year;
					$categories = "[";

					if($result = $conn->query($sql)) {
						$str = '{"dataPoints": [{ "data": [ ';
						while($row = $result->fetch_assoc()) {
							$year = $row['grad_year'];
							$categories .='"'.$row['label'].'",';
							$str .= ' { "name": "'.$row['label'].'", "y": '.$row['grad_num'].', "color": "#ff0000"},';
						}

					   $str = substr($str, 0, -1);
					   $categories = substr($categories, 0, -1).' ]';
					   $str .= '] }], "batch": '.$year.', "categories": '.$categories.' }';
					   echo $str;
					   $result->free();
					}
					else echo $conn->error;
					break;

				case "J-0":
					$sql = "DELETE FROM feedback WHERE feedback_id = ".$_POST['feedback-id'].";";
					$conn->query($sql);
					if($conn->affected_rows != 1)
						echo $conn->error();
					break;

				case "J-1":
					$count = $conn->query("SELECT COUNT(feedback_id) FROM feedback")->fetch_array()[0];
					$sql = "SELECT * FROM feedback ORDER BY feedback_id asc LIMIT ".$_POST['limit']." OFFSET ".$_POST['offset'] ;
					$json = '{ "total_rows": '.$count.', "table_content": "';
					if(!($result = $conn->query($sql)))
						echo $conn->error;
					else {
						while($row = $result->fetch_assoc()) {
							if($row['feedemail'] == "") $row['feedemail'] = '<span style=\"color: #ccc\">Anonymous</span>';
							$json .=
							'<tr>'.
								'<td>'.$row['feedemail'].'</td>'.
								'<td>'.$row['feedmessage'].'</td>'.
								'<td>'.$row['timestamp'].'</td>'.

								'<td><a onclick=\"attemptDelete(this, '.$row['feedback_id'].')\" href=\"javascript:void(0)\">Delete</a></td>'.
							'</tr>';
						}
					}
					$json .= '" }';
					echo $json;
					break;

				case "K-0":
					$sql = 'UPDATE admin, admin_activity '.
						'SET last_active = CURRENT_TIMESTAMP() '.
						'WHERE admin_activity.admin_id = admin.admin_id AND '.
						'admin.admin_id = '.$_SESSION['id'];
					if(!$conn->query($sql))
						echo $conn->error;
					break;

				default:
					echo "Invalid request type";
		}
	}
	else echo "Informal request";

	unset($_POST);
}
else if($_SERVER["REQUEST_METHOD"] == "GET") {
	switch($_GET['request-type']) {
		case "F-2":
			$sql =
				"SELECT ".
					"admin.admin_id, ".
					"first_name, ".
					"last_name, ".
					"last_login ".
				"FROM admin, admin_activity ".
				"WHERE ".
				"admin.admin_id = admin_activity.admin_id AND ".
				"admin.admin_id != ".$_SESSION['id']." AND ".
				"TIMESTAMPDIFF(MINUTE, last_active, CURRENT_TIMESTAMP()) <= 1";

			if($result = $conn->query($sql)) {
				$users = array();
				while($row = $result->fetch_assoc()) {
					array_push($users, array(
						'id' => $row['admin_id'],
						'f_name' => $row['first_name'],
						'l_name' => $row['last_name'],
						'login_time' => date("h:i A", strtotime($row['last_login']))
					));
				}
				echo json_encode($users);
				$result->free();
			}
			else echo $conn->error;
			break;
	}
}
else {
	$conn->close();
	header("Location: login.php");
	exit;
}

$conn->close();
?>