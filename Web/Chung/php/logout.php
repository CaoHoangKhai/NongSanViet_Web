<?php
    session_start();
    unset($_SESSION['user_info']);
    header ('location: ../../DangNhap/DangNhap.php');
?>
