<?php
	session_start();
	include('connect.php');
	if($_SERVER["REQUEST_METHOD"] == "POST"){
 
		$email=$_POST['email'];
		$password=$_POST['password'];
 
		$query=mysqli_query($conn,"select * from `admin` where email='$email' and password='$password'");
		if (mysqli_num_rows($query)<1){
			$_SESSION['msg']="Login Failed, User not found!";
			header('location:index.php');
		}
		else{
			$row=mysqli_fetch_array($query);
			$_SESSION['id']=$row['id'];
			header('location: dashboard.php');
			}
		}
?>