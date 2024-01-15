<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán</title>
</head>

<body>
    <h1>Thông tin thanh toán</h1>

    <h2>Thông tin người dùng</h2>
    <p>Tên người dùng: <?php echo $tennguoidung; ?></p>
    <p>Địa chỉ: <?php echo $diachinguoidung; ?></p>
    <p>Số điện thoại: <?php echo $sdtnguoidung; ?></p>
    <p>Email: <?php echo $emailnguoidung; ?></p>
    <br>
    <h2>Nhập mã giảm giá</h2>
    <br>
    <form action="?url=product/UseVoucher" method="POST">
        <input type="text" name="ten_voucher">
        <button type="submit">Dùng</button>
    </form>

    <h2>Thông tin sản phẩm</h2>
    <?php if (!empty($orderDetails)) { ?>
        <table border="1" width="100%">
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
                            // Nếu có voucher, set giá trị tienship về 0
                            $item['tienship'] = isset($_SESSION['ten_voucher']) ? 0 : $item['tienship'];
                            echo $item['tienship'] . " " . 'VND';
                            ?>
                        </td>
                        <td>
                            <?php
                            // Nếu có voucher, tổng thanh toán giảm tiền ship
                            $item['tongThanhToan'] = isset($_SESSION['ten_voucher']) ? $item['tongThanhToan'] - $item['tienship'] : $item['tongThanhToan'];
                            echo number_format($item['tongThanhToan']) . " " . 'VND';
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php } ?>
    <button type="submit"><a href="?url=product/Payments">Thanh toán ngay</a></button>
</body>

</html>