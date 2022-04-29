<?php 
    include("connect.php");
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
            <h3>Add Medicines</h3>
            <hr class="p-0.5 text-danger mb-4">
            <form action="manage_product.php" method="post">
                <div class="row">
                    <div class="col-md-4">
                        <label>Medicine Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Medicine Name" required>
                    </div>
                    <div class="col-md-4">
                        <label>HSN Number</label>
                        <input type="text" name="hsn" class="form-control" placeholder="HSN Number" >
                    </div>
                    <div class="col-md-4">
                        <label>Batch Number</label>
                        <input type="text" name="batch" class="form-control" placeholder="Batch Number" >
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label>Purchase Price</label>
                        <input type="text" name="p_price" class="form-control " placeholder="Purchase Price" required>
                    </div>
                    <div class="col-md-4">
                        <label>Sell Price</label>
                        <input type="text" name="s_price" class="form-control" placeholder="Sell Price" required>
                    </div>
                    <div class="col-md-4">
                        <label>Quantity</label>
                        <input type="text" name="quantity" class="form-control" placeholder="Packing eg:10pc">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label>Menufacture Date</label>
                        <input type="date" name="m_date" class="form-control" placeholder="Packing eg:10pc" required >
                    </div>
                    <div class="col-md-4">
                        <label>Expairy Date</label>
                        <input type="date" name="e_date" class="form-control" placeholder="Packing eg:10pc" required >
                    </div>
                    <div class="col-md-4">
                    <label>GST</label>
                        <select name="gst" class="form-control">
                            <option value="">Select GST</option>
                            <?php 
                                $sql = "SELECT gst_amount from gst";
                                $r = mysqli_query($conn,$sql);
                                while($row = mysqli_fetch_assoc($r)){ ?>
                            <option value="<?php echo $row["gst_amount"];?>"><?php echo $row["gst_amount"];?>%</option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="col-md-4">
                    <label>Category</label>
                        <select name="category" class="form-control">
                            <option value="">Select Category</option>
                        <?php 
                            $sql = "SELECT cat_type from category";
                            $r = mysqli_query($conn,$sql);       
                            while($row = mysqli_fetch_assoc($r)){?>
                            <option value="<?php echo $row["cat_type"]; ?>"><?php echo $row["cat_type"]; ?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="col-md-4">
                    <label>Rack Number</label>
                        <select name="rack" class="form-control">
                            <option value="">Select Rack</option>
                        <?php 
                            $sql = "SELECT rack_number from rack";
                            $r = mysqli_query($conn,$sql);       
                            while($row = mysqli_fetch_assoc($r)){?>
                            <option value="<?php echo $row["rack_number"]; ?>"><?php echo $row["rack_number"]; ?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="col-md-4">
                    <label>Supplier Name</label>
                        <select name="supplier" class="form-control">
                            <option value="">Select Supplier</option>
                        <?php 
                            $sql = "SELECT s_name from supplier";
                            $r = mysqli_query($conn,$sql);       
                            while($row = mysqli_fetch_assoc($r)){?>
                            <option value="<?php echo $row["s_name"]; ?>"><?php echo $row["s_name"]; ?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <input type="submit" class="btn btn-info my-3" value="Add">
            </form>                       
            </div>
            </div>
        </div>     
        </div>
        </div>       
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>