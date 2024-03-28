<?php 
session_start();
include "../Chung/php/connect.php";
?>
<?php
if(isset($_POST['username'])){
    $username= $_POST['username'];
    $phonenumber= $_POST['phonenumber'];
    $email= $_POST['email'];
    $address= $_POST['address'];
    $result = mysqli_query($conn,"INSERT INTO test (user_name, phone_number, email, addre) VALUES ('$username','$phonenumber','$email','$address')");
    if($result){
        echo 1;
    }else {
        echo 0;
    }
}
?>
<?php
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
        // If the product already exists, update the quantity
        $updateQuery = "UPDATE `shopping_cart` 
                        SET `quantity` = `quantity` + '$quantity'
                        WHERE `id_user` = '$id_user' AND `product_id` = '$product_id'";

        if ($conn->query($updateQuery) === TRUE) {
            $_SESSION['them_sp_thanh_cong'] = true;
            
        } else {
            $_SESSION['them_sp_thanh_cong'] = false;
            
        }
    } else {
        // If the product doesn't exist, insert a new record
        $insertQuery = "INSERT INTO `shopping_cart`(`id_user`, `product_id`, `quantity`) 
                        VALUES ('$id_user','$product_id','$quantity')";

        if ($conn->query($insertQuery) === TRUE) {
            $_SESSION['them_sp_thanh_cong'] = true;
            
        } else {
            $_SESSION['them_sp_thanh_cong'] = false;
            
        }
    }
}
?>
