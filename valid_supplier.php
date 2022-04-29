<?php
    include "connect.php";
    $index=1;
    if(isset($_POST['searchItem'])){
        $search = $_POST['searchItem'];
        $table = '
        <table class="table table-bordered">
        <thead>
            <tr>
            <th scope="col">Supplier ID</th>
            <th scope="col">Supplier Name</th>
            <th scope="col">Supplier Phone</th>
            <th scope="col">Supplier Email</th>
            <th scope="col">Supplier Address</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>';
        $sql = "SELECT * FROM supplier WHERE s_name LIKE '%{$search}%'";
        $r = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($r)){
            $id = $row['s_id'];
            $name = $row['s_name'];
            $email = $row['s_email'];
            $phone = $row['s_phone'];
            $address = $row['s_address'];
            $table.='
            <tr>
            <th scope="row">'.$index.'</th>
            <td>'.$name.'</td>
            <td>'.$email.'</td>
            <td>'.$phone.'</td>
            <td>'.$address.'</td>
            <td>
                <button class="btn btn-sm btn-info" onClick="getDetails('.$id.')">Edit</button>
                <button class="btn btn-sm btn-danger" onClick="deleteSupplier('.$id.')">Delete</button>
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
            <th scope="col">Supplier ID</th>
            <th scope="col">Supplier Name</th>
            <th scope="col">Supplier Phone</th>
            <th scope="col">Supplier Email</th>
            <th scope="col">Supplier Address</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>';
        $sql = "SELECT * FROM supplier";
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_array($result)){
            $id = $row['s_id'];
            $name = $row['s_name'];
            $email = $row['s_email'];
            $phone = $row['s_phone'];
            $address = $row['s_address'];
            $table.='
            <tr>
            <th scope="row">'.$index.'</th>
            <td>'.$name.'</td>
            <td>'.$email.'</td>
            <td>'.$phone.'</td>
            <td>'.$address.'</td>
            <td>
                <button class="btn btn-sm btn-info" onClick="getDetails('.$id.')">Edit</button>
                <button class="btn btn-sm btn-danger" onClick="deleteSupplier('.$id.')">Delete</button>
            </td>
            </tr>
        </tbody>';
        $index++;
        }

        $table.='</table>';
        echo $table;
    }
?>