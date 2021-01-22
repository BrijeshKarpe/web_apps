<?php
  include 'connect.php';
  session_start();
  if($_SERVER["REQUEST_METHOD"] == "POST") {

      $email = mysqli_real_escape_string($conn,$_POST['email']);
      $mypassword = mysqli_real_escape_string($conn,$_POST['password']);

      $sql = "SELECT position FROM teachers WHERE email = '$email' and password = '$mypassword'";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['position'];

      $count = mysqli_num_rows($result);

      if($count == 1) {
         $_SESSION['login_user'] = $email;
         if(strcmp($row['position'],"principal")==0){
           header("location: all_tt");
         }else{
           header("location: timetable");
         }
      }else {
         $error = "Your Login Email or Password is invalid";
         $_SESSION['one']=$error;
      }
      mysqli_free_result($result);
      mysqli_close($conn);
   }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Staff Reporting System</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href = "main.css" rel = "stylesheet">
    <link  rel = "stylesheet" href = "bootstrap.min.css">
    <script src="jquery.js"></script>
    <script src="bootstrap.min.js"></script>

  </head>
  <body class="bg-light">
    <div class="modal fade" id="login_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header text-center">
            <h4 class="modal-title w-100">Login</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
              <div class="container">
                <div class="input-group">
                  <input type="text" class="form-control" name="email" placeholder="Email" required>
                </div>
                <br/>
                <div class="input-group">
                  <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <br/>
                <div class="text-center">
                  <input type="submit" value="Login" class="btn btn-success" />
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <div class="container">
              <small><span>Forgot <a href="forgot">password?</a></span></small>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="jumbotron text-center">
      <h1>STAFF REPORTING SYSTEM</h1>
    </div>
    <div class="container-fluid  bg-light">
      <div class="row">
        <div class="col-lg-4 text-center">
          <h2>Project Developers</h2>
          <br/><br/>
          <dl>
            <dt><h6>aditi lachke</h6></dt>
            <dd><small>- TY (Comp.) </small></dd>
            <dt><h6>xyz xyz xyz</h6></dt>
            <dd><small>- TY (Comp.) </small></dd>
            <dt><h6>xyz xyz xyz</h6></dt>
            <dd><small>- TY (Comp.) </small></dd>
            <dt><h6>xyz xyz xyz</h6></dt>
            <dd><small>- TY (Comp.) </small></dd>
          </dl>
        </div>
        <div class="col-lg-4 text-center">
          <p>Please login to get started</p>
          <br/><br/>
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#login_form">Login</button>
          <br/><br/>
          <?php if(isset($_SESSION['one'])){
            echo "<div class=\"alert alert-danger alert-dismissible\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                    <strong>Warning!</strong> Invalid username or password.
                  </div>";
          }?>
        </div>
        <div class="col-lg-4 text-center">
          <h2>About Project</h2>
          <br/>
          <div class="text-muted">
            <p>This project provides a simple <abbr title="Staff Reporting System">SRS</abbr> to user.</p>
            <dl>
              <dt>Used Languages (Scripting and Server Side):</dt>
              <dd>- HTML5</dd>
              <dd>- Bootstrap 4.3.1</dd>
              <dd>- JavaScript</dd>
              <dd>- PHP 7</dd>
              <dt>Database :</dt>
              <dd>- MySQL</dd>
              <dt>Browser Requirements :</dt>
              <dd>- Google chrome</dd>
              <dd>- Mozilla Firefox</dd>
            </dl>
          </div>
        </div>
      </div>
    </div>
    <footer class = "card-footer bg-light text-center" style = "position: fixed;left: 0;bottom: 0;width: 100%">
      <strong>&copy; Ashok Institute Of Engineering and Technology, Polytechnic.</strong>
      <br />
      <small>Ashoknagar</small>
    </footer>
  </body>
  </html>
<?php unset($_SESSION['one']);?>
