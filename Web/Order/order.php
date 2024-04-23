<?php
session_start();
include '../Chung/php/connect.php';
?>
<?php
// Check if the user is logged in
    if (!isset($_SESSION['user_info']) || empty($_SESSION['user_info'])) {
        // If not logged in, redirect to the login page or display a message
        echo '<p style="color: red; text-align: center; font-weight: bold;">Bạn cần đăng nhập để xem giỏ hàng! <a href="../DangNhap/DangNhap.php">Đăng Nhập</a></p>';
        exit();
    }
    $userInfo = $_SESSION['user_info'];
    $id_user = $userInfo[0];
    $sql_khachhang = "SELECT * FROM customer WHERE id_user = '$id_user'";
    $result = mysqli_query($conn, $sql_khachhang);
    $row_khachhang = mysqli_fetch_array($result);
    
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
    <script src="../DangKy/DangKy.js"defer></script>
        
        
</head>

<body>
    <header>
        <div id="head_content"></div>
    </header>
    <main>
        <div class="container">
            <form class="row g-3 needs-validation" action="order_detail.php" method="post" novalidate>
                <div class="row">
                    <?php if (!empty($_SESSION['success'])): ?>
                        <div class="alert alert-success mb-1" role="alert"><?= $_SESSION['success'] ?></div>
                        <?php unset($_SESSION['success']); ?>
                    <?php endif; ?>
                        <div class="col-7">
                            <br>
                            <div class="text-start fs-3">THÔNG TIN THANH TOÁN</div>
                            <br>
                            <div class="mx-2 row g-3 needs-validation">
                                
                                    <div class="col-md-12">
                                        <label class="form-label fs-6"><strong>Họ và tên*</strong></label>
                                        <input type="text" class="form-control" name="username" id="fullname" placeholder="Họ tên của bạn" 
                                        autofocus required value="<?php echo $row_khachhang['username'];?>">
                                        <div class="invalid-feedback">
                                            Họ và tên không được bỏ trống.
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="inputAddress" class="form-label"><strong>Địa chỉ*</strong></label>
                                        <input type="text" class="form-control" name="address" id="inputAddress" value="<?php echo $row_khachhang['address'];?>"
                                            placeholder="Nhập địa chỉ của bạn VD:Số 20,ngõ 90" required >
                                        <div class="invalid-feedback">
                                        Địa chỉ không được bỏ trống.
                                        </div>                                    
                                    </div>

                            

                                    <div class="col-md-6">
                                        <label for="inputNumber4" class="form-label"><strong>Số điện thoại*</strong></label>
                                        <input type="text" class="form-control" name="phonenumber" id="inputNumber4" placeholder="Số điện thoại của bạn"
                                            required value="<?php echo $row_khachhang['phonenumber'];?>">
                                        <div id="phoneFeedback" class="invalid-feedback">
                                            <!-- Thông báo mặc định -->
                                            Số điện thoại không hợp lệ. Hãy nhập số điện thoại theo định dạng chính xác.
                                        </div>
                                        <div id="phoneEmptyFeedback" class="invalid-feedback">
                                            <!-- Thông báo khi trống -->
                                            Số điện thoại không được bỏ trống.
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fs-6"><strong>Phương Thức Thanh Toán</strong></label>
                                        <select class="form-select form-control" id="inputGroupSelect01" name="type" required>
                                            <option selected value="">Chọn phương thức thanh toán</option>
                                            <option value="Thanh_Toan_Khi_Nhan_Hang">Thanh Toán Khi Nhận Hàng</option>
                                            <option value="Thanh_Toan_Bang_Vi_Dien_Tu">Thanh toán bằng ví điện tử</option>
                                            <option value="Thanh_Toan_Qua_Ngan_Hang">Thẻ Tín Dụng/ Ghi Nợ</option>
                                        </select>
                                        <div class="invalid-feedback">
                                        Vui lòng chọn phương thức thanh toán.
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="inputEmail4" class="form-label"><strong>Email*</strong></label>
                                        <input type="email" class="form-control" name="email" id="inputEmail4" placeholder="Email của bạn" required value="<?php echo $row_khachhang['email'];?>">
                                        <div class="invalid-feedback">
                                            Email không được bỏ trống.
                                        </div>
                                        
                                    </div>

                                    
                                    

                                    <div class="col-md-12 mt-2">
                                        <label for="inputAddress" class="form-label"><strong>Ghi chú đơn hàng (tuỳ chọn)</strong></label>
                                        <textarea class="form-control" name="note" placeholder="Ghi chú về đơn hàng, ví dụ: thời gian hay chỉ dẫn địa điểm giao hàng chi tiết hơn." rows="3"></textarea>                              
                                    </div>
                            </div>
                        </div>

                        <div class="col-5">
                            <br>
                            <table class="table">
                                <div class="fs-3">ĐƠN HÀNG CỦA BẠN</div>
                                <br>
                                <tbody>
                                    <tr>
                                        <td class="text-muted fs-6"><strong>SẢN PHẨM</strong></td>
                                        <td class="text-muted text-end"><strong>TẠM TÍNH</strong></td>
                                    </tr>
                                </tbody>

                                <tbody>
                                <?php
                                    $sql = "SELECT * FROM product p JOIN shopping_cart sc ON p.product_id = sc.product_id WHERE id_user ='$id_user' ";
                                    $result = mysqli_query($conn, $sql);
                                    $sum =0;
                                    while ($row = mysqli_fetch_array($result)) {
                                        // Check if quantity is greater than 0
                                        if ($row['quantity_sp'] > 0 && $row['stat'] == 0) {     
                                            echo '<tr>' .
                                                    '<td>' .
                                                        '<div class="d-flex align-items-center">' .
                                                            '<span class="ml-2 text-muted">' . $row['product_name'] . '-1kg x ' . $row['quantity_sp'] . '</span>' .
                                                        '</div>' .
                                                    '</td>' .
                                                    '<td class="text-end"><strong>' . number_format($row['quantity_sp'] * $row['price'], 0, ',', ',') . ' VND</strong></td>' .
                                                '</tr>';
                                            $sum = $sum + $row['quantity_sp'] * $row['price'];
                                        }
                                    }
                                ?>
                                </tbody>

                                <tbody>
                                    <tr>
                                        <td class="text-muted"><strong>Tạm Tính</strong></td>
                                        <td class="text-end"><b><?php echo number_format($sum, 0, ',', '.'); ?>VND</b></td>
                                    </tr>
                                </tbody>

                                <tbody>
                                    <tr>
                                        <td class="text-muted"><strong>Giao Hàng</strong></td>
                                        <td class="text-end">Miễn phí giao hàng</td>
                                    </tr>
                                </tbody>

                                <tbody>
                                    <tr>
                                        <td class="text-muted"><strong>Tổng</strong></td>
                                        <td class="text-end"><b><?php echo number_format($sum, 0, ',', '.'); ?>VND</b></td>
                                    </tr>
                                </tbody>
                            </table>

                            <div>
                                <input type="hidden" name="id_user" value="<?php  echo $id_user ?>">
                                <input type="hidden" name="sum" value="<?php  echo $sum ?>">
                                <button class="btn btn-danger centered-btn" name='order_detail'>
                                    ĐẶT HÀNG
                                </button>
                            </div>
        
                        </div>
                    </div>
                </div>
            <form>
        </div>
    </main>
    <footer>
        <div id="foot_content"></div>
    </footer>

    <script type="text/javascript">
        $('#head_content').load('../Chung/php/head.php');
        $('#foot_content').load('../Chung/php/foot.php');
    </script>
</body>

</html>
