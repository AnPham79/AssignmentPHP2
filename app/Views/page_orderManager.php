<div class="container py-5">
    <div class="product-management-container">
        <h1>Đây là trang quản lí hóa đơn</h1>
        <br>
        <ul>
            <li><a href="?url=page/adminPage">pageAdmin</a></li>
            <li><a href="?url=product/viewPrdManager">Quản lí sản phẩm</a></li>
            <li><a href="?url=user/ViewUserManager">Quản lí tài khoản</a></li>
            <li><a href="?url=product/ViewCmtManager">Quản lí bình luận</a></li>
            <li><a href="?url=product/getAllOrderAdmin">Quản lí hóa đơn</a></li>
        </ul>

        <br>
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