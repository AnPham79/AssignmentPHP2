<div class="container pt-5">
    <div class="row">
        <div class="article__product-detail row">
            <div class="article__product-detail-img col-md-4 col-6 p-4">
                <img src="<?= $product['anh_sp'] ?>" alt="">
            </div>
            <div class="article__product-infomation col-md-8 col-6 p-4">
                <div class="article__product-name py-2">
                    <h3><?= $product['ten_sp'] ?></h3>
                </div>
                <div class="article__price-product py-2">
                    <span>Giá sản phẩm : <?= $product['gia_sp'] ?> VND</span>
                </div>
                <div class="article__description-product py-2">
                    <p>
                        <?= $product['mota_sp'] ?>
                    </p>
                </div>
                <div class="article__category-product py-2">
                    <p>Loại sản phẩm: <i><?= $product['FK_ten_danhmuc'] ?></i></p>
                </div>
                <div class="article__origin-product py-2">
                    <p>Nguồn góc: <i><?= $product['FK_noi_xuatxu'] ?></i></p>
                </div>
                <div class="product__Introducing-incentives">
                    <span>Vận chuyển:</span>
                    <div class="Introducing-incentives px-3">
                        <p>Giao hàng nhanh</p>
                        <i class='bx bxs-car'></i>
                    </div>
                    <div class="Introducing-incentives px-3">
                        <p>Phí Vận chuyển cố định chỉ từ 20.000đ ở mọi địa điểm trên cả nước.</p>
                        <i class='bx bx-money-withdraw'></i>
                    </div>
                </div>
                <div class="article__update-quantity--product py-2">
                    <form action="?url=product/AddToCartInPrdDetail/<?php echo $product['ma_sp'] ?>" method="POST">
                        <p>Số lượng</p>
                        <div class="group-update-quntity py-2">
                            <div class="button-update-qantity">
                                <button type="button" onclick="giamsoluong()">-</button>
                            </div>
                            <input type="number" id="soluong" name="soluong" value="1">
                            <div class="button-update-qantity">
                                <button type="button" onclick="tangsoluong()">+</button>
                            </div>
                        </div>
                        <div class="button-addtocart py-3">
                            <button type="submit">Thêm vào giỏ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="comment-form">
        <?php if (isset($_SESSION['hovaten'])) : ?>
            <p class="py-1">Tên người bình luận: <?php echo $_SESSION['hovaten']; ?></p>

            <form action="?url=product/comment" method="POST">
                <input type="hidden" name="ngaybinhluan" value="<?php echo date("Y-m-d H:i:s"); ?>">
                <input type="hidden" name="FK_ma_sp" value="<?php echo $product['ma_sp'] ?>">

                <h5 class="py-3">Nội dung bình luận</h5>
                <textarea name="noidungbinhluan" required></textarea>

                <button type="submit">Đăng bình luận</button>
            </form>
        <?php else : ?>
            <p class="login-message">Người dùng phải đăng nhập để bình luận. <a href="?url=user/login">Đăng nhập</a></p>
        <?php endif; ?>
    </div>

    <?php if ($getCommnet) : ?>
        <?php foreach ($getCommnet as $comment) : ?>
            <div class="comment">
                <h5>Tên người bình luận: <?php echo $comment['tennguoibinhluan']; ?></h5>
                <p>Ngày bình luận: <?php echo $comment['ngaybinhluan']; ?></p>
                <p>Nội dung bình luận: <?php echo $comment['noidungbinhluan']; ?></p>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>Chưa có bình luận nào cho sản phẩm này.</p>
    <?php endif; ?>
</div>

<div class="container">
    <div class="row py-5">
        <h1>Sản phẩm khác</h1>
        <?php foreach ($dsSP as $each) { ?>
            <div class="col-md-3 col-12 py-3">
                <div class="card-product" style="width: 18rem;">
                    <div class="card-product-img">
                        <a href="?url=product/viewProduct/<?= $each['ma_sp'] ?>">
                            <img src="<?php echo $each['anh_sp'] ?>" alt=""></a>
                    </div>
                    <div class="card-product-name">
                        <p><a href="?url=product/viewProduct/<?= $each['ma_sp'] ?>" style="text-decoration:none; color:black;">
                                <?php echo $each['ten_sp'] ?></a>
                        </p>
                    </div>
                    <div class="card-product-price">
                        <p><?php echo number_format($each['gia_sp']) ?> VND</p>
                    </div>
                    <div class="card-product-rating">
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                    </div>
                    <div class="card-product-origin">
                        <p>Xuất xứ : <i><?php echo $each['FK_noi_xuatxu'] ?></i></p>
                    </div>
                    <div class="card-product-addtocart">
                        <button>
                            <i class='bx bx-plus'></i>
                            <a href="?url=product/AddToCart/<?= $each['ma_sp'] ?>">Thêm vào giỏ hàng</a>
                        </button>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<script>
    function giamsoluong() {
        const input = document.getElementById('soluong');
        let value = parseInt(input.value);

        if (value > 1) {
            value--;
            input.value = value;
        }
    }

    function tangsoluong() {
        const input = document.getElementById('soluong');
        let value = parseInt(input.value);

        if (value >= 1 && value < 100) {
            value++;
            input.value = value;
        }
    }
</script>