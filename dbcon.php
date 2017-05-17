<?php 
$servername='localhost';
$username='root';
$password='';
$db='testapp';

$conn=mysqli_connect($servername,$username,$password,$db);

if(!$conn)
{
	echo "Connection error".mysqli_connect_error();

}


?>