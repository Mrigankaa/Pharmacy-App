<?php
include("connect.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    extract($_POST);
    if (isset($_POST['gst_amount'])) {
        $sql = "INSERT INTO gst(gst_amount) VALUES('$gst_amount')";
        $r = mysqli_query($conn, $sql);
    }
    if (isset($_POST['deleteSend'])) {
        $id = $_POST['deleteSend'];
        $sql = "DELETE FROM gst WHERE gst_id = $id";
        $r = mysqli_query($conn, $sql);
    }
    if (isset($_POST['uniqueId'])) {
        $unqueId = $_POST['uniqueId'];
        $amount = $_POST['amount'];

        $sql = "UPDATE gst SET amount='$amount' WHERE gst_id = $unqueId";
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
                    <h3>Manage GST</h3>
                    <hr class="p-0.5 text-danger mb-4">
                    <div id="displayData"></div>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#gstModel">
                        Add GST
                    </button>
                </div>
            </div>
        </div>
        <div class="modal fade" id="gstModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add GST</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="col-form-label">GST Amount</label>
                            <input type="number" id="amount" class="form-control">
                        </div>
                        <input type="submit" class="btn btn-info" onclick="addGst()" value="Add">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editGst" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update GST</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="col-form-label">GST Amount</label>
                            <input type="number" id="editAmount" class="form-control">
                        </div>
                        <input type="submit" class="btn btn-info" onclick="updateGst()" value="Update">
                        <input type="hidden" id="hidden">
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
                        sendGst: display
                    },
                    success: function(data, status) {
                        $("#displayData").html(data);
                    }
                })
            }

            function addGst() {
                var amount = $("#amount").val();
                $.ajax({
                    url: 'gst.php',
                    type: 'post',
                    data: {
                        gst_amount: amount
                    },
                    success: function(data, status) {
                        $("#gstModal").modal('hide');
                        displayData();
                    }
                });
            }

            function deleteGst(deleteId) {
                if (confirm("Are you sure?")) {
                    $.ajax({
                        url: 'gst.php',
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

            function getDetails(gstId) {
                $("#editGst").modal("show");
                $("#hidden").val(gstId);
            }

            function updateGst() {
                var amount = $("#editAmount").val();
                var uniqueId = $("#hidden").val();

                $.post(
                    "gst.php", {
                        amount: amount,
                        uniqueId: uniqueId
                    },
                    function(data, status) {
                        $("#editGst").modal('hide');
                        displayData();
                    }
                )

            }
        </script>
</body>

</html>