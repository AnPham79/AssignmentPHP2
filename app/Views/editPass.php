<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thay đổi mật khẩu</title>
    <link rel="stylesheet" href="path/to/your/styles.css">
    <style>
        /* Style cho container chứa form đổi mật khẩu */
        .fullscreen-container {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .center-container {
            text-align: center;
        }

        .change-password-container {
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Style cho tiêu đề h1 */
        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        /* Style cho input và button trong form */
        form {
            display: flex;
            flex-direction: column;
        }

        input {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
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
            background-color: #125682;
        }

        .change-password-container {
            border: 1px solid black;
            border-radius: 20px;
        }
    </style>
</head>

<body>
    <div class="fullscreen-container">
        <div class="center-container">
            <div class="change-password-container">
                <h1>Thay đổi mật khẩu</h1>
                <form action="?url=user/updatePass" method="POST">
                    Mật khẩu hiện tại
                    <br>
                    <?php echo $_SESSION['matkhau'] ?>
                    <br>
                    Mật khẩu mới
                    <br>
                    <input type="text" name="matkhau">
                    <br>
                    <button type="submit">Sửa mật khẩu</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>