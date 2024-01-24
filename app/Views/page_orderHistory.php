<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch sử mua hàng</title>
    <link rel="stylesheet" href="path/to/your/styles.css">
    <style>
        body,
        h1,
        h5,
        p,
        a,
        button {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
        }

        .order-history-container {
            margin: 20px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .order-card {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        .order-status {
            font-weight: bold;
        }

        .order-cancel-button {
            background-color: #e74c3c;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            text-decoration: none;
            cursor: pointer;
        }

        .order-cancel-button:hover {
            background-color: #c0392b;
        }
    </style>
</head>

<body>
    <div class="order-history-container">
        <h1>Lịch sử mua hàng</h1>
        <br>
        <a href="?url=page/index" class="nav-link">Trang chủ</a>
        <br>
        <h5>Xin chào : <?php echo $_SESSION['hovaten'] ?></h5>

        <?php if (!empty($orderHistory)) : ?>
            <?php foreach ($orderHistory as $row) : ?>
                <div class="order-card">
                    <strong>Mã đơn hàng:</strong> <?php echo $row['ma_donhang']; ?><br>
                    <strong>Tên người dùng:</strong> <?php echo $row['tennguoidung']; ?><br>
                    <strong>Địa chỉ:</strong> <?php echo $row['diachinguoidung']; ?><br>
                    <strong>Số điện thoại:</strong> <?php echo $row['sdtnguoidung']; ?><br>
                    <strong>Email:</strong> <?php echo $row['emailnguoidung']; ?><br>
                    <strong>Tên sản phẩm:</strong> <?php echo $row['tensanpham']; ?> - Số lượng: <?php echo $row['soluong']; ?><br>
                    <strong>Tổng tiền:</strong> <?php echo number_format($row['tongtien']); ?> VND<br>
                    <strong>Trạng thái:</strong>
                    <?php
                    $statusMapping = array(
                        'chua-xac-nhan' => 'Chưa xác nhận',
                        'dang-chuan-bi' => 'Đang chuẩn bị',
                        'dang-giao-hang' => 'Đang giao hàng',
                        'da-nhan-hang' => 'Đã nhận hàng'
                    );

                    if ($row['trangthai'] === 'chua-xac-nhan') {
                        echo "<span class='order-status' style='color:red;'>{$statusMapping[$row['trangthai']]}</span>";
                        echo "<button class='order-cancel-button'><a style='text-decoration:none; color:white;' href='?url=product/cancelOrder/{$row['ma_donhang']}''>Hủy đơn</a></button>";
                    } elseif ($row['trangthai'] === 'huy-don') {
                        echo "<span class='order-status' style='color:red;'>Đã hủy đơn</span>";
                    } else {
                        echo "<span class='order-status' style='color:green;'>{$statusMapping[$row['trangthai']]}</span>";
                    }
                    ?>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p>Không có lịch sử mua hàng.</p>
        <?php endif; ?>
    </div>
</body>

</html>