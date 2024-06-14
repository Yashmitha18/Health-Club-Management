<?php

require('db.php');

$errors = array(); 
if (isset($_REQUEST['member'])) {

  $mem_id = mysqli_real_escape_string($conn, $_REQUEST['id']);
  $name = mysqli_real_escape_string($conn, $_REQUEST['name']);
  $age = mysqli_real_escape_string($conn, $_REQUEST['age']);
  $dob = mysqli_real_escape_string($conn, $_REQUEST['dob']);
  $package = mysqli_real_escape_string($conn, $_REQUEST['package']);
  $mobileno = mysqli_real_escape_string($conn, $_REQUEST['mobileno']);
  $pay_id = mysqli_real_escape_string($conn, $_REQUEST['pay_id']);
  $instructor_id = mysqli_real_escape_string($conn, $_REQUEST['instructor_id']);
  $class_id = mysqli_real_escape_string($conn, $_REQUEST['class_id']);
  
  
  
  $user_check_query = "SELECT * FROM member WHERE mem_id='$mem_id' LIMIT 1";
  $result = mysqli_query($conn, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { 
    if ($user['mem_id'] === $mem_id) {
      array_push($errors, "<div class='alert alert-warning'><b>ID already exists</b></div>");
    }
  }


  if (count($errors) == 0) {
  

    $query = "INSERT INTO member (mem_id,name,age,dob,package,mobileno,pay_id,instructor_id,class_id) VALUES('$mem_id','$name','$age','$dob','$package','$mobileno','$pay_id','$instructor_id','$class_id')";
    $sql=mysqli_query($conn, $query);
    if ($sql) {
    $msg="<div class='alert alert-success'><b>Member added successfully</b></div>";
    }else{
      $msg="<div class='alert alert-warning'><b>Member not added</b></div>";
    }
  }
}



?>






<div class="container">
	<form class="form-group mt-3" method="post" action="">
		<div><h3><b>ADD MEMBER</b></h3></div>
		 <?php include('errors.php'); 
    echo @$msg;

    ?>
		<label class="mt-3">MEMBER ID</label>
		<input type="text" name="id" class="form-control">
		<label class="mt-3">MEMBER NAME</label>
		<input type="text" name="name" class="form-control">
		<label class="mt-3">AGE</label>
		<input type="text" name="age" class="form-control">
		<label class="mt-3">DOB</label>
    <input type="date" name="dob" class="form-control">
		<label class="mt-3">PACKAGE</label>
		<input type="text" name="package" class="form-control">
		<label class="mt-3">MOBILE NO</label>
		<input type="text" name="mobileno" value="<?php echo @$res['mobileno'];?>" class="form-control" pattern="[0-9]{10}" title="Enter a valid 10-digit mobile number">
		<label class="mt-3">PAYMENT ID</label>
		<input type="text" name="pay_id" class="form-control">
		<label class="mt-3">INSTRUCTOR ID</label>
		<input type="text" name="instructor_id" class="form-control">
    <label class="mt-3">CLASS ID</label>
		<input type="text" name="class_id" class="form-control">
		<button class="btn btn-dark mt-3" type="submit" name="member"><b>ADD</b></button>
	</form>
</div>