<?php
  include 'session.php';
  if(strcmp($position,'principal') == 0){
    include 'ch_teacher.php';
    include_once('principal.header.php');
  }else{
    include 'ch_principal.php';
    include_once('teacher.header.php');
  }

  include 'connect.php';
  $className = $total = "";
  $query = "SELECT nam,department,strength FROM class WHERE cteacher='$login_session'";

  $result = mysqli_query($conn,$query);
  $data = mysqli_fetch_array($result,MYSQLI_ASSOC);
  $name = $data["nam"];
  $div = $data["department"];
  $total = $data["strength"];
  $className = "".strtoupper($name)."-".strtoupper($div)."";
  mysqli_free_result($result);

  $sql = "SELECT dat,present FROM attendance WHERE cteacher='$login_session'";

  $response = mysqli_query($conn,$sql);
  $arr = mysqli_fetch_all($response,MYSQLI_ASSOC);

  mysqli_free_result($response);
  mysqli_close($conn);
?>
<div class="container text-center">
  <div class="card shadow mt-4">
    <div class="card-header">
      <h2 class="card-text"><?php echo "".$className.""?></h2>
    </div>
    <div class="card-body">
      <div>
        <small class="mx-auto"><?php echo "strength : ".$total."";?></small>
      <div>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Date</th>
            <th>Present Students</th>
          </tr>
        </thead>
        <tbody>
          <?php
            foreach($arr as $a){
              echo "<tr><td>".$a['dat']."</td><td>".$a['present']."</td></tr>";
            }
          ?>
        </tbody>
      </table>
    </div>
    <div class="card-footer">
      <p class="card-text">Classes are assigned by the principal</p>
    </div>
  </div>
</div>
<?php
  include_once("page.footer.php");
?>
