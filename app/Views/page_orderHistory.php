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
            <strong>Tên sản phẩm:</strong> <?php echo $row['tensanpham']; ?><br>
            <strong>Số lượng:</strong> <?php echo $row['soluong']; ?><br>
            <strong>Tổng tiền:</strong> <?php echo $row['tongtien']; ?><br>
            <strong>Trạng thái:</strong>
            <?php
            $statusMapping = array(
                'chua-xac-nhan' => 'Chưa xác nhận',
                'dang-chuan-bi' => 'Đang chuẩn bị',
                'dang-giao-hang' => 'Đang giao hàng',
                'da-nhan-hang' => 'Đã nhận hàng'
            );

            if ($row['trangthai'] === 'chua-xac-nhan') {
                echo "<span style='color:red;'>{$statusMapping[$row['trangthai']]}</span>";
                echo "<button><a href='?url=product/cancelOrder/{$row['ma_donhang']}'>Hủy đơn</a></button>";
            } elseif ($row['trangthai'] === 'huy-don') {
                echo "<span style='color:red;'>Đã hủy đơn</span>";
            } else {
                echo "<span style='color:green;'>{$statusMapping[$row['trangthai']]}</span>";
            }
            ?>

        </div>
        <hr>
    <?php endforeach; ?>
<?php else : ?>
    <p>Không có lịch sử mua hàng.</p>
<?php endif; ?>