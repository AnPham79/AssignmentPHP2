<div class="container py-5">
    <div class="product-management-container">
        <h1>Đây là trang quản lý sản phẩm</h1>
        <br>

        <ul>
            <li><a href="?url=page/adminPage">pageAdmin</a></li>
            <li><a href="?url=product/viewPrdManager">Quản lý sản phẩm</a></li>
            <li><a href="?url=user/ViewUserManager">Quản lý tài khoản</a></li>
            <li><a href="?url=product/ViewCmtManager">Quản lý bình luận</a></li>
            <li><a href="?url=product/getAllOrderAdmin">Quản lý hóa đơn</a></li>
        </ul>
        <br>

        <a href="?url=product/createPrd">Thêm sản phẩm</a>
        <br>

        <?php
        if (isset($_POST['search'])) {
            $search = $_POST['search'];
        } else {
            $search = '';
        }
        ?>

        <form id="searchForm" action="?url=product/viewPrdManager&search=<?php echo urlencode($search) ?>" method="POST">
            <input type="search" name="search" value="<?php echo $search ?>">
            <button type="submit">Tìm kiếm</button>
        </form>
        <br>

        <table border="1" width="100%">
            <tr>
                <td>#</td>
                <td>Tên sản phẩm</td>
                <td>Ảnh sản phẩm</td>
                <td>Giá sản phẩm</td>
                <td>Danh mục</td>
                <td>Xuất sứ</td>
                <td>Sửa</td>
                <td>Xóa</td>
            </tr>
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
                        <td><?= $each['gia_sp'] ?></td>
                        <td><?= $each['FK_ten_danhmuc'] ?></td>
                        <td><?= $each['FK_noi_xuatxu'] ?></td>
                        <td>
                            <a href="?url=product/editPrd/<?= $each['ma_sp'] ?>">
                                Sửa
                            </a>
                        </td>
                        <td>
                            <a href="?url=product/deletePrd/<?= $each['ma_sp'] ?>">
                                Xóa
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            <?php } ?>
        </table>
    </div>
</div>