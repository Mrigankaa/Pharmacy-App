<!DOCTYPE html>
<html lang="en">

<head>
  <title>Pharmacy Management</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="js/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head>

<body class="layout-fixed">
  <aside class="main-sidebar sidebar-dark elevation-4" style="background-color: #1A132F;">
    <a href="dashboard.php" class="brand-link text-center">
      <img src="img/6.png" alt="AdminLTE Logo" class="">
      <h5>Medicine.com</h5>
    </a>
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="" class="nav-link">
            <i class="nav-icon fas fa-edit"></i>
            <p>
              POS
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="sell_med.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Sell Medicine</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="product.php" class="nav-link">
            <i class="nav-icon fas fa-edit"></i>
            <p>
              Medicine
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="product.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Medicine</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="manage_product.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Manage Medicine</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="gst.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>GST</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="rack.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Rack</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="category.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Category</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="" class="nav-link">
            <i class="nav-icon fas fa-edit"></i>
            <p>
              Suplier
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="manage_supplier.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Manage Supplier</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="" class="nav-link">
            <i class="nav-icon fas fa-edit"></i>
            <p>
              Customer
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="manage_customer.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Manage Customer</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="" class="nav-link">
            <i class="nav-icon fas fa-edit"></i>
            <p>
              Report
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="sell.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Sale Report</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Purchase Report</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="" class="nav-link">
            <i class="nav-icon fas fa-edit"></i>
            <p>
              Account
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="logout.php" class="nav-link">
                <p>Logout</p>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
    </div>
  </aside>

  <script src="js/jquery.js"></script>
  <script src="js/jquery-ui/jquery-ui.js"></script>
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <script src="dist/js/adminlte.js"></script>
</body>

</html>