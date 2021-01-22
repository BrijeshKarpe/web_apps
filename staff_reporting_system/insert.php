<?php
if(isset($_POST["subject"]))
{
 include("connect.php");
 $subject =  $_POST["subject"];
 $comment = $_POST["comment"];
 $date = $_POST["date"];
 $query = "INSERT INTO notices (notice_subject, notice_text,notice_date) VALUES ('$subject', '$comment','$date')";
 mysqli_query($conn, $query);
}
?>
