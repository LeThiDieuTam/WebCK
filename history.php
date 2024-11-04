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
    <link rel="stylesheet" href="./css/history.css">
    <script src="script.js" defer></script>
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
                <div class="fas fa-heart"></div>
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
    <br><br>
    </div>
    <section class="parallax">
        <img src="image/hill1.png" id="hill1">
        <img src="image/hill2.png" id="hill2">
        <img src="image/hill3.png" id="hill3">
        <img src="image/hill4.png" id="hill4">
        <img src="image/nguoilinh3.png" id="nguoilinh3" width="50%">
        <img src="image/hill5.png" id="hill5">
        <img src="image/tree.png" id="tree">
        <img src="image/leaf.png" id="leaf">
        <img src="image/plant.png" id="plant">
        <h2 id="text">LỊCH SỬ VIỆT NAM</h2>
        <img src="image/plant.png" id="plant">

    </section>

    <div class="sec">
        <h2>Nội dung khác</h2>
        <p>Đây là phần nội dung khác nằm bên dưới phần parallax.</p>


        <div class="flex-container">
            <div class="text-title">
                <img src="image/hinh-anh-xe-tang-tien-vao-dinh-doc-lap.jpg" alt="Ảnh 1">
                <img src="image/hinh-anh-xe-tang-tien-vao-dinh-doc-lap.jpg" alt="Ảnh 2">
                <img src="image/hinh-anh-xe-tang-tien-vao-dinh-doc-lap.jpg" alt="Ảnh 3">
                <img src="image/hinh-anh-xe-tang-tien-vao-dinh-doc-lap.jpg" alt="Ảnh 4">
                <img src="image/hinh-anh-xe-tang-tien-vao-dinh-doc-lap.jpg" alt="Ảnh 5">
            </div>
        </div>








    </div>

</body>

</html>