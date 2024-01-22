<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin người dùng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f4f4f4;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input {
            width: 100%;
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
        }

        button:hover {
            transition: 0.5s;
            opacity: 0.7;
        }
    </style>
</head>

<body>
    <form action="?url=user/updateAccount" method="POST" enctype="multipart/form-data">
        <label for="hovaten"><i class='bx bxs-user'></i>Họ và tên</label>
        <input type="text" name="hovaten" value="<?php echo $_SESSION['hovaten'] ?>">

        <label for="diachi"><i class='bx bxs-home'></i>Địa chỉ</label>
        <input type="text" name="diachi" value="<?php echo $_SESSION['diachi'] ?>">

        <label for="sodienthoai"><i class='bx bxs-phone'></i>Số điện thoại</label>
        <input type="text" name="sodienthoai" value="<?php echo $_SESSION['sodienthoai'] ?>">

        <label>Ảnh của bạn</label>
        <img src="<?php echo $_SESSION['anhnguoidung'] ?>" alt="Ảnh đại diện" style="max-width: 100%; margin-bottom: 16px;">

        <label for="anhnguoidung"><i class='bx bxs-palette'></i>Chọn ảnh mới</label>
        <input type="file" name="anhnguoidung">

        <label for="email"><i class='bx bxs-envelope'></i>Email</label>
        <input type="email" name="email" value="<?php echo $_SESSION['email'] ?>">

        <label for="matkhau"><i class='bx bxs-lock-alt'></i>Mật khẩu</label>
        <input type="text" name="matkhau" value="<?php echo $_SESSION['matkhau'] ?>">

        <button type="submit">Cập nhật thông tin</button>
    </form>
</body>

</html>

</html>