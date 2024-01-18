<?php
$cart = $_SESSION['cart'] ?? [];

if (isset($_GET['ma_sp'])) {
    $ma_sp = $_GET['ma_sp'];
    if (isset($cart[$ma_sp])) {
        $cart[$ma_sp]['soluong']++;
    }
    $_SESSION['cart'] = $cart;
}
?>

<?php if (!empty($cart)) : ?>
    <div class="container">
        <div class="row" style="padding-top: 30px;">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <strong>Giỏ hàng</strong>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <td>Tên</td>
                                <td>Ảnh</td>
                                <td>Giá</td>
                                <td>Số lượng</td>
                                <td>Tăng số lượng</td>
                                <td>Giảm số lượng</td>
                                <td>Xóa sản phẩm</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cart as $ma_sp => $each) : ?>
                                <tr>
                                    <td><?php echo $each['ten_sp'] ?></td>
                                    <td>
                                        <img src="<?php echo $each['anh_sp'] ?>" alt="" style="height:200px">
                                    </td>
                                    <td><?php echo number_format($each['gia_sp']) ?></td>
                                    <td><?php echo $each['soluong'] ?></td>
                                    <td>
                                        <a href="?url=product/UpdateQuantity/<?php echo $ma_sp ?>&type=incre">+</a>
                                    </td>
                                    <td>
                                        <a href="?url=product/UpdateQuantity/<?php echo $ma_sp ?>&type=decre">-</a>
                                    </td>
                                    <td>
                                        <a href="?url=product/DeleteCart/<?php echo $ma_sp ?>">Xóa</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <strong>Hóa đơn</strong>
                    </div>
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-6">
                                <?php
                                $tongtien = 0;

                                foreach ($cart as $each) {
                                    $tongtien += @($each['gia_sp'] * $each['soluong']);
                                }

                                $_SESSION['tongtien'] = $tongtien;
                                $_SESSION['soluong'] = count($cart);
                                ?>
                                <strong>Tổng tiền</strong>
                            </div>
                            <div class="col-6 text-end">
                                <strong><?php echo number_format($tongtien) ?> VND</strong>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="margin-top: 20px;">
                    <a href="?url=product/checkOut" style="color: white; text-decoration:none;">Thanh toán sản phẩm</a>
                </button>
            </div>
        </div>
    </div>
<?php else : ?>
    <div style="text-align: center;">
        <img src="./img/cart-empty.jpg" alt="">
    </div>
<?php endif; ?>