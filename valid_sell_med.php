<?php 
    include("connect.php");
    extract(($_POST));
    if(isset($_POST['name']) && isset($_POST['batch'])){
        $sql = "SELECT * from medicine where med_name = '$name' AND batch_number = '$batch'";
        $r = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($r);
        $med_name = $row['med_name'];
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
                        <i class="bi bi-trash h4" style="cursor:pointer;" onclick="deleteRecord()"></i>
                    </td>  
                </tr>';
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
