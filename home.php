<?php
session_start(); // Bắt đầu session

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Nếu chưa đăng nhập, chuyển hướng về trang đăng nhập
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/styles.css">
    <script src="js.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="shortcut icon" href="image/vietnam.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <header class="header">
        <div class="logo">
            <img src="image/vietnam.png" alt="Logo">
        </div>
        <div id="translate-wrapper">
            <div id="google_translate_element"></div>
        </div>
        <script type="text/javascript">
            function googleTranslateElementInit() {
                new google.translate.TranslateElement({
                    pageLanguage: 'vi',
                    layout: google.translate.TranslateElement.InlineLayout.SIMPLE
                }, 'google_translate_element');
            }
        </script>
        <script type="text/javascript"
            src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
        <nav class="navbar">
            <a href="home.php" class="nav-link text-decoration-none">Trang chủ</a>
            <a href="history.php" class="nav-link text-decoration-none">Lịch Sử</a>
            <a href="product.php" class="nav-link text-decoration-none">Sản phẩm</a>
            <a href="donate.php" class="nav-link text-decoration-none">Quyên góp</a>
            <a href="contact.php" class="nav-link text-decoration-none">Liên Hệ</a>
            <a href="blogs.php" class="nav-link text-decoration-none">Blogs</a>
        </nav>
        </div>
        <div class="icons">
            <div class="fas fa-search" id="search-btn"></div>
            <a href="#">
                <div class="fas fa-user account-icon"></div>
            </a>
            <script>
                function updateCartCount() {
                    fetch("get_cart_count.php")
                        .then(response => response.json())
                        .then(data => {
                            if (data.error) {
                                console.error(data.error); // Hiển thị lỗi nếu có
                            } else {
                                // Cập nhật số lượng giỏ hàng trong giao diện
                                document.getElementById("cart-count").innerText = data.cart_count;
                            }
                        })
                        .catch(error => console.error("Lỗi:", error));
                }

                // Gọi hàm này khi tải trang để cập nhật số lượng giỏ hàng ban đầu
                window.onload = updateCartCount;

                function addToCart(productId, quantity) {
                    fetch("cart.php", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/x-www-form-urlencoded"
                            },
                            body: `product_id=${productId}&quantity=${quantity}`
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.error) {
                                alert(data.error);
                            } else {
                                alert(data.message);
                                updateCartCount(); // Cập nhật số lượng giỏ hàng
                            }
                        })
                        .catch(error => console.error("Lỗi:", error));
                }
            </script>
            <a href="cart.php">
                <div class="fas fa-shopping-cart" id="cart-btn">
                    <span id="cart-count">0</span> <!-- Số lượng sản phẩm -->
                </div>
            </a>
            <div class="fas fa-bars" id="menu-btn"></div>
            <div class="logout">
                <a href="login.php" class="btn btn-danger">Đăng xuất</a>
            </div>
            <div class="hello">
                <p style="font-size: 50%;">
                    <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>!
                </p>
            </div>
        </div>
        <div class="search-form">
            <input type="search" id="search-box" placeholder="search here...">
            <label for="search-box" class="fas fa-search"></label>
        </div>
        <div class="cart-items-container">
            <div class="cart-item">
                <span class="fas fa-times"></span>
                <img src="image/hinh-anh-xe-tang-tien-vao-dinh-doc-lap.jpg" alt="">
                <div class="content">
                    <h3>cart item 01</h3>
                    <div class="price">$15.99</div>
                </div>
            </div>
            <div class="cart-item">
                <span class="fas fa-times"></span>
                <img src="image/hinh-anh-xe-tang-tien-vao-dinh-doc-lap.jpg" alt="">
                <div class="content">
                    <h3>cart item 02</h3>
                    <div class="price">$15.99</div>
                </div>
            </div>
            <div class="cart-item">
                <span class="fas fa-times"></span>
                <img src="image/hinh-anh-xe-tang-tien-vao-dinh-doc-lap.jpg" alt="">
                <div class="content">
                    <h3>cart item 03</h3>
                    <div class="price">$15.99</div>
                </div>
            </div>
            <div class="cart-item">
                <span class="fas fa-times"></span>
                <img src="image/hinh-anh-xe-tang-tien-vao-dinh-doc-lap.jpg" alt="">
                <div class="content">
                    <h3>cart item 04</h3>
                    <div class="price">$15.99</div>
                </div>
            </div>
            <a href="#" class="btn">check out now</a>
        </div>
    </header>
    <div id="home" class="  text-white">
        <div class="video-background">
            <video autoplay muted loop id="background-video">
                <source src="audio/Untitled video - Made with Clipchamp (1).mp4" type="video/mp4">
            </video>
        </div>
        <br><br>
        <section class="home" id="home">
            <div class="content">
                <h3>Number1</h3>
                <p>Description</p>
                <a href="#" class="btn1">Get Your Now</a>
            </div>
        </section>

        <div class="banner ">
            <div class="slider" style="--quantity:10">
                <div class="item" style="--position: 1"><img src="image/hinh-anh-xe-tang-tien-vao-dinh-doc-lap.jpg"
                        alt="Image 1">
                    <div class="caption">Chiến thắng 30/4/1975.<p>Victory on April 30, 1975.</p>
                    </div>
                </div>
                <div class="item" style="--position: 2"><img
                        src="https://vienkiemsat.haiduong.gov.vn/uploads/news/2023_09/img_697_0_1693534557.png"
                        alt="Image 2">
                    <div class="caption">Chủ tịch Hồ Chí Minh đọc bản Tuyên Ngôn độc lập 2/9/1945. <p>President Ho
                            Chi
                            Minh
                            read the Declaration of Independence September 2, 1945.</p>
                    </div>
                </div>
                <div class="item" style="--position: 3"><img
                        src="https://icdn.dantri.com.vn/oYFp4wxLk7Q3Y2XcWsQ4489qiYdFDF/Image/2015/04/2.-vietnam-woman-flees-children-burning-village-1429569495-af683.jpg"
                        alt="Image 3">
                    <div class="caption">Lính chính quyền Sài Gòn đốt cháy tháng 7/1963.<p>Saigon government
                            soldiers
                            burned
                            it in July 1963.</p>
                    </div>
                </div>
                <div class="item" style="--position: 4"><img
                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRaI5f0ga_y4YD5hSrrYSZIvF8tl8X__BhHag&s"
                        alt="Image 4">
                    <div class="caption">Hoạt động quân sự của đồng minh Mỹ trong chiến tranh Việt Nam.<p>Military
                            operations of American allies during the Vietnam War.</p>
                    </div>
                </div>
                <div class="item" style="--position: 5"><img
                        src="https://baohaiquanvietnam.vn/storage/users/user_8/Nam%202019/Cuu%20ngu%20dan%20PLP/chien-tranh-bien-gioi-5-4fa4b-0-0-255-500-crop-1406570348787-1548824325963307103077.jpg"
                        alt="Image 5">
                    <div class="caption">Chiến tranh Tháng 2 năm 1979: Một cuộc chiến vô nghĩa, trái đạo lý và thảm
                        bại.
                        <p>
                            War in February 1979: A meaningless, immoral and disastrous war.
                        </p>
                    </div>
                </div>
                <div class="item" style="--position: 6"><img
                        src="https://cdn.tuyengiao.vn/uploads/2024/04/21/22/cq-259-1713677829.jpeg?s=jwpg0qc-4xq"
                        alt="Image 6">
                    <div class="caption">Chiến thắng Điện Biên Phủ: Sức mạnh đại đoàn kết toàn dân tộc thời đại Hồ
                        Chí
                        Minh.Dien Bien Phu Victory: The strength of great national unity in the Ho Chi Minh era.
                        <p></p>
                    </div>
                </div>
                <div class="item" style="--position: 7"><img
                        src="https://photo.znews.vn/w660/Uploaded/lce_cqdjw/2019_07_10/ezgifcomwebptojpg_14.jpg"
                        alt="Image 7">
                    <div class="caption">Bức ảnh năm 1968 được chụp, hàng hoạt tiếng súng.<p>In this 1968 photo, a
                            series of
                            gunshots are heard.</p>
                    </div>
                </div>
                <div class="item" style="--position: 8"><img
                        src="https://redsvn.net/wp-content/uploads/2018/02/China-invade-Vietnam-1979.jpg" alt="Image 8">
                    <div class="caption">Cuộc chiến phi nghĩa do Trung Quốc khởi xướng năm 1979.<p>Unjust war
                            initiated
                            by
                            China in 1979.</p>
                    </div>
                </div>
                <div class="item" style="--position: 9"><img
                        src="https://redsvn.net/wp-content/uploads/2017/05/Vietnam-War-01.jpg" alt="Image 9">
                    <div class="caption">Trực thăng Mỹ nã đạn vào những bụi cây để ểm trợ cho bộ binh VNCH.<p>
                            American
                            helicopters fired into the bushes to support the ARVN infantry.</p>
                    </div>
                </div>
                <div class="item" style="--position: 10"><img
                        src="https://cdn-i.vtcnews.vn/files/phamthinh/2019/07/22/chien-si-cam-b41-lang-son-8-0754065.jpg"
                        alt="Image 10">
                    <div class="caption">Người lính trong bức ảnh ‘biểu tượng nhất’ cuộc chiến chống Trung Quốc.<p>
                            The
                            soldier in the 'most iconic' photo of the war against Chinese.</p>
                    </div>
                </div>

            </div>
            <div class="typewriter ">
                <h1>Cột mốc quan trọng về lịch sử Việt Nam</h1>
            </div>
        </div>
    </div>
    <div class="typewriter text-center block ">
        <h1>Bảng Thống Kê Về Tổng số liệt sĩ và bệnh nhân chất độc màu da cam</h1>
    </div>
    <div class="container fade-in block">
        <div class="image-scroll">
            <button class="scroll-btn left" onclick="scrollLeft()">❮</button>
            <div class="row" id="imageRow">
                <div class="col-3">
                    <div class="fade-in-image">
                        <img src="image/info 13 can bo.jpg" height="320px" alt="Image Description">
                    </div>
                </div>
                <div class="col-3">
                    <div class="fade-in-image">
                        <img src="image/t76771.jpg" height="320px" alt="Image Description">
                    </div>
                </div>
                <div class="col-3">
                    <div class="fade-in-image">
                        <img src="image/XoaDiuNoiDauDaCam.jpg" height="320px" alt="Image Description">
                    </div>
                </div>
                <div class="col-3">
                    <div class="fade-in-image">
                        <img src="image/NGOC- HAU QUA LAU DAI TU CHAT DOC DA CAM_NGOC.jpg" height="320px"
                            alt="Image Description">
                    </div>
                </div>

            </div>
            <button class="scroll-btn right" onclick="scrollRight()">❯</button>
        </div>
    </div>


    <div class="canvas fade-in">
        <div class="row">
            <div class="col-4">
                <canvas id="canvas1"></canvas>
                <script>
                    var DoughnutChart1 = [{
                        value: 40,
                        color: "#fcc79e"
                    }, {
                        value: 20,
                        color: "#beefd2"
                    }, {
                        value: 50,
                        color: "#ffddfb"
                    }];

                    var ctx1 = document.getElementById("canvas1").getContext("2d");
                    var myDoughnutChart1 = new Chart(ctx1, {
                        type: 'doughnut',
                        data: {
                            datasets: [{
                                data: DoughnutChart1.map(item => item.value),
                                backgroundColor: DoughnutChart1.map(item => item.color)
                            }],
                            labels: ['Segment 1', 'Segment 2', 'Segment 3']
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                                title: {
                                    display: true,
                                    text: 'Updated Doughnut Chart 1'
                                }
                            }
                        }
                    });
                </script>
            </div>
            <div class="col-4">
                <canvas id="canvas2"></canvas>
                <script>
                    var DoughnutChart2 = [{
                        value: 60,
                        color: "#fcc79e"
                    }, {
                        value: 30,
                        color: "#beefd2"
                    }, {
                        value: 50,
                        color: "#ffddfb"
                    }];

                    var ctx2 = document.getElementById("canvas2").getContext("2d");
                    var myDoughnutChart2 = new Chart(ctx2, {
                        type: 'doughnut',
                        data: {
                            datasets: [{
                                data: DoughnutChart2.map(item => item.value),
                                backgroundColor: DoughnutChart2.map(item => item.color)
                            }],
                            labels: ['Segment 4', 'Segment 5', 'Segment 6']
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                                title: {
                                    display: true,
                                    text: 'Updated Doughnut Chart 2'
                                }
                            }
                        }
                    });
                </script>
            </div>

            <div class="col-4">
                <canvas id="canvas3"></canvas>
                <script>
                    var BarChart = {
                        labels: ["Ruby", "jQuery", "Java", "ASP.Net", "PHP"],
                        datasets: [{
                            backgroundColor: "rgba(255, 0, 0, 0.5)", // Màu nền nhạt (đỏ)
                            borderColor: "rgba(255, 255, 255, 1)", // Màu viền trắng
                            data: [13, 20, 30, 40, 50]
                        }, {
                            backgroundColor: "rgba(0, 128, 0, 0.5)", // Màu nền nhạt (xanh lá)
                            borderColor: "rgba(0, 128, 0, 1)", // Màu viền xanh lá
                            data: [28, 68, 40, 19, 96]
                        }]
                    };


                    var ctx3 = document.getElementById("canvas3").getContext("2d");
                    var myBarChart = new Chart(ctx3, {
                        type: 'bar',
                        data: BarChart,
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            },
                            plugins: {
                                legend: {
                                    display: true,
                                },
                                title: {
                                    display: true,
                                    text: 'Bar Chart Example'
                                }
                            }
                        }
                    });
                </script>
            </div>

        </div>

        <div class="col-4">
            <canvas id="canvas3">
                <script>
                    var myBarChart = new Chart(document.getElementById("canvas3").getContext("2d")).Bar(BarChart, {
                        scaleFontSize: 14,
                        scaleFontColor: "#ff8540"
                    });
                    var BarChart = {
                        labels: ["Ruby", "jQuery", "Java", "ASP.Net", "PHP"],
                        datasets: [{
                            fillColor: "rgba(151,249,190,0.5)",
                            strokeColor: "rgba(255,255,255,1)",
                            data: [13, 20, 30, 40, 50]
                        }, {
                            fillColor: "rgba(252,147,65,0.5)",
                            strokeColor: "rgba(255,255,255,1)",
                            data: [28, 68, 40, 19, 96]
                        }]
                    }
                </script>
            </canvas>
        </div>
    </div>

    <footer class="footer">
        <div class="container1">
            <div class="footer-content">
                <!-- Logo và thông tin -->
                <div class="footer-section">
                    <h5>Tên Công Ty</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis pulvinar vestibulum.
                    </p>
                </div>

                <!-- Liên kết nhanh -->
                <div class="footer-section">
                    <h5>Liên Kết Nhanh</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Trang Chủ</a></li>
                        <li><a href="#">Giới Thiệu</a></li>
                        <li><a href="#">Dịch Vụ</a></li>
                        <li><a href="#">Liên Hệ</a></li>
                    </ul>
                </div>

                <!-- Thông tin liên hệ -->
                <div class="footer-section">
                    <h5>Thông Tin Liên Hệ</h5>
                    <p>Địa chỉ: Số 123, Đường ABC, Thành phố XYZ</p>
                    r <p>Điện thoại: (012) 345-6789</p>
                    <p>Email: info@example.com</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>© 2024 Tên Công Ty. Bản quyền thuộc về công ty.</p>
            </div>
        </div>
    </footer>



</body>

</html>