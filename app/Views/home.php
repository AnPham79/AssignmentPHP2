<h1>trang chủ</h1>

<ul>
    <?php
    if (isset($_SESSION['user']['hovaten'])) {
        $hovaten = $_SESSION['user']['hovaten'];
        echo 'Xin chào' . " " . $hovaten;
        echo '<a href="?url=user/logout">Đăng xuất</a>';
    } else {
        echo '<li><a href="?url=user/register">Đăng kí</a></li>
              <li><a href="?url=user/login">Đăng nhập</a></li>';
    }
    ?>
</ul>

<ul>
    <li><a href="?url=page/index">
        Trang chủ
    </a></li>
    <li><a href="?url=product/productPage">
        Sản phẩm
    </a></li>
    <li><a href="?url=page/aboutPage">
        Giới thiệu
    </a></li>
    <li><a href="?url=page/contactPage">
        Liên hệ
    </a></li>
</ul>


<p>Thêm một máy bay của Lực lượng Bảo vệ Bờ biển Nhật Bản bị đâm dẫn tới hư hại và không thể hoạt động tại sân bay Haneda ở Tokyo.
Theo thông tin được tờ Straits Times công bố hôm 7/1, vụ việc xảy ra vào ngày 4/1. Các nguồn tin cho biết máy bay của Lực lượng Bảo vệ Bờ biển Nhật Bản đã bị hư hại sau khi bị một phương tiện dưới mặt đất của hãng hàng không Japan Airlines đâm phải.

Vào thời điểm xảy ra tai nạn, máy bay của Lực lượng Bảo vệ Bờ biển Nhật Bản không có người lái, và cũng không có báo cáo thương vong. Bộ Đất đai, Cơ sở hạ tầng, Giao thông và Du lịch Nhật Bản cùng các cơ quan khác đang tiến hành điều tra.

may bay tuan duyen nhat ban.jpg
Nhân viên của Lực lượng Bảo vệ Bờ biển Nhật Bản đánh giá thiệt hại sau khi máy bay LAJ501 bị xe nâng đâm. Ảnh: Japan News
Theo các nguồn tin, vụ việc xảy ra tại sân đỗ của sân bay Haneda vào khoảng 18h (giờ địa phương) ngày 4/1, khi chiếc LAJ501 do hãng Gulfstream Aerospace sản xuất bị xe nâng của hãng hàng không Japan Airlines dùng để bốc hàng không may tông phải, trong lúc máy bay của Lực lượng Bảo vệ Bờ biển Nhật Bản đang đỗ.

Chiếc máy bay của Lực lượng Bảo vệ Bờ biển Nhật Bản khi đó không có lịch bay. Nhưng sau khi bị đâm, một vết nứt ở mép cánh máy bay đã xuất hiện, và LAJ501 không thể bay được. Thiệt hại sau vụ việc vẫn chưa được công bố. Hiện chưa rõ khi nào máy bay có thể tiếp tục hoạt động.

Máy bay LAJ501 được trang bị radar, và hệ thống tìm kiếm hồng ngoại có độ chính xác cao. Nó có khả năng thực hiện các chuyến bay tầm xa giữa Nhật Bản và Mỹ. Lực lượng Bảo vệ Bờ biển Nhật Bản đã triển khai 2 máy bay loại này tại sân bay Haneda kể từ năm 2005.

Đáng nói, vào ngày 2/1 đã xảy ra vụ va chạm chết người giữa máy bay tuần tra hàng hải Dash-8 của Lực lượng Bảo vệ Bờ biển Nhật Bản và máy bay Airbus A350 của hãng hàng không Japan Airlines. Vụ việc đã khiến 5/6 thành viên trên chiếc Dash-8 đã thiệt mạng. May mắn toàn bộ 379 hành khách và phi hành đoàn trên chiếc Airbus A350 đã nhanh chóng sơ tán và thoát hiểm. </p>