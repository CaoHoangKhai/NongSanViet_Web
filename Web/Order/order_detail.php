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
        

        $sql_khachhang = "INSERT INTO `order_customer`(`id_user`,`username`, `phonenumber`, `address`, `note`, `email`, `type`,`price`) 
        VALUES('$id_user','$username','$phonenumber','$address','$note','$email','$type','$sum') ";

        if ($conn->query($sql_khachhang) === TRUE) {
            $sql_select_khachhang = mysqli_query($conn, "SELECT * FROM order_customer ORDER BY id_order DESC LIMIT 1 ");
            $row_khachhang  = mysqli_fetch_array($sql_select_khachhang);
            $item_code = rand(0, 9999);

            $total = "SELECT COUNT(*) as total_pr FROM shopping_cart WHERE id_user = '$id_user' AND quantity_sp > 0";
            $kq_pr = $conn->query($total);
            $row = $kq_pr->fetch_assoc();
            $totalPr = $row['total_pr'];

            $sql = "SELECT * FROM product p JOIN shopping_cart sc ON p.product_id = sc.product_id WHERE id_user ='$id_user' ";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_array($result)) {
                // Check if quantity is greater than 0
                if ($row['quantity'] > 0) {
                    $sql_donhang = "INSERT INTO `order_detail`(`product_id`, `quantity_product`, `price`, `item_code`, `id_order`) 
                                    VALUES ('{$row['product_id']}','{$row['quantity_sp']}','{$row['price']}','$item_code', '{$row_khachhang['id_order']}')";
                    
                    if ($conn->query($sql_donhang) === TRUE) {
                        // Update product quantity
                        $update_quantity_sql = "UPDATE product SET quantity = quantity - {$row['quantity_sp']},sold = sold + {$row['quantity_sp']}  WHERE product_id = '{$row['product_id']}'";
            
                        if ($conn->query($update_quantity_sql) === TRUE) {
                            $_SESSION['success'] = "ĐƠN HÀNG ĐÃ ĐƯỢC GỬI ĐI";
                            header('Location: ../GioHang/GioHang.php');
                        } else {
                            // Handle the case when updating product quantity fails
                            echo "Error updating product quantity: " . $conn->error;
                            header('Location: ../GioHang/GioHang.php');
                        }
                    } else {
                        // Handle the case when the order detail insertion fails
                        echo "Error inserting order detail: " . $conn->error;
                        header('Location: ../GioHang/GioHang.php');
                    }
                }
            }
            
        } else {
            // Handle the case when the customer order insertion fails
            echo "Error inserting customer order: " . $conn->error;
        }
        
        // Now update the quantity to 0
        $update_quantity_sql = "DELETE FROM shopping_cart WHERE id_user = '$id_user';";
        if ($conn->query($update_quantity_sql) === TRUE) {
            
            header('Location: ../GioHang/GioHang.php');
        } else {
            echo "Error updating quantity: " . $conn->error . "<br>";
             header('Location: ../GioHang/GioHang.php');
        }


        $conn->close();
    }
?>
