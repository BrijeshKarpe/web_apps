<?php
  include('connect.php');
  $dept = "";
  if(isset($_POST["department"]) && !empty($_POST["department"])){

    $dept = $_POST["department"];

    $query = "SELECT nam FROM class WHERE department = '$dept'";
    $result=mysqli_query($conn,$query);
    $data = mysqli_fetch_all($result,MYSQLI_ASSOC);
    if(mysqli_num_rows($result) > 0){
      echo '<option value="">Select Class</option>';
      foreach($data as $dt){
        echo '<option value="'.$dt['nam'].'">'.$dt['nam'].'</option>';
      }
    }else{
        echo '<option value="">Class not available</option>';
    }
    mysqli_free_result($result);
  }
?>
