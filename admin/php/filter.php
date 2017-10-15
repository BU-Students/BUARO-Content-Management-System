<?php  
 //filter.php  
 if(isset($_POST["from_date"], $_POST["to_date"]))  
 {  
      $connect = mysqli_connect("localhost", "root", "", "buaro");  
      $output = '';  
      $query = "  
           SELECT * FROM feedback  
           WHERE timestamp BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."'  
      ";  
      $result = mysqli_query($connect, $query);  
      $output .= '  
          <table class="table table-striped table-hover table-bordered">
          <caption>FEEDBACKS</caption>
          <thead>
            <tr>
              <th>Email</th>
              <th>Message</th>
              <th>Date and Time</th>
              <th>Delete Feedback</th>
            </tr>
          </thead>    
      ';  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           { if($row['feedemail'] == "") $row['feedemail'] = '<font color="#ccc">Anonymous</font>'; 
                $output .= '  
                     <tr>'.
                '<td>'.$row['feedemail'].'</td>'.
                '<td>'.$row['feedmessage'].'</td>'.
                '<td>'.$row['timestamp'].'</td>'.

                '<td><a onclick=\"attemptDelete(this, '.$row['feedback_id'].')\" href=\"javascript:void(0)\">Delete</a></td>'.
              '</tr>
                ';  
           }  
      }  
      else  
      {  
           $output .= '  
                <tr>  
                     <td colspan="5">No Order Found</td>  
                </tr>  
           ';  
      }  
      $output .= '</table>';  
      echo $output;  
 }  
 ?>

 <!DOCTYPE html>
 <html>
 <head>
  
 </head>
 <body>
 <script src="../js/feedback.js"></script>
 </body>
 </html>