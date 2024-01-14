<h1>Đây là trang sản phẩm</h1>

<ul>
    <li><a href="?url=page/index">Trang chủ</a></li>
    <li><a href="?url=product/productPage">Sản phẩm</a></li>
    <li><a href="?url=page/aboutPage">Giới thiệu</a></li>
    <li><a href="?url=page/contactPage">Liên hệ</a></li>
</ul>

<?php
if (isset($_POST['search'])) {
    $search = $_POST['search'];
} else {
    $search = '';
}
?>
<br>
<ul>
    <li><a href="?url=product/selectCategory/1">Mô hình One Piece</a></li>
    <li><a href="?url=product/selectCategory/2">Mô hình Naruto</a></li>
</ul>
<br>
<form id="searchForm" action="?url=product/productPage&search=<?php echo ($search) ?>" method="POST">
    <input type="search" name="search" value="<?php echo $search ?>">
    <button type="submit">Tìm kiếm</button>
</form>

<table border="1" width="100%">
    <tr>
        <td>#</td>
        <td>Tên sản phẩm</td>
        <td>Ảnh sản phẩm</td>
        <td>Giá sản phẩm</td>
        <td>Danh mục</td>
        <td>Xuất sứ</td>
        <td>Thêm vào giỏ</td>
    </tr>
    <?php if (isset($listProducts) && is_array($listProducts)) { ?>
        <?php foreach ($listProducts as $each) { ?>
            <tr>
                <td><?= $each['ma_sp'] ?></td>
                <td>
                    <a href="?url=product/viewProduct/<?= $each['ma_sp'] ?>"><?= $each['ten_sp'] ?></a>
                </td>
                <td>
                    <a href="?url=product/viewProduct/<?= $each['ma_sp'] ?>">
                        <img src="<?= $each['anh_sp'] ?>" alt="" style="height:200px">
                </td>
                <td><?= $each['gia_sp'] ?></td>
                <td><?= $each['FK_ten_danhmuc'] ?></td>
                <td><?= $each['FK_noi_xuatxu'] ?></td>
                <td>
                    <a href="?url=product/AddToCart/<?= $each['ma_sp'] ?>">
                    Thêm vào giỏ hàng</a>
                </td>
            </tr>
        <?php } ?>
    <?php } else { ?>
        <tr>
            <td colspan="7">Không có sản phẩm nào.</td>
        </tr>
    <?php } ?>
</table>