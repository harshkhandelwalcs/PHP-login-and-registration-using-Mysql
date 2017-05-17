<?php
session_start();
include_once("dbcon.php");
$error=false;
if(isset($_POST['btn-Login']))
{

$email=test_input($_POST['email']);
$password=test_input($_POST['password']);





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

if(!$error)
{
$password=md5($password);
$sql="select * from tbl_users where email='$email'";
$result=mysqli_query($conn,$sql);
$count=mysqli_num_rows($result);
$rows=mysqli_fetch_assoc($result);
if($count==1 && $rows['password']==$password)
{
$_SESSION['username']=$rows['username'];
header('location:home.php');

}else{
	$errorMsg='Invalid Username or Password';
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
       <center><h2>Login</h2></center>
       <hr/>
       <?php
            if(isset($errorMsg))
            {
            ?>
            <div class="alert alert-danger">
            <span class="glyphicon glyphicon-info-sign">

            </span>
            <?php
            echo $errorMsg;
            ?>

            </div>
            <?php
            }

       ?>
          <div class=form-group>
          	<label for="email" class="control-label">Email</label>
          	<input type="email" name="email" class="form-control" autocomplete="off">
          	 <span class=text-danger><?php if(isset($errorEmail)) echo $errorEmail;?></span>
          </div>
          <div class="form-group">
          	<label for="password" class="control-label">Password</label>
          	<input type="password" name="password" class="form-control" autocomplete="off">
          	 <span class=text-danger><?php if(isset($errorPassword)) echo $errorPassword;?></span>
          </div>
          <div>
          	<center><input type="submit" name="btn-Login" value="Login" class="btn btn-primary"></center>
          </div>
          <hr/>
          <a href="register.php">Register</a>
                    
       </form>

    </div>

</div>
	
</body>
</html>

