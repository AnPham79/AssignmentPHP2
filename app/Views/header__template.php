<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= APPURL ?>css/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?= APPURL ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= APPURL ?>css/product_detail-css.css">
    <link rel="stylesheet" href="<?= APPURL ?>css/product_page.css">
</head>
<?php
$tongsoluong = 0;

if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $soluong) {
        $tongsoluong += $soluong['soluong'];
    }
}

?>
<body>
    <div class="header">
        <div class="header__list">
            <div class="header__logo">
                <a href="?url=page/index">
                    <i class='bx bxl-unity'></i>
                    <span>PHAMAN</span>
                </a>
            </div>
            <div class="header__menu">
                <ul>
                    <li><a href="?url=page/index">Trang chủ</a></li>
                    <li><a href="?url=product/productPage">Sản phẩm</a></li>
                    <li><a href="?url=page/aboutPage">Giới thiệu</a></li>
                    <li><a href="?url=page/contactPage">Liên hệ</a></li>
                </ul>
                
            </div>
            <div class="header__authe">
                <div class="header__authe-icon">
                    <?php
                    if (isset($_SESSION['user']['hovaten'])) {
                        $hovaten = $_SESSION['user']['hovaten'];
                        echo '<li class="list-inline-item">Hi' .' ' . $hovaten . '</li>';
                        echo "<a href='?url=user/ViewProfile'><i class='bx bxs-cog fs-5' style='color:#ffffff' ></i></a>";
                    } else {
                        echo '<a href="?url=user/login">
                        <i class="bx bxs-user fs-4">
                            </i>Đăng nhập</a>';
                    }
                    ?>
                </div>
                <div class="header__cart-item">
                    <a href="?url=page/ViewCart"><i class='bx bxs-shopping-bag-alt fs-4'></i></a>
                    <span><?php echo $tongsoluong; ?></span>
                </div>
            </div>
        </div>
    </div>