<?php
  include 'session.php';
  include 'ch_teacher.php';
  include_once('principal.header.php');
  $t = 0;
  include "connect.php";
  $sql = "SELECT name,surname,email,dept,position FROM teachers";
  $fet = mysqli_query($conn,$sql);
  $second = mysqli_fetch_all($fet,MYSQLI_ASSOC);
  mysqli_free_result($fet);
  //$all=array_merge($second,$data);
  mysqli_close($conn);
?>
<div class="container text-center">
  <div class="card shadow mt-4">
    <div class="card-header">
      <h2 class="card-text">Teacher's List</h2>
    </div>
    <div class="card-body">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Name</th>
            <th>Surname</th>
            <th>Email</th>
            <th>Department</th>
            <th>Position</th>
          </tr>
        </thead>
        <tbody>
          <?php
            foreach($second as $dt){

              echo "<tr><td>".$dt['name']."</td><td>".$dt['surname']."</td><td>".$dt['email']."</td><td>".$dt['dept']."</td><td>".$dt['position']."</td></tr>";
              $t=$t+1;
            }
          ?>
        </tbody>
      </table>
    </div>
    <div class="card-footer">
      <p class="card-text">Total number of teachers : <?php echo $t;?></p>
    </div>
  </div>
</div>
<?php
  include_once("page.footer.php");
?>
