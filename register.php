<?php
include_once("dbcon.php");
$error=false;
if(isset($_POST['btn-register']))
{
$username=test_input($_POST['username']);
$email=test_input($_POST['email']);
$password=test_input($_POST['password']);


if(empty($username)){
  $error=true;
  $errorUsername='please input username';
}elseif (!preg_match("/^[a-zA-Z ]*$/",$username)) {
$error=true;
      $errorUsername = "Only letters and white space allowed"; 
    }



if(!filter_var($email,FILTER_VALIDATE_EMAIL))
{
$error=true;
$errorEmail="please input a valid email";
} 


if(empty($password))
{
$error=true;
$errorPassword="please enter a password";
}elseif(strlen($password)<6)
{
  $error=true;
$errorPassword="please enter a password atleast 6 chars";
}

$password=md5($password);

if(!$error)
{
$sql="insert into tbl_users (username,email,password) values ('$username','$email','$password')";

if(mysqli_query($conn,$sql))
{
$successMessage='Register Successfully . <a href="index.php">click here to login</a>';
}else
{
echo "Error".mysqli_error($conn);
}
}

}


function test_input($data) {
  $data = trim($data);
  $data=strip_tags($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>PHP Register and Login Page</title>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div style="width: 500px;margin: 50px auto">

       <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
       <center><h2>Register</h2></center>
       <hr/>
       <?php
        if (isset($successMessage)){
       ?>

       <div class="alert alert-success">
       <span class="glyphicon glyphicon-info-sign"></span>
       <?php
       echo  $successMessage;
       ?>
         
         <?php 

         ?>
       </div>
       <?php

             }

       ?>

       
       <div class=form-group>
            <label for="Username" class="control-label">Username</label>
            <input type="text" name="username" class="form-control" autocomplete="off">
            <span class=text-danger><?php if (isset($errorUsername)) echo $errorUsername;?></span>
          </div>
          <div class=form-group>
          	<label for="email" class="control-label">Email</label>
          	<input type="email" name="email" class="form-control" autocomplete="off">
            <span class=text-danger><?php if(isset($errorEmail)) echo $errorEmail;?></span>
          </div>
          <div class="form-group">
          	<label for="password" class="control-label">Password</label>
          	<input type="password" name="password" class="form-control" autocomplete="off">
            <span class=text-danger><?php if(isset($errorPassword)) echo $errorPassword?></span>
          </div>
          <div>
          
          	<center><input type="submit" name="btn-register" value="Register" class="btn btn-primary"></center>
          </div>
          <hr/>
          <a href="index.php">Login</a>
                    
       </form>

    </div>

</div>
	
</body>
</html>