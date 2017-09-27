<?php
		include 'connection.php';
		$id = $_POST['id'];
		if($_POST['content-type']==2){
			if(isset($_FILES['img-banner']['tmp_name'])){
				$imgbannername = rand(903,3484798);
				$imgbannerpath = "../../data/events-stories/".$imgbannername;
				move_uploaded_file($_FILES['img-banner']['tmp_name'],'../../../data/events-stories/'.$imgbannername);
				unlink("../".$_POST['curr-banner']);
				$sql = "UPDATE post SET title = '".$_POST['post-title']."', post_type = ".$_POST['content-type'].", content = '".$_POST['content2']."', eventdate = '".$_POST['event-date']."', imgbanner = '".$imgbannerpath."' WHERE post_id = ".$id;
			}
			else
				$sql = "UPDATE post SET title = '".$_POST['post-title']."', post_type = ".$_POST['content-type'].", content = '".$_POST['content2']."', eventdate = '".$_POST['event-date']."' WHERE post_id = ".$id;
		}
		else{
			if(isset($_FILES['img-banner']['tmp_name'])){
				$imgbannername = rand(903,3484798);
				$imgbannerpath = "../../data/events-stories/".$imgbannername;
				move_uploaded_file($_FILES['img-banner']['tmp_name'],'../../../data/events-stories/'.$imgbannername);
				unlink("../".$_POST['curr-banner']);
				$sql = "UPDATE post SET title = '".$_POST['post-title']."', post_type = ".$_POST['content-type'].", content = '".$_POST['content2']."', imgbanner = '".$imgbannerpath."' WHERE post_id = ".$id;
			}
			else
				$sql = "UPDATE post SET title = '".$_POST['post-title']."', post_type = ".$_POST['content-type'].", content = '".$_POST['content2']."' WHERE post_id = ".$id;
		}

		$conn->query($sql);
		echo $_POST['curr-banner'];
		header("Location:../eventstory.php");
?>