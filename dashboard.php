<?php
	session_start();
  include "connect.php";
	if (!isset($_SESSION['id']) ||(trim ($_SESSION['id']) == '')) {
		header('location:index.php');
		exit();
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Pharmacy Management</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <?php require "sidebar.php";?> 
  <div class="content-wrapper">
    <div class="container">
      <div class="card my-2">
          <div class="card-body">
            <h3><i class="bi bi-speedometer2"></i> DASHBOARD</h3>
            <hr class="p-0.5 text-danger mb-4">
            <div class="row">
            <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3>Sells<sup style="font-size: 20px"></sup></h3>
                <p>Total Sells</p>
              </div>
              <div class="icon">
                <i class="fas fa-chart-line"></i>
              </div>
              <a href="#" class="small-box-footer">See Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            </div>
            <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3>Medicines<sup style="font-size: 20px"></sup></h3>
                <p>Total Medicine</p>
              </div>
              <div class="icon">
                <i class="fa fa-medkit"></i>
              </div>
              <a href="manage_product.php" class="small-box-footer">See Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            </div>
            <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>Supplier<sup style="font-size: 20px"></sup></h3>
                <p>Total Supplies</p>
              </div>
              <div class="icon">
                <i class="far fa-address-book"></i>
              </div>
              <a href="#" class="small-box-footer">See Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            </div>
            <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>53<sup style="font-size: 20px">%</sup></h3>
                <p>Bounce Rate</p>
              </div>
              <div class="icon">
                <i class=""></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            </div>
            <div class="col-lg-3 col-6">
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>Report<sup style="font-size: 20px"></sup></h3>
                <p>Report Progress</p>
              </div>
              <div class="icon">
                <i class="fa fa-file"></i>
              </div>
              <a href="#" class="small-box-footer">See Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            </div>
            </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</body>
</html>
