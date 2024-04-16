<?php
include '../Chung/php/connect.php';
include "header_admin.php"; 
include "sidebar.php";
?>
<?php
$url = 'https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json';
$data = file_get_contents($url);
$jsonData = json_decode($data, true);

if ($jsonData === null) {
    die('Failed to decode JSON data');
}

function getCityName($cityCode) {
    global $jsonData;

    foreach ($jsonData as $city) {
        if ($city['Id'] == $cityCode) {
            return $city['Name'];
        }
    }

    return 'NULL';
}

function getDistrictName($cityCode, $districtCode) {
    global $jsonData;

    foreach ($jsonData as $city) {
        if ($city['Id'] == $cityCode && isset($city['Districts'])) {
            foreach ($city['Districts'] as $district) {
                if ($district['Id'] == $districtCode) {
                    return $district['Name'];
                }
            }
        }
    }

    return 'NULL';
}

$sql = 'SELECT * FROM customer';
// Thực hiện truy vấn SQL để lấy dữ liệu từ bảng customer
// Giả sử bạn đã có kết nối $conn được thiết lập ở nơi khác trong mã của bạn

$result = $conn->query($sql);

if ($result === false) {
    die('Query error: ' . $conn->error);
}

// Duyệt qua các dòng dữ liệu và in ra thông tin
while ($row = $result->fetch_assoc()) {
    $cityCode = $row['city']; // Thay 'city' bằng tên cột chứa mã thành phố trong bảng customer
    $districtCode = $row['district']; // Thay 'districts' bằng tên cột chứa mã quận huyện trong bảng customer

    $cityName = getCityName($cityCode);
    $districtName = getDistrictName($cityCode, $districtCode);
}
?>
<?php

// Hàm kiểm tra số điện thoại
function isValidPhoneNumber($phoneNumber) {
    $phoneRegex = '/^[0-9]{10}$/';
    return preg_match($phoneRegex, $phoneNumber);
}

