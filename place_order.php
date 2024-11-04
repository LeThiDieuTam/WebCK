<?php
session_start();

// Kết nối cơ sở dữ liệu
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "user_registration";
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Kiểm tra người dùng đăng nhập
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Lấy danh sách các sản phẩm được chọn
if (isset($_POST['selected_products']) && is_array($_POST['selected_products'])) {
    $selected_products = $_POST['selected_products'];
    $user_id = $_SESSION['id'];

    // Xử lý đơn hàng (ví dụ: thêm vào bảng orders nếu có)
    // Thực hiện các thao tác lưu trữ đơn hàng tại đây

    // Xóa các sản phẩm đã đặt khỏi giỏ hàng
    $cart_ids = implode(',', array_map('intval', $selected_products)); // Đảm bảo an toàn khi xử lý ID
    $sql_delete = "DELETE FROM cart WHERE cart_id IN ($cart_ids) AND user_id = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("i", $user_id);

    if ($stmt_delete->execute()) {
        echo "<script>
            alert('Đơn hàng đã được đặt thành công và sản phẩm đã được xóa khỏi giỏ hàng.');
            window.location.href = 'cart.php'; // Chuyển hướng về trang giỏ hàng
        </script>";
    } else {
        echo "<script>
            alert('Đơn hàng đặt thành công, nhưng có lỗi khi xóa sản phẩm khỏi giỏ hàng.');
            window.location.href = 'cart.php'; // Chuyển hướng về trang giỏ hàng nếu có lỗi
        </script>";
    }
} else {
    echo "<script>
        alert('Không có sản phẩm nào được chọn để đặt hàng.');
        window.location.href = 'cart.php'; // Quay lại giỏ hàng nếu không có sản phẩm nào được chọn
    </script>";
}

// Đóng kết nối
$conn->close();
