<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Tin Khách Hàng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .customer-info-box {
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            width: 400px;
        }

        .customer-info-box img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin: 10px auto;
            display: block;
        }

        h1 {
            color: #333;
        }

        p {
            margin: 10px 0;
            color: #666;
        }

        .customer-info-box a {
            display: inline-block;
            margin: 10px 0;
            padding: 10px;
            text-decoration: none;
            color: #fff;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .customer-info-box a.logout {
            background-color: #e74c3c;
        }

        .customer-info-box a.history {
            background-color: #3498db;
        }

        .customer-info-box a.edit-pass {
            background-color: #2ecc71;
        }

        .customer-info-box a:hover {
            background-color: #555;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="customer-info-box">
        <h1>Thông tin khách hàng</h1>
        <img src="<?php echo $_SESSION['anhnguoidung'] ?>" alt="">
        <p>Tên người dùng: <?php echo $hovaten; ?></p>
        <p>Địa chỉ: <?php echo isset($_SESSION['diachi']) ? $_SESSION['diachi'] : ''; ?></p>
        <p>Số điện thoại: <?php echo isset($_SESSION['sodienthoai']) ? $_SESSION['sodienthoai'] : ''; ?></p>
        <p>Email: <?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?></p>

        <a href="?url=user/logout" class="logout">Đăng xuất</a>
        <a href="?url=user/pageOrderHistory" class="history">Lịch sử mua hàng</a>
        <a href="?url=user/editAccount" class="edit-pass"><i class="bx bxs-cog"></i> Cài đặt</a>
    </div>
</div>

</body>
</html>
