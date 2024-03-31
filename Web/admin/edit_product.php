<?php
include '../Chung/php/connect.php';
include "header_admin.php"; 
include "sidebar.php";
?>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!--CSS-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="../Chung/CSS_bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="sidebar.css">

        <link rel="stylesheet" href="../Chung/css/header.css">
        <link rel="stylesheet" href="../Chung/css/style.css">
        <link rel="stylesheet" href="../Chung/css/footer.css">

        <!-- JavaScript và jQuery -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
            integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <!-- Bootstrap JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
        <!--Tinh/Thanh pho-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
        
    </head>
    <body>
    <?php
        if(isset($_POST['edit_product'])){
            $id = $_POST['edit_id_product'];

            $result = mysqli_query($conn, "SELECT * FROM `product` WHERE product_id = '$id'");
            $row = mysqli_fetch_assoc($result);
            
        }
    ?>
     <div class="container">
            <form  action="code.php" method="POST">
                <input type="hidden" name="edit_id" value="<?php echo $row['product_id']; ?>">
                    <div class="row">
                        <div class="col-md-10 offset-md-1">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="fullname" class="form-label"><strong>Tên Sản Phẩm</strong></label>
                                    <input type="text" class="form-control" name="edit_product_name" id="fullname" value="<?php echo $row['product_name']; ?>">
                                </div>
                                

                                <div class="col-md-6">
                                    <label class="form-label fs-6"><strong>Loại Sản Phẩm</strong></label>
                                    <select class="form-select" id="inputGroupSelect01" name="edit_type">
                                        <option <?php echo ($row['type'] == 'Chọn loại sản phẩm') ? 'selected' : ''; ?>>Chọn loại sản phẩm</option>
                                        <option <?php echo ($row['type'] == 'Gao_Dac_San') ? 'selected' : ''; ?> value="Gao_Dac_San">Gạo Đặc Sản</option>
                                        <option <?php echo ($row['type'] == 'Gao_Tam') ? 'selected' : ''; ?> value="Gao_Tam">Gạo Tấm</option>
                                        <option <?php echo ($row['type'] == 'Gao_Deo_Thom') ? 'selected' : ''; ?> value="Gao_Deo_Thom">Gạo Dẻo Thơm</option>
                                        <option <?php echo ($row['type'] == 'Gao_Lut') ? 'selected' : ''; ?> value="Gao_Lut">Gạo Lứt</option>
                                        <option <?php echo ($row['type'] == 'Gao_Nep') ? 'selected' : ''; ?> value="Gao_Nep">Gạo Nếp</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="formFile" class="form-label fs-6"><strong>Chọn giá tiền cho sản phẩm</strong></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="autoSizingInputGroup" placeholder="Chọn giá tiền cho sản phẩm" name="edit_price" value="<?php echo  number_format($row['price'], 0, ',', '') ?>">
                                        <!-- <input type="hidden" class="form-control" id="autoSizingInputGroup" placeholder="Chọn giá tiền cho sản phẩm" name="edit_price" value="<?php echo $row['price']  ?>"> -->
                                        <div class="input-group-text">&#8363;</div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <label for="formFile" class="form-label fs-6"><strong>Tồn kho</strong></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="autoSizingInputGroup" placeholder="Sản phẩm còn trong kho" name="edit_quantity" value="<?php echo $row['quantity']?>">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="formFile" class="form-label fs-6"><strong>Chọn hình ảnh của sản phẩm</strong></label>
                                    <input class="form-control" type="hidden" id="formFile" name="edit_image_"   value="<?php echo $row['image']; ?>">
                                    <input class="form-control" type="file" id="formFile" name="edit_image" >
                                    <?php
                                    if (!empty($row['image'])) {
                                        // Nếu có hình ảnh, hiển thị nó với alt là tên sản phẩm
                                        echo '<img src="../../Data/Gao/' . $row['type'] . '/' . $row['image'] . '" class="img-fluid" alt="' . $row['product_name'] . '">';
                                    }
                                    ?>
                                </div>



                                
                                

                                <div class="col-md-6 mt-3">
                                    <a href="ds_product.php" class="btn btn-danger">Cancel</a>
                                    <button type="submit" class="btn btn-primary" name="update_product" value="Cập nhật">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
            </form>
    </body>
</html>