<?php
    include "connect.php";    
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        extract($_POST);
        if(isset($_POST['med_name']) && isset($_POST['batch_number']) && isset($_POST['quantity'])){
            $med_name = $_POST['med_name'];
            $batch_number = $_POST['batch_number'];
            $quantity = $_POST['quantity'];
            $date = date('Y-m-d');
            for($count = 0; $count < count($med_name); $count++){
                $q= "INSERT INTO sales(med_name,batch_number,quantity,date) values('$med_name[$count]','$batch_number[$count]','$quantity[$count]','$date')";
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
            <div class="form-check d-inline ml-2 m-3">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                <label class="form-check-label" for="flexRadioDefault1">
                    Existing Customer
                </label>
            </div>                
            <div class="form-check d-inline m-4">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                <label class="form-check-label" for="flexRadioDefault2">
                    New Customer
                </label>
            </div>
            <div id="showExisting" class="col-md-2 mt-4">
                <select class="form-control">
                    <option value="">Select Customer</option>
                    <?php 
                        $sql = "SELECT customer_name from customer";
                        $r = mysqli_query($conn,$sql);       
                        while($row = mysqli_fetch_assoc($r)){?>
                        <option value="<?php echo $row["customer_name"]; ?>"><?php echo $row["customer_name"]; ?></option>
                    <?php }?>
                </select>
            </div>
            <div id="showForm" class="mt-4 m-2">
                <div class="row">
                    <form action="manage_customer.php" method="post">
                        <label>Customer Name</label>
                        <input type="text" name="c_name" class="form-control col-md-6" placeholder="Name" required>
                        <label>Contact Number</label>
                        <input type="text" name="c_phone" class="form-control col-md-6" placeholder="Contact Number">
                        <label for="">Previous Pay</label>
                        <input type="text" name="pre_pay" class="form-control col-md-6" placeholder="Previous Pay">
                        <label>Customer Address</label>
                        <textarea name="c_address" class="form-control col-md-6" placeholder="Address"></textarea>
                        <label>Doctor's Name</label>
                        <input type="text" name="d_name" class="form-control col-md-6" placeholder="Doctor's Name">
                        <label>Doctor's Address</label>
                        <textarea name="d_address" class="form-control col-md-6" placeholder="Doctor's Address"></textarea>
                        <input type="submit" class="btn btn-info my-2" value="Add">
                    </form>
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
               <hr class="p-0.5 text-success mt-5"> 
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
                <button class="btn btn-success float-right" id="save" onclick="makeBill()">Make Bill</button>
            </div>
        </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> 
    <script src="js/jquery.js"></script>
    <script src="js/html2pdf.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.13.216/pdf.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#showForm").hide();
            $("#showExisting").hide();
        });

        $("#flexRadioDefault1").on("click",function(){
            $("#showExisting").show();
            $("#showForm").hide();   
        });
                
        $("#flexRadioDefault2").on("click",function(){
            $("#showForm").show();
            $("#showExisting").hide();
        });

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

        // function deleteRecord(){
        //     $("#myTable").on("click","tr",function(){
        //         var item = $(this).find("#item").text();
        //         var selectItem = arr.indexOf(item);
        //         if(selectItem!==-1){
        //             arr.splice(selectItem,1);
        //         }
        //         console.log(arr);
        //         $(this).remove(); 
        //     })
        // }


        $("#save").click(function(){
            med_name = [];
            batch_number = [];
            quantity = [];
            $("#row #item").each(function(){
                med_name.push($(this).text());
            });
            $("#row #batchNumber").each(function(){
                batch_number.push($(this).text());
            });
            $("#row #qunatity").each(function(){
                quantity.push($(this).val());
            });
            
            console.log(med_name);
            
            $.ajax({
                url:"sell_med.php",
                type:"post",
                data:{
                    med_name:med_name,
                    batch_number:batch_number,
                    quantity:quantity
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

        function makeBill(){
            const element = $("#myTable");

            html2pdf()
            .form(element)
            .save();
        }
    </script>
</body>
</html>
