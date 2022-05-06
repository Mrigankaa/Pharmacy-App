<?php 
    include("connect.php");

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(isset($_POST['aemail'])){
            $name = $_POST["aname"];
            $email = $_POST["aemail"];
            $phone = $_POST["aphone"];
            $address = $_POST["aaddress"];
            
            $query = "INSERT INTO supplier(s_name,s_email,s_phone,s_address) VALUES('$name','$email','$phone','$address')";
            $result = mysqli_query($conn,$query);
        }
    }
    if(isset($_POST['deleteId'])){
        $deleteId = $_POST['deleteId'];
        $sql = "DELETE FROM supplier WHERE s_id = '$deleteId'";
        $r = mysqli_query($conn,$sql);
    }
    
    if(isset($_POST['updateId'])){
        $id = $_POST['updateId'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['number'];
        $address = $_POST['address'];

        $sql = "UPDATE supplier SET s_name = '$name',s_email = '$email', s_phone = '$phone', s_address='$address'
                WHERE s_id='$id'";
        $r = mysqli_query($conn,$sql);
    }
        
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" >

</head>
<body>
    <?php
        require "sidebar.php";
    ?>
        <div class="content-wrapper">
            <div class="container">
                <div class="card my-2">
                    <div class="card-body">
                    <h3>Manage Supplier</h3>
                    <hr class="p-0.5 text-danger mb-4">
                    <div class="col-md-3">
                        <label>Search:</label>
                        <input type="text" id="search" class="form-control" placeholder="Search Supplier">
                        <button class="btn btn-primary btn-sm my-2">Search</button>
                    </div>
                    <div class="col-md-3 my-2">
                        <a href="supplier.php" class="text-success" data-bs-toggle="modal" data-bs-target="#supplierModel">+ Add New Supplier</a>
                    </div>
                    <div class="modal fade" id="supplierModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Supplier</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                            <label>Supplier Name</label>
                            <input type="text" id="a_name" class="form-control" placeholder="Name">
                            <label>Supplier Email</label>
                            <input type="email" id="a_email" class="form-control" placeholder="Email">
                            <label>Supplier Phone</label>
                            <input type="number" id="a_phone" class="form-control" placeholder="Phone">
                            <label>Supplier Address</label>
                            <textarea id="a_address" class="form-control" placeholder="Address"></textarea>
                            </div>
                            <div>
                                <button class="btn btn-info" onclick="addSupplier()">Add Supplier</button>
                                <input type="hidden" id="hidden">
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>   
                    <hr class="p-0.5 text-danger mb-4">
                    <div id="displayData"></div>
                    </div>
                </div> 
                <div class="modal fade" id="updateSupplier" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Supplier</h5>
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.js"></script>
    <script>

        $(document).ready(function(){
            displayData();
        })

        function deleteSupplier(deleteId){
            if(confirm("Are you sure?")){
                $.ajax({
                    url:"manage_supplier.php",
                    type:"post",
                    data:{deleteId:deleteId},
                    success:function(data,status){
                        displayData();
                        
                    }
                })
            }
        }

        function addSupplier(){
            var aname = $("#a_name").val();
            var aemail = $("#a_email").val();
            var anumber = $("#a_phone").val();
            var aaddress = $("#a_address").val();

            $.ajax({
                url:"manage_supplier.php",
                type:"post",
                data:{  
                    aname:aname,
                    aemail:aemail,
                    anumber:anumber,
                    aaddress:address
                },
                success:function(data,status){
                    displayData();
                    $("#supplierModel").modal("hide");
                }
            })
        }

        function getDetails(editId){
            $("#hidden").val(editId);
            $("#updateSupplier").modal("show");
        }

        function updateDetails(){
            var name = $("#s_name").val();
            var email = $("#s_email").val();
            var number = $("#s_phone").val();
            var address = $("#s_address").val();
            var hiddenId = $("#hidden").val();

            $.post(
                "manage_supplier.php",
                {
                    name:name,
                    email:email,
                    number:number,
                    address:address,
                    updateId:hiddenId
                },
                function(data,status){
                    displayData();
                    $("#updateSupplier").modal("hide");
                }
            )
        }

        function displayData(){
            var display = "true";

            $.ajax({
                url:"valid_supplier.php",
                type:"post",
                data:{display:display},
                success:function(data,status){
                    $("#displayData").html(data);
                }
            })
        }
        $("#search").on("keyup",function(){
            var search = $(this).val();
            
            $.ajax({
                url:"valid_supplier.php",
                type:"post",
                data:{searchItem:search},
                success:function(data,status){
                    $("#displayData").html(data);
                }
            })
        })

    </script>
</body>
</html>