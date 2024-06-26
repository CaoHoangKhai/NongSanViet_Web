<?php
session_start();
include '../Chung/php/connect.php';
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
        header('Location: ds_user.php');
    } elseif (mysqli_num_rows($check_email_result) > 0) {
        // Email đã tồn tại
        $_SESSION['success'] = "Email đã được sử dụng bởi người khác. VUI LÒNG KIỂM TRA LẠI THÔNG TIN";
        header('Location: ds_user.php');
    } else {
        // Tiến hành cập nhật nếu số điện thoại và email không bị trùng
        $query = "UPDATE customer SET username='$username', phonenumber ='$phonenumber', email='$email', address='$address' WHERE id_user='$id'";
        $query_run = mysqli_query($conn, $query);

        if ($query_run) {
            $_SESSION['success'] = "Dữ liệu đã được cập nhật";
            header('Location: ds_user.php');
        } else {
            $_SESSION['success'] = "Dữ liệu cập nhật thất bại. VUI LÒNG KIỂM TRA LẠI THÔNG TIN";
            header('Location: ds_user.php');
        }
    }
}
?>

<?php
if (isset($_POST['del_user'])) {
    // Lấy thông tin từ biến POST
    $id = $_POST['del_id'];
    $trang = $_POST['trang'];

    // Cập nhật trạng thái của bản ghi trong bảng customer
    $sql_update_customer = "UPDATE customer SET status = 1 WHERE id_user = '$id'";
    $result_update_customer = mysqli_query($conn, $sql_update_customer);

    if ($result_update_customer) {
        // Nếu cập nhật thành công, thiết lập thông báo thành công
        $_SESSION['success'] = "Dữ liệu đã được xóa";
    } else {
        // Nếu cập nhật không thành công, thiết lập thông báo lỗi
        $_SESSION['error'] = "Dữ liệu xóa thất bại. VUI LÒNG KIỂM TRA LẠI THÔNG TIN";
    }

    // Chuyển hướng người dùng đến trang danh sách người dùng
    header('Location: ds_user.php?trang='.$trang);
    exit; // Kết thúc kịch bản sau khi chuyển hướng
}
?>
    
<?php
if (isset($_POST['update_product'])) {
    $id = $_POST['edit_id'];
    $product_name = $_POST['edit_product_name'];
    $type = $_POST['edit_type'];

    $page = $_POST['trang'];
    // Kiểm tra nếu 'edit_image' rỗng, lấy giá trị từ 'edit_image_'.
    $image = empty($_POST['edit_image']) ? $_POST['edit_image_'] : $_POST['edit_image'];

    $price = $_POST['edit_price'];
    $check_product_name = "SELECT * FROM product WHERE product_name = '$product_name' AND product_id != '$id'";
    $check_product_name_result = mysqli_query($conn, $check_product_name);
    echo $page;
    if (mysqli_num_rows($check_product_name_result) > 0) {
        // Tên sản phẩm đã tồn tại
        $_SESSION['success'] = "Tên Sản Phẩm đã có trong dữ liệu. VUI LÒNG KIỂM TRA LẠI THÔNG TIN";
        header('Location: ds_product.php?trang='.$page);
    } else {
        // Tiến hành cập nhật nếu tên sản phẩm không bị trùng
        $query = "UPDATE product SET product_name='$product_name', type ='$type', image='$image', price ='$price ' WHERE product_id = '$id'";
        $query_run = mysqli_query($conn, $query);

        if ($query_run) {
            $_SESSION['success'] = "Dữ liệu đã được cập nhật";
            header('Location: ds_product.php?trang='.$page);
        } else {
            $_SESSION['success'] = "Dữ liệu cập nhật thất bại. VUI LÒNG KIỂM TRA LẠI THÔNG TIN";
            header('Location: ds_product.php');
        }
    }
}
?>

<?php
    if (isset($_POST['del_product'])) {
        $id = $_POST['del_id'];
        $sql = "UPDATE  product SET stat = 1 WHERE product_id='$id'";
        $query_run = mysqli_query($conn,$sql);
        if($query_run){
            $_SESSION['success'] = "Dữ liệu đã được xóa";
            header('Location: ds_product.php');
        }else{
            $_SESSION['success'] = "Dữ liệu xóa thất bại. VUI LÒNG KIỂM TRA LẠI THÔNG TIN";
            header('Location: ds_product.php');
        }
    }
?>

<?php
    if (isset($_POST['del_idpb'])) {
        $id = $_POST['id'];
        $page=$_POST['trang'];
        $sql = "DELETE  FROM lienhe WHERE id='$id'";
        $query_run = mysqli_query($conn,$sql);
        if($query_run){
            $_SESSION['success'] = "THÔNG TIN ĐÃ ĐƯỢC XỬ LÝ";
            header('Location: ds_feedback.php?trang='.$page);
        }else{
            $_SESSION['success'] = "LỖI HỆ THỐNG";
            header('Location: ds_feedback.php?trang='.$page);
        }
    }
?>
<?php
if (isset($_POST['up_status'])) {
    $edit_status = $_POST['edit_status'];
    $id_order = $_POST['id_order'];
    $trang = $_POST['trang'];
    echo $trang;
    $query = "UPDATE order_customer SET status='$edit_status' WHERE id_order = '$id_order'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['success'] = "Thông tin đơn hàng đã cập nhật";
    } else {
        $_SESSION['success'] = "Thông tin đơn hàng đã cập nhật thất bại. VUI LÒNG KIỂM TRA LẠI THÔNG TIN";
    }
    
    // Đặt lại trang hiện tại sau khi xử lý dữ liệu POST

    $currentPage = isset($_POST['trang']) ? $_POST['trang'] : 1;
    header("Location: ds_order.php?trang=$currentPage");

    
}

if (isset($_POST['del_order'])) {
    $id_user = $_POST['id_user'];
    $id_order = $_POST['id_order'];
    echo  $id_user . '' . $id_order;
    $query = "UPDATE order_customer SET status= 5 WHERE id_order = '$id_order'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['del_order'] = "Đã Gửi Yêu Cầu Hủy Đơn Hàng Thành Công";
        header('Location: admin_order.php');
    } else {
        $_SESSION['del_order'] = "Đã Gửi Yêu Cầu Hủy Đơn Hàng Thất Bại. VUI LÒNG KIỂM TRA LẠI THÔNG TIN";
        header('Location: admin_order.php');
    }
}
?>
<?php
if (isset($_POST['Cancel'])) {
    
    $id_order = $_POST['id_order'];
    $page = $_POST['trang'];
    $lidohuy = $_POST['lidohuy'];
    echo $id_order . "hiiiii";
    echo $page;
    echo $lidohuy;
    $sql = "UPDATE order_customer SET status = 7, huy = '$lidohuy' WHERE id_order = '$id_order'";
    $query_run = mysqli_query($conn, $sql);

    // Check if the query was successful
    if ($query_run) {
        $_SESSION['success'] = "ĐƠN HÀNG ĐÃ ĐƯỢC XỬ LÝ";
    } else {
        $_SESSION['success'] = "LỖI HỆ THỐNG";
    }

    // Redirect to the orders page
    header('Location: ds_order.php?trang=' . $page);
    exit();
}
?>
