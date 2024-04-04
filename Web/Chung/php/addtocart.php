<?php
session_start();
include 'connect.php';
?>
<?php
if (!isset($_SESSION['user_info'])) {
    // Chuyển hướng người dùng đến trang Đăng Nhập
    $_SESSION['success'] = "Bạn phải Đăng Nhập để thêm được sản phẩm";
    header('Location: ../../DangNhap/DangNhap.php');
    exit(); // Dừng việc thực thi các lệnh tiếp theo sau lệnh header
}
    if (isset($_POST['addtocart'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $type = $_POST['type'];
    $image = $_POST['image'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    
    $userInfo = $_SESSION['user_info'];
    $id_user = $userInfo[0];
    $_SESSION['them_sp_thanh_cong'] = true;

    // Check if the product already exists in the shopping cart
    $checkQuery = "SELECT * FROM `shopping_cart` 
                   WHERE `id_user` = '$id_user' AND `product_id` = '$product_id'";
    $result = $conn->query($checkQuery);

    if ($result->num_rows > 0) {
        // If the product already exists, update the quantity if it doesn't exceed the product quantity
        $row = $result->fetch_assoc();
        $quantity_sp = $row['quantity_sp'];
        $new_quantity = $quantity_sp + $quantity;

        $checkProductQuery = "SELECT `quantity` FROM `product` WHERE `product_id` = '$product_id'";
        $productResult = $conn->query($checkProductQuery);
        if ($productResult->num_rows > 0) {
            $productRow = $productResult->fetch_assoc();
            $product_quantity = $productRow['quantity'];
            if ($new_quantity <= $product_quantity) {
                $updateQuery = "UPDATE `shopping_cart` 
                                SET `quantity_sp` = '$new_quantity'
                                WHERE `id_user` = '$id_user' AND `product_id` = '$product_id'";
                
                if ($conn->query($updateQuery) === TRUE) {
                    $_SESSION['success_message'] = "Bạn đã thêm sản phẩm vào giỏ hàng thành công!";
                    header('Location: ../../TrangChu/TrangChu.php');
                } else {
                    $_SESSION['them_sp_thanh_cong'] = false;
                    
                    header('Location: ../../TrangChu/TrangChu.php');
                }
            } else {
                // Quantity exceeds product quantity
                $_SESSION['them_sp_thanh_cong'] = false;
                $_SESSION['error_message'] = "Sản phẩm đã đạt tối đa số lượng trong kho!";
                header('Location: ../../TrangChu/TrangChu.php');
            }
        }
    } else {
        // If the product doesn't exist, insert a new record
        $insertQuery = "INSERT INTO `shopping_cart`(`id_user`, `product_id`, `quantity_sp`) 
                        VALUES ('$id_user','$product_id','$quantity')";

        if ($conn->query($insertQuery) === TRUE) {
            $_SESSION['success_message'] = "Bạn đã thêm sản phẩm vào giỏ hàng thành công!";
            header('Location: ../../TrangChu/TrangChu.php');
        } else {
            $_SESSION['them_sp_thanh_cong'] = false;
            header('Location: ../../TrangChu/TrangChu.php');
        }
    }
}

?>
<?php 
    if (isset($_POST['del_order'])) {
        $product_id = $_POST['product_id'];
        $userInfo = $_SESSION['user_info'];
        $id_user = $userInfo[0];
        
        // Construct the DELETE query
        $query = "DELETE FROM shopping_cart WHERE id_user = '$id_user' AND product_id = '$product_id'";
        
        // Execute the DELETE query
        $query_run = mysqli_query($conn, $query);

        // Check if the query was successful
        if ($query_run) {
            $_SESSION['success'] = "Sản phẩm đã được xóa";
            header('Location: ../../GioHang/GioHang.php');
        } else {
            $_SESSION['success'] = "Sản phẩm không thể xóa. VUI LÒNG KIỂM TRA LẠI THÔNG TIN";
            header('Location: ../../GioHang/GioHang.php');
        }
    }
?>

<?php
if (isset($_POST['del_one_pro'])) {
    $product_id = $_POST['product_id'];
    $userInfo = $_SESSION['user_info'];
    $id_user = $userInfo[0];
    $quantity = $_POST['quantity'];
    
    // Giảm số lượng đi 1
    $quantity -= 1;

    // Nếu số lượng giảm xuống 0, thì xóa sản phẩm khỏi giỏ hàng
    if ($quantity <= 0) {
        $query = "DELETE FROM shopping_cart WHERE id_user = '$id_user' AND product_id = '$product_id'";
    } else {
        // Nếu số lượng không phải là 0, thì cập nhật số lượng mới vào cơ sở dữ liệu
        $query = "UPDATE shopping_cart SET quantity_sp = '$quantity' WHERE id_user = '$id_user' AND product_id = '$product_id'";
    }

    $query_run = mysqli_query($conn, $query);
    if ($query_run) {
        header('Location: ../../GioHang/GioHang.php');
    } else {
        echo "Có lỗi xảy ra khi xóa sản phẩm khỏi giỏ hàng.";
    }
}
?>


<?php
if (isset($_POST['add_one_pro'])) {
    // Lấy thông tin sản phẩm và người dùng từ session
    $product_id = $_POST['product_id'];
    $userInfo = $_SESSION['user_info'];
    $id_user = $userInfo[0];

    // Lấy quantity hiện tại của sản phẩm trong giỏ hàng
    $query_cart = "SELECT quantity_sp FROM shopping_cart WHERE product_id = '$product_id' AND id_user = '$id_user'";
    $result_cart = mysqli_query($conn, $query_cart);
    $row_cart = mysqli_fetch_assoc($result_cart);
    $quantity_in_cart = $row_cart['quantity_sp'];

    // Lấy quantity của sản phẩm từ bảng product
    $query_product = "SELECT quantity FROM product WHERE product_id = '$product_id'";
    $result_product = mysqli_query($conn, $query_product);
    $row_product = mysqli_fetch_assoc($result_product);
    $quantity_product = $row_product['quantity'];

    // Kiểm tra nếu quantity trong giỏ hàng nhỏ hơn hoặc bằng quantity của sản phẩm
    if ($quantity_in_cart < $quantity_product) {
        // Tăng quantity lên 1
        $quantity_in_cart += 1;

        // Thực hiện cập nhật quantity trong giỏ hàng
        $query_update = "UPDATE shopping_cart SET quantity_sp = '$quantity_in_cart' WHERE id_user = '$id_user' AND product_id = '$product_id'";
        $query_run = mysqli_query($conn, $query_update);
        if ($query_run) {
            header('Location: ../../GioHang/GioHang.php');
            exit(); // Kết thúc luồng xử lý sau khi chuyển hướng
        } else {
            $_SESSION['error'] = "Có lỗi xảy ra khi cập nhật giỏ hàng.";
            header('Location: ../../GioHang/GioHang.php');
        }
    } else {
        $_SESSION['error'] = "Sản phẩm đã đạt tối đa số lượng trong kho.";
        header('Location: ../../GioHang/GioHang.php');
    }
}
?>

<?php
    if (isset($_POST['sp_addtocart'])) {
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $type = $_POST['type'];
        $image = $_POST['image'];
        $price = $_POST['price'];
        $quantity_sp = $_POST['quantity'];
        $page = $_POST['trang'];
    
        $userInfo = $_SESSION['user_info'];
        $id_user = $userInfo[0];
        $_SESSION['them_sp_thanh_cong'] = true;
    
        // Truy vấn để lấy số lượng sản phẩm từ cả hai bảng shopping_cart và product
        $checkQuantityQuery = "SELECT sc.quantity_sp AS quantity_sp_cart, p.quantity AS quantity_product
                               FROM shopping_cart AS sc
                               LEFT JOIN product AS p ON sc.product_id = p.product_id
                               WHERE sc.id_user = '$id_user' AND sc.product_id = '$product_id'";
        $quantityResult = $conn->query($checkQuantityQuery);
    
        if ($quantityResult->num_rows > 0) {
            $row = $quantityResult->fetch_assoc();
            $quantity_sp_cart = $row['quantity_sp_cart'];
            $quantity_product = $row['quantity_product'];
    
            // So sánh số lượng sản phẩm trong giỏ hàng và số lượng từ bảng product
            if ($quantity_product >= $quantity_sp_cart + $quantity_sp) {
                // Nếu số lượng sản phẩm từ bảng product đủ, thực hiện thêm vào giỏ hàng
                $updateQuery = "UPDATE `shopping_cart` 
                                SET `quantity_sp` = `quantity_sp` + '$quantity_sp'
                                WHERE `id_user` = '$id_user' AND `product_id` = '$product_id'";
    
                if ($conn->query($updateQuery) === TRUE) {
                    $_SESSION['success_message'] = "Bạn đã thêm sản phẩm vào giỏ hàng thành công!";
                    header("Location: ../../SanPham/SanPham.php?trang=$page");
                } else {
                    $_SESSION['them_sp_thanh_cong'] = false;
                    header("Location: ../../SanPham/SanPham.php?trang=$page");
                }
            } else {
                // Hiển thị thông báo cho người dùng nếu số lượng không đủ
                $_SESSION['error_message'] = "Sản phẩm đã đạt tối đa số lượng trong kho!";
                header("Location: ../../SanPham/SanPham.php?trang=$page");
            }
        } else {
            // Nếu không tìm thấy số lượng sản phẩm trong giỏ hàng, thực hiện thêm mới
            $insertQuery = "INSERT INTO `shopping_cart`(`id_user`, `product_id`, `quantity_sp`) 
                            VALUES ('$id_user','$product_id','$quantity_sp')";
    
            if ($conn->query($insertQuery) === TRUE) {
                $_SESSION['success_message'] = "Bạn đã thêm sản phẩm vào giỏ hàng thành công!";
                header("Location: ../../SanPham/SanPham.php?trang=$page");
            } else {
                $_SESSION['them_sp_thanh_cong'] = false;
                header("Location: ../../SanPham/SanPham.php?trang=$page");
            }
        }
    }
    
?>
<?php
    if (isset($_POST['detail_pro'])) {
        // $product_id = $_POST['product_id'];
        // $product_name = $_POST['product_name'];
        // $type = $_POST['type'];
        // $image = $_POST['image'];
        // $price = $_POST['price'];
        // $quantity = $_POST['quantity'];
        $_SESSION['product'] = array(
            'product_id' => $_POST['product_id'],
            'product_name' => $_POST['product_name'],
            'type' => $_POST['type'],
            'image' => $_POST['image'],
            'price' => $_POST['price'],
            'quantity' => $_POST['quantity']
        );
        // echo "Product ID: " . $_SESSION['product']['product_id'] . "<br>";
        // echo "Product Name: " . $_SESSION['product']['product_name'] . "<br>";
        // echo "Type: " . $_SESSION['product']['type'] . "<br>";
        // echo "Image: " . $_SESSION['product']['image'] . "<br>";
        // echo "Price: " . $_SESSION['product']['price'] . "<br>";
        // echo "Quantity: " . $_SESSION['product']['quantity'] . "<br>";
        
        $userInfo = $_SESSION['user_info'];
        $id_user = $userInfo[0];
        $_SESSION['them_sp_thanh_cong'] = true;

        header("Location: ../../Gao/GaoDetail.php");
    }
?>