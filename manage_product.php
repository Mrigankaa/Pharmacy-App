<?php
require("checkLogin.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $hsn = $_POST['hsn'];
    $p_price = $_POST['p_price'];
    $s_price = $_POST['s_price'];
    $quantity = $_POST['quantity'];
    $gst = $_POST['gst'];
    $cat = $_POST['category'];
    $batch = $_POST['batch'];
    $rack = $_POST['rack'];
    $supplier = $_POST['supplier'];
    $e_date = $_POST['e_date'];
    $m_date = $_POST['m_date'];

    $sql = "SELECT gst_id FROM gst where gst_amount = '$gst'";
    $r = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($r);
    $gst_id = $row['gst_id'];

    $sql = "SELECT rack_id FROM rack where rack_number = '$rack'";
    $r = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($r);
    $rack_id = $row['rack_id'];

    $sql = "SELECT cat_id FROM category where cat_type = '$cat'";
    $r = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($r);
    $cat_id = $row['cat_id'];

    $sql = "SELECT s_id from supplier where s_name = '$supplier'";
    $r = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($r);
    $s_id = $row['s_id'];


    $sql = "INSERT INTO medicine(med_name,HSN_number,purchase_price,sell_price,quantity,menufature_date,expiry_date,batch_number,gst_id,cat_id,rack_id,supplier_id)
                VALUES('$name','$hsn','$p_price','$s_price','$quantity','$m_date','$e_date','$batch','$gst_id','$cat_id','$rack_id','$s_id')";
    $r = mysqli_query($conn, $sql);
}

if (isset($_POST['deleteId'])) {
    $deleteId = $_POST['deleteId'];
    $sql = "DELETE FROM medicine WHERE med_id = '$deleteId'";
    $r = mysqli_query($conn, $sql);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Medicine.php</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php
    require "sidebar.php";
    ?>
    <div class="content-wrapper">
        <div class="container">
            <div class="card my-2">
                <div class="card-body">
                    <h3>Manage Medicine</h3>
                    <hr class="p-0.5 text-danger mb-4">
                    <div class="col-md-3">
                        <label>Search:</label>
                        <input type="text" id="search" class="form-control" placeholder="Search Medicine">
                        <button class="btn btn-primary btn-sm my-2">Search</button>
                    </div>
                    <div class="col-md-3 my-2">
                        <a href="product.php" class="text-success">+ Add New Medicine</a>
                    </div>
                    <hr class="p-0.5 text-danger mb-4">
                    <div id="displayData">

                    </div>
                    <div id="pagination">
                        <a id="previous" href="" class="btn btn-light">Previous</a>
                        <a id="next" href="" class="btn btn-light">Next</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php require "footer.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.js"></script>
    <script>
        $(document).ready(function() {
            displayData();
        })

        function displayData() {
            var display = "true";

            $.ajax({
                url: "valid_med.php",
                type: "post",
                data: {
                    display: display
                },
                success: function(data, status) {
                    $("#displayData").html(data);
                }
            })
        }

        function deleteMedicine(deleteId) {
            if (confirm("Are you sure?")) {
                $.ajax({
                    url: "manage_product.php",
                    type: "post",
                    data: {
                        deleteId: deleteId
                    },
                    success: function(data, status) {
                        displayData();
                    }
                })
            }
        }

        $("#search").on("keyup", function() {
            var search = $(this).val();
            $.ajax({
                url: "valid_med.php",
                type: "post",
                data: {
                    search: search
                },
                success: function(data, status) {
                    $("#displayData").html(data);
                }
            })
        });
    </script>
</body>

</html>