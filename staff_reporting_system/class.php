<?php
  include 'session.php';
  include 'ch_teacher.php';
  include_once('principal.header.php');
  include 'connect.php';
  $cname = $cdivision = $cstrength = $cteacher = $sqlErr =  "";


  $resulttt = mysqli_query($conn,"SELECT dept_name from departments");
  $dataaa = mysqli_fetch_all($resulttt,MYSQLI_ASSOC);

  if($_SERVER["REQUEST_METHOD"] == "POST"){

    $cname = strtolower($_POST['class']);
    $cdivision = strtolower($_POST['dept']);
    $cstrength = $_POST['strength'];
    $cteacher = $_POST['teacher'];

    if(mysqli_num_rows(mysqli_query($conn,"select * from class where nam = '$cname' and department='$cdivision'")) == 0){
      $sql = "UPDATE class SET nam = '$cname', department = '$cdivision', strength = '$cstrength' WHERE class.cteacher = '$cteacher'";
      if (!mysqli_query($conn,$sql)) {
        $sqlErr="Teacher has already been assigned a class.";
      }
    }else{

      $sqlErr="<p class='error'>Class already exists in the department.</p>";
    }
    
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

      url:'ajaxData.php',

      data:'department='+department,

      success:function(html){

      $('#teacher').html(html);

      }

      });

    }

    });
  });
</script>

<div class="container text-center">
  <div class="card shadow mt-4">
    <div class="card-header">
      <h2 class="card-text">Add New Class</h2>
    </div>
    <div class="card-body">
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text bg-dark text-white">Class</span>
          </div>
          <input type="text" name="class" class="form-control" placeholder="Class Name" required>
          <select id="dept_name" name="dept" class="custom-select form-control" required>
            <option value="">Select Department</option>
            <?php
                foreach($dataaa as $dt){

                  echo "<option value=".$dt['dept_name'].">".$dt['dept_name']."</option>";
                }
            ?>
          </select>
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text bg-dark text-white">Strength</span>
          </div>
          <input type="number" name="strength" class="form-control" placeholder="Total Number Of Students" required>
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text bg-dark text-white">Class Teacher</span>
          </div>
          <select id="teacher" name="teacher" class="custom-select form-control" required>
            <option value="">Select Department First</option>
          </select>
        </div>
        <div class="btn-group mt-3">
          <input type="submit" value="submit" class="btn  btn-success">
          <a href="class" class="btn  btn-primary">Reset</a>
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
