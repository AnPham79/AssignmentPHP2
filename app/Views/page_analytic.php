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
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #3498db;
            color: white;
        }

        td a {
            text-decoration: none;
            color: #3498db;
            font-weight: bold;
        }

        td a:hover {
            color: #1a5276;
        }

        button {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        select {
            padding: 8px;
        }

        .my-2 {
            margin-top: 5px;
            margin-bottom: 5px;
        }

        span.status {
            color: #e74c3c;
            font-weight: bold;
        }
    </style>
</head>

<body>
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
                <li><a href="?url=product/getAllOrderAdmin">Quản lý hóa đơn và thống kê</a></li>
            </ul>
        </div>
        <div class="article-content--option">
            <h1>Thống kê & Đơn hàng</h1>
            <div class="analytics py-5">
                <div class="analytics__total-order">
                    <div class="analytics__total-order--icon">
                        <i class='bx bxs-package' style="color: red;"></i>
                    </div>
                    <div class="analytics__total-order-quantity">
                        <b><?php echo $totalquantity[0]['total_quantity']; ?></b>
                        <p>Đơn hàng</p>
                    </div>
                </div>
                <div class="analyrics__product-buy-the--most">
                    <div class="analyrics__product-buy-the--most--icon">
                        <i class='bx bx-trending-up' style="color: green;"></i>
                    </div>
                    <div class="analyrics__product-buy-the--most-quantity">
                        <b><?php echo $maxQuantityProduct[0]['tensanpham']; ?></b>
                        <p><?php echo $maxQuantityProduct[0]['soluong']; ?> Sản phẩm</p>
                    </div>
                </div>
                <div class="analytics__revenue">
                    <div class="analytics__revenue-icon">
                        <i class='bx bx-money' style="color: rgb(41, 41, 255);"></i>
                    </div>
                    <div class="analytics__revenue-quantity">
                        <b><?php echo number_format($totalPrice[0]['total_price']) ?></b>
                        <p>Tổng doanh thu</p>
                    </div>
                </div>
                <div class="analytics__quantity-product">
                    <div class="analytics__quantity-product--icon">
                        <i class='bx bxs-circle-three-quarter' style="color: #ffc107;"></i>
                    </div>
                    <div class="analytics__quantity-product-quantity">
                        <b><?php echo $totalproduct[0]['total_quantity_product']; ?></b>
                        <p>Sản phẩm được mua</p>
                    </div>
                </div>
            </div>
            <div class="analytics__achive pt-4">
                <b>Sản phẩm có số lượng lớn nhất: <?php echo $maxQuantityProduct[0]['tensanpham']; ?></b>
                <b>Số lượng: <?php echo $maxQuantityProduct[0]['soluong']; ?></b>
                <b>Sản phẩm có số lượng ít nhất: <?php echo $minQuantityProduct[0]['tensanpham']; ?></b>
                <b>Số lượng: <?php echo $minQuantityProduct[0]['soluong']; ?></b>
            </div>
            <table border="1" width="100%">
                <tr>
                    <td>#</td>
                    <td>Tên người dùng</td>
                    <td>Địa chỉ</td>
                    <td>SĐT</td>
                    <td>Email</td>
                    <td>Tên sản phẩm</td>
                    <td>Số lượng</td>
                    <td>Tổng tiền</td>
                    <td>Trạng thái</td>
                </tr>
                <?php if (isset($orderList) && is_array($orderList)) { ?>
                    <?php foreach ($orderList as $each) { ?>
                        <tr>
                            <td><?= $each['ma_donhang'] ?></td>
                            <td><?= $each['tennguoidung'] ?></a></td>
                            <td><?= $each['diachinguoidung'] ?></a></td>
                            <td><?= $each['sdtnguoidung'] ?></a></td>
                            <td><?= $each['emailnguoidung'] ?></a></td>
                            <td><?= $each['tensanpham'] ?></a></td>
                            <td><?= $each['soluong'] ?></a></td>
                            <td><?= number_format($each['tongtien']) ?></a></td>
                            <td>
                                <?php if ($each['trangthai'] === 'huy-don') { ?>
                                    <span style="color: red;"><?= $each['trangthai'] ?></span>
                                <?php } else { ?>
                                    <?= $each['trangthai'] ?>
                                    <form method="POST" action="?url=product/changeStatus">
                                        <input type="hidden" name="ma_donhang" value="<?= $each['ma_donhang'] ?>">
                                        <select name="trangthai">
                                            <option value="chua-xac-nhan">Chưa xác nhận</option>
                                            <option value="dang-chuan-bi">Đang chuẩn bị</option>
                                            <option value="dang-giao-hang">Đang giao hàng</option>
                                            <option value="da-nhan-hang">Đã nhận hàng</option>
                                        </select>
                                        <button class="my-2" type="submit">Cập nhật trạng thái</button>
                                    </form>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </table>
        </div>
    </div>
    <script src="<?php APPURL ?>js/bootstrap.bundle.js"></script>
</body>

</html>