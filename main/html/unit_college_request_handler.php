<?php

require_once "../../admin/php/backend/connection.php";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
	$year = -1;
	$categories = "[";
	$sql = "SELECT grad_year, grad_num, course.label AS label ".
			"FROM graduates, college, course ".
			"WHERE graduates.course_id = course.course_id AND ".
				"course.college_id = college.college_id AND ".
				"college.label = '".$_POST['college']."' AND ".
				"grad_year = (SELECT grad_year FROM graduates ORDER BY grad_year DESC LIMIT 1) ".
				"ORDER BY grad_year DESC";

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
}

$conn->close();

?>