<?php
session_start();
include '../Chung/php/connect.php';

$search_name = ""; // Khởi tạo biến lưu trữ $search_name

if (!isset($_SESSION['user_info'])) {
    // Chuyển hướng người dùng đến trang Đăng Nhập
    $_SESSION['success'] = "Bạn phải Đăng Nhập để thêm được sản phẩm";
    header('Location: ../DangNhap/DangNhap.php');
    exit(); // Dừng việc thực thi các lệnh tiếp theo sau lệnh header
}

// Hàm này sẽ thêm sản phẩm vào giỏ hàng cho từng loại gạo

function addToCart($conn, $product_id, $quantity, $redirect_page, $search_name) {
    $userInfo = $_SESSION['user_info'];
    $id_user = $userInfo[0];
    $_SESSION['them_sp_thanh_cong'] = true;

    // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng của người dùng hay chưa
    $checkQuery = "SELECT * FROM `shopping_cart` 
                   WHERE `id_user` = '$id_user' AND `product_id` = '$product_id'";
    $result = $conn->query($checkQuery);

    if ($result->num_rows > 0) {
        // Nếu sản phẩm đã tồn tại, cập nhật số lượng
        $updateQuery = "UPDATE `shopping_cart` 
                        SET `quantity_sp` = `quantity_sp` + '$quantity'
                        WHERE `id_user` = '$id_user' AND `product_id` = '$product_id'";

        if ($conn->query($updateQuery) === TRUE) {
            $_SESSION['success_message'] = "Bạn đã thêm sản phẩm vào giỏ hàng thành công!";
            header("Location: $redirect_page?search_name=$search_name"); // Chuyển hướng với $search_name
        } else {
            $_SESSION['them_sp_thanh_cong'] = false;
            header("Location: $redirect_page");
        }
    } else {
        // Nếu sản phẩm chưa tồn tại, thêm bản ghi mới
        $insertQuery = "INSERT INTO `shopping_cart`(`id_user`, `product_id`, `quantity_sp`) 
                        VALUES ('$id_user','$product_id','$quantity')";

        if ($conn->query($insertQuery) === TRUE) {
            $_SESSION['success_message'] = "Bạn đã thêm sản phẩm vào giỏ hàng thành công!";
            header("Location: $redirect_page?search_name=$search_name"); // Chuyển hướng với $search_name
        } else {
            $_SESSION['them_sp_thanh_cong'] = false;
            header("Location: $redirect_page");
        }
    }
}



// Gạo Dẻo Thơm
if (isset($_POST['addtocartGDT'])) {
    addToCart($conn, $_POST['product_id'], $_POST['quantity'], 'GaoDeoThom.php', $search_name);
}

// Gạo Nếp
if (isset($_POST['addtocartN'])) {
    addToCart($conn, $_POST['product_id'], $_POST['quantity'], 'GaoNep.php', $search_name);
}

// Gạo Tấm
if (isset($_POST['addtocartT'])) {
    addToCart($conn, $_POST['product_id'], $_POST['quantity'], 'GaoTam.php', $search_name);
}

// Gạo Lứt
if (isset($_POST['addtocartL'])) {
    addToCart($conn, $_POST['product_id'], $_POST['quantity'], 'GaoLut.php', $search_name);
}

// Gạo từ kết quả tìm kiếm
if (isset($_POST['addtocartSearch'])) {
    addToCart($conn, $_POST['product_id'], $_POST['quantity'], 'GaoSearch.php', $_POST['search_name']); // Truyền $search_name vào hàm
}
if (isset($_POST['addtocartDetail'])) {
    addToCart($conn, $_POST['product_id'], $_POST['quantity'], 'GaoDetail.php', $search_name);
}
?>

<?php
    if (isset($_POST['detail_pro'])) {
        $_SESSION['product'] = array(
            'product_id' => $_POST['product_id'],
            'product_name' => $_POST['product_name'],
            'type' => $_POST['type'],
            'image' => $_POST['image'],
            'price' => $_POST['price'],
            'quantity' => $_POST['quantity']
        );
        $userInfo = $_SESSION['user_info'];
        $id_user = $userInfo[0];
        $_SESSION['them_sp_thanh_cong'] = true;

        header("Location: GaoDetail.php");
    }
?>
