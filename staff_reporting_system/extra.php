<?php
  include 'session.php';
  include 'ch_teacher.php';
  include_once('principal.header.php');
  include 'connect.php';

  $dname = $cname = $day = $ftime = $ttime = $subject = $faculty = $sqlErr = $second = "";

  $result = mysqli_query($conn,"SELECT dept_name from departments");
  $data = mysqli_fetch_all($result,MYSQLI_ASSOC);
  mysqli_free_result($result);

  if($_SERVER["REQUEST_METHOD"] == "POST"){

    $dname = $_POST["dept"];
    $cname = $_POST["class"];
    $day = $_POST["date"];
    $ftime = $_POST["from"];
    $ttime = $_POST["to"];
    $subject = $_POST["subject"];
    $faculty = $_POST["teacher"];

    $query = "INSERT INTO extra_lectures (dept_name,class_name,dat,from_time,to_time,subject,faculty) VALUES ('$dname','$cname','$day','$ftime','$ttime','$subject','$faculty')";

    if(!mysqli_query($conn,$query)){

      $sqlErr = "Could not insert data.";
    }
    
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

  $(document).ready(function(){

  $('#dept_name').on('change',function(){

  var department = $(this).val();

  if(department){

    $.ajax({

      type:'POST',

      url:'ajaxFirst.php',

      data:'department='+department,

      success:function(html){

      $('#teacher').html(html);

      }

      });

    }

    });
  });

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
      <h2 class="card-text">Extra Lecture Record</h2>
    </div>
    <div class="card-body">
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text bg-dark text-white">Class Details</span>
          </div>
          <select id="dept_name" name="dept" class="custom-select form-control" required>
            <option value="">Select Department</option>
            <?php
                foreach($data as $dt){

                  echo "<option value=".$dt['dept_name'].">".$dt['dept_name']."</option>";
                }
            ?>
          </select>
          <select name="class" id="class" class="custom-select form-control" required>
            <option value="">Select Department First</option>

          </select>
        </div>
        <div class="input-group mb-3">

            <div class="input-group-prepend">
              <span class="input-group-text bg-dark text-white">Date</span>
            </div>
            <input class="form-control" name="date" type="text" id="datepicker" placeholder="Click here" required>

          <div class="input-group-prepend">
            <span class="input-group-text bg-dark text-white">From time</span>
          </div>
          <input type="time" class="form-control" name="from" required>
          <div class="input-group-prepend">
            <span class="input-group-text bg-dark text-white">To time</span>
          </div>
          <input type="time" class="form-control" name="to" required>
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text bg-dark text-white">Subject</span>
          </div>
          <input type="text" class="form-control" placeholder="Enter subject name" name="subject">
        </div>
        <div class="input-group mb3">
          <div class=input-group-prepend>
            <span class="input-group-text bg-dark text-white">Faculty Name</span>
          </div>
          <select id="teacher" name="teacher" class="custom-select form-control" required>
            <option value="">Select Department First</option>
          </select>
        </div>
        <div class="btn-group mt-3">
          <input type="submit" value="submit" class="btn  btn-success">
          <a href="extra" class="btn  btn-primary">Reset</a>
        </div>
        <div class="mt-3">
        <span class="error"><?php echo $sqlErr;?></span>
      </div>
      </form>
    </div>
  </div>
</div>


<?php
  include 'page.footer.php';
?>
