<?php
session_start();
include 'connect.php';
?>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['contact'])) {
            $username = $_POST['username'];
            $phonenumber = $_POST['phonenumber'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $note = $_POST['note'];
            
            // Kiểm tra xem biến id_user có tồn tại không, nếu không, gán giá trị là 0
            $id_user = isset($_SESSION['user_info'][0]) ? $_SESSION['user_info'][0] : 1;

            $query = "INSERT INTO `lienhe`(`id_user`,`username`, `phonenumber`, `email`, `address`, `note`)
            VALUES ('$id_user','$username', '$phonenumber', '$email', '$address', '$note')";
            if ($conn->query($query) === TRUE) {
                $_SESSION['success'] = "THÔNG TIN ĐÃ ĐƯỢC GỬI ĐI. VUI LÒNG ĐỢI ÍT PHÚT";
                header('Location: ../../LienHe/LienHe.php');
            } else {
                $_SESSION['error'] = "Thông tin gửi đi THẤT BẠI. VUI LÒNG KIỂM TRA LẠI THÔNG TIN";
                header('Location: ../../LienHe/LienHe.php');
            }
        }
    }
?>

<?php
if (isset($_POST['update_user'])) {
    $id = $_POST['edit_id'];
    $username = $_POST['edit_username'];
    $phonenumber = $_POST['edit_phonenumber'];
    $email = $_POST['edit_email'];
    $address = $_POST['edit_address'];

    // Kiểm tra xem số điện thoại đã tồn tại chưa
    $check_phone_query = "SELECT * FROM customer WHERE phonenumber = '$phonenumber' AND id_user != '$id'";
    $check_phone_result = mysqli_query($conn, $check_phone_query);

    // Kiểm tra xem email đã tồn tại chưa
    $check_email_query = "SELECT * FROM customer WHERE email = '$email' AND id_user != '$id'";
    $check_email_result = mysqli_query($conn, $check_email_query);

    if (mysqli_num_rows($check_phone_result) > 0) {
        // Số điện thoại đã tồn tại
        $_SESSION['success'] = "Số điện thoại đã được sử dụng bởi người khác. VUI LÒNG KIỂM TRA LẠI THÔNG TIN";
        header('Location: ../../user/user_info.php');
    } elseif (mysqli_num_rows($check_email_result) > 0) {
        // Email đã tồn tại
        $_SESSION['success'] = "Email đã được sử dụng bởi người khác. VUI LÒNG KIỂM TRA LẠI THÔNG TIN";
        header('Location: ../../user/user_info.php');
    } else {
        // Tiến hành cập nhật nếu số điện thoại và email không bị trùng
        $query = "UPDATE customer SET username='$username', phonenumber ='$phonenumber', email='$email', address='$address' WHERE id_user='$id'";
        $query_run = mysqli_query($conn, $query);

        if ($query_run) {
            $_SESSION['success'] = "Dữ liệu đã được cập nhật";
            header('Location: ../../user/user_info.php');
        } else {
            $_SESSION['success'] = "Dữ liệu cập nhật thất bại. VUI LÒNG KIỂM TRA LẠI THÔNG TIN";
            header('Location: ../../user/user_info.php');
        }
    }
}
?>
<?php 
if (isset($_POST['del_order'])) {
    $id_user = $_POST['id_user'];
    $id_order = $_POST['id_order'];
    echo  $id_user . '' . $id_order;
    $query = "UPDATE order_customer SET status= 5 WHERE id_order = '$id_order'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['del_order'] = "Đã Gửi Yêu Cầu Hủy Đơn Hàng Thành Công";
        header('Location: ../../user/order_user.php');
    } else {
        $_SESSION['del_order'] = "Đã Gửi Yêu Cầu Hủy Đơn Hàng Thất Bại. VUI LÒNG KIỂM TRA LẠI THÔNG TIN";
        header('Location: ../../user/order_user.php');
    }
}
?>