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