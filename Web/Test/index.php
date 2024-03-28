<?php
require '../Chung/php/connect.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nông Sản Việt</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
    <!-- <div class="container">
        <div class="col-md-12">
            <h3>insert dữ liệu</h3>
            <form method="POST" id="insert_data_hoten">
                <div class="col-md-12 offset-md-1">
                    <label class="form-label fs-6"><strong>Họ và tên</strong></label>
                    <input type="text" class="form-control" id="username" >
                </div>
                <div class="col-md-12 offset-md-1">
                    <label for="inputNumber4" class="form-label"><strong>Số điện thoại</strong></label>
                    <input type="text" class="form-control" id="phonenumber">
                </div>
                
                <div class="col-md-12 offset-md-1">
                    <label for="inputEmail4" class="form-label"><strong>Email</strong></label>
                    <input type="email" class="form-control" id="email" >
                    
                </div>

                
                <div class="col-md-12 offset-md-1">
                    <label for="inputAddress" class="form-label"><strong>Địa chỉ</strong></label>
                    <input type="text" class="form-control" id="address">
                </div>
                <div class="col-12">
                    <div class="col-md-6">
                        <button type="button" class="btn btn-primary" name="insert_data" id="button_insert" value="Cập Nhật Thông Tin">Cập Nhật Thông Tin</button>

                    </div>
                </div>
            </form>
        </div>
    </div> -->
    <div class="container">
            <div class="row flex-container">
                <?php
                $sql = "SELECT * FROM product WHERE type = 'Gao_Deo_Thom'";
                $result = mysqli_query($conn, $sql);

                // Initializing a variable to keep track of the ID

                while ($row = mysqli_fetch_array($result)) {
                ?>
                
                <div class="col-md-3 mb-4 product-item">
                    <div class="p-3 border bg-light text-center ">
                    <img src="../../Data/Gao/<?php echo $row['type'] . '/'; ?><?php echo $row['image'] ?>"
                            class="product-image img-fluid rounded mx-auto d-block " alt="<?php echo $row['product_name'] ?>">
                        <div class="mt-2"><?php echo $row['product_name'] ?></div>
                        <div class="mt-2 red-price"><?php echo  number_format($row['price'], 0, ',', '.') ?> &#8363;</div>
                        
                        <div class="d-flex justify-content-between mt-3"> 
                            <form method="post">
                                <input type="hidden" id="product_id" value="<?php echo $row['product_id'] ?>">
                                <input type="hidden" id="image" value="<?php echo $row['image'] ?>">
                                <input type="hidden" id="product_name" value="<?php echo $row['product_name'] ?>">
                                <input type="hidden" id="type" value="<?php echo $row['type']; ?>">
                                <input type="hidden" id="quantity" value="1">
                                <input type="hidden" id="price" value="<?php echo $row['price'] ?>"> 
                                <input type="hidden" id="id_user" value="<?php echo $id_user ?>"> 
                                <a class="btn btn-secondary btn-sm" >Chi tiết</a>
                                <button type="button" class="btn btn-primary btn-sm" name="addtocart" id="button_addtocart">Thêm vào giỏ hàng</button>
                            </form>
                        </div>
                    
                    </div>
                </div>

                <?php
                }
                ?>
            </div>
        </div>
    <script type="text/javascript">
       $('#button_addtocart').on('click',function(){
        var product_id = $('#product_id').val();
        var product_name = $('#product_name').val();
        var image = $('#image').val();
        var price = $('#price').val();
        var price = $('#price').val();
        var id_user = $('#id_user').val();
        var quantity = $('#quantity').val();
        

            $.ajax({
            url: "ajax.php",
            method: "POST",
            data:{product_id:product_id,product_name:product_name,image:image,id_user:id_user,quantity:quantity},
            success:function(data){
                if(data === '1'){
                    alert('Insert dữ liệu thành công');
                   
                }else{
                    alert('Insert dữ liệu thất bại');
                }
                
            }
            })
        
       });
    </script>
    
</body>
</html>
