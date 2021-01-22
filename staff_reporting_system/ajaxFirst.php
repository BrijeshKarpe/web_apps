<?php
  include('connect.php');
  $dept = "";
  if(isset($_POST["department"]) && !empty($_POST["department"])){

    $dept = $_POST["department"];
    echo $dept;
    $query = "SELECT name,surname,email FROM teachers WHERE dept = '$dept'";
    $result=mysqli_query($conn,$query);
    $data = mysqli_fetch_all($result,MYSQLI_ASSOC);
    if(mysqli_num_rows($result) > 0){
      echo '<option value="">Select Teacher</option>';
      foreach($data as $dt){
        echo '<option value="'.$dt['email'].'">'.$dt['name'].'&nbsp;'.$dt['surname'].'</option>';
      }
    }else{
        echo '<option value="">Teacher not available</option>';
    }
    mysqli_free_result($result);
  }
?>
