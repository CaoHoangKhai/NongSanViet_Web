<?php
require '../Chung/php/connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--logo-->
    <link rel="icon" href="../../../../WEB_BAN_HANG/Data/Logo/logo.ico">

    <!--CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../Chung/CSS_bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="../Chung/css/header.css">
    <link rel="stylesheet" href="../Chung/css/style.css">
    <link rel="stylesheet" href="../Chung/css/footer.css">
    


    <!--javascript-->
    
    <!--Tinh/Thanh pho-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    
    <script src="../Chung/js/header.js" defer></script>

    <!-- <script src="https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script> -->
    
    <!--Script chen html-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    <header>
        <?php include ("../Chung/php/head.php")?>
    </header>
    <main>

    
        <div class="container">
            <div class="row flex-container">
            <?php
                if (!empty($_SESSION['success_message'])) {
                    $_SESSION['success_expire'] = time() + 1; // Thời gian hết hạn là 3 giây
                    ?>
                    <div class="alert alert-success mb-1" id="success-alert" role="alert"><?= $_SESSION['success_message'] ?></div>
                    <?php unset($_SESSION['success_message']);
                }
            ?>
            <div class="p-2 flex-grow-1 bd-highlight fs-4">GẠO NẾP</div>
                <?php
                $sql = "SELECT * FROM product WHERE type = 'Gao_Nep'";
                $result = mysqli_query($conn, $sql);

                // Initializing a variable to keep track of the ID
                $counter = 1;

                while ($row = mysqli_fetch_array($result)) {
                    if($row['quantity'] > 0){
                ?>
                
                <div class="col-md-3 mb-4 product-item">
                    <div class="p-3 border bg-light text-center ">
                    <img src="../../Data/Gao/<?php echo $row['type'] . '/'; ?><?php echo $row['image'] ?>"
                            class="product-image img-fluid rounded mx-auto d-block " alt="<?php echo $row['product_name'] ?>">
                        <div class="mt-2"><?php echo $row['product_name'] ?></div>
                        <div class="row">
                            <div class="col-auto mr-auto">
                                <div class="mt-2 red-price fs-5"><?php echo number_format($row['price'], 0, ',', '.') ?> &#8363;</div>
                            </div>
                            <div class="col-auto">
                                <div class="mt-2">Đã bán: <?php echo $row['sold'];?> </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between mt-3"> 
                            <form action="addGao.php" method="post">
                                <input type="hidden" name="product_id" value="<?php echo $row['product_id'] ?>">
                                <input type="hidden" name="image" value="<?php echo $row['image'] ?>">
                                <input type="hidden" name="product_name" value="<?php echo $row['product_name'] ?>">
                                <input type="hidden" name="type" value="<?php echo $row['type']; ?>">
                                <input type="hidden" name="quantity" value="1">
                                <input type="hidden" name="price" value="<?php echo $row['price'] ?>"> 
                                <input type="hidden" name="id_user" value="<?php echo $id_user ?>"> 
                                <button class="btn btn-secondary btn-sm"  type="submit" name="detail_pro">Chi tiết</button>
                                <button type="submit" class="btn btn-primary btn-sm" name="addtocartN">Thêm vào giỏ hàng</button>
                            </form>
                        </div>
                    
                    </div>
                </div>

                <?php
                    }
                }
                ?>
            </div>
        </div>
    </main>
    <footer>
        <?php include ("../Chung/php/foot.php")?>
    </footer>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var successAlert = document.getElementById('success-alert');
            var expireTime = <?= !empty($_SESSION['success_expire']) ? $_SESSION['success_expire'] : 0 ?>;

            if (successAlert && expireTime > 0) {
                setTimeout(function () {
                    successAlert.style.display = 'none';
                }, (expireTime - <?= time() ?>) * 1000);
            }
        });
    </script>
    <script type="text/javascript">
        $('#head_content').load('../Chung/php/head.php');
        $('#foot_content').load('../Chung/php/foot.php');
    </script>
</body>
</html>