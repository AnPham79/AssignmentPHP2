<div class="container py-5">
    <div class="product-management-container">
        <h1>Đây là trang quản lý bình luận</h1>
        <br>

        <ul>
            <li><a href="?url=page/adminPage">pageAdmin</a></li>
            <li><a href="?url=product/viewPrdManager">Quản lý sản phẩm</a></li>
            <li><a href="?url=user/ViewUserManager">Quản lý tài khoản</a></li>
            <li><a href="?url=product/ViewCmtManager">Quản lý bình luận</a></li>
            <li><a href="?url=product/getAllOrderAdmin">Quản lý hóa đơn</a></li>
        </ul>
        <br>

        <table border="1" width="100%">
            <tr>
                <td>#</td>
                <td>Tên người binh luận</td>
                <td>Ngày bình luận</td>
                <td>Nội dung</td>
                <td>Mã tài khoản</td>
                <td>Mã sản phẩm</td>
            </tr>
            <?php if (isset($result) && is_array($result)) { ?>
                <?php foreach ($result as $each) { ?>
                    <tr>
                        <td><?= $each['ma_binhluan'] ?></td>
                        <td>
                            <?= $each['tennguoibinhluan'] ?></a>
                        </td>
                        <td><?= $each['ngaybinhluan'] ?></td>
                        <td><?= $each['noidungbinhluan'] ?></td>
                        <td><?= $each['FK_ma_taikhoan'] ?></td>
                        <td><?= $each['FK_ma_sp'] ?></td>
                    </tr>
                <?php } ?>
            <?php } ?>
        </table>
    </div>
</div>