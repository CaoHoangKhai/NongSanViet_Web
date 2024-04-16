<?php
    session_start();
  
    // Check if the user is logged in and has the necessary session data
    if(isset($_SESSION['login']) && $_SESSION['login'] === true && isset($_SESSION['user_info'])) {
        // Access user information
        $userInfo = $_SESSION['user_info'];

        // Now you can use $userInfo array as needed
        
        $email = $userInfo[1];

        // Display or use the information as per your requirements
        // echo "Welcome, Admin! Your email is: $email";
    } else {
        // Redirect to login page if the user is not logged in
        header("Location: ../DangNhap/DangNhap.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin's page</title>
        <!--logo-->
        <link rel="icon" href="../../Data/Logo/logo.ico">
    </head>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark"data-bs-theme="dark">
        <!-- Tên sản phẩm ở góc trái -->
        <a class="navbar-brand fs-2" style="font-family:'Bungee Shade'" href="../../../../WEB_BAN_HANG/Web/TrangChu/TrangChu.php">Admin's page</a>
        
        <!-- Thẻ navbar cho phần phải -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav pr-4">
                <!-- Biểu tượng user và chữ "Xin Chào" -->
                <li class="nav-item dropdown">
                    <span class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-user-o fa-2x" aria-hidden="true"></i>
                        <a class="fs-5 mb-2 ml-2 navbar-brand">Admin,<?php echo "$email";?></a>
                    </span>
                </li>
            </ul>
        </div>
    </nav>
