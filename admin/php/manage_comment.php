<?php


if(session_status() == PHP_SESSION_NONE)
    session_start();

//if user attemps to access this page without authentication
if(!isset($_SESSION['id'])) {
    $_SESSION['error_msg'] = "Please log in first to continue";
    header("Location: login.php");
    exit;
}

  require_once "topbar-eshop.php";



if(isset($_GET['comment_id'])){
     require_once "backend/connection.php";
    $sql1 = "DELETE FROM comments WHERE c_id = ".$_GET['comment_id']." ";
    $conn->query($sql1);
                if($conn->affected_rows == 1)
                    echo "";
                else
                    echo "";



}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Alumni Administator</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merriweather">
        <link rel="stylesheet" href="../css/sidebar.css" />
        <link rel="stylesheet" href="../css/topbar.css" />
        <link rel="stylesheet" href="../css/comment.css" />
        <link rel="stylesheet" href="../css/modal.css" />
        <link rel="stylesheet" href="../css/stories.css" />
        <link rel="stylesheet" href="../css/notif.css" />
    </head>

    <body>
<a href="eshop.php"><button style="margin-left: 50px">Go back</button> </a>
        <!-- topbar and sidebar here -->

        <?php

            require_once "backend/connection.php";



         $sql="SELECT c_id,mem_id,content, timestamp,nick FROM comments WHERE mem_id = ".$_GET['post_id']."   ";

        $conn->query($sql);

             $result = $conn->query($sql);
             if($row = $result->num_rows == 0 ){
                echo '<br><br><br><h1 align="center">No Comments Available</h1>';
             }
                else{

                while($row = $result->fetch_assoc()) {
                    echo '<div class="comment"> <table class="table table-border"><tr><td><b>Name: </b>              '.$row['nick'].'<br> </td><tr><td><b>Comment Content:</b> '.$row['content'].'</td></tr><br><td><b>Posted:</b> '.$row['timestamp'].' </td> </table>
                    ';
                    echo '<a href ="manage_comment.php?comment_id='.$row['c_id'].'&post_id='.$row['mem_id'].' "><button onclick="return(YNconfirm());"> DELETE </button></a><br>  </div>';

                }
}

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="../js/manage_comment.js"></script>
        <script src="../js/sidebar.js"></script>
        <script src="../js/notif.js"></script>


</body>
</html>