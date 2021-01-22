<?php
  include 'session.php';
  include 'ch_teacher.php';
  include_once('principal.header.php');


  include "connect.php";
  $class = $dept = $data = $second = $faculty = "";

  $quer = "SELECT dept_name FROM departments";
  $res = mysqli_query($conn,$quer);
  $second = mysqli_fetch_all($res,MYSQLI_ASSOC);

  if($_SERVER["REQUEST_METHOD"] == "POST"){

      $class=$_POST["class"];
      $dept=$_POST["dept"];
      $query = "SELECT * FROM timetable WHERE class_name='$class' AND dept_name='$dept'";
      $result = mysqli_query($conn,$query);
      $data = mysqli_fetch_all($result,MYSQLI_ASSOC);

  }
  mysqli_close($conn);
?>

<script>
  $(document).ready(function(){

  $('#dept_name').on('change',function(){

  var department = $(this).val();

  if(department){

    $.ajax({

      type:'POST',

      url:'ajaxClass.php',

      data:'department='+department,

      success:function(html){

      $('#class').html(html);

      }

      });

    }

    });
  });
</script>

<div class="container text-center">
  <div class="card shadow mt-4">
    <div class="card-header">
      <h3 class="card-text">Timetables</h3>
    </div>

      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text bg-dark text-white">Class Details</span>
          </div>
          <select id="dept_name" name="dept" class="custom-select form-control" required>
            <option value="">Select Department</option>
            <?php
                foreach($second as $d){

                  echo "<option value=".$d['dept_name'].">".$d['dept_name']."</option>";
                }
            ?>
          </select>
          <select name="class" id="class" class="custom-select form-control" required>
            <option value="">Select Department First</option>
          </select>
        </div>
      <div class="btn-group mt-3">
        <input type="submit" name="class_submit" value="submit" class="btn  btn-success">
        <a href="all_tt" class="btn  btn-primary">Reset</a>
      </div>
    </form>
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
            error_reporting(0);
            if(mysqli_num_rows($result) > 0){
              foreach($data as $dt){

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

</div>

<?php
  include 'page.footer.php';
?>
