<?php
   include('connect.php');
   if(!isset($_SESSION['login_user'])){
     session_start();
   }

   $user_check = $_SESSION['login_user'];
   $ses_sql = mysqli_query($conn,"select name,surname,email,position,dept from teachers where email = '$user_check'");

   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

   $login_session = $row['email'];
   $position = $row['position'];
   $name = $row['name'];
   if(!isset($_SESSION['login_user'])){
     header('location: home');
     die();
   }
   mysqli_free_result($ses_sql);
   mysqli_close($conn);
?>
