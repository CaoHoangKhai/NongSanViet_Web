<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--logo-->
    <link rel="icon" href="../../../../WEB_BAN_HANG/Data/Logo/logo.ico">

    <title>
    Liên hệ-Nông Sản Việt
    </title>

    <!--CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../Chung/CSS_bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="../Chung/css/header.css">
    <link rel="stylesheet" href="../Chung/css/style.css">
    <link rel="stylesheet" href="../Chung/css/footer.css">
    


    <!--javascript-->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js" defer></script>
    <script src="../Chung/js/header.js" defer></script>
    <script src="../DangKy/DangKy.js"defer></script>

    <!--Script chen html-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>

<body>
    <header>
        <?php include "../Chung/php/head.php"?>
    </header>
    <main>
        <div class="container">
            <p class="text-center fs-5 text-muted"><strong>CHUYÊN MỤC:LIÊN HỆ</strong></p>
            <a><hr class="dropdown-divider"></a>
            <br>
        </div>
        <div class="container">
            <div class="row">
                <?php if (!empty($_SESSION['success'])): ?>
                    <div class="alert alert-success mb-1" role="alert"><?= $_SESSION['success'] ?></div>
                    <?php unset($_SESSION['success']); ?>
                <?php endif; ?>
               
                    <div class="col-8">
                        <br>
                        <div class="text-start fs-3">GỬI THÔNG TIN YÊU CẦU HỖ TRỢ</div>
                        <br>
                        <span>
                        Cám ơn Quý Khách đã quan tâm , Quý Khách vui lòng để lại thông tin yêu cầu, chúng tôi sẽ liên hệ lại trong vòng 48 tiếng. Mọi yêu cầu cần hỗ trợ gấp, xin vui lòng gọi số Hotline của Nông Sản Việt: 02903832166 để được hỗ trợ.
                        </span>
                        <div class="mx-2">
                            <form class="row g-3 needs-validation" action="../Chung/php/code.php" method="post" novalidate>
                                <div class="col-md-6">
                                    <label class="form-label fs-6"><strong>Họ và tên</strong></label>
                                    <input type="text" class="form-control" name="username" id="fullname" placeholder="Họ tên của bạn" 
                                    autofocus
                                        required>
                                    <div class="invalid-feedback">
                                        Họ và tên không được bỏ trống.
                                    </div>
                                </div>

                        

                                <div class="col-md-6">
                                    <label for="inputNumber4" class="form-label"><strong>Số điện thoại</strong></label>
                                    <input type="text" class="form-control" name="phonenumber" id="inputNumber4" placeholder="Số điện thoại của bạn"
                                        required>
                                    <div id="phoneFeedback" class="invalid-feedback">
                                        <!-- Thông báo mặc định -->
                                        Số điện thoại không hợp lệ. Hãy nhập số điện thoại theo định dạng chính xác.
                                    </div>
                                    <div id="phoneEmptyFeedback" class="invalid-feedback">
                                        <!-- Thông báo khi trống -->
                                        Số điện thoại không được bỏ trống.
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="inputEmail4" class="form-label"><strong>Email</strong></label>
                                    <input type="email" class="form-control" name="email" id="inputEmail4" placeholder="Email của bạn" required>
                                    <div class="invalid-feedback">
                                        Email không được bỏ trống.
                                    </div>
                                    
                                </div>

                                <div class="col-md-6">
                                    <label for="inputAddress" class="form-label"><strong>Địa chỉ</strong></label>
                                    <input type="text" class="form-control" name="address" id="inputAddress"
                                        placeholder="Nhập địa chỉ của bạn VD:Số 20,ngõ 90" required>
                                    <div class="invalid-feedback">
                                    Địa chỉ không được bỏ trống.
                                    </div>                                    
                                </div>
                                

                                <div class="form-floating col-md-12">
                                    <label for="floatingTextarea2" class="form-label pl-4" >Nội dung cần tư vấn</label>
                                    <input type="text" class="form-control" name="note" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px">
                                                                        
                                </div>

                                
                            
                                <div class="col-12">
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary" name="contact" value="Đăng Ký" id="submitBtn">Gửi thông tin</button>
                                        
                                    </div>
                                </div>
                            </form>


                        </div>
                    </div>

                <div class="col-4">
                    <br>
                    <div class="text-center fs-5  pb-3">CÔNG TY CỔ PHẦN LƯƠNG THỰC NÔNG SẢN VIỆT</div>
                    
                    <div class="mb-3 border-bottom pb-3" style="max-width: 347px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="../../../../WEB_BAN_HANG/Data/LienHe/dia_chi.png"
                                    class="img-thumbnail rounded-start border-0" style="border: 1px solid rgba(0,0,0,0.1); background-color: transparent;" alt="Địa Chỉ">
                            </div>
                            <div class="col-md-8">
                                <h5>Địa chỉ</h5>
                                <div>397, Đường 30/4, Phường Hưng Lợi, Quận Ninh Kiều, Thành phố Cần Thơ, Việt Nam</div>
                            </div>
                        </div>
                    </div>



                    <div class=" mb-3 border-bottom pb-3" style="max-width: 347px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="../../../../WEB_BAN_HANG/Data/LienHe/email.png"
                                class="img-thumbnail rounded-start border-0" style="border: 1px solid rgba(0,0,0,0.1); background-color: transparent;" alt=" Email">
                            </div>
                            <div class="col-md-8">
                                <h5 >Email</h5>
                                <div >Email: nongsanviet@gmail.com</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </main>
    
    <footer>
        <?php include "../Chung/php/foot.php"?>
    </footer>

    <!-- 1.Sắp xếp lại thanh điều hướng 
2.Cbj lại giỏ hàng ,thanh search,user.
3.Thêm thông tin -->

    <!-- <script>
        document.getElementById("submitBtn").addEventListener("click", function() {
        var currentDate = new Date();
        var formattedDate = currentDate.toISOString().slice(0, 10);
        document.getElementById("user_time").value = formattedDate;

    });
    </script> -->

    <!-- <script>
        // Lắng nghe sự kiện click của nút gửi
        document.getElementById("submitBtn").addEventListener("click", function() {
            // Lấy thời gian hiện tại
            var currentTime = new Date();
            
            // Lấy giờ, phút và giây
            var hours = currentTime.getHours();
            var minutes = currentTime.getMinutes();
            var seconds = currentTime.getSeconds();
            
            // Định dạng thời gian theo đúng định dạng của trường input time
            var formattedTime = (hours < 10 ? "0" : "") + hours + ":" +
                                (minutes < 10 ? "0" : "") + minutes + ":" +
                                (seconds < 10 ? "0" : "") + seconds;
            
            // Gán giá trị thời gian vào trường input ẩn
            document.getElementById("user_time1").value = formattedTime;
        });
    </script> -->


</body>

</html>