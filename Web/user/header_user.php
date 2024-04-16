<?php
    session_start();

    // Check if the user is logged in and has the necessary session data
    if(isset($_SESSION['login']) && $_SESSION['login'] === true && isset($_SESSION['user_info'])) {
        // Access user information
        $userInfo = $_SESSION['user_info'];

        // Now you can use $userInfo array as needed

        $email = $userInfo[1];

        // Display or use the information as per your requirements
        // echo "Welcome,User! Your email is: $email";
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

        <title>Nông Sản Việt</title>

        <!--logo-->
        <link rel="icon" href="../../Data/Logo/logo.ico">
        <!--CSS-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="../Chung/CSS_bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="user.css">

        <link rel="stylesheet" href="../Chung/css/header.css">
        <link rel="stylesheet" href="../Chung/css/style.css">
        <link rel="stylesheet" href="../Chung/css/footer.css">

        <!-- JavaScript và jQuery -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
            integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <!-- Bootstrap JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
        
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
        <script src="../Chung/js/header.js" defer></script>
        <script src="../DangKy/DangKy.js"defer></script>

        


        <!--Tinh/Thanh pho-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
        
    </head>
    <body>
    
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark"data-bs-theme="dark">
            <!-- Tên sản phẩm ở góc trái -->
            <a class="navbar-brand fs-2" href="../../../../WEB_BAN_HANG/Web/TrangChu/TrangChu.php" style="font-family:'Bungee Shade'">NÔNG SẢN VIỆT</a>
            
            <!-- Thẻ navbar cho phần phải -->
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav pr-4">
                    <!-- Biểu tượng user và chữ "Xin Chào" -->
                    <li class="nav-item dropdown">
                        <span class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-user-o fa-2x" aria-hidden="true"></i>
                            <a class="fs-5 mb-2 ml-2 navbar-brand">Xin Chào,<?php echo "$email";?></a>
                        </span>

                    </li>
                </ul>
            </div>
        </nav>

