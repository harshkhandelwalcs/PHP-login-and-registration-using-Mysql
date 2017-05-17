<?php
session_start();
if(!isset($_SESSION['username']))
{
  header('location:index.php');
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
<a href="logout.php">Logout</a>
    <div style="width: 500px;margin: 50px auto">
<h3>Welcome <?php echo $_SESSION['username'];?></h3>
       

    </div>

</div>
	
</body>
</html>

