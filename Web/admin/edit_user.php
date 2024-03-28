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
        <!--Tinh/Thanh pho-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
        
    </head>
    <body>
        <?php
        if(isset($_POST['edit_user'])){
            $id = $_POST['edit_id'];

            $result = mysqli_query($conn, "SELECT * FROM `customer` WHERE id_user = '$id'");
            $row = mysqli_fetch_assoc($result);
            $cityCode = $row['city']; // Thay 'city' bằng tên cột chứa mã thành phố trong bảng customer
            $districtCode = $row['district']; // Thay 'districts' bằng tên cột chứa mã quận huyện trong bảng customer
            $cityName = getCityName($cityCode);
            $districtName = getDistrictName($cityCode, $districtCode);
        }
        ?>
        <div class="container">
            <form  action="code.php" method="POST">
            <input type="hidden" name="edit_id" value="<?php echo $row['id_user']; ?>">
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="fullname" class="form-label"><strong>Họ và tên</strong></label>
                                <input type="text" class="form-control" name="edit_username" id="fullname" value="<?php echo $row['username']; ?>">
                            </div>

                            <div class="col-md-6">
                                <label for="inputPassword4" class="form-label"><strong>Password</strong></label>
                                <input type="text" class="form-control" name="edit_password" id="inputPassword4" value="<?php echo $row['password']; ?>" readonly >
                            
                            </div>

                            <div class="col-md-6">
                                <label for="inputNumber4" class="form-label"><strong>Số điện thoại*</strong></label>
                                <input type="text" class="form-control" name="edit_phonenumber" id="inputNumber4" value="<?php echo $row['phonenumber']; ?>">
                            </div>

                            <div class="col-md-6">
                                <label for="inputEmail4" class="form-label"><strong>Email*</strong></label>
                                <input type="email" class="form-control" name="edit_email" id="inputEmail4" value="<?php echo $row['email']; ?>">
                            </div>

                            <div class="col-md-6">
                                <label for="city" class="form-label"><strong>Tỉnh/Thành phố</strong></label>
                                <input type="text" class="form-control" name="edit_city" id="city" value="<?php echo $cityName; ?>"  readonly>
                            </div>

                            <div class="col-md-6">
                                <label for="district" class="form-label"><strong>Quận/Huyện</strong></label>
                                <input type="text" class="form-control" name="edit_district" id="district" value="<?php echo $districtName; ?>" readonly >
                            </div>

                            <div class="col-md-6">
                                <label for="inputAddress" class="form-label"><strong>Địa chỉ</strong></label>
                                <input type="text" class="form-control" name="edit_address" id="inputAddress" value="<?php echo $row['address']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6 mt-3">
                            <a href="ds_user.php" class="btn btn-danger">Cancel</a>
                            <button type="submit" class="btn btn-primary" name="update_user" value="Cập nhật">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </body>
</html>