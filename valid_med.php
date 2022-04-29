<?php
    include "connect.php";
    if(isset($_POST['search'])){
        $search = $_POST['search'];
        $table = '
        <table class="table table-bordered">
        <thead>
            <tr>
            <th scope="col">id</th>
            <th scope="col">Medicine Name</th>
            <th scope="col">Batch Number</th>
            <th scope="col">Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">Expiry Date</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>';
        $sql = "SELECT * FROM medicine WHERE med_name LIKE '%{$search}%'";
        $r = mysqli_query($conn,$sql);
        $index=1;
        while($row = mysqli_fetch_assoc($r)){
            $id = $row['med_id'];
            $name = $row['med_name'];
            $batch = $row['batch_number'];
            $price = $row['sell_price'];
            $quantity = $row['quantity'];
            $e_date = $row['expiry_date'];
            $table.='
                <tr>
                <th scope="row">'.$index.'</th>
                <td>'.$name.'</td>
                <td>'.$batch.'</td>
                <td>'.$price.'</td>
                <td>'.$quantity.'</td>
                <td>'.$e_date.'</td>
                <td>
                    <button class="btn btn-sm btn-info" onClick="getDetails('.$id.')">Edit</button>
                    <button class="btn btn-sm btn-danger" onClick="deleteMedicine('.$id.')">Delete</button>
                </td>
                </tr>
            </tbody>';
            $index++;
        }
    
        $table.='</table>';
        echo $table; 
    }

    if(isset($_POST['display'])){
    $table = '
        <table class="table table-bordered">
        <thead>
            <tr>
            <th scope="col">id</th>
            <th scope="col">Medicine Name</th>
            <th scope="col">Batch Number</th>
            <th scope="col">Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">Expiry Date</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>';
        $sql = "SELECT * FROM medicine";
        $result = mysqli_query($conn,$sql);
        $index=1;
        while($row = mysqli_fetch_array($result)){
            $id = $row['med_id'];
            $name = $row['med_name'];
            $batch = $row['batch_number'];
            $price = $row['sell_price'];
            $quantity = $row['quantity'];
            $e_date = $row['expiry_date'];
            $table.='
                <tr>
                <th scope="row">'.$index.'</th>
                <td>'.$name.'</td>
                <td>'.$batch.'</td>
                <td>'.$price.'</td>
                <td>'.$quantity.'</td>
                <td>'.$e_date.'</td>
                <td>
                    <button class="btn btn-sm btn-info" onClick="getDetails('.$id.')">Edit</button>
                    <button class="btn btn-sm btn-danger" onClick="deleteMedicine('.$id.')">Delete</button>
                </td>
                </tr>
            </tbody>';
            $index++;
        }
    
        $table.='</table>';
        echo $table;
    }
?>