<?php
if(isset($_POST["view"]))
{
  include("session.php");
 include("connect.php");
 if($_POST["view"] != '')
 {
  $update_query = "UPDATE notices_status SET notice_status=1 WHERE notice_status=0 AND teacher='$user_check'";
  mysqli_query($conn, $update_query);
 }
 $query = "SELECT * FROM notices ORDER BY notice_id DESC";
 $result = mysqli_query($conn, $query);
 $output = '';

 if(mysqli_num_rows($result) > 0)
 {
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
   
    <a class="dropdown-item" href="show_notice">
     <strong>'.substr($row["notice_subject"],0,100).'</strong><br />
     <small><em>'.substr($row["notice_text"],0,80).'...</em></small><br />
     <small class="float-right"><em>'.$row["notice_date"].'</em></small><br/>
    </a>
   
  
   ';
  }
 }
 else
 {
  $output .= '<li><a href="#" class="text-bold text-italic">No Notification Found</a></li>';
 }

 $query_1 = "SELECT * FROM notices WHERE notice_id IN (SELECT notice_id FROM notices_status WHERE notice_status=0 AND teacher='$user_check')";
 $result_1 = mysqli_query($conn, $query_1);
 $count = mysqli_num_rows($result_1);
 $data = array(
  'notification'   => $output,
  'unseen_notification' => $count
 );
 echo json_encode($data);
}
?>
