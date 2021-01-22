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
    <script src="bootstrap.min.js"></script>

  </head>
  <body class="bg-light">
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <a href="admin"><img src="img_avatar.png" alt="Avatar" class="avatar" title="profile"></a>
          <a href="admin" class="navbar-brand"><?php include('session.php'); echo strtoupper($name);?></a>
        </div>
        <div id="main-navbar">
          <ul class="nav navbar-nav navbar-right">
            <li class="nav-item"><a class="nav-link" href="admin">Home</a></li>
            <li class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" id="toggle"><span class="bg-danger text-white count"></span>&nbsp;Notices</a>
              <div class="dropdown-menu">
                <div class="Mydropdown-menu" id="notices">
                </div>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="tt" data-toggle="dropdown">
                Timetables
              </a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="extra">Extra Lecture Record</a>
                <a class="dropdown-item" href="my_lectures">My Lectures</a>
                <a class="dropdown-item" href="all_tt">All timetables</a>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="notice" data-toggle-"tooltip" title="Create a new notice">Create Notice</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="forms" data-toggle="dropdown">
                Forms
              </a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="registration">Staff Registration</a>
                <a class="dropdown-item" href="class">Add New Class</a>
                <a class="dropdown-item" href="department">Add New Department</a>
                <a class="dropdown-item" href="attendance">Attendance Form</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="lists" data-toggle="dropdown">
                Lists
              </a>
              <div class="dropdown-menu">
                <a class="dropdown-item" data-toggle="tooltip" title="See the list of teachers" href="schedule">Teachers</a>
                <a class="dropdown-item" data-toggle="tooltip" title="See the Attendance list" href="tasks">My class</a>
            </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="graphs">Statistics</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active btn btn-sm btn-info m-1" href="logout">Log out</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
<script>$("#main-navbar").dynamicMenu();

$(document).ready(function(){
$('.count').hide();
 function load_unseen_notification(view = '')
 {
  $.ajax({
   url:"fetch.php",
   method:"POST",
   data:{view:view},
   dataType:"json",
   success:function(data)
   {
    $('#notices').html(data.notification);

    if(data.unseen_notification > 0)
    {
     $('.count').html(data.unseen_notification);
     $('.count').show();
    }
   }
  });
 }

 load_unseen_notification();

$(document).on('click', '#toggle', function(){
 $('.count').html('');
 load_unseen_notification('yes');
});

setInterval(function(){
 load_unseen_notification();
}, 5000);
});

</script>