if (isset($_POST['save'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $phonenumber = $_POST['phonenumber'];
    $email = $_POST['email'];
    $city = $_POST['city'];
    $district = $_POST['district'];
    $address = $_POST['address'];
    $role = $_POST['role'];

    // Kiểm tra xem tất cả các trường đã được điền đúng hay chưa
    if (!empty($username) && !empty($password) && !empty($phonenumber) && !empty($email) && !empty($city) && !empty($district) && !empty($address)) {

        // Kiểm tra xem email đã tồn tại trong cơ sở dữ liệu hay chưa
        $checkEmailQuery = "SELECT * FROM `customer` WHERE `email` = '$email'";
        $checkEmailResult = $conn->query($checkEmailQuery);

        // Kiểm tra xem số điện thoại đã tồn tại trong cơ sở dữ liệu hay chưa
        $checkPhoneQuery = "SELECT * FROM `customer` WHERE `phonenumber` = '$phonenumber'";
        $checkPhoneResult = $conn->query($checkPhoneQuery);

        // Nếu số điện thoại hoặc email chưa tồn tại trong cơ sở dữ liệu, thêm dữ liệu mới
        if ($checkPhoneResult->num_rows == 0 && $checkEmailResult->num_rows == 0) {
            
            // Kiểm tra số điện thoại có đúng định dạng hay không
            if (isValidPhoneNumber($phonenumber)) {
                // Thêm dữ liệu vào cơ sở dữ liệu
                $insertQuery = "INSERT INTO `customer` (`username`, `password`, `phonenumber`, `email`, `city`, `district`, `address`,`role`) 
                    VALUES ('$username', '$password', '$phonenumber', '$email', '$city', '$district', '$address','$role')";

                if ($conn->query($insertQuery) === TRUE) {
                    echo "<script>alert('Đăng ký thành công')</script>";
                } else {
                    echo "Lỗi: " . $insertQuery . "<br>" . $conn->error;
                }
            } else {
                echo "<script>alert('Số điện thoại không hợp lệ. Vui lòng nhập số điện thoại theo định dạng chính xác.')</script>";
            }
        } else {
            echo "<script>alert('Số điện thoại hoặc Email đã được sử dụng. Vui lòng chọn số điện thoại hoặc Email khác.')</script>";
        }
    } else {
        echo "<script>alert('Vui lòng điền đầy đủ thông tin vào các trường bắt buộc.')</script>";
    }
}
?>


<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
            integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <!-- Bootstrap JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
        <script src="../Chung/js/header.js" defer></script>
        <script src="../DangKy/DangKy.js"defer></script>

        


        <!--Tinh/Thanh pho-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
        
    </head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-11 offset-md-1">
                <button type="button" class="btn btn-primary float-end mt-3 mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Add User
                </button>
            </div>
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
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

                            <div class="col-md-6">
                                <label class="form-label fs-6"><strong>Chọn vai trò</strong></label>
                                <select class="form-select" id="inputGroupSelect01" name="role">
                                    <option selected>Chọn vai trò</option>
                                    <option value="0" selected>User</option>
                                    <option value="1">Admin</option>
                                    
                                </select>
                            </div>

                            <div class="col-12">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary" name="save" value="Đăng Ký">Save</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-14 offset-md-1">
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
                            <th scope="col"class="col-0.5">STT</th>
                            <th scope="col"class="col-3">Khách Hàng</th>
                            <th scope="col"class="col-1">Email</th>
                            <th scope="col"class="col-1">Điện Thoại</th>
                            <th scope="col"class="col-2">Thành Phố</th>
                            <th scope="col"class="col-2">Quận Huyện</th>
                            <th scope="col"class="col-2">Địa Chỉ</th>
                           
                            <th scope="col"class="col-0.5">Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(isset($_GET['trang'])){
                            $page = $_GET['trang'];
                        }else{
                            $page = '';
                        }
                        if( $page == '' ||  $page == 1){
                            $begin =0;
                        }else {
                            $begin = ($page*5)-5;
                        }
                        $sql = "SELECT * FROM customer WHERE role= 0 ORDER BY id_user ASC LIMIT $begin,5";
                        $result = mysqli_query($conn, $sql);
                        // Initializing a variable to keep track of the ID
                        $counter = 1;

                        while ($row = mysqli_fetch_array($result)) {
                            // Lấy thông tin thành phố và quận huyện dựa trên mã thành phố và mã quận huyện từ cơ sở dữ liệu
                            $cityCode = $row['city']; // Thay 'city' bằng tên cột chứa mã thành phố trong bảng customer
                            $districtCode = $row['district']; // Thay 'districts' bằng tên cột chứa mã quận huyện trong bảng customer
                            $cityName = getCityName($cityCode);
                            $districtName = getDistrictName($cityCode, $districtCode);
                            if ($row['status'] == 0){
                        ?>
                            <tr>
                                <td><?php echo $counter; ?></td>
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['phonenumber']; ?></td>
                                <td><?php echo $cityName; ?></td>
                                <td><?php echo $districtName; ?></td>
                                <td><?php echo $row['address']; ?></td>
                                
                                <td>

                                    <form action="code.php" method="post" onsubmit="return confirmDelete()">
                                        <input type="hidden" name="del_id" value="<?php echo $row['id_user']; ?>">
                                        <input type="hidden" name="trang" value="<?php echo $page ?>">
                                        <button type="submit" name="del_user"class="btn btn-success ">Xóa</button>
                                    </form>
                                        <script>
                                            function confirmDelete() {
                                                return confirm("Bạn có chắc chắn muốn xóa người dùng  này?");
                                            }
                                        </script>
                                </td>
                            </tr>

                        <?php
                            // Increment the counter for the next row
                            $counter++;
                            }
                        } 
                        ?>
                        <?php
                        $count = "SELECT COUNT(*) as total FROM customer WHERE role=0";
                        $kq = $conn->query($count);
                        $row = $kq->fetch_assoc();
                        $totalCustomers = $row['total'];
                        $trang = ceil($totalCustomers/5);
                        ?>
                    </tbody>
                </table>
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-end" id="pagination">
                        <li class="page-item">
                            <a class="page-link" href="ds_user.php?trang=1" aria-label="Previous">
                                <span aria-hidden="true" name="first">&laquo;</span>
                            </a>
                        </li>
                        <?php
                        for($i =1;$i <= $trang;$i++){
                        ?>
                        <li class="page-item"><a class="page-link" href="ds_user.php?trang=<?php echo $i ?>"><?php echo $i ?></a></li>
                        <?php
                        }
                        ?>
                        <li class="page-item">
                            <?php 
                                if($trang == 0) $trang =1;
                            ?>
                            <a class="page-link" href="ds_user.php?trang=<?php echo $trang ?>" aria-label="Next">
                                <span aria-hidden="true" name="last">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>

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
