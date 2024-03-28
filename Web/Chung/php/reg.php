<?php
require '../Chung/php/connect.php';

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Check if username, password, and email are not empty
    if (empty($username) || empty($password) || empty($email)) {
        echo "<script>alert('Vui lòng nhập đầy đủ thông tin.')</script>";
    } else {
        $result = mysqli_query($conn, "SELECT * FROM `customer` WHERE username = '$username' AND password = '$password' AND email = '$email'");
        $row = mysqli_fetch_assoc($result);

        if (mysqli_num_rows($result) > 0) {
            if ($password == $row["password"]) {
                $_SESSION["login"] = true;

                // Chuyển hướng người dùng tùy vào vai trò
                if ($row['role'] == 0) {
                    header("Location: ../user/user.php"); // Chuyển hướng đến trang của người dùng
                    exit();
                } else if ($row['role'] == 1) {
                    header("Location: ../admin/admin.php"); // Chuyển hướng đến trang admin
                    exit();
                }
            } else {
                echo "<script>alert('Sai mật khẩu. Vui lòng kiểm tra lại.')</script>";
            }
        } else {
            echo "<script>alert('Thông tin đăng nhập không đúng. Vui lòng kiểm tra lại.')</script>";
        }
    }
}

?>



<?php

require '../Chung/php/connect.php';

if (isset($_POST['submit'])) {
    $error = array();
    
    $password = $_POST['password'];
    $email = $_POST['email'];

    if(empty($_POST['username'])){
        $error['username'] = 'Khong dduoc dder tronggggg';
    }else{
        $username = $_POST['username'];
    }


    // Check if username, password, and email are not empty
    if(empty($username) || empty($password) || empty($email)) {
        echo "<script>alert('Vui lòng nhập đầy đủ thông tin.')</script>";
    }
    else {
        $result = mysqli_query($conn, "SELECT * FROM `customer` WHERE username = '$username' AND password = '$password' AND email = '$email'");
        $row = mysqli_fetch_assoc($result);

        if (mysqli_num_rows($result) > 0) {
            if ($password == $row["password"]) {
                $_SESSION["login"] = true;
                // $_SESSION["id"] = $row["id"];
                if ($row['role'] == 0) {
                    header("Location: ../TrangChu/TrangChu.php");
                } else if($row['role'] == 1){
                    header("Location: ../admin/admin.php");
                }
            } else {
                echo "<script>alert('Sai mật khẩu. Vui lòng kiểm tra lại.')</script>";
            }
        } else {
            echo "<script>alert('Thông tin đăng nhập không đúng. Vui lòng kiểm tra lại.')</script>";
        }
    }
}
?>