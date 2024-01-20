<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng kí tài khoản</title>
    <link rel="icon" href="./path/to/your/logo.png" type="image/png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-image: url(./img/bannerauth.png);
            background-color: #f4f4f4;
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .form-container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .form {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 350px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 8px;
            color: #333;
        }

        input {
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            padding: 10px;
            background-color: orange;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin: 10px;
        }

        button a {
            text-decoration: none;
            color: white;
        }

        button:hover {
            transition: 0.5s;
            opacity: 70%;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <div class="form">
            <h1>Đăng kí</h1>
            <?php
            if (isset($_GET['error'])) {
                $errorMessage = $_GET['error'];
                echo "<p style='color: red;'>$errorMessage</p>";
            }
            ?>
            <form action="" method="POST">
                <label for="hovaten"><i class='bx bxs-user'></i>Họ và tên</label>
                <input type="text" name="hovaten" placeholder="Nhập họ và tên của bạn" required>

                <label for="diachi"><i class='bx bxs-home'></i>Địa chỉ</label>
                <input type="text" name="diachi" placeholder="Nhập địa chỉ của bạn" required>

                <label for="sodienthoai"><i class='bx bxs-phone'></i>Số điện thoại</label>
                <input type="text" name="sodienthoai" placeholder="Nhập số điện thoại của bạn" required>

                <label for="email"><i class='bx bxs-envelope'></i>Email</label>
                <input type="email" name="email" placeholder="Nhập email của bạn" required>

                <label for="matkhau"><i class='bx bxs-lock-alt'></i>Mật khẩu</label>
                <input type="password" name="matkhau" placeholder="Nhập mật khẩu của bạn" required>

                <button type="submit">Đăng kí</button>
            </form>
        </div>
    </div>
</body>
</html>
