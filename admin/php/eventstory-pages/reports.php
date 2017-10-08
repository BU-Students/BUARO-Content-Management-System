<style type="text/css">
  .thcl:hover{
    cursor: pointer;
  }
</style>
<div class="page-header">
  <h1>Reports on Event / Story</h1>
  <h4>As of: <?php echo date("D-M-Y")?></h4>
  <input type="button" class="btn btn-default btn-s" onclick="printDiv('printarea')" value="Print this Report" />
  <input type="button" id="button-report-date" class="btn btn-default btn-s" onclick="showDate()" value="Print a report by post date" />
    <div id="report-date" class="hidden">
      <label for="start">From: </label><input type="date" id="start">
      <label for="end">To: </label><input type="date" id="end">
      <input type="button" class="btn btn-default btn-s" onclick="printdate()" value="Print Up to this date" />
    </div>
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
<div class="hidden" id="speccont"></div>
<script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
<script>
  function printdate(){
    val1 = document.getElementById("start").value;
    val2 = document.getElementById("end").value;
    var params = "start="+val1+"&end="+val2;
    console.log(params);
    var xhttp4 = new XMLHttpRequest();
    xhttp4.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("speccont").innerHTML = this.responseText;
        var printContents = document.getElementById("speccont").innerHTML;
         var originalContents = document.body.innerHTML;

         document.body.innerHTML = printContents;

         window.print();

         document.body.innerHTML = originalContents;
      }
    };
  xhttp4.open("GET", "backend/spec-reports.php?"+params, true);
  xhttp4.send();
  };
</script>
<script>
  function showDate(){
    if(document.getElementById("button-report-date").className=="btn btn-default btn-s active"){
      document.getElementById("button-report-date").className ="btn btn-default btn-s";
      document.getElementById("report-date").className="hidden";
    }
    else{
    document.getElementById("button-report-date").className +=" active";
    document.getElementById("report-date").className="show";
  }
  }
</script>