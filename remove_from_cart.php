<?php
session_start(); // Bắt đầu session

// Kết nối cơ sở dữ liệu
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "user_registration";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Lấy cart_id từ tham số URL
if (isset($_GET['cart_id'])) {
    $cart_id = $_GET['cart_id'];

    // Xóa sản phẩm khỏi giỏ hàng
    $sql_remove = "DELETE FROM cart WHERE cart_id = ?";
    $stmt_remove = $conn->prepare($sql_remove);
    $stmt_remove->bind_param("i", $cart_id);

    if ($stmt_remove->execute()) {
        // Quay lại trang giỏ hàng sau khi xóa thành công
        header("Location: cart.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}

$stmt_remove->close();
$conn->close();