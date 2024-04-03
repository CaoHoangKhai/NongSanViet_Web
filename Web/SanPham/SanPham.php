<?php
// session_start();
include '../Chung/php/connect.php';
if(isset($_SESSION['user_info']) && !empty($_SESSION['user_info'])) {
    $userInfo = $_SESSION['user_info'];
    $id_user = $userInfo[0];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nông Sản Việt</title>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js" defer></script>
    <script src="../Chung/js/header.js" defer></script>

    <!--Script chen html-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


</head>

<body>
    <header>
        <?php include "../Chung/php/head.php"?>
    </header>
    <main>

        <div class="container">
            <div class="row">
                <?php
                    if (!empty($_SESSION['success_message'])) {
                        $_SESSION['success_expire'] = time() + 3; // Thời gian hết hạn là 3 giây
                        ?>
                        <div class="alert alert-success mb-1" id="success-alert" role="alert"><?= $_SESSION['success_message'] ?></div>
                        <?php unset($_SESSION['success_message']);
                    }
                ?>
                <div class="d-flex bd-highlight">
                
                    <div class="p-2 flex-grow-1 bd-highlight fs-4">GẠO ĐẶC SẢN</div>
                    
                </div>
            </div>
        </div>

        <div class="container">
            
            <div class="row flex-container">
                <?php
                if(isset($_GET['trang'])){
                    $page = $_GET['trang'];
                }else{
                    $page = '';
                }
                if( $page == '' ||  $page == 1){
                    $begin =0;
                }else {
                    $begin = ($page*12)-12;
                }
                $sql = "SELECT * FROM product ORDER BY 	product_id ASC LIMIT  $begin,12";
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
                                <div class="mt-2 red-price"><?php echo number_format($row['price'], 0, ',', '.') ?> &#8363;</div>
                            </div>
                            <div class="col-auto">
                                <div class="mt-2 ">Đã bán: <?php echo $row['sold'];?> </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between mt-3"> 
                            <form action="../Chung/php/addtocart.php" method="post">
                                <input type="hidden" name="product_id" value="<?php echo $row['product_id'] ?>">
                                <input type="hidden" name="image" value="<?php echo $row['image'] ?>">
                                <input type="hidden" name="product_name" value="<?php echo $row['product_name'] ?>">
                                <input type="hidden" name="type" value="<?php echo $row['type']; ?>">
                                <input type="hidden" name="quantity" value="1">
                                <input type="hidden" name="price" value="<?php echo $row['price'] ?>"> 
                                <input type="hidden" name="id_user" value="<?php echo $id_user ?>">
                                <input type="hidden" name="i" value="<?php echo $i ?>">
                                <input type="hidden" name="trang" value="<?php echo $page ?>">
                                
                                <button class="btn btn-secondary btn-sm"  type="submit" name="detail_pro">Chi tiết</button>
                                <button type="submit" class="btn btn-primary btn-sm" name="sp_addtocart">Thêm vào giỏ hàng</button>
                            </form>
                        </div>
                   
                    </div>
                </div>

                <?php
                    }
                }
                ?>

                <?php
                    $count = "SELECT COUNT(*) as total FROM product";
                    $kq = $conn->query($count);
                    $row = $kq->fetch_assoc();
                    $totalCustomers = $row['total'];
                    $trang = ceil($totalCustomers/12);
                ?>

                <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-end" id="pagination">
                            <li class="page-item">
                                <a class="page-link" href="SanPham.php?trang=1" aria-label="Previous">
                                    <span aria-hidden="true" name="first">&laquo;</span>
                                </a>
                            </li>
                            <?php
                            for($i =1;$i <= $trang;$i++){
                            ?>
                            <li class="page-item"><a class="page-link" href="SanPham.php?trang=<?php echo $i ?>"><?php echo $i ?></a></li>
                            <?php
                            }
                            ?>

                            <li class="page-item">
                                <a class="page-link" href="SanPham.php?trang=<?php echo $trang ?>" aria-label="Next">
                                    <span aria-hidden="true" name="last">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>


                <!-- <div class="col-md-3 mb-4 product-item">
                    <div class="p-3 border bg-light text-center ">
                        <img src="../../../../WEB_BAN_HANG/Data/SanPham/Gao_Dac_San/gao_nuong_tim(YenBai).png"
                            class="product-image img-fluid rounded mx-auto d-block " alt="GẠO NƯƠNG TÍM (YÊN BÁI)">
                        <div class="mt-2">GẠO NƯƠNG TÍM</div>
                        <div class="mt-2 red-price">20,000&#8363;</div>
                        
                        <div class="d-flex justify-content-between mt-3"> 
                            <form action="../../Chung/php/addtocart.php" method="psot">
                                <intput type="hiden" name="img" value="">
                                <intput type="hiden" name="tensp" value="GẠO NƯƠNG TÍM (YÊN BÁI)">
                                <intput type="hiden" name="gia" value="20000"> 
                                <intput type="hiden" name="id" value="3">
                            </form>
                                <button class="btn btn-secondary btn-sm" >Chi tiết</button>
                                <button class="btn btn-primary btn-sm" name="addtocart" value="Thêm vào giỏ hàng">Thêm vào giỏ hàng</button>
                        </div>
                    </div>
                </div> -->
            
            </div>
        </div>
    </main>
    
    <footer>
        <?php include "../Chung/php/foot.php"?>
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
    <!-- 1.Sắp xếp lại thanh điều hướng 
2.Cbj lại giỏ hàng ,thanh search,user.
3.Thêm thông tin -->
<script type="text/javascript">
    $('#head_content').load('../Chung/php/head.php');
    $('#foot_content').load('../Chung/php/foot.php');
</script>
</body>

</html>