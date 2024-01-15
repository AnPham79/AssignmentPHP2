<h1>Lịch sử mua hàng</h1>

<br>
<a href="?url=page/index" class="nav-link">Trang chủ</a>
<br>
<h5>Xin chào : <?php echo $_SESSION['hovaten'] ?></h5>

<?php if (!empty($orderHistory)) : ?>
    <ul>
        <?php foreach ($orderHistory as $row) : ?>
            <li>
                <strong>Mã đơn hàng:</strong> <?php echo $row['ma_donhang']; ?><br>
                <strong>Tên người dùng:</strong> <?php echo $row['tennguoidung']; ?><br>
                <strong>Địa chỉ:</strong> <?php echo $row['diachinguoidung']; ?><br>
                <strong>Số điện thoại:</strong> <?php echo $row['sdtnguoidung']; ?><br>
                <strong>Email:</strong> <?php echo $row['emailnguoidung']; ?><br>
                <strong>Tên sản phẩm:</strong> <?php echo $row['tensanpham']; ?><br>
                <strong>Số lượng:</strong> <?php echo $row['soluong']; ?><br>
                <strong>Tổng tiền:</strong> <?php echo $row['tongtien']; ?><br>
                <strong>Trạng thái:</strong> 
                <?php $displayStatus = ($row['trangthai'] === 'chua-xac-nhan') ? 'Chưa xác nhận' : $row['trangthai']; ?>
                <?php if ($row['trangthai'] === 'chua-xac-nhan') : ?>
                    <span style="color: red;"><?php echo $displayStatus; ?></span><br>
                    <form action="">
                        <button><a href="">Hủy đơn</a></button>
                    </form>
                <?php else : ?>
                    <?php echo $row['trangthai']; ?><br>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else : ?>
    <p>Không có lịch sử mua hàng.</p>
<?php endif; ?>