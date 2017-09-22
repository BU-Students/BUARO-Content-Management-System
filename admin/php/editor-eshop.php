<?php

if(session_status() == PHP_SESSION_NONE)
    session_start();

//if user attemps to access this page without fist logging in
if(!isset($_SESSION['id'])) {
    $_SESSION['error_msg'] = "Please log in first to continue";
    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Markdown Editor</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="../../sparksuite-simplemde-markdown-editor-6abda7a/dist/simplemde.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merriweather">

        <link rel="stylesheet" href="../css/topbar.css" />
        <link rel="stylesheet" href="../css/sidebar.css" />
        <link rel="stylesheet" href="../css/editor.css" />
        <link rel="stylesheet" href="../css/notif.css" />
    </head>
    <body>
        <?php
            require_once "topbar-eshop.php";
            require_once "sidebar.php";
        ?>
        <div id="content-wrapper">
            <form method="post" id="editor-form" enctype="multipart/form-data">
                <input type="hidden" id="existing-story-id" value="-1" />
                <input id="title" type="text" name="title" placeholder="Title goes here" /><hr>
                <div class="container-fluid" id="content-type">



                </div>
                <hr>





<div class="container">
            <div class="page-header">

            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                   <!-- <form method="post" enctype="multipart/form-data" name="formUploadFile" id="uploadForm" action="upload.php"> -->
                        <div class="form-group">

                            <?php if(isset($_GET['post_id']))
                                echo '<img src="" id="img_path" height="210px">';
                                else{
                                    echo ' <label for="img_path">Select a Picture to upload:</label>
                                    <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
                            <input type="file" id="img_path" name="file_upload">
                            <p class="help-block"><span class="label label-info"></span> Valid file extention (.jpg, .jpeg, .png, .gif)</p>
                        </div>
                        <output id="list"></output>';
                                }
                             ?>

                        <br>
                        <label">Description</label><br>
                        <textarea id="textarea" name="content"></textarea><br>






                    <br/>
                    <label for="Progressbar">Progress:</label>
                    <div class="progress" id="Progressbar">
                        <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 0%" id="divProgressBar">
                            <span class="sr-only">45% Complete</span>
                        </div>
                    </div>
                    <div id="status">
           </div>
           </div>
           </div>

                <div class="container-fluid">
                    <div class="col-sm-12" style="text-align: center;"><button type="button" class="btn btn-success" id="submit">Publish</button></div>
                </div>
            </form>
        </div>

        <div class="notif" id="notif-container">
            <div class="notif-img">
                <img id="notif-img" />
            </div>
            <div class="notif-content" id="notif-content"></div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="../../sparksuite-simplemde-markdown-editor-6abda7a/dist/simplemde.min.js"></script>
        <script src="../js/editor-eshop.js"></script>
        <script src="../js/sidebar.js"></script>
        <script type="text/javascript">

        </script>
        <script>

</script>
    </body>

</html>