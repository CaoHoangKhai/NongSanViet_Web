<?php
    session_start();
    require '../Chung/php/connect.php';

    if (isset($_POST['login'])) {
        
        $password = $_POST['password'];
        $email = $_POST['email'];

        // Check if username, password, and email are not empty
        if (empty($password) || empty($email)) {
            echo "<script>alert('Vui lòng nhập đầy đủ thông tin.')</script>";
        } else {
            $result = mysqli_query($conn, "SELECT * FROM `customer` WHERE password = '$password' AND email = '$email'");
            $row = mysqli_fetch_array($result);

            if (mysqli_num_rows($result) > 0) {
                if ($password == $row["password"]) {
                    $_SESSION["login"] = true;

                    $u = array($row['id_user'], $email,$row["role"],$password); // Updated array without $username

                    if ($row['role'] == 0) {
                        header("Location: ../user/user_info.php");
                        $_SESSION['user_info'] = $u; // Store user information in the session
                        
                    } else if ($row['role'] == 1) {
                        header("Location: ../admin/admin.php");
                        $_SESSION['user_info'] = $u; // Store admin information in the session
                    }
                }
            } else {
                echo "<script>alert('Thông tin đăng nhập không đúng. Vui lòng kiểm tra lại.')</script>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--logo-->
    <link rel="icon" href="../../../../WEB_BAN_HANG/Data/Logo/logo.ico">

    <!--CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../Chung/CSS_bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="../Chung/css/header.css">
    <link rel="stylesheet" href="../Chung/css/style.css">
    <link rel="stylesheet" href="../Chung/css/footer.css">
    


    <!--javascript-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js" defer></script>
    <script src="../Chung/js/header.js" defer></script>
    <script src="DangNhap.js"defer></script>

    <!--Script chen html-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <header>
        <div id="head_content"></div>
    </header>
    <br>
    <main class="mx-2">
        <div class="container">
        <?php if (!empty($_SESSION['success'])): ?>
                    <div class="alert alert-success mb-1" role="alert"><?= $_SESSION['success'] ?></div>
                    <?php unset($_SESSION['success']); ?>
                <?php endif; ?>
            <form class="row g-3 needs-validation" action="<?php echo $_SERVER['PHP_SELF']; ?>" novalidate method="post">

                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label"><strong>Email*</strong></label>
                    <input type="email" class="form-control" name="email" id="inputEmail4 email" placeholder="Email của bạn" required>
                    <div class="invalid-feedback">
                        Email không được bỏ trống.
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label"><strong>Password*</strong></label>
                    <input type="password" class="form-control" name="password" id="inputPassword4 password" placeholder="Nhập mật khẩu của bạn"
                        required>
                    <div class="invalid-feedback">
                        PassWord không được bỏ trống.
                    </div>
                </div>

                <div >
                    Bạn chưa có <a href="../../Web/DangKy/DangKy.php">tài khoản?</a>
                </div>
                
                <div class="col-12">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary" name="login">Đăng Nhập</button>
                        <button type="reset" class="btn btn-primary">Reset</button>
                        
                    </div>
                </div>
               
            </form>
            
        </div>
    </main>
    <br><br>
    <br>
    <footer>
        <div id="foot_content"></div>
    </footer>
</body>
<script type="text/javascript">
    $('#head_content').load('../Chung/php/head.php');
    $('#foot_content').load('../Chung/php/foot.php');
</script>

</html>