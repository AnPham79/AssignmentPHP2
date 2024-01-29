<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập tài khoản</title>
    <link rel="icon" href="./path/to/your/logo.png" type="image/png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-image: url(./img/bannerauth.png);
            background-color: #f4f4f4;
        }

        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .form-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            width: 400px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form_login h1 {
            text-align: center;
            color: #333;
        }

        .form_login form {
            display: flex;
            flex-direction: column;
        }

        .form_login label {
            margin-bottom: 8px;
            color: #333;
        }

        .form_login input {
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form_login button {
            padding: 10px;
            background-color: orange;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin: 10px;
        }

        .form_login span {
            display: flex;
            justify-content: center;
        }

        .bx {
            font-size: 20px;
            padding: 5px;
            transform: translateY(1.5px);
        }

        .form_login button a {
            text-decoration: none;
            color: white;
        }

        .form_login button:hover {
            transition: 0.5s;
            opacity: 70%;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <div class="form_login">
                <h1>Quên mật khẩu</h1>
                <form action="?url=user/getPassword" method="POST">
                    <label for="gmail"><i class='bx bxs-user'></i>Nhập email của bạn</label>
                    <input type="email" name="email" placeholder="Nhập email của bạn tại đây." required>
                    <i class="mb-2" style="color: gray;">Mật khẩu của bạn sẽ được gửi lại về email</i>
                    <button>
                        Lấy lại mật khẩu
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>