<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pharmacy.com</title>
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
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Medicine Name</th>
                                    <th>Batch Number</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody id="table">
                                <?php 
                                    $sql = "SELECT * from sales";
                                    $r = mysqli_query($conn,$sql);
                                    $index = 1;
                                    while($row = mysqli_fetch_array($r)){
                                ?>
                                <tr>
                                    <td><?php echo $index ?></td>
                                    <td><?php echo $row['med_name']; ?></td>
                                    <td><?php echo $row['batch_number']; ?></td>
                                    <td><?php echo $row['quantity']; ?></td>
                                    <td id="price"><?php echo $row['total']; ?></td>
                                    <td><?php echo $row['date']; ?></td>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery.js"></script>
    <script>
        $(document).ready(function(){
            var grandTotal = 0;
            $("#table #price").each(function(){
                var total = parseFloat($(this).text());
                grandTotal = grandTotal+total;
                console.log(grandTotal);
                $("#total").text("₹"+grandTotal)
            })
        })
    </script>
</body>
</html>