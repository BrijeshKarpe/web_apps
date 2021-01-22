<?php
  include 'session.php';
  include 'ch_teacher.php';
  include_once('principal.header.php');
  include 'connect.php';
  $dname = $sqlErr = "";

  if($_SERVER["REQUEST_METHOD"] == "POST"){

    $dname = strtolower($_POST['department']);


    $sql = "INSERT INTO departments (dept_name) VALUES ('$dname')";
    if (!mysqli_query($conn,$sql)) {
      $sqlErr="Teacher has already been assigned a class.";
    }
    header('location:department');
  }
  mysqli_close($conn);

?>

<div class="container text-center">
  <div class="card shadow mt-4">
    <div class="card-header">
      <h2 class="card-text">Add New Department</h2>
    </div>
    <div class="card-body">
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text bg-dark text-white">Department</span>
          </div>
          <input type="text" name="department" class="form-control" placeholder="Department Name" required>
        </div>
        <div class="btn-group mt-3">
          <input type="submit" value="submit" class="btn  btn-success">
          <a href="department" class="btn  btn-primary">Reset</a>
        </div>
        <div class="mt-3">
          <span><?php echo $sqlErr;?></span>
        </div>
      </form>
    </div>
    <div class="card-footer">
      <p class="card-text">All fields are mandatory to fill.</p>
    </div>
  </div>
</div>

<?php
  include_once("page.footer.php");
?>
