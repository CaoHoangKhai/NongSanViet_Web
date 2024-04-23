<?php
include '../Chung/php/connect.php';
include "header_admin.php"; 
include "sidebar.php";

// Truy vấn để lấy tổng doanh thu theo ngày
$sql = "SELECT DATE(created) AS ngay, SUM(price) AS doanh_thu FROM order_customer WHERE status <= 3 GROUP BY DATE(created)";
$result = $conn->query($sql);

// Dữ liệu cho biểu đồ
$labels = []; // Nhãn cho trục x (ngày)
$data = []; // Dữ liệu doanh thu tương ứng

// Xử lý kết quả truy vấn
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $labels[] = $row['ngay'];
        $data[] = $row['doanh_thu'];
    }
}

?>

<!DOCTYPE html>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js" defer></script>
        <script src="../Chung/js/header.js" defer></script>
        <!-- Đường dẫn đến thư viện Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-12 offset-md-1">
                    
                    <?php
                    //User
                    $count_user = "SELECT COUNT(*) as total_u FROM customer WHERE role=0";
                    $kq_u = $conn->query($count_user);
                    $row =  $kq_u->fetch_assoc();
                    $totalCustomers = $row['total_u'];
                    //Product
                    $count_product = "SELECT COUNT(*) as total_p FROM product";
                    $kq_p = $conn->query($count_product);
                    $row =  $kq_p->fetch_assoc();
                    $totalProduct = $row['total_p'];
                    //Feedback
                    $count_feedback = "SELECT COUNT(*) as total_fb FROM lienhe";
                    $kq_fb = $conn->query($count_feedback);
                    $row =  $kq_fb->fetch_assoc();
                    $totalFeedBack = $row['total_fb'];
                    
                    $sql_doanhthu = "SELECT SUM(CASE WHEN status <= 3 THEN price ELSE 0 END) AS sum_condition FROM order_customer;";
                    $kq_doanhthu = $conn->query($sql_doanhthu);
                    $row =  $kq_doanhthu->fetch_assoc();
                    $totaldoanhthu = $row['sum_condition'];

                    function format_doanhthu($totaldoanhthu) {
                        if ($totaldoanhthu >= 1000000000) {
                            return number_format($totaldoanhthu / 1000000000, 1, ',', ' ') . 'B';
                        } elseif ($totaldoanhthu >= 1000000) {
                            return number_format($totaldoanhthu / 1000000, 1, ',', ' ') . 'M';
                        } else {
                            return number_format($totaldoanhthu, 0, ',', ' ');
                        }
                    }
                    
                    ?>
                    <div class="container">
                        <div class="row g-2">
                            <div class="col-3" >
                                <a href="ds_product.php?trang=1" class="link-dark">
                                <div class="p-3 border bg-info d-flex justify-content-between align-items-center">
                                    <div class=" text-left text-white fs-5">
                                        <div class=" text-left text-white fs-3"><?php echo $totalProduct;?></div>
                                        <div>News Product</div>
                                    </div>
                                    <div class="text-right">
                                        <i class="fas fa-shopping-bag fa-5x"></i>
                                    </div>
                                </div>
                                </a>
                            </div>

                            <div class="col-3">
                                <a href="ds_user.php?trang=1" class="link-dark">
                                <div class="p-3 border bg-info d-flex justify-content-between align-items-center">
                                    <div class=" text-left text-white fs-5">
                                        <div class=" text-left text-white fs-3"><?php echo $totalCustomers;?></div>
                                        <div>News User</div>
                                    </div>
                                    <div class="text-right">
                                    <i class="fas fa-user-plus fa-5x"></i>
                                    </div>
                                </div>
                                </a>
                            </div>

                            <div class="col-3">
                                <a href="ds_feedback.php?trang=1" class="link-dark">
                                <div class="p-3 border bg-info d-flex justify-content-between align-items-center">
                                    <div class="text-left text-white fs-5">
                                        <div class="text-left text-white fs-3"><?php echo $totalFeedBack; ?></div>
                                        <div>Feed Back</div>
                                    </div>
                                    <div class="text-right">
                                        <i class="fas fa-comments fa-5x"></i>
                                    </div>
                                </div>
                                </a>
                            </div>

                            
                            <div class="col-3">
                                <a href="ds_order.php" class="link-dark">
                                    <div class="p-3 border bg-info d-flex justify-content-between align-items-center">
                                        <div class="text-left text-white fs-5">
                                            <div class="text-left text-white fs-3"><?php echo format_doanhthu($totaldoanhthu);?></div>
                                            <div>Doanh Thu</div>
                                        </div>
                                        <div class="text-right" style="margin-right: 20px;">
                                            <i class="fa fa-bar-chart" style="font-size:80px;"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>

                      
                        </div>
                    </div>

                    <div class="container">
                        <!-- Đối với biểu đồ, bạn cần một phần tử canvas -->
                        <canvas id="doanhThuChart" width="1500" height="395"></canvas>

                        <script>
                            // Lấy tham chiếu đến phần tử canvas
                            var ctx = document.getElementById('doanhThuChart').getContext('2d');

                            // Khởi tạo biểu đồ cột
                            var doanhThuChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: <?php echo json_encode($labels); ?>, // Sử dụng dữ liệu từ PHP
                                    datasets: [{
                                        label: 'Doanh thu theo ngày',
                                        data: <?php echo json_encode($data); ?>, // Sử dụng dữ liệu từ PHP
                                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                                        borderColor: 'rgba(54, 162, 235, 1)',
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    scales: {
                                        yAxes: [{
                                            ticks: {
                                                beginAtZero: true
                                            }
                                        }]
                                    }
                                }
                            });
                        </script>
                    </div>

                </div>
            </div>
        </div>

    </body>
</html>