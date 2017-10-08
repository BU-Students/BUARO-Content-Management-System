<?php
	 include '../backend/connection.php';
        include '../backend/input_handler.php';
    $_GET['start'] = date('Y-m-d H:i:s', strtotime($_GET['start']));
    $_GET['end'] = date('Y-m-d H:i:s', strtotime($_GET['end']));
	$sql = "SELECT * FROM post,admin WHERE post.admin_id=admin.admin_id";
	
	$sql .= " ORDER BY timestamp DESC";
		$result="";
        $result = $conn->query($sql);
        $num = 0;
		echo '
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
		';
		while($row = $result->fetch_assoc()) {
          if(($row['timestamp']>=$_GET['start']) && ($row['timestamp']<=$_GET['end'])){
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
  }
    	 echo '
		        </tbody>
		</table>
        ';
       
?>