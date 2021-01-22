<?php
include 'session.php';
include 'connect.php';
$class = "";
$query = "SELECT class FROM attendance GROUP BY class";
$result = mysqli_query($conn,$query);
$classes = mysqli_fetch_all($result,MYSQLI_ASSOC);
mysqli_free_result($result);

if($_SERVER["REQUEST_METHOD"] == "POST"){

  $class = $_POST["class"];
  $sql = "SELECT dat,present FROM attendance WHERE class = '$class'";
  $res = mysqli_query($conn,$sql);
  $data = mysqli_fetch_all($res,MYSQLI_ASSOC);
  mysqli_free_result($res);
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Staff Reporting System</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href = "main.css" rel = "stylesheet">
    <link  rel = "stylesheet" href = "bootstrap.min.css">
    <link  rel = "stylesheet" href = "jquery-ui-1.12.1/jquery-ui.min.css">
    <script src="jquery.js"></script>
    <script src="jquery-ui-1.12.1/jquery-ui.min.js"></script>
    <script src="dynamic-menu.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="bootstrap.min.js"></script>


    <script type="text/javascript">
      google.charts.load('current', {packages: ['corechart', 'line']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Date', 'Attendance'],
          <?php
            foreach($data as $dt){

              echo "['".$dt['dat']."',".$dt['present']."],";
            }
          ?>
        ]);

        var options = {
          vAxis: {
            title: "Attendance"
          },
          chart: {
            title: 'Day wise attendance.',
            subtitle: 'Class : <?php echo $class?>',
            //colors: ['#a52714'],
          },
          series: {
          0: {
            lineWidth: 1,
            //lineDashStyle: [5, 1, 5]
          }
        },
        backgroundColor: '#f1f8e9'
        };

        var chart = new google.charts.Line(document.getElementById('columnchart_material'));
        

        chart.draw(data, google.charts.Line.convertOptions(options));
      }
    </script>
  </head>
  <body class="bg-light">
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <a href="user"><img src="img_avatar.png" alt="Avatar" class="avatar" title="profile"></a>
          <a href="user" class="navbar-brand"><?php include('session.php'); echo strtoupper($name);?></a>
        </div>
        <div id="main-navbar">
          <ul class="nav navbar-nav navbar-right">
            <li class="nav-item"><a class="nav-link" href="user">Home</a></li>
            <li class="nav-item">
              <a class="nav-link" href="graphs">Statistics</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-sm btn-info m-1" href="logout">Log out</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
<script>$("#main-navbar").dynamicMenu();</script>
<div class="container-fluid">
  <div class="row">
    <div class="col-xl-2 text-center">
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="input-group mb-3 mt-3">
          <div class="input-group-prepend">
            <span class="input-group-text bg-dark text-white">Class</span>
          </div>
          <select name="class" class="custom-select form control" required>
            <option value="">Select</option>
              <?php
                foreach($classes as $cl){

                  echo "<option value=".$cl['class'].">".$cl['class']."</option>";
                }
              ?>
          </select>
          <div class="input-group-append">
            <input onclick="drawChart()" type="submit" value="OK" class="input-group-text bg-dark text-white">
          </div>
        </div>
      </form>
    </div>
    <div class="col-xl-10">
      <div id="columnchart_material" class="mb-5 mt-3 mx-auto" style="width: 1000px; height: 550px;"></div>

    </div>

  </div>
</div>
<?php
  include_once("page.footer.php");
?>
