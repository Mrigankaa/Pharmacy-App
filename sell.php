<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pharmacy.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <?php
    require "connect.php";
    require "sidebar.php";
    ?>
    <div class="content-wrapper">
        <div class="container">
            <div class="card my-2">
                <div class="card-body">
                    <h3><i class=""></i>Sell Report</h3>
                    <hr class="p-0.5 text-danger mb-4">
                    <div class="container table-responsive">
                        <div class="modal fade" id="popUp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" id="show">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>Invoice Number</th>
                                    <th>Customer Name</th>
                                    <th>Date</th>
                                    <th>Actual Price</th>
                                    <th>Discount</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="table">
                                <?php
                                $sql = "SELECT * from invoices";
                                $r = mysqli_query($conn, $sql);
                                $index = 1;
                                while ($row = mysqli_fetch_array($r)) {
                                    $id = $row['invoice_id'];
                                    $c_id = $row['c_id'];
                                    $sql1 = "SELECT customer_name from customer where customer_id  = '$c_id'";
                                    $r1 = mysqli_query($conn, $sql1);
                                    $row1 = mysqli_fetch_assoc($r1);
                                ?>
                                    <tr>
                                        <td><?php echo $index; ?></td>
                                        <td><?php echo $row1['customer_name']; ?></td>
                                        <td><?php echo $row['invoice_date']; ?></td>
                                        <td><?php echo $row['total_amount']; ?></td>
                                        <td><?php echo $row['discount']; ?></td>
                                        <td id="price"><?php echo $row['net_total']; ?></td>
                                        <td><button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#popUp" onclick="view(<?php echo $id; ?>)">view</button></td>
                                    </tr>
                                <?php
                                    $index++;
                                }
                                ?>
                            </tbody>
                        </table>

                        <div class="float-right">
                            <h3 class="d-inline-block">Total: </h3>
                            <h3 class="d-inline-block text-success" id="total"></h3>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary">Print </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/dataTable.js"></script>
    <script>
        $(document).ready(function() {
            var grandTotal = 0;
            $("#table #price").each(function() {
                var total = parseFloat($(this).text());
                grandTotal = grandTotal + total;
                console.log(grandTotal);
                $("#total").text("₹" + grandTotal)
            })
        });

        function view(id) {
            $.ajax({
                url: "valid.php",
                type: "POST",
                data: {
                    id: id
                },
                success: function(data, status) {
                    $("#show").html(data);
                }
            })
        }
    </script>
</body>

</html>