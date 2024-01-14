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

    <h2>Thông tin sản phẩm</h2>
    <?php if (!empty($order)) { ?>
        <table border="1" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên</th>
                    <th>Ảnh</th>
                    <th>Giá</th>
                    <th>Mô tả</th>
                    <th>Số lượng</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($order as $ma_sp => $product) : ?>
                    <tr>
                        <td><?php echo $ma_sp; ?></td>
                        <td><?php echo $product['ten_sp']; ?></td>
                        <td>
                            <img src="<?php echo $product['anh_sp']; ?>" alt="" style="height: 100px;">
                        </td>
                        <td><?php echo $product['gia_sp']; ?></td>
                        <td><?php echo $product['mota_sp']; ?></td>
                        <td><?php echo $product['soluong']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php } ?>
    <button type="submit"><a href="?action=Payment">Thanh toán ngay</a></button>
</body>

</html>