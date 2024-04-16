<?php
include '../Chung/php/connect.php';
include "header_admin.php"; 
include "sidebar.php";
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

    </head>
    <body>
        <div class="container">
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
                        <thead>
                            <tr>
                                <th scope="col"class="col-0.5">STT</th>
                                <th scope="col"class="col-1.5">Họ tên</th>
                                <th scope="col"class="col-0.5">Điện Thoại</th>
                                <!-- <th scope="col"class="col-0.5">Email</th> -->

                                <th scope="col"class="col-0.5">Địa Chỉ</th>
                                <th scope="col-1"class="col-3.5">Ghi Chú</th>
                                <th scope="col"class="col-0.5">Time</th>
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
                            $sql = "SELECT * FROM lienhe ORDER BY created DESC LIMIT $begin,4";
                            $result = mysqli_query($conn, $sql);
                            $counter = 1;

                            while ($row = mysqli_fetch_array($result)) {
                            ?>
                                <tr>
                                    <td><?php echo $counter; ?></td>
                                    <td><?php echo $row['username'] ?></td>
                                    <td><?php echo $row['phonenumber'] ?></td>
                                    
                                    <td><?php echo $row['address'] ?></td>
                                    <td><?php echo $row['note'] ?></td>
                                    <td><?php echo $row['created'] ?></td>
                                    <td>
                                        <form action="code.php" method="post" onsubmit="return confirmDelete()">
                                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                            <input type="hidden" name="trang" value="<?php echo $page?>">
                                            <button type="submit" name="del_idpb"class="btn btn-success ">Xóa</button>
                                        </form>
                                        <script>
                                            function confirmDelete() {
                                                return confirm("Bạn đã xử lý PHẢN HỒI này?");
                                            }
                                        </script>
                                    </td>
                                </tr>
                            <?php
                            // Increment the counter for the next row
                            $counter++;
                            //if($counter == 6) break;
                            }
                            ?>
                            <?php
                                $count = "SELECT COUNT(*) as total FROM lienhe";
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
                                <a class="page-link" href="ds_feedback.php?trang=1" aria-label="Previous">
                                    <span aria-hidden="true" name="first">&laquo;</span>
                                </a>
                            </li>
                            <?php
                            for($i =1;$i <= $trang;$i++){
                            ?>
                            <li class="page-item"><a class="page-link" href="ds_feedback.php?trang=<?php echo $i ?>"><?php echo $i ?></a></li>
                            <?php
                            }
                            ?>
                            <?php 
                                if($trang == 0) $trang=1; 
                            ?>
                            <li class="page-item">
                                <a class="page-link" href="ds_feedback.php?trang=<?php echo $trang ?>" aria-label="Next">
                                    <span aria-hidden="true" name="last">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

    

    </body>
</html>