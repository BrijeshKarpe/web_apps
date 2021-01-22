<?php
include 'session.php';
$fname=$row['name'];
$lname=$row['surname'];
$position=$row['position'];
$cname=$row['dept'];
$email=$row['email'];
include 'ch_teacher.php';
include_once('principal.header.php');
?>
<div class="container-fluid">
  <div class="card-deck">
    <div class="card bg-light" style="border:none">
      <div class="card-body text-center" style="margin:auto">
        <h1>Profile</h1>
        <img class="l_avatar" id="profile_pic" src="img_avatar.png" />
      </div>
    </div>
  </div>
    <div class="card-columns">
          <div class="card bg-light" style="border:none">
            <div class="card-body text-center">
              <dl>
                <dt>First Name :</dt>
                <dd><?php echo $fname;?></dd>
              </dl>
            </div>
          </div>
          <div class="card bg-light" style="border:none">
            <div class="card-body text-center">
              <dl>
                <dt>Last Name :</dt>
                <dd><?php echo $lname;?></dd>
              </dl>
            </div>
          </div>
          <div class="card bg-light" style="border:none">
            <div class="card-body text-center">
              <dl>
                <dt>Position :</dt>
                <dd><dd><?php echo $position;?></dd></dd>
              </dl>
            </div>
          </div>

          <div class="card bg-light" style="border:none">
            <div class="card-body text-center">
              <dl>
                <dt>Department Name :</dt>
                <dd><dd><?php echo $cname;?></dd></dd>
              </dl>
            </div>
          </div>
          <div class="card bg-light" style="border:none">
            <div class="card-body text-center">
              <dl>
                <dt>Email :</dt>
                <dd><dd><?php echo $email;?></dd></dd>
              </dl>
            </div>
          </div>
    </div>
  </div>
</div>

<?php
  include_once("page.footer.php");
?>
