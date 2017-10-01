<?php include_once('connection.php'); ?>

<?php

$sql = "SELECT COUNT(*) FROM post";
$result = mysqli_query($con, $sql) or trigger_error("SQL", E_USER_ERROR);
$r = mysqli_fetch_row($result);
$numrows = $r[0];

$rowsperpage = 10;
$totalpages = ceil($numrows / $rowsperpage);

if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
   $currentpage = (int) $_GET['currentpage'];
} else {
   $currentpage = 1;
}

if ($currentpage > $totalpages) {
   $currentpage = $totalpages;
}

if ($currentpage < 1) {
   $currentpage = 1;
}

$offset = ($currentpage - 1) * $rowsperpage;

$sql = "SELECT * FROM post ORDER BY timestamp DESC LIMIT $offset, $rowsperpage";
$result = mysqli_query($con, $sql) or trigger_error("SQL", E_USER_ERROR);

$count = 0;
while ($list = mysqli_fetch_assoc($result)) {
   $post_id = $list['post_id'];
   $post_type = $list['post_type'];
   $title = $list['title'];
   $content = $list['content'];
   $time = $list['timestamp'];

   $cut_content = (strlen($content) > 20) ? substr($content, 0, 125) . '...' : $content;   

   echo '
         <div class=\'w3-example w3-section\' style="height:100%;" overflow:hidden;">
            <h3 class=\'title\'>'.$title.'</h3>
            <center><img src="../img/img35.jpg" style="max-height:200px;"></center>
            <p>Time Posted: '.$time.'</p>
            <div style="display:inline-block; white-space:nowrap; width:98%; overflow:hidden; text-overflow:ellipsis;">
               <p>'.$cut_content.'</p>
            </div>
            <button onclick="myFunc(\'more'.$count.'\')" class="w3-btn w3-large w3-theme w3-margin-bottom" target="_blank"><h5 class="read">Read More &raquo;</h5></button>
               <div id="more'.$count.'" class="w3-accordion-content">
                  <p>'.$content.'</p><br>
               </div>

         </div>
   ';
   $count++;
}
$range = 3;

if ($currentpage > 1) {
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=1'><<</a> ";
   $prevpage = $currentpage - 1;
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage'><</a> ";
}
for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
   if (($x > 0) && ($x <= $totalpages)) {
      if ($x == $currentpage) {
         echo " [<b>$x</b>] ";
      } else {
         echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$x'>$x</a> ";
      }
   }
}

if ($currentpage != $totalpages) {
   $nextpage = $currentpage + 1;
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$nextpage'>></a> ";
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$totalpages'>>></a> ";
}
?>


