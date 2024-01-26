<div class="container py-5">
    <h1>Chi tiết thanh toán</h1>
    <div class="user-info py-2">
        <span>Thông tin người dùng</span>
        <p>Tên người dùng: <?php echo $tennguoidung; ?></p>
        <p>Địa chỉ: <?php echo $diachinguoidung; ?></p>
        <p>Số điện thoại: <?php echo $sdtnguoidung; ?></p>
        <p>Email: <?php echo $emailnguoidung; ?></p>
    </div>

    <?php
        if (isset($_SESSION['voucher_error'])) {
            echo '<div class="error-message" style="color:red;">' . $_SESSION['voucher_error'] . '</div>';
            unset($_SESSION['voucher_error']);
        } elseif (isset($_SESSION['voucher_sussess'])) {
            echo '<div class="error-message" style="color:green;">' . $_SESSION['voucher_sussess'] . '</div>';
            unset($_SESSION['voucher_sussess']);
        }
    ?>
    <div class="discount-code py-2">
        <span>Nhập mã giảm giá</span>
        <form action="?url=voucher/UseVoucher" method="POST">
            <input type="text" name="ten_voucher">
            <button type="submit">Dùng</button>
        </form>
    </div>

    <div class="product-info py-2">
        <span>Thông tin sản phẩm</span>
        <?php if (!empty($orderDetails)) { ?>
            <table border="1" width="100%" class="text-center">
                <thead>
                    <tr>
                        <th>Tên</th>
                        <th>Số lượng</th>
                        <th>Phí vận chuyển</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orderDetails as $index => $item) : ?>
                        <tr>
                            <td><?php echo $item['ten_sp']; ?></td>
                            <td><?php echo $item['soLuong']; ?></td>
                            <td>
                                <?php
                                if (isset($_SESSION['ten_voucher']) && $_SESSION['ten_voucher'] === 'FREESHIP') {
                                    $item['tienship'] == 0;
                                    echo '0';
                                } else {
                                    $phiVanChuyen = $item['tienship'];
                                    echo number_format($item['tienship']);
                                }
                                ?>
                            </td>
                            <td>
                                <?php echo number_format($item['gia_sp']) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php } ?>
    </div>
    <?php
    $thanhToan = $item['tongThanhToan'];
    if (isset($_SESSION['gia_tri']) && isset($_SESSION['ten_voucher']) && $_SESSION['ten_voucher'] !== 'FREESHIP') {
        $giamGia = ($thanhToan * $_SESSION['gia_tri']) / 100;
        $thanhToan -= $giamGia;
        echo 'Tổng tiền:' . ' ' . number_format($thanhToan);
    } else {
        echo 'Tổng tiền:' . ' ' . number_format($thanhToan);
    }
    ?>

    <?php
    $_SESSION['tongtien'] = $thanhToan;
    ?>

    <div class="payment-btn payment-btnn">
        <button><a href="?url=order/Payments">Thanh toán ngay</a></button>
    </div>
</div>