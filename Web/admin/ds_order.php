<?php
include '../Chung/php/connect.php';
include "header_admin.php";
include "sidebar.php";
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="../../Data/Logo/logo.ico">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script src="../Chung/js/header.js" defer></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-14 offset-md-1">
                <!-- Mã PHP và HTML cho bảng -->
                <?php
                if (!empty($_SESSION['success'])) {
                    $_SESSION['success_expire'] = time() + 3; // Thời gian hết hạn là 3 giây
                ?>
                    <div class="alert alert-success mb-1" id="success-alert" role="alert"><?= $_SESSION['success'] ?></div>
                <?php unset($_SESSION['success']);
                }
                ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col" class="col-1.5">Họ tên</th>
                            <th scope="col" class="col-0.5">Điện Thoại</th>
                            <th scope="col" class="col-0.5">Địa Chỉ</th>
                            <th scope="col" class="col-2.5">Hình Thức Nhận Hàng</th>
                            <th scope="col" class="col-0.75">Tổng</th>
                            <th scope="col" class="col-1.5"></th>
                            <th scope="col" class="col-0.5"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($_GET['trang'])) {
                            $page = $_GET['trang'];
                        } else {
                            $page = '';
                        }
                        if ($page == '' ||  $page == 1) {
                            $begin = 0;
                        } else {
                            $begin = ($page * 8) - 8;
                        }
                        ?>
                        <?php
                        $sql = "SELECT order_customer.*, customer.id_user FROM order_customer JOIN customer ON order_customer.id_user = customer.id_user ORDER BY order_customer.id_order DESC  LIMIT $begin,8";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_array($result)) {
                            // Lấy id_order từ kết quả truy vấn
                            $id_order = $row['id_order'];
                        ?>
                            <tr>
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['phonenumber']; ?></td>
                                <td><?php echo $row['address']; ?></td>
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
                                <td><?php echo number_format($row['price'], 0, ',', ',') . ' VND'; ?></td>

                                <td class="d-flex align-items-center">
                                    <form action="" method="post">
                                        <!-- Cập nhật giá trị id_order -->
                                        <input type="hidden" name="id_order" value="<?php echo $id_order; ?>">
                                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $id_order; ?>"> Chi Tiết </button>
                                    </form>
                                </td>
                                <td>
                                    <form action="code.php" method="post">
                                        <input type="hidden" name="id_order" value="<?php echo $row['id_order']; ?>">
                                        <button type="submit" name="del_order_customer" class="btn btn-success">Xóa</button>
                                    </form>

                                    </script>
                                </td>

                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <?php
                $count = "SELECT COUNT(*) as total FROM order_customer";
                $kq = $conn->query($count);
                $row = $kq->fetch_assoc();
                $totalCustomers = $row['total'];
                $trang = ceil($totalCustomers / 8);
                ?>
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-end" id="pagination">
                        <li class="page-item">
                            <a class="page-link" href="ds_order.php?trang=1" aria-label="Previous">
                                <span aria-hidden="true" name="first">&laquo;</span>
                            </a>
                        </li>
                        <?php
                        for ($i = 1; $i <= $trang; $i++) {
                        ?>
                            <li class="page-item"><a class="page-link" href="ds_order.php?trang=<?php echo $i ?>"><?php echo $i ?></a></li>
                        <?php
                        }
                        ?>
                        <li class="page-item">
                            <a class="page-link" href="ds_order.php?trang=<?php echo $trang ?>" aria-label="Next">
                                <span aria-hidden="true" name="last">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
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
                                <!-- <form class="row g-3 needs-validation" action="" method="post" novalidate> -->
                                <?php
                                // Truy vấn chi tiết đơn hàng và thông tin sản phẩm cho mỗi id_order
                                $sql_donhang = "SELECT * FROM order_detail o_r 
                                                JOIN product p ON o_r.product_id = p.product_id 
                                                WHERE o_r.id_order = $id_order";
                                $result_donhang = mysqli_query($conn, $sql_donhang);
                                echo '<tr>' .
                                    '<div class="col-md-6">' .
                                    '<label for="inputNumber4" class="form-label"><strong>Họ và Tên</strong></label>' .
                                    '<input type="text" class="form-control" name="username" id="inputNumber4" value="' . $row['username'] . '"disabled>' .
                                    '</div>' .
                                    '<div class="col-md-6">' .
                                    '<label for="inputNumber4" class="form-label"><strong>Email</strong></label>' .
                                    '<input type="text" class="form-control" name="email" id="inputNumber4" value="' . $row['email'] . '" disabled>' .
                                    '</div>' .
                                    '<div class="col-md-6">' .
                                    '<label for="inputNumber4" class="form-label"><strong>Số điện thoại</strong></label>' .
                                    '<input type="text" class="form-control" name="phonenumber" id="inputNumber4" value="' . $row['phonenumber'] . '"disabled>' .
                                    '</div>' .
                                    '<div class="col-md-6">' .
                                    '<label for="inputNumber4" class="form-label"><strong>Địa chỉ</strong></label>' .
                                    '<input type="text" class="form-control" name="address" id="inputNumber4" value="' . $row['address'] . '"disabled>' .
                                    '</div>';
                                echo '<div class="col-md-6">' .
                                    '<label for="inputNumber4" class="form-label"><strong>Phương Thức Thanh Toán</strong></label>';
                                switch ($row['type']) {
                                    case 'Thanh_Toan_Khi_Nhan_Hang':
                                        echo '<input type="text" class="form-control" value="Thanh Toán Khi Nhận Hàng" readonly>';
                                        break;
                                    case 'Thanh_Toan_Bang_Vi_Dien_Tu':
                                        echo '<input type="text" class="form-control" value="Thanh toán bằng ví điện tử" readonly>';
                                        break;
                                    case 'Thanh_Toan_Qua_Ngan_Hang':
                                        echo '<input type="text" class="form-control" value="Thẻ Tín Dụng/ Ghi Nợ" readonly>';
                                        break;
                                    default:
                                        echo '<input type="text" class="form-control" value="Chọn loại sản phẩm" readonly>';
                                }
                                echo '</div>';
                                echo '<div class="col-md-6">
                                            <form action="code.php" method="post">
                                                <label for="inputNumber4" class="form-label"><strong>Trạng Thái Đơn Hàng</strong></label>
                                                <select class="form-select" id="inputGroupSelect01" name="edit_status">';
                                switch ($row['status']) {
                                    case 0:
                                        echo '<option value="0" selected>Đơn hàng đang chờ xác nhận</option>';
                                        echo '<option value="1">Đơn hàng đang được chuẩn bị</option>';
                                        echo '<option value="2">Đơn hàng đang được vận chuyển</option>';
                                        echo '<option value="3">Đơn hàng giao thành công</option>';
                                        echo '<option value="4">Đơn hàng vận chuyển thất bại</option>';
                                        // echo '<option value="5">Đơn hàng đang chờ xác nhận (HỦY)</option>';
                                        // echo '<option value="6">Đơn hàng yêu cầu HỦY thành công</option>';
                                        break;
                                    case 1:
                                        // echo '<option value="0">Đơn hàng đang chờ xác nhận</option>';
                                        echo '<option value="1" selected>Đơn hàng đang được chuẩn bị</option>';
                                        echo '<option value="2">Đơn hàng đang được vận chuyển</option>';
                                        echo '<option value="3">Đơn hàng giao thành công</option>';
                                        echo '<option value="4">Đơn hàng vận chuyển thất bại</option>';
                                        // echo '<option value="5">Đơn hàng đang chờ xác nhận (HỦY)</option>';
                                        // echo '<option value="6">Đơn hàng yêu cầu HỦY thành công</option>';
                                        break;
                                    case 2:
                                        // echo '<option value="0">Đơn hàng đang chờ xác nhận</option>';
                                        // echo '<option value="1">Đơn hàng đang được chuẩn bị</option>';
                                        echo '<option value="2" selected>Đơn hàng đang được vận chuyển</option>';
                                        echo '<option value="3">Đơn hàng giao thành công</option>';
                                        echo '<option value="4">Đơn hàng vận chuyển thất bại</option>';
                                        // echo '<option value="5">Đơn hàng đang chờ xác nhận (HỦY)</option>';
                                        // echo '<option value="6">Đơn hàng yêu cầu HỦY thành công</option>';
                                        break;
                                    case 3:
                                        // echo '<option value="0">Đơn hàng đang chờ xác nhận</option>';
                                        // echo '<option value="1">Đơn hàng đang được chuẩn bị</option>';
                                        // echo '<option value="2">Đơn hàng đang được vận chuyển</option>';
                                        echo '<option value="3" selected>Đơn hàng giao thành công</option>';
                                        echo '<option value="4">Đơn hàng vận chuyển thất bại</option>';
                                        // echo '<option value="5">Đơn hàng đang chờ xác nhận (HỦY)</option>';
                                        // echo '<option value="6">Đơn hàng yêu cầu HỦY thành công</option>';
                                        break;
                                    case 4:
                                        // echo '<option value="0">Đơn hàng đang chờ xác nhận</option>';
                                        // echo '<option value="1">Đơn hàng đang được chuẩn bị</option>';
                                        // echo '<option value="2">Đơn hàng đang được vận chuyển</option>';
                                        // echo '<option value="3">Đơn hàng giao thành công</option>';
                                        echo '<option value="4" selected>Đơn hàng vận chuyển thất bại</option>';
                                        // echo '<option value="5">Đơn hàng đang chờ xác nhận (HỦY)</option>';
                                        // echo '<option value="6">Đơn hàng yêu cầu HỦY thành công</option>';
                                        break;
                                    case 5:
                                        // echo '<option value="0">Đơn hàng đang chờ xác nhận</option>';
                                        // echo '<option value="1">Đơn hàng đang được chuẩn bị</option>';
                                        // echo '<option value="2">Đơn hàng đang được vận chuyển</option>';
                                        // echo '<option value="3">Đơn hàng giao thành công</option>';
                                        // echo '<option value="4">Đơn hàng vận chuyển thất bại</option>';
                                        echo '<option value="5" selected>Đơn hàng đang chờ xác nhận (HỦY)</option>';
                                        echo '<option value="6">Đơn hàng yêu cầu HỦY thành công</option>';
                                        break;

                                    case 6:
                                        // echo '<option value="0">Đơn hàng đang chờ xác nhận</option>';
                                        // echo '<option value="1">Đơn hàng đang được chuẩn bị</option>';
                                        // echo '<option value="2">Đơn hàng đang được vận chuyển</option>';
                                        // echo '<option value="3">Đơn hàng giao thành công</option>';
                                        // echo '<option value="4">Đơn hàng vận chuyển thất bại</option>';
                                        // echo '<option value="5">Đơn hàng đang chờ xác nhận (HỦY)</option>';
                                        echo '<option value="6" selected>Đơn hàng yêu cầu HỦY thành công</option>';
                                        break;
                                }
                                echo '</select>
                                                <input type="hidden" name="id_order" value="' . $row['id_order'] . '">
                                                <input type="hidden" name="trang" value="' .  $page . '">
                                                <button type="submit" class="btn btn-primary mt-3" name="up_status">Cập Nhật Trạng Thái</button>
                                            </form>
                                        </div>';





                                if (!empty($row['note'])) {
                                    echo '<div class="col-md-12">' .
                                        '<label for="inputNumber4" class="form-label"><strong>Ghi Chú</strong></label>' .
                                        '<input type="text" class="form-control" name="edit_phonenumber" id="inputNumber4" value="' . $row['note'] . '"disabled>' .
                                        '</div>';
                                };
                                echo '<div class="col-md-12">' .
                                    '<label for="inputNumber4" class="form-label fs-4"><strong>Thông tin sản phẩm</strong></label>' .
                                    '</div>';


                                while ($row_donhang = mysqli_fetch_array($result_donhang)) {
                                    echo
                                    '<td>' .
                                        '<div class="d-flex align-items-center">' .
                                        '<span class="ml-2">' . $row_donhang['product_name'] . '-1kg x ' . $row_donhang['quantity_product'] . '</span>' .
                                        '<strong class="ms-auto">' . number_format($row_donhang['quantity_product'] * $row_donhang['price'], 0, ',', ',') . ' VND</strong>' .
                                        '</div>' .
                                        '</td>';
                                }
                                echo '<hr>' .
                                    '<div class="d-flex align-items-center">' .

                                    '<span class="ml-2 fs-4"><strong> Tổng Tiền</strong></span>' .
                                    '<strong class="ms-auto fs-4">' . number_format($row['price'], 0, ',', ',') . ' VND</strong>' .
                                    '</div>';
                                ?>
                                <!-- </form> -->
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
        document.addEventListener("DOMContentLoaded", function() {
            var successAlert = document.getElementById('success-alert');
            var expireTime = <?= !empty($_SESSION['success_expire']) ? $_SESSION['success_expire'] : 0 ?>;

            if (successAlert && expireTime > 0) {
                setTimeout(function() {
                    successAlert.style.display = 'none';
                }, (expireTime - <?= time() ?>) * 1000);
            }
        });
    </script>
</body>

</html>