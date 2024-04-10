<?php
include '../Chung/php/connect.php';
include "header_admin.php"; 
include "sidebar.php";
?>
<?php
if (isset($_POST['add'])) {
    $product_name = $_POST['product_name'];
    $type = $_POST['type'];
    $price = $_POST['price'];

    // Kiểm tra xem trường 'image' đã được gửi và không trống
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['image']['name'];

        // Move uploaded file to desired location
        $uploadDir = "../../Data/Gao/" . $type . "/";
        $uploadFile = $uploadDir . basename($image);

        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
            echo "<script>alert('Đã xảy ra lỗi khi tải lên hình ảnh.');</script>";
            exit;
        }
    } else {
        echo "<script>alert('Vui lòng chọn hình ảnh cho sản phẩm.');</script>";
        exit;
    }

    if (!empty($product_name) && !empty($type) && !empty($price)) {
        $checkProductNamelQuery = "SELECT * FROM `product` WHERE `product_name` = '$product_name'";
        $checkProductNameResult = $conn->query($checkProductNamelQuery);

        if ($checkProductNameResult->num_rows > 0) {
            echo "<script>alert('Tên Sản Phẩm đã được dùng. Vui lòng chọn sản phẩm khác')</script>";
        } else {
            $insertQuery = "INSERT INTO `product` (`product_name`, `type`, `image`, `price`) 
                VALUES ('$product_name', '$type', '$image', '$price')";

            if ($conn->query($insertQuery) === TRUE) {
                echo "<script>alert('Thêm thành công')</script>";
            } else {
                echo "Lỗi: " . $insertQuery . "<br>" . $conn->error;
            }
        }
    }
}
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--CSS-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="../Chung/CSS_bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="sidebar.css">

        <link rel="stylesheet" href="../Chung/css/header.css">
        <link rel="stylesheet" href="../Chung/css/style.css">
        <link rel="stylesheet" href="../Chung/css/footer.css">

        <!-- JavaScript và jQuery -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
            integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <!-- Bootstrap JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
        <script src="../Chung/js/header.js" defer></script>
        <script src="../DangNhap/DangNhap.js"defer></script>

        
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-11 offset-md-1">
                    <button type="button" class="btn btn-primary float-end mt-3 mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Add Product
                    </button>
                </div>
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <form class="row g-3 needs-validation" action="" method="post" enctype="multipart/form-data" novalidate>
                                <div class="col-md-6">
                                    <label class="form-label fs-6"><strong>Tên Sản Phẩm</strong></label>
                                    <input type="text" class="form-control" name="product_name" placeholder="Tên sản phẩm" autofocus required>
                                    <div class="invalid-feedback">
                                        Tên Sản Phẩm không được bỏ trống.
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fs-6"><strong>Loại Sản Phẩm</strong></label>
                                    <select class="form-select form-control" id="inputGroupSelect01" name="type" required>
                                        <option selected disabled value="">Chọn loại sản phẩm</option>
                                        <option value="Gao_Dac_San">Gạo Đặc Sản</option>
                                        <option value="Gao_Tam">Gạo Tấm</option>
                                        <option value="Gao_Deo_Thom">Gạo Dẻo Thơm</option>
                                        <option value="Gao_Lut">Gạo Lứt</option>
                                        <option value="Gao_Nep">Gạo Nếp</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Vui lòng chọn loại sản phẩm.
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="formFile" class="form-label fs-6"><strong>Chọn hình ảnh của sản phẩm</strong></label>
                                    <input class="form-control" type="file" id="formFile" name="image" required>
                                    <div class="invalid-feedback">
                                        Vui lòng chọn hình ảnh cho sản phẩm.
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="autoSizingInputGroup" class="form-label fs-6"><strong>Chọn giá tiền cho sản phẩm</strong></label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="autoSizingInputGroup" placeholder="Chọn giá tiền cho sản phẩm" name="price" required>
                                        <div class="input-group-text">₫</div>
                                        <div class="invalid-feedback">
                                            <!-- Default invalid feedback for required field -->
                                            Vui lòng nhập giá tiền cho sản phẩm.
                                        </div>
                                        <div class="invalid-feedback" id="negativeFeedback">
                                            <!-- Custom invalid feedback for negative value -->
                                            Giá tiền phải là số dương.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary" name="add" value="Thêm">Thêm</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-14 offset-md-1">
                    <?php
                        if (!empty($_SESSION['success'])) {
                            $_SESSION['success_expire'] = time() + 3; // Thời gian hết hạn là 3 giây
                            ?>
                            <div class="alert alert-success mb-1" id="success-alert" role="alert"><?= $_SESSION['success'] ?></div>
                            <?php unset($_SESSION['success']);
                        }
                    ?>

                    <table class="table table-striped">
                        <!-- <thead>
                            <tr>              
                                <th scope="col" class="col-1">STT</th>
                                <th scope="col" class="col-3">Tên sản phẩm</th>
                                <th scope="col" class="col-3">Hình Ảnh</th>
                                <th scope="col" class="col-1">Giá</th>
                                <th scope="col" class="col-1">Thao tác</th>
                            </tr>
                        </thead> -->
                        <thead>
                        <tr>
                            <th scope="col"class="col-0.5">STT</th>
                            <th scope="col"class="col-2">Tên sản phẩm</th>
                            <th scope="col"class="col-2">Hình Ảnh</th>
                            <th scope="col"class="col-0.5">Tồn Kho</th>
                            <th scope="col"class="col-0.5">Đã Bán</th>
                            <th scope="col"class="col-2">Giá</th>
                            <th scope="col"class="col-0.5">Sửa</th>
                            <th scope="col"class="col-0.5">Xóa</th>

                        </tr>
                    </thead>
                        <tbody>
                        <?php
                            if(isset($_GET['trang'])){
                                $page = $_GET['trang'];
                            }else{
                                $page = '';
                            }
                            if( $page == '' ||  $page == 1){
                                $begin =0;
                            }else {
                                $begin = ($page*4)-4;
                            }
                            $sql = "SELECT * FROM product ORDER BY 	product_id ASC LIMIT $begin,4";
                            $result = mysqli_query($conn, $sql);

                            // Initializing a variable to keep track of the ID
                            $counter = 1;

                            while ($row = mysqli_fetch_array($result)) {
                                ?>
                                <tr>
                                    <td><?php echo $counter; ?></td>
                                    <td><?php echo $row['product_name'] ?></td>
                                    <td><img src="../../Data/Gao/<?php echo $row['type'] . '/'; ?><?php echo $row['image'] ?>" style="width: 100px; height: 80px;"></td>
                                    <td><?php echo $row['quantity'] ?></td>
                                    <td ><?php echo $row['sold'] ?></td>
                                    <td><b><?php echo  number_format($row['price'], 0, ',', '.') ?> VND</b></td>
                                    <td>
                                        <form action="edit_product.php" method="post">
                                            <input type="hidden" name="edit_id_product" value="<?php echo $row['product_id']; ?>">
                                            <input type="hidden" name="trang" value="<?php echo $page ?>">
                                            <button type="submit" name="edit_product" class="btn btn-secondary ">Sửa</button>
                                        </form>
                                    </td>
                                    <td>
                                        <!-- <form action="code.php" method="post">
                                            <input type="hidden" name="del_id" value="<?php echo $row['product_id']; ?>">
                                            <button type="submit" name="del_product"class="btn btn-success ">Xóa</button>
                                        </form> -->
                                        <form action="code.php" method="post" onsubmit="return confirmDelete()">
                                            <input type="hidden" name="del_id" value="<?php echo $row['product_id']; ?>">
                                            <button type="submit" name="del_product" class="btn btn-success">Xóa</button>
                                        </form>
                                        <script>
                                            function confirmDelete() {
                                                return confirm("Bạn có chắc chắn muốn xóa sản phẩm này?");
                                            }
                                        </script>
                                    </td>
                                </tr>
                                <?php
                                // Increment the counter for the next row
                                $counter++;
                            //    if($counter == 6) break;
                            }
                            ?>
                            <?php
                        $count = "SELECT COUNT(*) as total FROM product";
                        $kq = $conn->query($count);
                        $row = $kq->fetch_assoc();
                        $totalProduct= $row['total'];
                        $trang = ceil($totalProduct/4);
                        ?>
                        </tbody>
                    </table>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-end" id="pagination">
                            <li class="page-item">
                                <a class="page-link" href="ds_product.php?trang=1" aria-label="Previous">
                                    <span aria-hidden="true" name="first">&laquo;</span>
                                </a>
                            </li>
                            <?php
                            for($i =1;$i <= $trang;$i++){
                            ?>
                            <li class="page-item"><a class="page-link" href="ds_product.php?trang=<?php echo $i ?>"><?php echo $i ?></a></li>
                            <?php
                            }
                            ?>

                            <li class="page-item">
                                <a class="page-link" href="ds_product.php?trang=<?php echo $trang ?>" aria-label="Next">
                                    <span aria-hidden="true" name="last">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>

                </div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var form = document.querySelector('.needs-validation');
                var priceInput = document.getElementById('autoSizingInputGroup');
                var negativeFeedback = document.getElementById('negativeFeedback');

                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }

                    form.classList.add('was-validated');

                    // Custom validation for negative value
                    if (parseFloat(priceInput.value) < 0) {
                        negativeFeedback.style.display = 'block';
                        event.preventDefault();
                    } else {
                        negativeFeedback.style.display = 'none';
                    }
                });
            });
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                var successAlert = document.getElementById('success-alert');
                var expireTime = <?= !empty($_SESSION['success_expire']) ? $_SESSION['success_expire'] : 0 ?>;

                if (successAlert && expireTime > 0) {
                    setTimeout(function () {
                        successAlert.style.display = 'none';
                    }, (expireTime - <?= time() ?>) * 1000);
                }
            });
        </script>
    

    </body>
    
</html>
