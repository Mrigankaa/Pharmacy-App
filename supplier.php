<?php 
    include("connect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php require 'sidebar.php';?>
    <div class="content-wrapper">
        <div class="container">
            <div class="card my-2">
                <div class="card-body">
                <h3><i class="bi bi-person-lines-fill"></i> Add Supplier</h3>
                <hr class="p-0.5 text-danger mb-4">
                    <div class="row">
                    <form action="manage_supplier.php" method="post">
                        <label>Supplier Name</label>
                        <input type="text" name="s_name" class="form-control col-md-6" placeholder="Name">
                        <label>Supplier Email</label>
                        <input type="email" name="s_email" class="form-control col-md-6" placeholder="Email">
                        <label>Supplier Phone</label>
                        <input type="number" name="s_phone" class="form-control col-md-6" placeholder="Phone">
                        <label>Supplier Address</label>
                        <textarea name="s_address" class="form-control col-md-6" placeholder="Address"></textarea>
                        <input type="submit" class="btn btn-info my-2" value="Add">
                    </form>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</body>
</html>