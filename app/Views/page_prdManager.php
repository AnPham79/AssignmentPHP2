<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="<?= APPURL ?>css/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?= APPURL ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= APPURL ?>css/cssadmin.css">
</head>

<body>
    <?php
    if (isset($_POST['search'])) {
        $search = $_POST['search'];
    } else {
        $search = '';
    }
    ?>

    <div class="header__admin">
        <div class="header__admin-logo">
            <div class="header__logo">
                <a href="?url=page/index">
                    <i class='bx bxl-unity'></i>
                    <span>PHAMAN</span>
                </a>
            </div>
        </div>
        <div class="header__admin-info">
            <div class="header__admin-info-group--1">
                <div class="header__admin-avt">
                    <img src="<?php echo $_SESSION['anhnguoidung'] ?>" alt="">
                </div>
            </div>
            <div class="header__admin-info-group--2">
                <div class="header__admin-email">
                    <?php
                    if (isset($_SESSION['user']['email'])) {
                        $email = $_SESSION['user']['email'];
                        echo '<b>' . $email . '</b>';
                    }
                    ?>
                </div>
                <div class="header__admin-name">
                    <?php
                    if (isset($_SESSION['user']['hovaten'])) {
                        $hovaten = $_SESSION['user']['hovaten'];
                        echo 'Xin chào ' . $hovaten . ' ' . "<a href='?url=user/logout'>Đăng xuất</a>";
                    } else {
                        echo 'lỗi';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="article__admin">
        <div class="article-list-option--admin">
            <ul>
                <li><a href="?url=product/viewPrdManager">Quản lý sản phẩm</a></li>
                <li><a href="?url=user/ViewUserManager">Quản lý tài khoản</a></li>
                <li><a href="?url=product/ViewCmtManager">Quản lý bình luận</a></li>
                <li><a href="?url=product/getAllOrderAdmin">Quản lý hóa đơn</a></li>
            </ul>
        </div>
        <div class="article-content--option">
            <h1>Sản phẩm</h1>
            <div class="group__option-content">
                <button class="btn-createProduct my-4">
                    <a href="?url=product/createPrd">Thêm sản phẩm</a>
                </button>
                <form id="searchForm" action="?url=product/viewPrdManager&search=<?php echo urlencode($search) ?>" method="POST" class="my-4">
                    <input type="search" name="search" value="<?php echo $search ?>">
                    <button type="submit">Tìm kiếm</button>
                </form>
            </div>
            <table border="1" width="100%">
                <thead>
                    <tr>
                        <td>Mã</td>
                        <td>tên</td>
                        <td>Ảnh</td>
                        <td>Giá</td>
                        <td>Mô tả</td>
                        <td>Lượt xem</td>
                        <td>Sửa</td>
                        <td>Xóa</td>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($listAllPrd) && is_array($listAllPrd)) { ?>
                        <?php foreach ($listAllPrd as $each) { ?>
                            <tr>
                                <td><?= $each['ma_sp'] ?></td>
                                <td>
                                    <?= $each['ten_sp'] ?></a>
                                </td>
                                <td>
                                    <img src="<?= $each['anh_sp'] ?>" alt="" style="height:200px">
                                </td>
                                <td><?= number_format($each['gia_sp']) ?> VND</td>
                                <td><?= $each['FK_ma_danhmuc'] ?></td>
                                <td><?= $each['luotxem'] ?></td>
                                <td>
                                    <a href="?url=product/editPrd/<?= $each['ma_sp'] ?>" class="edit-link">
                                        <i class='bx bxs-edit'></i>
                                        Sửa
                                    </a>
                                </td>

                                <td>
                                    <a href="?url=product/deletePrd/<?= $each['ma_sp'] ?>" class="delete-link">
                                        <i class='bx bx-trash'></i>
                                        Xóa
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="<?php APPURL ?>js/bootstrap.bundle.js"></script>
</body>

</html>