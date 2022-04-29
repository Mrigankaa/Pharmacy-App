<?php
	session_start();
	include('connect.php');
 
	if (isset($_SESSION['id'])){
		header('location:dashboard.php');
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pharmacy Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Smooch+Sans:wght@400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body style="background-color: #FFF6EA; font-family: 'Smooch Sans', sans-serif;">
<div class="container text-center mt-5" style="height: 550px; width: 350px;">
    <i class="fa fa-medkit mt-5" style="font-size:50px;"></i>
    <div class="card card-body mt-1">
      <h1 class="text-danger">PHARMACY</h1>
      <h3 style="text-align:center;">Login</h3>
    <p style="text-align:center;" class="login-box-msg">Sign in to start your session</p>
    <form action="validlogin.php" method="post">    
      <div class="input-group mb-3">
        <input type="email" name="email" class="form-control" placeholder="Email">
      </div>
      <div class="input-group mb-3">
        <input type="password" name="password" class="form-control" placeholder="Password">
      </div>
      <button type="submit" class="btn btn-info btn-sm btn-block">Sign In</button>
    </form>
    </div>    
</div>
</body>
</html>


<!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
    </div>
</div> -->