<?php
include 'session.php';
include 'ch_teacher.php';
include_once('principal.header.php');
$sqlErr = "";
?>

<div class="container text-center">
  <div class="card shadow mt-4">
    <div class="card-header">
      <h2 class="card-text">Create Notice</h2>
    </div>
    <div class="card-body">
      <form method="post" id="comment_form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text bg-dark text-white">Enter Subject</span>
          </div>
          <input class="form-control" name="subject" type="text" id="subject" required>
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text bg-dark text-white">Select Date</span>
          </div>
          <input class="form-control" name="date" type="text" id="datepicker" placeholder="Click here" required>
        </div>
        <div class="input-group mb-3">
          <textarea class="form-control" name="comment" rows="10" id="comment" placeholder="Enter the notice here" required></textarea>
        </div>
        <div class="btn-group mt-3">
          <input type="submit" id="post" value="submit" class="btn  btn-success">
          <a href="notice" class="btn  btn-primary">Reset</a>
        </div>
        <div class="mt-3">
          <span id="error">Notice Sent Successfully</span>
        </div>
      </form>
    </div>
    <div class="card-footer">
      <p class="card-text">The notice will be sent to <strong class="text-warning">All Teachers</strong>.</p>
    </div>
  </div>
</div>

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
$('#error').hide();
 $('#comment_form').on('submit', function(event){
  event.preventDefault();
  if($('#subject').val() != '' && $('#comment').val() != '' && $('#datepicker').val() != '')
  {
   var form_data = $(this).serialize();
   $.ajax({
    url:"insert.php",
    method:"POST",
    data:form_data,
    success:function(data)
    {
     $('#comment_form')[0].reset();
     $('#error').show();
     load_unseen_notification();
    }
   });
  }
  else
  {
   alert("All Fields are Required");
  }
 });

});
</script>
