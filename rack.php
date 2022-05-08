<?php
include("connect.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    extract($_POST);
    if (isset($_POST['number'])) {
        $sql = "INSERT INTO rack(rack_number) VALUES('$number')";
        $r = mysqli_query($conn, $sql);
    }
    if (isset($_POST['deleteSend'])) {
        $id = $_POST['deleteSend'];
        $sql = "DELETE FROM rack WHERE rack_id = $id";
        $r = mysqli_query($conn, $sql);
    }
    if (isset($_POST['hiddenId'])) {
        $uniqueId = $_POST['hiddenId'];
        $rack_number = $_POST['rackNumber'];
        $sql = "UPDATE rack SET rack_number = '$rack_number' WHERE rack_id = '$uniqueId'";
        $r = mysqli_query($conn, $sql);
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
                    <h3>Manage Rack</h3>
                    <hr class="p-0.5 text-danger mb-4">
                    <div id="displayRack"></div>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#rackModel">
                        Add Rack
                    </button>
                </div>
            </div>
        </div>
        <div class="modal fade" id="rackModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Rack</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="col-form-label">Rack Number</label>
                            <input type="text" id="number" class="form-control">
                        </div>
                        <input type="submit" class="btn btn-info" onclick="addRack()" value="Add">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="updateRack" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Rack</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="col-form-label">Update Rack Number</label>
                            <input type="text" id="rack" class="form-control">
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.js"></script>
    <script>
        $(document).ready(function() {
            displayData();
        });

        function displayData() {
            var display = "true";

            $.ajax({
                url: 'valid.php',
                type: 'post',
                data: {
                    sendRack: display
                },
                success: function(data, status) {
                    $("#displayRack").html(data);
                }
            })
        }

        function addRack() {
            var number = $("#number").val();
            $.ajax({
                url: 'rack.php',
                type: 'post',
                data: {
                    number: number
                },
                success: function(data, status) {
                    $("#rackModal").modal('hide');
                    displayData();
                }
            });
        }

        function deleteRack(deleteId) {
            if (confirm("Are you sure?")) {

                $.ajax({
                    url: 'rack.php',
                    type: 'post',
                    data: {
                        deleteSend: deleteId
                    },
                    success: function(data, status) {
                        displayData();
                    }
                });
            }
        }

        function editRack(editId) {
            $("#hidden").val(editId);
            $("#updateRack").modal("show");
        }

        function updateDetails() {
            var rackNumber = $("#rack").val();
            var hiddenId = $("#hidden").val();
            $.post(
                "rack.php", {
                    rackNumber: rackNumber,
                    hiddenId: hiddenId
                },
                function(data, status) {
                    $("#updateRack").modal('hide');
                    displayData();
                })
        }
    </script>
</body>

</html>