<?php
session_start();
include '../Chung/php/connect.php';
?>
<?php
// Check if the user is logged in
    if (!isset($_SESSION['user_info']) || empty($_SESSION['user_info'])) {
        // If not logged in, redirect to the login page or display a message
        echo '<p style="color: red; text-align: center; font-weight: bold;">Bạn cần đăng nhập để xem giỏ hàng! <a href="../DangNhap/DangNhap.php">Đăng Nhập</a></p>';
        echo '<p style=" text-align: center; font-weight: bold;"><img src="../../Data/BackGround/dangnhap.jpg"></p>';
        exit();
    }
    $userInfo = $_SESSION['user_info'];
    $id_user = $userInfo[0];
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
    <!-- JavaScript và jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js" defer></script> -->
    <script src="../Chung/js/header.js" defer></script>
        
        
</head>

<body>
    <header>
        <div id="head_content"></div>
    </header>
    <main>
        <div class="container">
            <div class="row">
                <?php
                    // Check if the user is logged in again to avoid displaying content when not logged in
                    if (isset($_SESSION['user_info']) && !empty($_SESSION['user_info'])) {
                        // Rest of your main content
                    }
                ?>
                <?php
                    // Kiểm tra xem session 'error' có tồn tại không và có giá trị không
                    if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
                        // Hiển thị thông báo lỗi
                        echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error'] . '</div>';
                        // Xóa session 'error' sau khi hiển thị
                        unset($_SESSION['error']);
                    }
                    ?>

                <?php
                    if (!empty($_SESSION['success'])) {
                        $_SESSION['success_expire'] = time() + 3; // Thời gian hết hạn là 3 giây
                        ?>
                        <div class="alert alert-success mb-1" id="success-alert" role="alert"><?= $_SESSION['success'] ?></div>
                        <?php unset($_SESSION['success']);
                    }
                ?>
                <!-- Bảng hiển thị giỏ hàng -->
                <div class="col-sm-5 col-md-6">
                    <div class="container">
                        <div class="row flex-container">
                            <table class="table" id="myTable">
                                <thead>
                                    <tr>
                                        <th scope="col" class="col-6">SẢN PHẨM</th>
                                        <th scope="col" class="col-0.5">GIÁ</th>
                                        <th scope="col" class="col-3">SỐ LƯỢNG</th>
                                        <th scope="col" class="col-1.5">TỔNG</th>
                                        <th scope="col" class="col-0.5"></th>
                                        <!-- <th scope="col">TẠM TÍNH</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $sql = "SELECT * FROM product p JOIN shopping_cart sc ON p.product_id = sc.product_id WHERE id_user ='$id_user' ";
                                    $result = mysqli_query($conn, $sql);
                                    $sum =0;
                                    $product_count = mysqli_num_rows($result); // Đếm số lượng sản phẩm trong giỏ hàng
                                    while ($row = mysqli_fetch_array($result)) {
                                        // Check if quantity is greater than 0
                                        if ($row['quantity_sp'] > 0) {     
                                            echo '<tr>' .
                                                    '<td>' .
                                                        '<div class="d-flex align-items-center">' .
                                                            '<img src="../../Data/Gao/' . $row['type'] . '/' . $row['image'] . '" style="width: 70px; height: 80px;"> ' .
                                                            '<span class="ml-2">' . $row['product_name'] . '</span>' .
                                                        '</div>' .
                                                    '</td>' .
                                                    '<td>' . number_format($row['price'], 0, ',', '.') . '</td>' .
                                                    '<td>' .
                                                    '<form action="../Chung/php/addtocart.php" method="post">' .
                                                        '<div class="d-flex align-items-center">' .
                                                            
                                                                '<input type="hidden" name="product_id" value="' . $row['product_id'] . '">' .
                                                                '<input type="hidden" name="quantity" value="' . $row['quantity_sp'] . '">' .
                                                                '<button type="submit" class="btn btn-outline-success" name="del_one_pro">-</button>' .
                                                          

                                                            
                                                                '<input class="m-2" type="text" name="quantity_sp" id="quantityInput" value="' . $row['quantity_sp'] . '" size="2">' .
                                                            

                                                            

                                                                '<button type="submit" class="btn btn-outline-success" name="add_one_pro">+</button>' .
                                                            
                                                        '</div>' .
                                                        
                                                            
                                                            '<button type="submit" class="btn btn-outline-success" name="update_quantity" style="width: 140px;">Cập nhật</button>'.

                                                        '</form>' .
                                                    '</td>' .
                                                    '<td>' . number_format($row['quantity_sp'] * $row['price'], 0, ',', '.') . '</td>' .
                                                    '<td>' .
                                                        '<form action="../Chung/php/addtocart.php" method="post">' .
                                                            '<input type="hidden" name="product_id" value="' . $row['product_id'] . '">' .
                                                            '<button type="submit" class="btn btn-danger" name="del_order"><i class="fa fa-trash" aria-hidden="true"></i></button>' .
                                                        '</form>' .
                                                    '</td>' . // Delete button
                                                '</tr>';
                                            $sum = $sum + $row['quantity_sp'] * $row['price'];

                                        }
                                    }
                                ?>
                                </tbody>
 
                            </table> 
            
                            <div class="container mt-1">
                                <button class="btn btn-light transparent-button">
                                    <a href="../../../../WEB_BAN_HANG/Web/SanPham/SanPham.php?trang=1" class="text-secondary">
                                        <i class="fas fa-arrow-left ml-2"></i>TIẾP TỤC XEM SẢN PHẨM
                                    </a>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Thông tin giỏ hàng -->
                
                <div class="col-sm-5 offset-sm-2 col-md-6 offset-md-0">
                    <div class="container">
                        <div class="row flex-container">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">CỘNG GIỎ HÀNG</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Thành Tiền </td>
                                        <td>&nbsp;</td>
                                        <td><b class="fs-4"><?php echo number_format($sum, 0, ',', '.'); ?>VND</b></td>
                                        <td>&nbsp;</td>
                                    </tr>
                                </tbody>

                                <tbody>
                                    <tr>
                                        <td>Tổng Chi Phí</td>
                                        <td>&nbsp;</td>
                                        <td><b class="fs-4"><?php echo number_format($sum, 0, ',', '.'); ?>VND</b></td>
                                        <td>&nbsp;</td>
                                        
                                    </tr>
                                </tbody>

                                
                            </table>
                            <?php if ($product_count > 0) : ?>
                                <div class="container mt-5 text-center">
                                    <form action="../Order/order.php" method="POST">
                                        <button class="btn btn-danger centered-btn w-100" name='order'>
                                            TIẾN HÀNH THANH TOÁN
                                        </button>
                                    </form>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <div id="foot_content"></div>
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
