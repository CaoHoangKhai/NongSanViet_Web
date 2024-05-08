<?php
    require '../Chung/php/connect.php';
    include "header_user.php"; 
    include "sidebar.php";
    if(isset($_SESSION['login']) && $_SESSION['login'] === true && isset($_SESSION['user_info'])) {
        // Access user information
        $userInfo = $_SESSION['user_info'];
        $id_user =  $userInfo[0];
        
        // Now you can use $userInfo array as needed

        $email = $userInfo[1];

        // Display or use the information as per your requirements
        // echo "Welcome,User! Your email is: $email";
    } else {
        // Redirect to login page if the user is not logged in
        header("Location: ../DangNhap/DangNhap.php");
        exit();
    }
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Nông Sản Việt</title>

    
    

    </head>

<body> 
    

<div class="container">
    <div class="row">
        <div class="col-14 offset-md-1">
            <?php
                if (!empty($_SESSION['del_order'])) {
                    $_SESSION['success_expire'] = time() + 3; // Thời gian hết hạn là 3 giây
                    ?>
                    <div class="alert alert-success mb-1" id="success-alert" role="alert"><?= $_SESSION['del_order'] ?></div>
                    <?php unset($_SESSION['del_order']);
                }
            ?>
            <?php
            if(isset($_GET['trang'])){
                $page = $_GET['trang'];
            }else{
                $page = '';
            }
            if( $page == '' ||  $page == 1){
                $begin =0;
            }else {
                $begin = ($page*7)-7;
            }
            $sql = "SELECT * FROM order_customer WHERE id_user = '$id_user' ORDER BY id_order DESC LIMIT  $begin,7";
            $result = mysqli_query($conn, $sql);

            // Kiểm tra xem có đơn hàng nào hay không
            if (mysqli_num_rows($result) > 0) {
            ?>
            <table class="table table-striped">
                <!-- Bảng dữ liệu đơn hàng -->
                <!-- Tiêu đề bảng -->
                <thead>
                    <tr>
                        <th scope="col" class="col-2">Khách Hàng</th>
                        <th scope="col" class="col-0.5">Email</th>
                        <th scope="col" class="col-0.25">Điện Thoại</th>
                        <th scope="col" class="col-1.75">Trạng Thái Đơn Hàng</th>
                        <th scope="col" class="col-2">Địa Chỉ</th>
                        <th scope="col" class="col-1.5">Chi Tiết</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_array($result)) {
                        // Lấy id_order từ kết quả truy vấn
                        $id_order = $row['id_order'];
                    ?>
                    <tr>
                        <!-- Hiển thị thông tin đơn hàng -->
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['phonenumber']; ?></td>
                        <td>
                            <?php
                            if ($row['status'] == 0) {
                                echo "Đơn hàng đang chờ xác nhận";
                            } elseif ($row['status'] == 1) {
                                echo "Đơn hàng đang được chuẩn bị";
                            } elseif ($row['status'] == 2) {
                                echo "Đơn hàng đang được vận chuyển";
                            } elseif ($row['status'] == 3) {
                                echo "Đơn hàng giao thành công";
                            } elseif ($row['status'] == 4) {
                                echo "Đơn hàng vận chuyển thất bại";
                            } elseif ($row['status'] == 5) {
                                echo "Đơn hàng đang chờ xác nhận (HỦY)";
                            } elseif ($row['status'] == 6) {
                                echo "Đơn hàng yêu cầu HỦY thành công";
                            }
                            ?>
                        </td>
                        <td><?php echo $row['address']; ?></td>
                        <td>
                            <!-- Button chi tiết đơn hàng -->
                            <form action="" method="post">
                                <!-- Cập nhật giá trị id_order -->
                                <input type="hidden" name="id_order" value="<?php echo $id_order; ?>">
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $id_order; ?>">
                                    Chi Tiết
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
                <?php
                    $count = "SELECT COUNT(*) as total FROM order_customer WHERE id_user = '$id_user'";
                    $kq = $conn->query($count);
                    $row = $kq->fetch_assoc();
                    $totalCustomers = $row['total'];
                    $trang = ceil($totalCustomers/7);
                ?>
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-end" id="pagination">
                        <li class="page-item">
                            <a class="page-link" href="admin_order.php?trang=1" aria-label="Previous">
                                <span aria-hidden="true" name="first">&laquo;</span>
                            </a>
                        </li>
                        <?php
                        for($i =1;$i <= $trang;$i++){
                        ?>
                        <li class="page-item"><a class="page-link" href="admin_order.php?trang=<?php echo $i ?>"><?php echo $i ?></a></li>
                        <?php
                        }
                        ?>

                        <li class="page-item">
                            <?php 
                                if($trang == 0) $trang =1;
                            ?>
                            <a class="page-link" href="admin_order.php?trang=<?php echo $trang ?>" aria-label="Next">
                                <span aria-hidden="true" name="last">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            <?php
            } else {
                // Hiển thị thông báo khi không có đơn hàng
                echo '<div class="text-center fs-4"><p>Bạn chưa có đơn hàng.</p>';
                echo '<div class="d-flex justify-content-center" style="background-color: transparent;">';
                echo '<img src="../../Data/Cart/ko_co_don_hang.png" alt="Bạn chưa có đơn hàng" class="img-thumbnail border-0" style=" background-color: transparent; width: 200px;">';
                echo '</div>';
                echo '</div>';
                
            }
            
            ?>
        </div>

        <!-- Modal -->
        <?php
            // Bắt đầu mới một vòng lặp để tạo modal cho mỗi id_order
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)) {
                $id_order = $row['id_order'];
        ?>
        <div class="modal fade" id="exampleModal<?php echo $id_order; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Chi Tiết Đơn Hàng</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body row g-3 needs-validation">
                        
                        <?php
                            // Truy vấn chi tiết đơn hàng và thông tin sản phẩm cho mỗi id_order
                            $sql_donhang = "SELECT * FROM order_detail o_r 
                                            JOIN product p ON o_r.product_id = p.product_id 
                                            WHERE o_r.id_order = $id_order";
                            $result_donhang = mysqli_query($conn, $sql_donhang);
                            echo '<tr>' .
                                    '<div class="col-md-6">' .
                                        '<label for="inputNumber4" class="form-label"><strong>Họ và Tên</strong></label>' .
                                        '<input type="text" class="form-control" name="username" id="inputNumber4" value="' . $row['username'] . '" disabled>' .
                                    '</div>' .
                                    '<div class="col-md-6">' .
                                        '<label for="inputNumber4" class="form-label"><strong>Email</strong></label>' .
                                        '<input type="text" class="form-control" name="email" id="inputNumber4" value="' . $row['email'] . '" disabled>' .
                                    '</div>' .
                                    '<div class="col-md-6">' .
                                        '<label for="inputNumber4" class="form-label"><strong>Số điện thoại</strong></label>' .
                                        '<input type="text" class="form-control" name="phonenumber" id="inputNumber4" value="' . $row['phonenumber'] . '" disabled>' .
                                    '</div>' .
                                    '<div class="col-md-6">' .
                                        '<label for="inputNumber4" class="form-label"><strong>Địa chỉ</strong></label>' .
                                        '<input type="text" class="form-control" name="address" id="inputNumber4" value="' . $row['address'] . '" disabled>' .
                                    '</div>';

                            echo '<div class="col-md-6">' .
                                '<label for="inputNumber4" class="form-label"><strong>Phương Thức Thanh Toán</strong></label>' .
                                '<input type="text" class="form-control" name="payment_method" id="inputNumber4" value="';
                            if ($row['type'] === 'Thanh_Toan_Khi_Nhan_Hang') {
                                echo 'Thanh Toán Khi Nhận Hàng';
                            } elseif ($row['type'] === 'Thanh_Toan_Bang_Vi_Dien_Tu') {
                                echo 'Thanh toán bằng ví điện tử';
                            } elseif ($row['type'] === 'Thanh_Toan_Qua_Ngan_Hang') {
                                echo 'Thẻ Tín Dụng/ Ghi Nợ';
                            } else {
                                echo 'Other Payment Method';
                            }
                            echo '" disabled>'.
                                '</div>';

                            if (!empty($row['note'])) {
                                echo '<div class="col-md-12">' .
                                        '<label for="inputNumber4" class="form-label"><strong>Ghi Chú</strong></label>' .
                                        '<input type="text" class="form-control" name="edit_phonenumber" id="inputNumber4" value="' . $row['note'] . '" disabled>' .
                                    '</div>';
                            }

                            echo '<div class="col-md-12">' .
                                    '<label for="inputNumber4" class="form-label fs-4"><strong>Thông tin sản phẩm</strong></label>' .
                                '</div>';

                            while ($row_donhang = mysqli_fetch_array($result_donhang)) {
                                if ($row_donhang['quantity_product'] > 0) {
                                    echo '<td>' .
                                            '<div class="d-flex align-items-center">' .
                                                '<span class="ml-2 fs-6">' . $row_donhang['product_name'] . '-1kg x ' . $row_donhang['quantity_product'] . '</span>' .
                                                '<strong class="ms-auto fs-6">' . number_format($row_donhang['quantity_product'] * $row_donhang['price'], 0, ',', ',') . ' VND</strong>' .
                                            '</div>' .
                                        '</td>';
                                }
                            }

                            echo '<hr>' . 
                                '<div class="d-flex align-items-center">' .
                                    '<span class="ml-2 fs-4"><strong> Tổng Tiền</strong></span>' .
                                    '<strong class="ms-auto fs-4">' . number_format($row['price'], 0, ',', ',') . ' VND</strong>' .
                                '</div>';
                            ?>

                        <form class="row g-3 needs-validation" action="../Chung/php/code.php" method="post" novalidate>
                            <div class="col-12">
                                <div class="col-md-6">
                                    <input type="hidden" name="id_user" value="<?php echo $row['id_user']; ?>">
                                    <input type="hidden" name="id_order" value="<?php echo $row['id_order']; ?>">
                                    <?php if ($row['status'] >= 2): ?>
                                        <!-- Hide the button if status is greater than or equal to 2 -->
                                        <!-- You can add additional styling or classes to make it hidden -->
                                        <button type="submit" class="btn btn-primary d-none" value="Hủy Đơn Hàng" name="del_order">Hủy Đơn Hàng</button>
                                    <?php else: ?>
                                        <!-- Show the button if status is less than 2 -->
                                        <button type="submit" class="btn btn-primary" value="Hủy Đơn Hàng" name="del_order">Hủy Đơn Hàng</button>
                                    <?php endif; ?>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div> 
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <?php
            }
        ?>
    </div>
</div>

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
    
    
</body>
</html>