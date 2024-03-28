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
            <div class="row">
                <?php 
                    $product_id = $_SESSION['product']['product_id'];
                    // $product_name = $_SESSION['product']['product_name'];
                    // $type = $_SESSION['product']['type'];
                    // $image = $_SESSION['product']['image'];
                    // $price = $_SESSION['product']['price'];
                    // $quantity = $_SESSION['product']['quantity'];
                    $sql = "SELECT * FROM product p JOIN product_detail pd ON p.product_id=pd.product_id  WHERE p.product_id = '$product_id'";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($result)) {
                ?>
                <span>
                    <a  class="link-dark" href="../TrangChu/TrangChu.php">TRANG CHỦ</a>
                    <a>/</a>
                    <a  class="link-dark" href="../SanPham/SanPham.php">SẢN PHẨM</a>
                    <a>/</a>
                    <a>CHI TIÊT SẢN PHẨM</a>
                </span>
                <div class="col-5 text-end">
                <br>
                    
                    <img src="../../Data/Gao/<?php echo $row['type'] . '/'; ?><?php echo $row['image'] ?>" style="width: 400px;height:400px">
                </div>
                <div class="col-7">
                    <span class="fs-5 text-start"><strong><?php echo $row['product_name']?></strong></span>
                    <p class="red-price fs-2 fw-bolder"><?php echo number_format($row['price'], 0, ',', ',') ?> &#8363;</p>
                    <span class=" text-start"><?php echo preg_replace('/\[|\]/', '<br>', $row['content']) ?></span>
                </div>
            </div>
            <div>Hạn sử dụng: <?php echo $row['hsd'] ?>tháng</div>
        </div>
            <?php
                }
            ?>
        
    
    </main>
    <footer>
        <?php include ("../Chung/php/foot.php")?>
    </footer>
    
</body>
</html>