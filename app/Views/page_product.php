<?php
if (isset($_POST['search'])) {
    $search = $_POST['search'];
} else {
    $search = '';
}
?>
<div class="container my-5">
    <div class="row">
        <div class="article__category col-md-3">
            <div class="category-title">
                <i class='bx bx-list-ul'></i>
                <h5>Danh mục sản phẩm</h5>
            </div>
            <hr>
            <ul class="category-list">
                <li><i class='bx bx-chevron-right'></i><a href="?url=product/productPage">Tất cả mô hình</a></li>
                <li><i class='bx bx-chevron-right'></i><a href="?url=product/selectCategory/1">Mô hình One Piece</a></li>
                <li><i class='bx bx-chevron-right'></i><a href="?url=product/selectCategory/2">Mô hình Naruto</a></li>
                <li><i class='bx bx-chevron-right'></i><a href="?url=product/selectCategory/3">Mô hình Liên Minh</a></li>
            </ul>
        </div>
        <div class="article__list-product ps-5 col-md-9">
            <div class="row">
                <form class="searchForm" action="?url=product/productPage&search=<?php echo ($search) ?>" method="POST">
                    <input type="search" name="search" value="<?php echo $search ?>" placeholder="Nhập tìm kiếm của bạn">
                    <button type="submit">Tìm kiếm</button>
                </form>
                <?php if (isset($listProducts) && is_array($listProducts)) { ?>
                    <?php foreach ($listProducts as $each) { ?>
                        <div class="col-4 mb-4">
                            <div class="card-product" style="width: 18rem;">
                                <div class="card-product-img">
                                    <a href="?url=product/viewProduct/<?= $each['ma_sp'] ?>">
                                        <img src="<?php echo $each['anh_sp'] ?>" alt="">
                                    </a>
                                </div>
                                <div class="card-product-name">
                                    <p>
                                        <a href="?url=product/viewProduct/<?= $each['ma_sp'] ?>" style="text-decoration:none; color:black;">
                                            <?php echo $each['ten_sp'] ?>
                                        </a>
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
                <?php } else { ?>
                    <div class="col-12">
                        <p>Không có sản phẩm nào phù hợp với tìm kiếm của bạn.</p>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php echo $paginationOutput; ?>