<?php
include 'session.php';
include 'ch_teacher.php';
$nameErr = $emailErr = $passErr = $sqlErr = "";
$fname = $lname = $email = $pass = $pos = $col = $no = "";
include 'connect.php';

$result = mysqli_query($conn,"select count(*) from teachers");

$row = mysqli_fetch_array($result,MYSQLI_ASSOC);

$no=$row["count(*)"];
mysqli_free_result($result);

$resulttt = mysqli_query($conn,"SELECT dept_name from departments");
$dataaa = mysqli_fetch_all($resulttt,MYSQLI_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["fname"])) {
    $nameErr = "Name is required";
  } else {
    $fname = test_input($_POST["fname"]);
    $lname = test_input($_POST["lname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$fname)) {
      $nameErr = "Only letters and white space allowed";
    }
    if (!preg_match("/^[a-zA-Z ]*$/",$lname)) {
      $nameErr = "Only letters and white space allowed";
    }
  }

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }

  if (strcmp($_POST["fpas"],$_POST["spas"])!=0){
    $passErr = "Passwords do not match";
  } elseif (strlen($_POST["fpas"]) < 8) {
    $passErr = "Passwords must be at least 8 characters";
  }else{
    $pass = $_POST["fpas"];
  }

  $pos = strtolower($_POST["position"]);
  $col = strtolower($_POST["dept"]);

  if(strcmp($nameErr,$emailErr) == 0 and strcmp($emailErr,$passErr) == 0 ){


    $sql = "INSERT INTO teachers (name, surname, email, password, position, dept) VALUES ('$fname','$lname','$email','$pass','$pos','$col')";

    if (!mysqli_query($conn,$sql)) {
      $sqlErr="email already exists. U se another email.";
    }


    mysqli_close($conn);
    header('location:registration');
  }
}
 function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   $data = strtolower($data);
   return $data;
 }
?>
<?php
include 'session.php';
include 'ch_teacher.php';
include 'principal.header.php';
?>

<div class="container text-center">
  <div class="card shadow mt-4">
    <div class="card-header">
      <h2 class="card-text">Registration Form</h2>
    </div>
    <div class="card-body">
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text bg-dark text-white">Person</span>
          </div>
          <input type="text" name="fname" class="form-control" placeholder="First Name" required>
          <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
          <span class="error"><?php echo $nameErr;?></span>
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text bg-dark text-white">@</span>
          </div>
          <input type="text" name="email" class="form-control" placeholder="email" required>
          <span class="error"><?php echo $emailErr;?></span>
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text bg-dark text-white">Password</span>
          </div>
          <input type="password" name="fpas" class="form-control" placeholder="Enter Password" required>
          <input type="password" name="spas" class="form-control" placeholder="Confirm Password" required>
          <span class="error"><?php echo $passErr;?></span>
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text bg-dark text-white">Position</span>
          </div>
          <select name="position" class="custom-select form-control" required>
            <option value="">Select Position</option>
            <option value="principal">Principal</option>
            <option value="teacher">Teacher</option>
          </select>
        </div>
        <div class="input-group mb3">
          <div class=input-group-prepend>
            <span class="input-group-text bg-dark text-white">Department</span>
          </div>


            <select name="dept" class="custom-select form-control" required>
              <option value="">Select Department</option>
              <?php
                  foreach($dataaa as $dt){

                    echo "<option value=".$dt['dept_name'].">".$dt['dept_name']."</option>";
                  }
              ?>
            </select>


        </div>
        <div class="btn-group mt-3">
          <input type="submit" value="submit" class="btn  btn-success">
          <a href="registration" class="btn  btn-primary">Reset</a>
        </div>
        <div class="mt-3">
        <span class="error"><?php echo $sqlErr;?></span>
      </div>
      </form>
    </div>
    <div class="card-footer">
      <p class="card-text">Total number of Employees :<?php echo $no;?></p>
    </div>
  </div>
</div>

<?php
  include_once("page.footer.php");
?>
