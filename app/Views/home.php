<body>
    <div class="banner">
        <div class="container">
            <div class="row py-5">
                <div class="col-md-6 col-12">
                    <span class="py-3">Uy tín - Chất lượng - Giá rẻ</span>
                    <h1 class="py-3">Cùng Khám phá thế giới mô hình tại <b>Phạm An Paradigm</b></h1>
                    <p class="py-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos ea doloremque velit molestias atque dolore dignissimos, rem eligendi? Dolorum quisquam assumenda quos explicabo nemo eveniet autem quod saepe quidem accusantium.
                        Expedita totam animi accusamus sed obcaecati voluptas error exercitationem ex hic incidunt iure facilis consequatur atque sapiente, sint quo commodi saepe placeat, deserunt provident quae voluptatibus! Consequatur, error enim. Impedit.</p>
                    <button class="btn">
                        <a href="?url=product/productPage" style="color:white; text-decoration:none;">
                            Khám phá ngay
                        </a>
                    </button>
                </div>
                <div class="col-md-6 col-12">
                    <img src="./img/banner1.png" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
    <div class="article">
        <div class="article__about-index">
            <div class="container">
                <div class="row py-5">
                    <div class="col-md-6 col-12">
                        <img src="./img/banner2.png" alt="" class="img-fluid">
                    </div>
                    <div class="col-md-6 col-12">
                        <h1 class="py-3">Giới thiệu</h1>
                        <p class="py-3">Được thành lập vào năm 2010, PhamAn paradigm là một thương hiệu Luxembourg chuyên thiết
                            kế và tiếp thị các bức tượng sưu tập cao cấp theo giấy phép chính thức, có các nhân vật đình
                            đám từ thế giới hoạt hình, truyện tranh, điện ảnh và trò chơi điện tử. Trong những năm qua,
                            PhamAn paradigm đã nhận được sự tin tưởng của các giấy phép uy tín nhất trong vũ trụ Văn hóa Đại chúng,
                            như Dragon Ball Z, Naruto, One Piece, My Hero Academia, Fairy Tail, Batman, Harry Potter.
                        </p>
                        <a href="?url=page/aboutPage">Xem thêm<i class='bx bx-right-arrow-alt'></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="article__product-demo--index">
            <div class="container">
                <div class="row py-5">
                    <h1>Sản phẩm nổi bật</h1>
                    <span class="py-3">Trong thế giới mua sắm trực tuyến đầy cạnh tranh, không gì có thể so sánh với sự
                        hứng thú và niềm vui của việc khám phá những sản phẩm nổi bật trên trang web của chúng tôi.
                        Với sự đa dạng và chất lượng hàng đầu, chúng tôi tự hào giới thiệu đến bạn bộ sưu tập sản phẩm nổi bật,
                        nơi mà sự độc đáo và chất lượng hội tụ để mang lại cho bạn trải nghiệm mua sắm tuyệt vời nhất.
                    </span>
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
                    <div class="see-more-product-index my-4">
                        <button class="btn">
                            <a href="?url=product/productPage"><i class='bx bx-right-arrow-alt'></i>Xem thêm</a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="banner-mid-page">
            <img src="./img/banner3.jpg" alt="">
        </div>
    </div>