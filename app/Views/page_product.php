<h1>Đây là trang sản phẩm</h1>

<ul>
    <li><a href="?url=page/index">Trang chủ</a></li>
    <li><a href="?url=product/productPage">Sản phẩm</a></li>
    <li><a href="?url=page/aboutPage">Giới thiệu</a></li>
    <li><a href="?url=page/contactPage">Liên hệ</a></li>
</ul>

<table border="1" width="100%">
    <tr>
        <td>#</td>
        <td>Tên sản phẩm</td>
        <td>Ảnh sản phẩm</td>
        <td>Giá sản phẩm</td>
        <td>Danh mục</td>
        <td>Xuất sứ</td>
    </tr>
    <?php if(isset($listProducts) && is_array($listProducts)) { ?>
        <?php foreach ($listProducts as $each) { ?>
            <tr>
                <td><?=$each['ma_sp']?></td>
                <td>
                    <a href="?url=product/viewProduct/<?=$each['ma_sp']?>"><?=$each['ten_sp']?></a>
                </td>
                <td>
                    <a href="?url=product/viewProduct/<?=$each['ma_sp']?>">
                    <img src="<?=$each['anh_sp']?>" alt="" style="height:200px">
                </td>
                <td><?=$each['gia_sp']?></td>
                <td><?=$each['FK_ten_danhmuc']?></td>
                <td><?=$each['FK_noi_xuatxu']?></td>
            </tr>
        <?php } ?>
    <?php } else { ?>
        <tr>
            <td colspan="7">Không có sản phẩm nào.</td>
        </tr>
    <?php } ?>
</table>


