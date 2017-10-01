<style type="text/css">
  .thcl:hover{
    cursor: pointer;
  }
</style>
<div class="page-header">
  <h1>Reports on Event / Story</h1>
  <h4>As of: <?php echo date("D-M-Y")?></h4>
  <input type="button" class="btn btn-default btn-s" onclick="printDiv('printarea')" value="Print this Report" />
</div>
<div class="table-responsive" id="printarea">
<table class="table table-bordered table-hover table-striped" id="admins-table">
  <thead>
  <tr id="admin-table-headers">
  	<th class="thcl" onclick="sortAdminTable(this, 0)">No.</th>
  	<th class="thcl" onclick="sortAdminTable(this, 1)">Title</th>
  	<th class="thcl" onclick="sortAdminTable(this, 2)">Status</th>
  	<th class="thcl" onclick="sortAdminTable(this, 3)">Views</th>
    <th class="thcl" onclick="sortAdminTable(this, 4)">Post Type</th>
  	<th class="thcl" onclick="sortAdminTable(this, 5)">Event Due</th>
  	<th class="thcl" onclick="sortAdminTable(this, 6)">Image Banner</th>
  	<th class="thcl" onclick="sortAdminTable(this, 7)">Image Slider</th>
  	<th class="thcl" onclick="sortAdminTable(this, 8)">Date Posted</th>
  	<th class="thcl" onclick="sortAdminTable(this, 9)">Posted by:</th>
  </tr>
  </thead>
  <tbody id="admin-table-body">
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
  </tbody>
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