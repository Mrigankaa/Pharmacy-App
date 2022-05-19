<?php
require("checkLogin.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $c_name = $_POST['c_name'];
    $c_number = $_POST['c_phone'];
    $previous_pay = $_POST['pre_pay'];
    $c_address = $_POST['c_address'];
    $d_name = $_POST['d_name'];
    $d_address = $_POST['d_address'];

    $sql = "INSERT into customer(customer_name, previous_pay, phone_number, address, doctor_name, doctor_address)
         VALUES('$c_name','$previous_pay','$c_number','$c_address','$d_name','$d_address')";
    $r = mysqli_query($conn, $sql);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Medicine.com</title>
</head>

<body>
    <?php
    require "sidebar.php";
    ?>
    <div class="content-wrapper">
        <div class="container">
            <div class="card my-2">
                <div class="card-body">
                    <h3><i class="bi bi-people-fill"></i> Manage Customer</h3>
                    <hr class="p-0.5 text-danger mb-4">
                    <div class="col-md-3">
                        <label>Search:</label>
                        <input type="text" id="search" class="form-control" placeholder="Search Customer">
                    </div>
                    <hr class="p-0.5 text-danger mb-4">
                    <div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Doctor Name</th>
                                    <th>Doctor's Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * from customer";
                                $r = mysqli_query($conn, $sql);
                                $index = 1;
                                while ($row = mysqli_fetch_array($r)) {
                                ?>
                                    <tr>
                                        <td><?php echo $index; ?></td>
                                        <td><?php echo $row['customer_name']; ?></td>
                                        <td><?php echo $row['phone_number']; ?></td>
                                        <td><?php echo $row['address']; ?></td>
                                        <td><?php echo $row['doctor_name']; ?></td>
                                        <td><?php echo $row['doctor_address']; ?></td>
                                        <td><button class="btn btn-danger btn-sm">Delete</button></td>
                                    </tr>
                                <?php
                                    $index++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="updateSupplier" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Customer</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label>Update Supplier Name</label>
                                <input type="text" id="s_name" class="form-control" placeholder="Name">
                                <label>Update Supplier Email</label>
                                <input type="email" id="s_email" class="form-control" placeholder="Email">
                                <label>Update Supplier Phone</label>
                                <input type="number" id="s_phone" class="form-control" placeholder="Phone">
                                <label>Update Supplier Address</label>
                                <textarea id="s_address" class="form-control" placeholder="Address"></textarea>
                            </div>
                            <div>
                                <button class="btn btn-info" onclick="updateDetails()">Update</button>
                                <input type="hidden" id="hidden">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery.js"></script>
    <script></script>
</body>

</html>