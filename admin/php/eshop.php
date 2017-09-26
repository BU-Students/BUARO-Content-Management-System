<?php

if(session_status() == PHP_SESSION_NONE)
    session_start();

//if user attemps to access this page without authentication
if(!isset($_SESSION['id'])) {
    $_SESSION['error_msg'] = "Please log in first to continue";
    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Alumni Administator</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../../vendor/Bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merriweather">
        <link rel="stylesheet" href="../css/sidebar.css" />
        <link rel="stylesheet" href="../css/topbar.css" />
        <link rel="stylesheet" href="../css/stories.css" />
        <link rel="stylesheet" href="../css/modal.css" />
        <link rel="stylesheet" href="../css/notif.css" />
    </head>
    <body>
        <!-- topbar and sidebar here -->
        <?php
            require_once "topbar.php";
            require_once "sidebar.php";
        ?>

        <!-- page content here -->

<!-- <form id="form1" runat="server">
    <input type='file' id="imgInp" />
    <img id="blah" src="#" alt="your image" />
</form>
-->


<div id="content-wrapper">
            <!-- background image if no stories -->
            <div id="no-stories-backdrop">
                <img src="https://cdn4.iconfinder.com/data/icons/linecon/512/file-512.png" />
                <label>No Items Available.</label><br>
                <a href="editor-eshop.php">
                    <h5>Post your first Item<span class="glyphicon glyphicon-pencil"></span></h5>
                </a>
            </div>

            <div id="stories-wrapper">
            </div>
        </div>

        <!-- story modal here -->
        <div class="modal fade" id="expanded-story" role="dialog" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title" id="expanded-story-title"></h4>
                        <h6 id="expanded-story-date"></h6>
                        <div class="container-fluid">
                            <div class="col-xs-6"><a id="edit-story-link">Edit<span class="glyphicon glyphicon-pencil"></span></a></div>

                            <div class="col-xs-6"><a id="delete-story-link" data-toggle="modal" data-target="#confirmation-modal">Delete<span class="glyphicon glyphicon-trash"></span></a><br></div>
                                 <a id="edit-story-comment"><span class="glyphicon glyphicon-stats"></span>Manage Comment</a>

                        </div>
                    </div>
                    <div class="modal-body">
                        <div id="expanded-story-body">
                        </div>
                    </div>
                    <div class="modal-footer">

                        <br>

                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- delete confirmation modal here -->
        <div class="modal fade" id="confirmation-modal" role="dialog" tabindex="1">
            <input type="hidden" id="story-dom-id" />
            <input type="hidden" id="story-db-id" />
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Delete Item</h4>
                    </div>
                    <div class="modal-body">
                        <span>Are you sure you want to permanently delete this Item?</span>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" />
                        <button type="button" class="btn btn-default btn-danger" onclick="deleteStory()">Yes</button>
                        <button type="button" class="btn btn-default btn-success" data-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- notification here -->
        <?php
            $img_path = "";
            $message = "";
            $class = "";

            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['notif-status'])) {
                $class = "show-notif";
                $img_path = "../img/check-icon.png";

                if($_POST['notif-status'] == "memorabilia_item-created") {
                    $message = "Item successfully created.";
                }
                else if($_POST['notif-status'] == "memorabilia_item-updated") {
                    $message = "Item successfully updated.";
                }

                unset($_POST['notif-status']);
            }

            echo('
                <div class="notif '.$class.'" id="notif-container">
                    <div class="notif-img">
                        <img id="notif-img" src="'.$img_path.'" />
                    </div>
                    <div class="notif-content" id="notif-content">'.$message.'</div>
                </div>
            ');
        ?>



</div>
		<script src="../../vendor/jQuery/jquery-3.2.1.min.js"></script>
		<script src="../../vendor/Bootstrap/js/bootstrap.min.js"></script>
        <script src="../js/eshop.js"></script>
        <script src="../js/sidebar.js"></script>
        <script src="../js/notif.js"></script>
    </body>
</html>