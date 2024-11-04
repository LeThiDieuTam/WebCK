<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spinner Phần Trăm</title>
    <style>
    body {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
        background-color: #f0f0f0;
    }

    .spinner-container {
        position: relative;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .spinner {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        border: 10px solid transparent;
        border-top-color: #3498db;
        animation: spin 2s linear infinite;
    }

    .percentage {
        position: absolute;
        font-size: 24px;
        font-weight: bold;
        color: #333;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
    </style>
</head>

<body>
    <div class="spinner-container">
        <div class="spinner" id="spinner">
            <div class="percentage" id="percentage">0%</div>
        </div>
    </div>
    <button onclick="startSpinner()">Bắt đầu</button>

    <script>
    let percentage = 0;

    function startSpinner() {
        percentage = 0;
        document.getElementById('percentage').innerText = percentage + '%';

        // Lấy dữ liệu từ place_order.php
        fetch('place_order.php')
            .then(response => response.json())
            .then(data => {
                const totalOrders = data.total_orders; // Tổng số đơn hàng
                const completedOrders = data.completed_orders; // Số đơn hàng đã hoàn thành

                // Tính phần trăm
                percentage = (completedOrders / totalOrders) * 100;

                // Cập nhật phần trăm hiển thị
                const interval = setInterval(() => {
                    percentage += 10; // Tăng phần trăm mỗi lần lặp
                    if (percentage >= 100) {
                        percentage = 100; // Giới hạn phần trăm tối đa là 100
                        clearInterval(interval); // Dừng khi đạt 100%
                    }
                    document.getElementById('percentage').innerText = Math.round(percentage) +
                    '%'; // Làm tròn phần trăm
                }, 1000); // Thay đổi mỗi giây (1000ms)
            })
            .catch(error => console.error('Error fetching data:', error));
    }
    </script>
</body>

</html>