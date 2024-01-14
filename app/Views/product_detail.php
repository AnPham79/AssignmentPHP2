<h1>Đây là trang liên hệ</h1>

<ul>
    <li><a href="?url=page/index">
            Trang chủ
        </a></li>
    <li><a href="?url=product/productPage">
            Sản phẩm
        </a></li>
    <li><a href="?url=page/aboutPage">
            Giới thiệu
        </a></li>
    <li><a href="?url=page/contactPage">
            Liên hệ
        </a></li>
</ul>

<h1><?= $product['ten_sp'] ?></h1>
<img src="<?= $product['anh_sp'] ?>" alt="" style="height:200px">
<p><?= $product['gia_sp'] ?></p>
<p><?= $product['mota_sp'] ?></p>
<p><?= $product['FK_ten_danhmuc'] ?></p>
<p><?= $product['FK_noi_xuatxu'] ?></p>

<form action="?url=product/AddToCartInPrdDetail/<?php echo $product['ma_sp'] ?>" method="POST">
    <h5>Tăng số lượng sản phẩm</h5>
    <button type="button" onclick="giamsoluong()">-</button>
    <input type="number" id="soluong" name="soluong" value="1"> <!-- Giữ nguyên value="1" -->
    <button type="button" onclick="tangsoluong()">+</button>
    <button type="submit">Thêm vào giỏ</button>
</form>

<?php
if (isset($_SESSION['hovaten'])) {
    ?>
    <p>Tên người bình luận: <?php echo $_SESSION['hovaten']; ?></p>
    <p>Thời gian hiện tại là: <?php echo date("Y-m-d H:i:s"); ?></p>

    <form action="?url=product/comment" method="POST">
        <input type="hidden" name="ngaybinhluan" value="<?php echo date("Y-m-d H:i:s"); ?>">
        <input type="hidden" name="FK_ma_sp" value="<?php echo $product['ma_sp'] ?>">

        <h5>Nội dung bình luận</h5>
        <textarea name="noidungbinhluan"></textarea>

        <button type="submit">Đăng bình luận</button>
    </form>
    <?php
} else {
    echo 'Người dùng phải đăng nhập để bình luận';
    echo '<a href="?url=user/login">Đăng nhập</a>';
}
?>

<?php
if ($getCommnet) {
    foreach ($getCommnet as $comment) {
        echo "<p>Tên người bình luận: " . $comment['tennguoibinhluan'] . "</p>";
        echo "<p>Ngày bình luận: " . $comment['ngaybinhluan'] . "</p>";
        echo "<p>Nội dung bình luận: " . $comment['noidungbinhluan'] . "</p>";
    }
} else {
    echo 'Chưa có bình luận nào cho sản phẩm này.';
}
?>

<script>
    function giamsoluong() {
        const input = document.getElementById('soluong');
        let value = parseInt(input.value);

        if (value > 1) { // Sửa điều kiện từ 0 thành 1
            value--;
            input.value = value;
        }
    }

    function tangsoluong() {
        const input = document.getElementById('soluong');
        let value = parseInt(input.value);

        if (value >= 1 && value < 100) { // Sửa điều kiện từ 0 thành 1
            value++;
            input.value = value;
        }
    }
</script>
