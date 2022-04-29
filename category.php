<?php
    include("connect.php");
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        extract($_POST);
        if(isset($_POST['cat_type'])){
            $sql = "INSERT INTO category(cat_type) VALUES('$cat_type')";
            $r = mysqli_query($conn,$sql);
        }
        if(isset($_POST['deleteSend'])){
            $id = $_POST['deleteSend'];
            $sql = "DELETE FROM category WHERE cat_id = $id";
            $r = mysqli_query($conn,$sql);
        } 
        if(isset($_POST['hiddenId'])){
            $hiddenId = $_POST['hiddenId'];
            $category = $_POST['editCategory'];
            $sql = "UPDATE category SET cat_type = '$category' WHERE cat_id = '$hiddenId'";
            $r = mysqli_query($conn,$sql);
        }       
    } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pharmacy Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php require "sidebar.php"; ?>
    <div class="content-wrapper">
    <div class="container">
        <div class="card my-2">
            <div class="card-body">
            <h3>Manage Category</h3>
            <hr class="p-0.5 text-danger mb-4">
                <div id="displayCategory"></div>
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#categoryModal">
                    Add Category
                </button>
            </div>
        </div>
    </div>
    <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label class="col-form-label">Category Type</label>
                <input type="text" id="category" class="form-control">
            </div>
            <input type="submit" class="btn btn-info" onclick="addCategory()" value="Add">
        </div>
        </div>
    </div>
    </div>
    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label class="col-form-label">Category Type</label>
                <input type="text" id="editCategory" class="form-control">
            </div>
            <input type="submit" class="btn btn-info" onclick="updateCategory()" value="Update">
            <input type="hidden" id="hiddenData">
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
        });

        function displayData(){
            var display = "true";

            $.ajax({
                url:'valid.php',
                type:'post',
                data:{
                    sendCategory:display
                },
                success:function(data,status){
                    $("#displayCategory").html(data);
                }
            })
        }
        function addCategory(){
            var type = $("#category").val();

            $.ajax({
                url:'category.php',
                type:'post',
                data:{
                    cat_type:type
                },
                success:function(data,status){
                    ('#categoryModal').modal('hide');
                    displayData();
                }
            });
        }

        function deleteCategory(deleteId){
            if(confirm("Are you sure?")){
                $.ajax({
                url:'category.php',
                type:'post',
                data:{
                    deleteSend:deleteId
                },
                success:function(data,status){
                    displayData()
                }
            });
            }
        }

        function editCategory(editId){
            $("#editCategoryModal").modal('show');
            $("#hiddenData").val(editId);
        }

        function updateCategory(){
            var hiddenId = $("#hiddenData").val();
            var editCategory = $("#editCategory").val();
        
            $.post(
                "category.php",
                {editCategory:editCategory,hiddenId:hiddenId},
                function(data,status){
                    $("#editCategoryModal").modal('hide');
                    displayData();
                }
            )
        }
    </script>
</body>
</html>
