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


$email = $_POST['email'];
$message = $_POST['message'];


$sql = "insert into feedback (email,message) values ('$email','$message')";

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