<?php
  include 'session.php';
  if(strcmp($position,'principal') == 0){
    include 'ch_teacher.php';
    include_once('principal.header.php');
  }else{
    include 'ch_principal.php';
    include_once('teacher.header.php');
  }
  include 'connect.php';
  $date = $className = $present = $sqlErr = $total = $totalErr = "";
  $query = "SELECT nam,department,strength FROM class WHERE cteacher='$login_session'";

  $result = mysqli_query($conn,$query);
  $data = mysqli_fetch_array($result,MYSQLI_ASSOC);
  $name = $data["nam"];
  $div = $data["department"];
  $total = $data["strength"];
  $className = "".strtoupper($name)."-".strtoupper($div)."";
  mysqli_free_result($result);
  if($_SERVER["REQUEST_METHOD"] == "POST"){

    $date = $_POST['date'];
    $present = $_POST['present'];

    if($present <= $total){
      $sql = "INSERT INTO attendance (dat,class,cteacher,present) VALUES ('$date','$className','$login_session','$present')";
      if(!mysqli_query($conn,$sql)){

        $sqlErr = "Could not add attendance.";
      }
    }else{

      $totalErr = "Present students cannot be more than strength of the class.";
    }
    header("location:attendance");
  }
  mysqli_close($conn);
?>

<script>
$(document).ready(function clear() {
  $('.card-body').find('input:text').val('');
});
$( function() {
    $( "#datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'dd-mm-yy'
     });
  } );
</script>
<div class="container text-center">
  <div class="card shadow mt-4">
    <div class="card-header">
      <h2 class="card-text">Attendance Form</h2>
    </div>
    <div class="card-body">
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text bg-dark text-white">Select Date</span>
          </div>
          <input class="form-control" name="date" type="text" id="datepicker" placeholder="Click here" required>
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text bg-dark text-white">Class</span>
          </div>
          <span class="input-group-text bg-info text-white"><?php echo $className;?></span>
          <span class="input-group-text bg-info text-white"><?php echo $total;?></span>
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text bg-dark text-white">Attendance</span>
          </div>
          <input type="number" name="present" class="form-control" placeholder="Present students" required>
        </div>
        <div class="btn-group mt-3">
          <input type="submit" value="submit" class="btn  btn-success">
          <a href="attendance" class="btn  btn-primary">Reset</a>
        </div>
        <div class="mt-3">
          <span><?php echo $sqlErr;?></span>
          <span><?php echo $sqlErr;?></span>
        </div>
      </form>
    </div>
    <div class="card-footer">
      <p class="card-text">To check attendance goto <strong class="text-warning">My class</strong> tab.</p>
    </div>
  </div>
</div>

<?php
include_once("page.footer.php");
?>
