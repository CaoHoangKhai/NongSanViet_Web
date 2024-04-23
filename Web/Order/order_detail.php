<?php
session_start();
include '../Chung/php/connect.php';
?>
<?php

if (isset($_POST['order_detail'])) {
    $id_user = $_POST['id_user'];
    $username = $_POST['username'];
    $address = $_POST['address'];
    $phonenumber = $_POST['phonenumber'];
    $type = $_POST['type'];
    $email = $_POST['email'];
    $note = $_POST['note'];
    $sum = $_POST['sum'];

    // Thêm thông tin đơn hàng vào bảng order_customer
    $sql_khachhang = "INSERT INTO `order_customer`(`id_user`, `username`, `phonenumber`, `address`, `note`, `email`, `type`, `price`) 
    VALUES('$id_user', '$username', '$phonenumber', '$address', '$note', '$email', '$type', '$sum') ";

    if ($conn->query($sql_khachhang) === TRUE) {
        // Lấy thông tin về đơn hàng vừa thêm vào
        $sql_select_khachhang = mysqli_query($conn, "SELECT * FROM order_customer ORDER BY id_order DESC LIMIT 1 ");
        $row_khachhang  = mysqli_fetch_array($sql_select_khachhang);
        $item_code = rand(0, 99999999);

        // Lấy thông tin chi tiết sản phẩm từ bảng product và shopping_cart
        $sql = "SELECT * FROM shopping_cart sc JOIN product p ON sc.product_id = p.product_id WHERE id_user ='$id_user' ";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_array($result) ) {
            if($row['stat'] == 0){
            // Thêm chi tiết đơn hàng vào bảng order_detail
            $sql_donhang = "INSERT INTO `order_detail`(`product_id`, `quantity_product`, `price`, `item_code`, `id_order`) 
                            VALUES ('{$row['product_id']}', '{$row['quantity_sp']}', '{$row['price']}', '$item_code', '{$row_khachhang['id_order']}')";

            if ($conn->query($sql_donhang) === TRUE) {
                // Xóa sản phẩm khỏi giỏ hàng
                $delete_cart_item_sql = "DELETE FROM shopping_cart WHERE id_user = '$id_user' AND product_id = '{$row['product_id']}'";
                if ($conn->query($delete_cart_item_sql) === TRUE) {
                    $_SESSION['success'] = "ĐƠN HÀNG ĐÃ ĐƯỢC GỬI ĐI";
                    header('Location: ../GioHang/GioHang.php');
                } else {
                    // Xử lý trường hợp xóa sản phẩm khỏi giỏ hàng thất bại
                    echo "Error deleting item from shopping cart: " . $conn->error;
                    header('Location: ../GioHang/GioHang.php');
                }
            } else {
                // Xử lý trường hợp thêm chi tiết đơn hàng thất bại
                echo "Error inserting order detail: " . $conn->error;
                header('Location: ../GioHang/GioHang.php');
            }
        }
    }
    } else {
        // Xử lý trường hợp thêm thông tin đơn hàng thất bại
        echo "Error inserting customer order: " . $conn->error;
    }

    $conn->close();
}
?>

