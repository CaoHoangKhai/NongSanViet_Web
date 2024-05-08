<?php
require '../Chung/php/connect.php';
include "header_user.php"; 
include "sidebar.php";

if (isset($_SESSION['login']) && $_SESSION['login'] === true && isset($_SESSION['user_info'])) {
    // Access user information
    $userInfo = $_SESSION['user_info'];
    $id_user = $userInfo[0];
    
    // Now you can use $userInfo array as needed

    $email = $userInfo[1];

    // Display or use the information as per your requirements
    // echo "Welcome,User! Your email is: $email";
} else {
    // Redirect to login page if the user is not logged in
    header("Location: ../DangNhap/DangNhap.php");
    exit();
}



$sql = "SELECT * FROM customer WHERE id_user = '$id_user'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
?>
<?php

// Hàm kiểm tra số điện thoại
function isValidPhoneNumber($phoneNumber) {
    $phoneRegex = '/^[0-9]{10}$/';
    return preg_match($phoneRegex, $phoneNumber);
}

if (isset($_POST['update_user'])) {
    $id = $id_user;
    $username = $_POST['username'];
    $phonenumber = $_POST['phonenumber'];
    $email = $_POST['email'];

    $address = $_POST['address'];

    // Kiểm tra xem số điện thoại đã tồn tại chưa
    $check_phone_query = "SELECT * FROM customer WHERE phonenumber = '$phonenumber' AND id_user != '$id'";
    $check_phone_result = mysqli_query($conn, $check_phone_query);

    // Kiểm tra xem email đã tồn tại chưa
    $check_email_query = "SELECT * FROM customer WHERE email = '$email' AND id_user != '$id'";
    $check_email_result = mysqli_query($conn, $check_email_query);

    if (mysqli_num_rows($check_phone_result) > 0) {
        // Số điện thoại đã tồn tại
        $_SESSION['success'] = "Số điện thoại đã được sử dụng bởi người khác. VUI LÒNG KIỂM TRA LẠI THÔNG TIN";
        
    } elseif (mysqli_num_rows($check_email_result) > 0) {
        // Email đã tồn tại
        $_SESSION['success'] = "Email đã được sử dụng bởi người khác. VUI LÒNG KIỂM TRA LẠI THÔNG TIN";
        
    } else {
        // Tiến hành cập nhật nếu số điện thoại và email không bị trùng
       


        $query = "UPDATE customer SET username='$username', phonenumber ='$phonenumber', email='$email',address='$address' WHERE id_user='$id'";
        $query_run = mysqli_query($conn, $query);

        if ($query_run) {
            $_SESSION['success'] = "Dữ liệu đã được cập nhật";
            
        } else {
            $_SESSION['success'] = "Dữ liệu cập nhật thất bại. VUI LÒNG KIỂM TRA LẠI THÔNG TIN";
            
        }
    }
}

?>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
    </head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-11 offset-md-1">
            <?php
                if (!empty($_SESSION['success'])) {
                    $_SESSION['success_expire'] = time() + 3; // Thời gian hết hạn là 3 giây
                    ?>
                    <div class="alert alert-success mb-1" id="success-alert" role="alert"><?= $_SESSION['success'] ?></div>
                    <?php unset($_SESSION['success']);
                }
            ?>
            </div>
            <div class="col-md-4 offset-md-1">
                <label class="form-label fs-6"><strong>Họ và tên</strong></label>
                <input type="text" class="form-control border-dark" name="username" id="fullname" value="<?php echo $row['username']; ?>" disabled>
            </div>
            <div class="col-md-4 offset-md-1">
                <label for="inputNumber4" class="form-label"><strong>Số điện thoại</strong></label>
                <input type="text" class="form-control border-dark" name="phonenumber" id="inputNumber4" value="<?php echo $row['phonenumber']; ?>" disabled>
            </div>
            
            <div class="col-md-4 offset-md-1">
                <label for="inputEmail4" class="form-label"><strong>Email</strong></label>
                <input type="email" class="form-control border-dark" name="email" id="inputEmail4" value="<?php echo $row['email']; ?>" disabled>
                
            </div>

           

            <div class="col-md-4 offset-md-1">
                <label for="inputAddress" class="form-label"><strong>Địa chỉ</strong></label>
                <input type="text" class="form-control border-dark" name="address" id="inputAddress" value="<?php echo $row['address']; ?>" disabled>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-1">
                <button type="button" class="btn btn-primary mt-3 mb-3 float-md-start" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Cập Nhật Thông Tin
                </button>
            </div>
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thông Tin </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <form class="row g-3 needs-validation" action="" method="post" novalidate>
                            <div class="col-md-6">
                                <label class="form-label fs-6"><strong>Họ và tên</strong></label>
                                <input type="text" class="form-control" name="username" id="fullname" placeholder="Họ tên của bạn" 
                                autofocus value="<?php echo $row['username'];?>"
                                required>
                                <div class="invalid-feedback">
                                    Họ và tên không được bỏ trống.
                                </div>
                            </div>

                            <!-- <div class="col-md-6">
                                <label for="inputPassword4" class="form-label"><strong>Password</strong></label>
                                <input type="password" class="form-control" name="password" id="inputPassword4" placeholder="Nhập mật khẩu của bạn"  value="<?php echo $row['password'];?>"
                                required>
                                <div class="invalid-feedback">
                                    PassWord không được bỏ trống.
                                </div>
                            </div> -->

                            <div class="col-md-6">
                                <label for="inputNumber4" class="form-label"><strong>Số điện thoại</strong></label>
                                <input type="text" class="form-control" name="phonenumber" id="inputNumber4" value="<?php echo $row['phonenumber'];?>">
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
                                <label for="inputEmail4" class="form-label"><strong>Email</strong></label>
                                <input type="email" class="form-control" name="email" id="inputEmail4" placeholder="Email của bạn" value="<?php echo $row['email']; ?>">
                                <div class="invalid-feedback">
                                    Email không được bỏ trống.
                                </div>
                            </div>

                           

                            <div class="col-md-6">
                                <label for="inputAddress" class="form-label"><strong>Địa chỉ</strong></label>
                                <input type="text" class="form-control" name="address" id="inputAddress"
                                placeholder="Nhập địa chỉ của bạn VD:Số 20,ngõ 90"  value="<?php echo $row['address']; ?>" required>
                                <div class="invalid-feedback">
                                    Địa chỉ không được bỏ trống.
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary" name="update_user" value="Cập Nhật Thông Tin">Cập Nhật Thông Tin</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>

                            
                        </form>
                    </div>
                </div>
            </div>
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
