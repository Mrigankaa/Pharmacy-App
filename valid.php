<?php
include("connect.php");
if (isset($_POST['sendGst'])) {
    $table = '
        <table class="table table-bordered text-center">
        <thead>
            <tr>
            <th scope="col">Id</th>
            <th scope="col">GST Amount</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        ';
    $sql = "SELECT * FROM gst";
    $r = mysqli_query($conn, $sql);
    $index = 1;
    while ($row = mysqli_fetch_assoc($r)) {
        $id = $row['gst_id'];
        $amount = $row['gst_amount'];

        $table .= '
            <tbody>
                <tr>
                <th scope="row">' . $index . '</th>
                <td>' . $amount . '%</td>
                <td>
                    <button class="btn btn-sm btn-info" onClick="getDetails(' . $id . ')">Edit</button>
                    <button class="btn btn-sm btn-danger" onClick="deleteGst(' . $id . ')">Delete</button>
                </td>
                </tr>
            </tbody>';
        $index++;
    }
    $table .= '</table>';
    echo $table;
}


if (isset($_POST['sendCategory'])) {
    $table = '
        <table class="table table-bordered text-center">
        <thead>
            <tr>
            <th scope="col">Id</th>
            <th scope="col">Category Type</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        ';
    $sql = "SELECT * FROM category";
    $r = mysqli_query($conn, $sql);
    $index = 1;
    while ($row = mysqli_fetch_assoc($r)) {
        $id = $row['cat_id'];
        $number = $row['cat_type'];
        $table .= '
            <tbody>
                <tr>
                <th scope="row">' . $index . '</th>
                <td>' . $number . '</td>
                <td>
                    <button class="btn btn-sm btn-info" onClick="editCategory(' . $id . ')">Edit</button>
                    <button class="btn btn-sm btn-danger" onClick="deleteCategory(' . $id . ')">Delete</button>
                </td>
                </tr>
            </tbody>';
        $index++;
    }
    $table .= '</table>';
    echo $table;
}

if (isset($_POST['sendRack'])) {
    $table = '
        <table class="table table-bordered text-center">
        <thead>
            <tr>
            <th scope="col">Id</th>
            <th scope="col">Rack Number</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        ';
    $sql = "SELECT * FROM rack";
    $r = mysqli_query($conn, $sql);
    $index = 1;
    while ($row = mysqli_fetch_assoc($r)) {
        $id = $row['rack_id'];
        $number = $row['rack_number'];
        $table .= '
            <tbody>
                <tr>
                <th scope="row">' . $index . '</th>
                <td>' . $number . '</td>
                <td>
                    <button class="btn btn-sm btn-info" onClick="editRack(' . $id . ')">Edit</button>
                    <button class="btn btn-sm btn-danger" onClick="deleteRack(' . $id . ')">Delete</button>
                </td>
                </tr>
            </tbody>';
        $index++;
    }
    $table .= '</table>';
    echo $table;
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $table = '
            <table class="table table-bordered text-center">
            <thead>
                <tr>
                <th scope="col">Med Name</th>
                <th scope="col">Batch Number</th>
                <th scope="col">Quantity</th>
                <th scope="col">Date</th>
                </tr>
            </thead>
            ';
    $sql = "SELECT * FROM sales where invoice_id = '$id'";
    $r = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($r)) {
        $med_name = $row['med_name'];
        $number = $row['batch_number'];
        $quantity = $row['quantity'];
        $total = $row['total'];

        $table .= '
                <tbody>
                    <tr>
                    <th scope="row">' . $med_name . '</th>
                    <td>' . $number . '</td>
                    <td>' . $quantity . '</td>
                    <td>' . $total . '</td>
                    </tr>
                </tbody>';
    }

    $table .= '</table>';
    echo $table;
}
