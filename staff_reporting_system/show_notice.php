<?php
  include 'session.php';
  if(strcmp($position,'principal') == 0){
    include 'ch_teacher.php';
    include_once('principal.header.php');
  }else{
    include 'ch_principal.php';
    include_once('teacher.header.php');
  }
  include("connect.php");
  $limit=5;
  $result=mysqli_query($conn,"SELECT * FROM notices ORDER BY notice_id DESC LIMIT $limit");
  $data=mysqli_fetch_all($result,MYSQLI_ASSOC);
  mysqli_free_result($result);
  if(isset($_POST['all'])){

    unset($data);
    $result=mysqli_query($conn,"SELECT * FROM notices ORDER BY notice_id DESC");
    $data=mysqli_fetch_all($result,MYSQLI_ASSOC);
    mysqli_free_result($result);
  }
  mysqli_close($conn);
?>
<div class="container">
  <div class="text-center">
    <h1 class="card-text">Notice List</h1><br/>
    <small><form method="post" class="float-right"><input name="all" class="btn btn-outline-dark btn-sm" type="submit" value="Show more" ></form></small>
    <a href="show_notice" class="float-left btn btn-sm btn-outline-dark">Show less</a><br/>
  </div>
  <div class="text-center">
    <?php
      foreach($data as $dt){

        echo '<div class="card shadow mt-4">
          <div class="card-header">
            <h3 class="card-text">'.$dt["notice_subject"].'</h3>
          </div>
          <div class="card-body">
            <p class="card-text">'.$dt["notice_text"].'</p>
          </div>
          <div class="card-footer">
            <p class="card-text">'.$dt["notice_date"].'</p>
          </div>
        </div>';
      }
    ?>
  </div>
</div>
<?php
  include("page.footer.php");
?>
