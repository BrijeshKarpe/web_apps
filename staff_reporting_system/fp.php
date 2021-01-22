<?php
  include 'connect.php';
  session_start();
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
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" onclick="window.location.href='home'">&times;</button>
            <em>Plaese contact system admin for help.</em>
          </div>
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
