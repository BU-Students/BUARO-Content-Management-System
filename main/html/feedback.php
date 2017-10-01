<?php




$con = mysqli_connect('localhost','root','');
if(!$con)
{
 echo 'Not Connected To Server';
}
if (!mysqli_select_db ($con,'buaro'))
{
 echo 'Database Not Selected';
}


$feedemail = $_POST['feedemail'];
$feedmessage = $_POST['feedmessage'];


$sql = "insert into feedback (feedemail,feedmessage) values ('$feedemail','$feedmessage')";

if (!mysqli_query($con,$sql))
{
 echo 'Not Inserted';
}

else
{
 echo 'Inserted Successfully';
}

header("refresh:2; url=.contact.php");


?>