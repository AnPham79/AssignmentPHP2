<style>
    .article-feedback {
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        margin: 10px 10px;
        width: 26rem;
    }

    .article__feedback-icon i {
        font-size: 36px;
    }

    .article__feedback-user {
        font-size: 20px;
        font-weight: bold;
    }

    .article__feedback-date i {
        color: gray;
    }
</style>

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
        <div class="article__product-demo--index">
            <div class="container">
                <div class="row py-5">
                    <h1>Sản phẩm xem nhiều</h1>
                    <span class="py-3">Trong thế giới mua sắm trực tuyến đầy cạnh tranh, không gì có thể so sánh với sự
                        hứng thú và niềm vui của việc khám phá những sản phẩm nổi bật trên trang web của chúng tôi.
                        Với sự đa dạng và chất lượng hàng đầu, chúng tôi tự hào giới thiệu đến bạn bộ sưu tập sản phẩm nổi bật,
                        nơi mà sự độc đáo và chất lượng hội tụ để mang lại cho bạn trải nghiệm mua sắm tuyệt vời nhất.
                    </span>
                    <?php foreach ($dsSP2 as $each) { ?>
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
        <div class="container">
            <h1 class="text-center py-2">Mọi người nói gì về chúng tôi</h1>
            <div class="row py-5">
                <div class="article-feedback col-3">
                    <div class="article__feedback-card">
                        <div class="article__feedback-icon py-2">
                            <i class='bx bxs-quote-alt-right'></i>
                        </div>
                        <div class="article__feedback-user py-2">
                            Phạm Ngọc Bảo An
                        </div>
                    </div>
                    <div class="article__feedback-date py-2">
                        <i>26/01/2024</i>
                    </div>
                    <div class="article__feedback-content py-2">
                        <p>
                            Chúng tôi rất hài lòng với sản phẩm mô hình từ cửa hàng của bạn! Mọi thứ đều hoạt động tốt, từ chất lượng đến thiết kế.
                            Sự chăm sóc và chi tiết trong sản phẩm khiến chúng tôi cảm thấy hết sức hạnh phúc.
                            Chúng tôi không thể tin nổi rằng mình đã tìm thấy một cửa hàng với sản phẩm chất lượng như vậy.
                            Chắc chắn sẽ quay lại và giới thiệu cho bạn bè!
                        </p>
                    </div>
                </div>
                <div class="article-feedback col-3">
                    <div class="article__feedback-card">
                        <div class="article__feedback-icon py-2">
                            <i class='bx bxs-quote-alt-right'></i>
                        </div>
                        <div class="article__feedback-user py-2">
                            Nhật Hiếu
                        </div>
                    </div>
                    <div class="article__feedback-date py-2">
                        <i>26/12/2023</i>
                    </div>
                    <div class="article__feedback-content py-2">
                        <p>
                            Sản phẩm mô hình của bạn có những điểm tích cực, nhưng cũng cần một số cải thiện.
                            Chất lượng là tốt, nhưng có vẻ thiếu một số chi tiết quan trọng. Nếu có thể tăng cường độ chân thực và tinh tế,
                            chúng tôi tin rằng sản phẩm sẽ trở nên hoàn hảo hơn. Hơn nữa,
                            dịch vụ khách hàng cũng có thể được cải thiện để đảm bảo rằng mọi khách hàng đều có trải nghiệm tích cực.
                        </p>
                    </div>
                </div>
                <div class="article-feedback col-3">
                    <div class="article__feedback-card">
                        <div class="article__feedback-icon py-2">
                            <i class='bx bxs-quote-alt-right'></i>
                        </div>
                        <div class="article__feedback-user py-2">
                            Nguyễn Thiên
                        </div>
                    </div>
                    <div class="article__feedback-date py-2">
                        <i>23/02/2023</i>
                    </div>
                    <div class="article__feedback-content py-2">
                        <p>
                            Sản phẩm mô hình từ cửa hàng của bạn thực sự là một tác phẩm nghệ thuật! Chúng tôi không chỉ mua sản phẩm,
                            mà chúng tôi còn đầu tư vào một trải nghiệm thú vị và độc đáo.
                            Từ sự sáng tạo trong thiết kế đến việc sử dụng các yếu tố nghệ thuật độc đáo,
                            húng tôi cảm thấy như mình đang sở hữu một tác phẩm nghệ thuật thực sự.
                            Sự độc đáo này làm cho cửa hàng của bạn nổi bật và đáng để khám phá.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>