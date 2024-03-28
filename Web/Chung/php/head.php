<?php
session_start();
require 'connect.php';
?>

<!DOCTYPE html>
<html>

<head>
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Nông Sản Việt</title>
   


</head>

<body>
    <style>
        body {
            background-image: url("../../Data/BackGround/bottom.jpg");
            background-color: rgba(200, 200, 200, 0);
            background-repeat: repeat; 
            background-size:  cover ;/*  contain auto Đảm bảo hình nền kích thước phù hợp với kích thước cửa sổ trình duyệt */
        }
    </style>
   <header>
    <div class="logo">
        <a href="../../../../WEB_BAN_HANG/Web/TrangChu/TrangChu.php">
            <img src="../../../../WEB_BAN_HANG/Data/Logo/header/banner_header_top.png" alt="Logo" style="width:100%; height: 110px;">
        </a>
    </div>
    


    <!-- <div class="p-3 mb-2  text-white" style="background-color: #65B741;">
            <div class="row">
            <div class="col-sm-8">
            
            </div>
            
            <div class="col-sm-4">
            </div>
    </div> -->


    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler " type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <a class="nav-link fs-6" href="../../../../WEB_BAN_HANG/Web/TrangChu/TrangChu.php"><strong>TRANG CHỦ</strong></a>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fs-6" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <strong>GẠO </strong>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="../../../../WEB_BAN_HANG/Web/SanPham/SanPham.php">Gạo Đặc Sản</a></li>
                            <li><a class="dropdown-item" href="../../../../WEB_BAN_HANG/Web/Gao/GaoDeoThom.php">Gạo Dẻo Thơm</a></li>
                            <li><a class="dropdown-item" href="../../../../WEB_BAN_HANG/Web/Gao/GaoNep.php">Gạo Nếp</a></li>
                            <li><a class="dropdown-item" href="../../../../WEB_BAN_HANG/Web/Gao/GaoTam.php">Gạo Tấm</a></li>
                            <li><a class="dropdown-item" href="../../../../WEB_BAN_HANG/Web/Gao/GaoLut.php">Gạo Lứt</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-6" href="#"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-6" href="../../../../WEB_BAN_HANG/Web/TinTuc/TinTuc.html"><strong>TIN TỨC</strong></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-6" href="../../../../WEB_BAN_HANG/Web/LienHe/LienHe.php"><strong>LIÊN HỆ</strong></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link fs-6" href="../../../../WEB_BAN_HANG/Web/GioiThieu/GioiThieu.php"><strong>VỀ CHÚNG TÔI</strong></a>
                    </li>
                    
                </ul>
            </div>

            <!-- <form class="navbar-form d-flex" action ="../../Gao/GaoSearch.php" method="POST"> -->
                <div class=" d-flex align-items-center">
                <form class="navbar-form d-flex" action ="../../../../WEB_BAN_HANG/Web/Gao/GaoSearch.php" method="POST" onsubmit="return validateForm()">
                    <input class="form-control search-input" placeholder="Search" aria-label="Search" name="search_name" id="search_name">
                    <div class="invalid-feedback" id="error-message" style="color: red;"></div>
                    
                    <button class="btn btn-outline-success me-2" type="submit" name="search">Search</button>
                </form>
                    
               
                    <a href="../../../../WEB_BAN_HANG/Web/GioHang/GioHang.php" class="btn btn-outline-success me-2" type="a">
                        <i class="fas fa-shopping-cart"></i>
                    </a>
                    <?php
                        // Kiểm tra trạng thái đăng nhập
                        if(isset($_SESSION['user_info']) && !empty($_SESSION['user_info'])) {
                            // Nếu đã đăng nhập, hiển thị biểu tượng user
                            $userInfo = $_SESSION['user_info'];
                            $email = $userInfo[1];
                            //$u = array($row['id_user'], $email,$row["role"],$password);
                            if ($userInfo[2] == 0) {
                                // Nếu là người dùng, chuyển đến trang người dùng
                                echo '<a href="../../../../WEB_BAN_HANG/Web/user/user_info.php" class="btn btn-outline-success me-2" type="a"><i class="fas fa-user"></i></a>';
                            } elseif ($userInfo[2] == 1) {
                                // Nếu là admin, chuyển đến trang admin
                                echo '<a href="../../../../WEB_BAN_HANG/Web/admin/admin.php" class="btn btn-outline-success me-2" type="a"><i class="fas fa-user"></i></a>';
                            }

                            // Bạn có thể hiển thị email hoặc bất kỳ thông tin người dùng khác nếu cần
                            // echo '<a href="../../../../WEB_BAN_HANG/Web/user/user.php" class="btn btn-outline-success me-2" type="a"><i class="fas fa-user"></i></a>';
                            // echo '<a>'.$email.'</a>';
                        } else {
                            // Nếu chưa đăng nhập, hiển thị nút Đăng Nhập
                            echo '<a href="../../../../WEB_BAN_HANG/Web/DangNhap/DangNhap.php" class="btn btn-outline-success me-2" type="a"><i class="fas fa-user"></i></a>';
                        }
                    ?>

                </div>
            <!-- </form> -->
        </div>
    </nav>
    <script>
    function validateForm() {
        // Lấy giá trị của trường nhập liệu
        var searchName = document.getElementById('search_name').value;

        // Kiểm tra xem trường nhập liệu có rỗng hay không
        if (searchName.trim() === "") {
            // Hiển thị thông báo lỗi
            document.getElementById('error-message').innerHTML = 'Vui lòng nhập thông tin tìm kiếm.';
            return false; // Ngăn chặn việc gửi form nếu có lỗi
        } else {
            // Xóa thông báo lỗi nếu trường nhập liệu hợp lệ
            document.getElementById('error-message').innerHTML = '';
            return true; // Cho phép gửi form nếu không có lỗi
        }
    }
</script>
</header>