<?php
  include 'session.php';
  if(strcmp($position,'principal') == 0){
    include 'ch_teacher.php';
    include_once('principal.header.php');
  }else{
    include 'ch_principal.php';
    include_once('teacher.header.php');
  }

  include "connect.php";
  $sql = "SELECT * FROM timetable WHERE faculty = '$user_check'";
  $fet = mysqli_query($conn,$sql);
  $second = mysqli_fetch_all($fet,MYSQLI_ASSOC);
  
  $query = "SELECT * FROM extra_lectures WHERE faculty = '$user_check'";
  $result = mysqli_query($conn,$query);
  $data = mysqli_fetch_all($result,MYSQLI_ASSOC);
  mysqli_close($conn);
?>

<div class="container text-center">
  <div class="card shadow mt-4">
    <div class="card-header">
      <h3 class="card-text">My Lectures' List</h3>
    </div>
    <div class="card-body">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Department</th>
            <th>Class</th>
            <th>Day</th>
            <th>From</th>
            <th>To</th>
            <th>Subject</th>
          </tr>
        </thead>
        <tbody>
          <?php
            //error_reporting(0);
            if(mysqli_num_rows($fet) > 0){
              foreach($second as $dt){

                echo "<tr><td>".$dt['dept_name']."</td><td>".$dt['class_name']."</td><td>".$dt['day']."</td><td>".$dt['from_time']."</td><td>".$dt['to_time']."</td><td>".$dt['subject']."</td></tr>";
              }
            }else{

              echo "<tr>
                      <td>None</td>
                      <td>None</td>
                      <td>None</td>
                      <td>None</td>
                      <td>None</td>
                      <td>None</td>
                    </tr>";
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <div class="card shadow mt-4">
    <div class="card-header">
      <h3 class="card-text">My Extra Lectures' List</h3>
    </div>
    <div class="card-body">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Department</th>
            <th>Class</th>
            <th>Day</th>
            <th>From</th>
            <th>To</th>
            <th>Subject</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if(mysqli_num_rows($result)>0){
              foreach($data as $dt){

                echo "<tr><td>".$dt['dept_name']."</td><td>".$dt['class_name']."</td><td>".$dt['dat']."</td><td>".$dt['from_time']."</td><td>".$dt['to_time']."</td><td>".$dt['subject']."</td></tr>";
              }
            }else{

              echo "<tr>
                      <td>None</td>
                      <td>None</td>
                      <td>None</td>
                      <td>None</td>
                      <td>None</td>
                      <td>None</td>
                    </tr>";
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php
  include 'page.footer.php';
?>
