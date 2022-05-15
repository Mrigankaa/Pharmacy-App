<?php 
    include("connect.php");
    extract(($_POST));

    if(isset($_POST['name']) && isset($_POST['batch'])){
        $sql = "SELECT * from medicine where med_name = '$name' AND batch_number = '$batch'";
        $r = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($r);
        $med_name = $row['med_name'];
        $med_id = $row['med_id'];
        $aval = $row['quantity'];
        $batch = $row['batch_number'];
        $expairy = $row['expiry_date'];
        $price = $row['sell_price'];
        $gst = $row['gst_id'];
        $rack = $row['rack_id'];
        $sql = "SELECT rack_number from rack where rack_id='$rack'";
        $r = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($r);
        $rack_number = $row['rack_number'];
        $sql = "SELECT gst_amount from gst where gst_id='$gst'";
        $r = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($r);
        $gst_amount = $row['gst_amount'];
        $table = '<tr id="index">
                    <td id="item">'.$med_name.'</td>  
                    <td id="batchNumber">'.$batch.'</td>
                    <td id="aval">'.$aval.'</td>  
                    <td>'.$expairy.'</td>  
                    <td id="price">'.$price.'</td>  
                    <td><input type="number" id="qunatity" class="form-control" min=1></td>  
                    <td>'.$gst_amount.'%</td>
                    <td>'.$rack_number.'</td>
                    <td id="total"></td>
                    <td >
                        <i class="bi bi-trash h4" id="Delete" style="cursor:pointer;" onclick="deleteRecord(\''.$med_name.'\')"></i>
                    </td>  
                </tr>';
        echo $table;
    }

    if(isset($_POST['customer'])){
        $sql = "SELECT * from customer where customer_name = '$customer'";
        $r = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($r);
        $name = $row['customer_name'];
        $number = $row['phone_number'];
        $address = $row['address'];
        $doctor = $row['doctor_name'];
        $d_phone = $row['doctor_address'];

        $table =   '<div class="d-inline-block">
                        <label>Cusomer Name :</label>
                        <input type="text" id="customer_name" value="'.$name.'" class="form-control" readonly>
                    </div>
                    <div class="d-inline-block">
                        <label>Phone Number :</label>
                        <input type="text" id="" value="'.$number.'" class="form-control" readonly>
                    </div>
                    <div class="d-inline-block">
                        <label>Address :</label>
                        <input type="text" id="" value="'.$address.'" class="form-control" readonly>
                    </div>
                    <div class="d-inline-block">
                        <label>Payment Type :</label>
                        <select id="payment_type" class="form-control">
                            <option value="1">Cash Payment</option>
                            <option value="2">Card Payment</option>
                        </select>
                    </div>
                    <div class="d-inline-block">
                        <label>Date :</label>
                        <input type="date" id="date" class="form-control" >
                    </div>';
        echo $table;
    }

    if(isset($_POST['name'])){
        $show = '<select class="form-control col-md-12" id="hello">
                    <option id="null" value="empty">Select Batch</option>';
        $sql = "SELECT batch_number FROM medicine WHERE med_name = '$name'";
        $r = mysqli_query($conn,$sql);
        while($row=mysqli_fetch_array($r)){
            $show.='<option value="'.$row['batch_number'].'">'.$row['batch_number'].'</option>';
        }
        $show.='</select>';
        echo $show;
    }
?>