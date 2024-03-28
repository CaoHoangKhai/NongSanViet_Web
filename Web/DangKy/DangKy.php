<?php
session_start();
require '../Chung/php/connect.php';

if (isset($_POST['sign_up'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $phonenumber = $_POST['phonenumber'];
    $email = $_POST['email'];
    $city = $_POST['city'];
    $district = $_POST['district'];
    $address = $_POST['address'];

    if (!empty($username) && !empty($password) && !empty($phonenumber) && !empty($email) && !empty($city) && !empty($district) && !empty($address)) {

        // Kiểm tra xem email đã tồn tại trong cơ sở dữ liệu hay chưa
        $checkEmailQuery = "SELECT * FROM `customer` WHERE `email` = '$email'";
        $checkEmailResult = $conn->query($checkEmailQuery);
        // Kiểm tra xem số điện thoại đã tồn tại trong cơ sở dữ liệu hay chưa
        $checkPhoneQuery = "SELECT * FROM `customer` WHERE `phonenumber` = '$phonenumber'";
        $checkPhoneResult = $conn->query($checkPhoneQuery);

        if ($checkPhoneResult->num_rows > 0) {
            echo "<script>alert('Số điện thoại đã được sử dụng. Vui lòng chọn số điện thoại khác.')</script>";
        } else if($checkEmailResult->num_rows > 0) {
            echo "<script>alert('Email đã được sử dụng. Vui lòng chọn email khác.')</script>";
        } else {
            // Thêm dữ liệu vào cơ sở dữ liệu
            $insertQuery = "INSERT INTO `customer` (`username`, `password`, `phonenumber`, `email`, `city`, `district`, `address`) 
                VALUES ('$username', '$password', '$phonenumber', '$email', '$city', '$district', '$address')";

            if ($conn->query($insertQuery) === TRUE) {
                echo "<script>alert('Đăng ký thành công')</script>";
            } else {
                echo "Lỗi: " . $insertQuery . "<br>" . $conn->error;
            }
        }
    }
}
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
    <script src="DangKy.js"defer></script>

    <!-- <script src="https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script> -->
    
    <!--Script chen html-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <header>
        <div id="head_content"></div>
    </header>
    <main>
        <div class="mx-2">
            <div class="container">
                <form class="row g-3 needs-validation" action="" method="post" novalidate>
                    <div class="col-md-6">
                        <label class="form-label fs-6"><strong>Họ và tên*</strong></label>
                        <input type="text" class="form-control" name="username" id="fullname" placeholder="Họ tên của bạn" 
                        autofocus
                            required>
                        <div class="invalid-feedback">
                            Họ và tên không được bỏ trống.
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="inputPassword4" class="form-label"><strong>Password</strong></label>
                        <input type="password" class="form-control" name="password" id="inputPassword4" placeholder="Nhập mật khẩu của bạn"
                            required>
                        <div class="invalid-feedback">
                            PassWord không được bỏ trống.
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="inputNumber4" class="form-label"><strong>Số điện thoại*</strong></label>
                        <input type="text" class="form-control" name="phonenumber" id="inputNumber4" placeholder="Số điện thoại của bạn"
                            required>
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
                        <label for="inputEmail4" class="form-label"><strong>Email*</strong></label>
                        <input type="email" class="form-control" name="email" id="inputEmail4" placeholder="Email của bạn" required>
                        <div class="invalid-feedback">
                            Email không được bỏ trống.
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="validationCustom04" class="form-label"><strong>Tỉnh/Thành phố*</strong></label>
                        <select class="form-select" name="city" id="city" required>
                            <option selected value="">Chọn Tỉnh/Thành phố của bạn</option>
                        </select>
                        <div class="invalid-feedback">
                            Hãy chọn một tỉnh/thành phố hợp lệ.
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="validationCustom04" class="form-label"><strong>Quận/Huyện*</strong></label>
                        <select class="form-select" name="district" id="district" required>
                            <option selected value="">Chọn Quận/Huyện của bạn</option>
                        </select>
                        <div class="invalid-feedback">
                            Hãy chọn một quận/huyện hợp lệ.
                        </div>
                    </div>
                    

                    <div class="col-md-6">
                        <label for="inputAddress" class="form-label"><strong>Địa chỉ*</strong></label>
                        <input type="text" class="form-control" name="address" id="inputAddress"
                            placeholder="Nhập địa chỉ của bạn VD:Số 20,ngõ 90" required>
                        <div class="invalid-feedback">
                            Địa chỉ không được bỏ trống.
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary" name="sign_up" value="Đăng Ký">Đăng Ký</button>
                            <button type="reset" class="btn btn-primary">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <footer>
        <div id="foot_content"></div>
    </footer>
</body>
<script type="text/javascript">
    $('#head_content').load('../Chung/php/head.php');
    $('#foot_content').load('../Chung/php/foot.php');
</script>
</html>