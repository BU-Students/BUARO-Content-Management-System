<?php
function encode($string) {
	return htmlspecialchars(str_replace("\n", "<br/>", $string), ENT_HTML5 | ENT_QUOTES);
}
	session_start();

	include 'connection.php';

	$_POST['post-title'] = encode($_POST['post-title']);
	$_POST['content'] = encode($_POST['content']);

	$imgbanner = $_FILES['img-banner']['tmp_name'];
	$imgbannername = rand(903,34847);
	$imgbannerpath = "../../data/events-stories/".$imgbannername;
	if(empty($_FILES['img-banner']['tmp_name'])){
		$imgbannerpath = "";
	}
	else{
		move_uploaded_file($imgbanner,'../../../data/events-stories/'.$imgbannername);
	}
	
	//Algo for multi-image upload
	$foldername = rand(10000,90987)."".date("y-m-d");
	$path = "../../data/events-stories/".$foldername."/";
	$fullpath = "";
	mkdir("../".$path); //Creates a folder in the imgfolders
	foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name){
	    $temp = $_FILES["files"]["tmp_name"][$key];
	    $name = $_FILES["files"]["name"][$key];
	    $name = rand(0,23402387427)."".$name;
	    if(empty($temp))
	    {
	        break;
	    }
	    $imgspath = $path."".$name;
	    if($fullpath=="")
	    	$fullpath = ";".$imgspath;
	    else
	    	$fullpath = $fullpath.";".$imgspath;
	    move_uploaded_file($temp,"../".$path."".$name);
	    
	}

	$fullpath = substr($fullpath, 1); //Remove the extra ;
	if($fullpath==""){
		$fullpath="";
	}
	if($_POST['content-type']==2){
		$sql = "INSERT INTO post (admin_id, post_type, title, content, imgbanner, eventdate, imglinks) VALUES (".$_SESSION['id'].", ".$_POST['content-type'].", '".$_POST['post-title']."', '".$_POST['content']."', '".$imgbannerpath."', '".$_POST['event-date']."', '".$fullpath."');";
	}
	else
		$sql = "INSERT INTO post (admin_id, post_type, title, content, imgbanner, imglinks) VALUES (".$_SESSION['id'].", ".$_POST['content-type'].", '".$_POST['post-title']."', '".$_POST['content']."', '".$imgbannerpath."', '".$fullpath."');";
	$conn->query($sql);

	header("Location:../eventstory.php")
?>