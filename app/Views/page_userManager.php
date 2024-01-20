<div class="container py-5">
    <div class="product-management-container">
        <h1>Đây là trang quản lý tài khoản</h1>
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
                <td>Tên người dùng</td>
                <td>Số điện thoại</td>
                <td>Địa chỉ</td>
                <td>Email</td>
                <td>Mật khẩu</td>
                <td>Quyền</td>
            </tr>
            <?php if (isset($result) && is_array($result)) { ?>
                <?php foreach ($result as $each) { ?>
                    <tr>
                        <td><?= $each['ma_tk'] ?></td>
                        <td>
                            <?= $each['hovaten'] ?></a>
                        </td>
                        <td><?= $each['sodienthoai'] ?></td>
                        <td><?= $each['diachi'] ?></td>
                        <td><?= $each['email'] ?></td>
                        <td><?= $each['matkhau'] ?></td>
                        <td><?= $each['quyen'] ?></td>
                    </tr>
                <?php } ?>
            <?php } ?>
        </table>
    </div>
</div>