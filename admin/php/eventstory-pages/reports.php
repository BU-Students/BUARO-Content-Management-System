<div class="page-header">
  <h1>Reports on Event / Story</h1>
  <h4>As of: <?php echo date("D-M-Y")?></h4>
  <input type="button" class="btn btn-default btn-s" onclick="printDiv('printarea')" value="Print this Report" />
</div>
<div class="table-responsive" id="printarea">
<table class="table table-hover" id="reportsTable">
  <tr>
  	<th>No.</th>
  	<th>Title</th>
  	<th>Status</th>
  	<th>Views</th>
    <th>Post Type</th>
  	<th>Event Due</th>
  	<th>Image Banner</th>
  	<th>Image Slider</th>
  	<th>Date Posted</th>
  	<th>Posted by:</th>
  </tr>
  <?php
        include 'backend/connection.php';
        include 'backend/input_handler.php';

        $sql = "SELECT * FROM post,admin WHERE post.admin_id=admin.admin_id";
        $sql .= " ORDER BY timestamp DESC";
        $result = $conn->query($sql);
        $num = 0;
        while($row = $result->fetch_assoc()) {
          $num++;
          echo '<tr>';
            echo '<td>'.$num.'</td>';
            echo '<td>'.$row['title'].'</td>';
            echo '<td>'.$row['status'].'</td>';
            echo '<td>'.$row['view_count'].'</td>';
            if($row['post_type']=="1")
                echo "<td>Story</td>";
            elseif($row['post_type']=="2")
                echo "<td>Event</td>";
            else
                echo "<td>Unknown</td>";
            if($row['post_type']=="1")
                echo "<td>N/A</td>";
            else
              echo '<td>'.$row['eventdate'].'</td>';
            if($row['imgbanner']=="" || $row['imgbanner']==NULL || empty($row['imgbanner']))
                echo "<td>None</td>";
            else
                echo "<td>Available</td>";
            if($row['imglinks']=="" || $row['imglinks']==NULL || empty($row['imglinks']))
                echo "<td>None</td>";
            else{
                $strings = explode(";", $row['imglinks']);
                $q=0;
                foreach ($strings as $links) {
                  $q++;
                }
                echo '<td>'.$q.' Images</td>';
            }
            echo '<td>'.$row['timestamp'].'</td>';
            echo '<td>'.$row['first_name'].' '.$row['last_name'].'</td>';
          echo '</tr>';
        }
  ?>
</table>
</div>
<script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>