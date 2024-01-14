<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <header class="bg-dark text-white text-center py-4">
        <h1>Trang chủ</h1>
        <ul class="list-inline">
            <?php
            if (isset($_SESSION['user']['hovaten'])) {
                $hovaten = $_SESSION['user']['hovaten'];
                echo '<li class="list-inline-item">Xin chào ' . $hovaten . '</li>';
                echo '<li class="list-inline-item"><a href="?url=user/logout" class="text-white">Đăng xuất</a></li>';
            } else {
                echo '<li class="list-inline-item"><a href="?url=user/register" class="text-white">Đăng kí</a></li>';
                echo '<li class="list-inline-item"><a href="?url=user/login" class="text-white">Đăng nhập</a></li>';
            }
            ?>
        </ul>
    </header>

    <nav class="navbar navbar-light bg-light">
        <ul class="navbar-nav">
            <li class="nav-item"><a href="?url=page/index" class="nav-link">Trang chủ</a></li>
            <li class="nav-item"><a href="?url=product/productPage" class="nav-link">Sản phẩm</a></li>
            <li class="nav-item"><a href="?url=page/aboutPage" class="nav-link">Giới thiệu</a></li>
            <li class="nav-item"><a href="?url=page/contactPage" class="nav-link">Liên hệ</a></li>
        </ul>
    </nav>

    <div class="jumbotron text-center">
        <h1 class="display-4">Chào mừng bạn đến với trang web</h1>
        <p class="lead">Slogan của bạn có thể được đặt ở đây.</p>
    </div>

    <!-- Thay thế phần này bằng hình ảnh bạn muốn sử dụng -->
    <div class="banner">
        <img src="<?= APPURL ?>/images/banner1.jpg" class="img-fluid" alt="Banner Image">
    </div>

    <!-- Bootstrap JS và Popper.js (cần thiết cho một số tính năng Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
