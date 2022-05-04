<?php
    include "connect.php";    
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        extract($_POST);
        if(isset($_POST['med_name']) && isset($_POST['batch_number']) && isset($_POST['quantity']) && isset($_POST['total'])){
            $med_name = $_POST['med_name'];
            $batch_number = $_POST['batch_number'];
            $quantity = $_POST['quantity'];
            $total = $_POST['total'];
            $date = date('Y-m-d');
            for($count = 0; $count < count($med_name); $count++){
                $q= "INSERT INTO sales(med_name,batch_number,quantity,total,date) values('$med_name[$count]','$batch_number[$count]','$quantity[$count]','$total[$count]','$date')";
                $r = mysqli_query($conn,$q);
                $s = "UPDATE medicine SET quantity = quantity-'$quantity[$count]' Where med_name = '$med_name[$count]' AND batch_number = '$batch_number[$count]'";
                $r1 = mysqli_query($conn,$s);
            }    
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pharmacy.com</title>
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
                <h3><i class="bi bi-cart-plus-fill"></i> Manage Sell</h3>
                <hr class="p-0.5 text-danger mb-4">               
            <div id="showExisting" class="mt-4 d-inline-block">
                <select class="form-control" id="customer">
                    <option value="">Select Exising</option>
                    <?php 
                        $sql = "SELECT customer_name from customer";
                        $r = mysqli_query($conn,$sql);       
                        while($row = mysqli_fetch_assoc($r)){?>
                        <option value="<?php echo $row["customer_name"]; ?>"><?php echo $row["customer_name"]; ?></option>
                    <?php }?>
                </select>
            </div>
            <div class="m-2 d-inline-block">
                <button type="button" class="btn btn-sm btn-primary" style="height: 37px;" data-bs-toggle="modal" data-bs-target="#addCustomer">
                    New Customer
                </button>
            </div>
            <div class="mt-2" id="showCustomer">
            </div>
            <div class="col col-md-12 table-responsive">
            <div id="print_content" class="table-responsive">
            	<table class="table table-bordered table-striped table-hover" id="sales_report_div">
                    
            	</table>
            </div>
          </div>
            <div class="modal fade" id="addCustomer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-4 m-2">
                            <label>Customer Name</label>
                            <input type="text" name="c_name" id="c_name" class="form-control" placeholder="Name" required>
                            <label>Contact Number</label>
                            <input type="text" name="c_phone" class="form-control" placeholder="Contact Number">
                            <label for="">Previous Pay</label>
                            <input type="text" name="pre_pay" class="form-control" placeholder="Previous Pay">
                            <label>Customer Address</label>
                            <textarea name="c_address" class="form-control" placeholder="Address"></textarea>
                            <label>Doctor's Name</label>
                            <input type="text" name="d_name" class="form-control" placeholder="Doctor's Name">
                            <label>Doctor's Contact Number</label>
                            <input type="text" name="d_address" class="form-control" placeholder="Doctor's Contact Information">
                            <button class="btn btn-info mt-2" onclick="addCustomer()">Add</button>            
                    </div>
                </div>
                </div>
            </div>
            </div>
            <hr class="p-0.5 text-danger mb-4">
            <div class="d-inline-block mr-5">
                <select class="form-control" id="name">
                   <option id="option" value="empty">Select Medicine</option>
               <?php 
                   $sql = "SELECT med_name FROM medicine";
                   $r = mysqli_query($conn,$sql);
                   while($row=mysqli_fetch_array($r)){
               ?>
                   <option value='<?php echo $row['med_name']; ?>'><?php echo $row['med_name']; ?></option>
               <?php } ?>
               </select>
            </div>
            <div class="d-inline-block" id="batch"></div>
               <div class="mt-2">
               <table class="table table-bordered text-center" id="myTable">
                <thead>
                    <tr>
                        <th>Medicine Name</th>
                        <th>Batch Number</th>
                        <th>Aval. Quant.</th>
                        <th>Expiry</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>GST</th>
                        <th>Rack</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="row">
                </tbody>
               </table>
               </div>
               <hr class="p-0.5 text-info mt-5"> 
               <div>
                    <div class="d-inline-block">
                        <h5>Grand Total</h5>
                        <input type="text" class="form-control col-md-8 text-center" id="grand" readonly>
                    </div>
                    <div class="d-inline-block mt-4">
                        <h6>Paid Amount:</h6>
                        <input type="text" class="form-control mt-2 col-md-8" id="paid">
                    </div>
                    <div class="d-inline-block">
                        <h6>Change:</h6>
                        <input type="text" class="form-control col-md-4 text-center" id="change" readonly> 
                    </div>   
                    
                </div>
                <button class="btn btn-success float-right" id="save" onclick="makeBill('Bill')">Make Bill</button>
            </div>
        </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> 
    <script src="js/jquery.js"></script>
    <script src="js/sweetAlert.js"></script>
    <!-- <script src="js/makePdf.js"></script> -->
    <script>

        function getDate(){
            var date = new Date();
            $("#date").val(date);
        }

        $("#customer").change(function(){
            var customer = $(this).val();
            
            $.ajax({
                url:"valid_sell_med.php",
                type:"post",
                data:{customer:customer},
                success:function(data,status){
                    $("#showCustomer").html(data);
                }
            })
        })
        var arr = [];

        $("#name").change(function(){            
            var name = $(this).val();
            var option = $("#option").val();
            if(name==option){
                swal({
                    title: "Choose A Medicine",
                    icon: "warning",
                });
            }else{
                $.ajax({
                url:"valid_sell_med.php",
                type:"post",
                data:{name:name},
                success:function(data,status){
                    $("#batch").html(data);
                    $("#hello").change(function(){
                        var batch = $(this).val();
                        var value = $("#null").val();
                        if(batch==value){
                            swal({
                                title: "Choose Batch",
                                icon: "warning",
                            });
                        }else{
                            $.ajax({
                                url:"valid_sell_med.php",
                                type:"post",
                                data:{name:name,batch:batch},
                                success:function(data,status){
                                    if(arr.includes(name)){
                                        swal({
                                            title: "Already Adeed",
                                            icon: "warning",
                                            timer: 1000
                                        });
                                    }else{
                                        arr.push(name);
                                        $("#row").append(data);                              
                                    }
                                }
                            });
                        }
                    });
                }
            });
            }  
        });
            
        $("#myTable").on("input","tr", function(){
            var c = $(this).find("#qunatity").val();
            var b = $(this).find("#price").text();
            var total = b*c;
            $(this).find("#total").text(total);
            var grandTotal = 0;
            $("#row #total").each(function(){ 
                var get_value = parseInt($(this).text());
                grandTotal = grandTotal+get_value;
            });
            $("#grand").val(grandTotal);
        });

        function deleteRecord(med_name){
            var selectItem = arr.indexOf(med_name);
            if(selectItem!==-1){
                arr.splice(selectItem,1);
            }  
            
        }


        $("#save").click(function(){
            med_name = [];
            batch_number = [];
            quantity = [];
            total = [];
            $("#row #item").each(function(){
                med_name.push($(this).text());
            });
            $("#row #batchNumber").each(function(){
                batch_number.push($(this).text());
            });
            $("#row #qunatity").each(function(){
                quantity.push($(this).val());
            });
            $("#row #total").each(function(){
                total.push($(this).text());
            });
            
            console.log(med_name);
            console.log(total);
            
            $.ajax({
                url:"sell_med.php",
                type:"post",
                data:{
                    med_name:med_name,
                    batch_number:batch_number,
                    quantity:quantity,
                    total:total
                },
                success:function(data,status){
                    alert("Data Saved Successfully");
                }
            });            
        })

        $("#paid").on("keyup", function(){
            var paid = $(this).val();
            var grandTotal = $("#grand").val();
            var change = grandTotal-paid;
            $("#change").val(change);
        });
    </script>
</body>
</html>

