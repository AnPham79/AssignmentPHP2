<?php

class OrderModel
{
    protected $conndb;

    public function __construct()
    {
        $this->conndb = new Database();
    }

    public function __destruct()
    {
        unset($this->conndb);
    }

    public function Payments($tennguoidung, $diachinguoidung, $sdtnguoidung, $emailnguoidung, $tongtien, $FK_ma_taikhoan)
    {
        $products = $_SESSION['cart'] ?? [];

        $sanpham_name = '';
        $sanpham_quantity = '';
        foreach ($products as $ma_sp => $product) {
            $sanpham_name .= $product['ten_sp'] . ' ' . ',';
            $sanpham_quantity .=  $product['soluong'] . ' ' . ',';
        }

        $ma_voucher = isset($_SESSION['ma_voucher']) ? $_SESSION['ma_voucher'] : 5;

        $sql = "INSERT INTO 
        donhang(tennguoidung, diachinguoidung, sdtnguoidung, emailnguoidung, tensanpham, soluong , tongtien, FK_ma_taikhoan, FK_ma_voucher) 
        VALUES
        ('$tennguoidung', '$diachinguoidung', '$sdtnguoidung', '$emailnguoidung', '$sanpham_name','$sanpham_quantity', '$tongtien', '$FK_ma_taikhoan', '$ma_voucher')";

        $result = $this->conndb->pdo_execute($sql);

        if ($result) {
            $id_donhang = $this->conndb->pdo_query_value("SELECT ma_donhang FROM donhang");

            foreach ($products as $ma_sp => $product) {
                $soluong_chitiet = $product['soluong'];
                $FK_ma_sanpham = $ma_sp;

                $sql_chitietdonhang = "INSERT INTO chitietdonhang(FK_ma_donhang, FK_ma_sanpham, soluong_chitiet) 
                                       VALUES ('$id_donhang', '$FK_ma_sanpham', '$soluong_chitiet')";

                $result_chitietdonhang = $this->conndb->pdo_execute($sql_chitietdonhang);
            }

            $this->sendMail($_SESSION['email']);

            return $result;
        }
    }

    // -------------------------- gửi mail ------------------------------------
    function sendMail($email)
    {
        require '../PHPMailer-master/src/PHPMailer.php';
        require '../PHPMailer-master/src/SMTP.php';
        require '../PHPMailer-master/src/Exception.php';

        // Tạo đối tượng PHPMailer
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);

        try {
            $mail->SMTPDebug = 2;
            $mail->isSMTP();
            $mail->CharSet = "utf-8";
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'phamngocbaoan792004@gmail.com'; // Thay bằng email của bạn
            $mail->Password = 'rldfqcifrfswdmrr'; // Thay bằng mật khẩu của bạn
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            // Thiết lập thông tin gửi và nhận
            $mail->setFrom('phamngocbaoan792004@gmail.com', 'Admin Phạm An Paradigm'); // Thay bằng thông tin của bạn
            $mail->addAddress($email);

            $mail->isHTML(true);

            // Thiết lập chủ đề của email
            $mail->Subject = 'Hóa đơn thanh toán sản phẩm mua hàng của bạn';

            // Nội dung email
            if (isset($_SESSION['hovaten']) && isset($_SESSION['sodienthoai']) && isset($_SESSION['diachi']) && isset($_SESSION['email'])) {
                $noidungthu = '<div style="font-family: Arial, sans-serif; color: #333;">
                    <p>Chào bạn,</p>
                    <p>Chúng tôi xin gửi lời cảm ơn chân thành đến bạn vì đã mua hàng tại cửa hàng chúng tôi.</p>
                    <p>Chúng tôi rất trân trọng sự ủng hộ và tin tưởng của bạn trong việc lựa chọn sản phẩm của chúng tôi.</p>
            
                    <p>Dưới đây là thông tin đơn hàng của bạn:</p>';
            
                foreach ($_SESSION['cart'] as $product) {
                    $noidungthu .= '<p>Tên sản phẩm: ' . $product['ten_sp'] . '</p>';
                    $noidungthu .= '<p>Số lượng: ' . $product['soluong'] . '</p>';
                    $noidungthu .= '<p>Giá sản phẩm: ' . number_format($product['gia_sp']) . ' VND</p>';

                }
            
                $noidungthu .= '<p>Thông tin khách hàng:</p>
                    <ul>
                        <li>Tên khách hàng: ' . $_SESSION['hovaten'] . '</li>
                        <li>Địa chỉ: ' . $_SESSION['diachi'] . '</li>
                        <li>Email: ' . $_SESSION['email'] . '</li>
                        <li>Số điện thoại: ' . $_SESSION['sodienthoai'] . '</li>
                    </ul>
            
                    <p>Cảm ơn bạn đã ủng hộ chúng tôi!</p>
            
                    <p>Trân trọng,<br>Phạm An Paradigm</p>
                </div>';
            }
            
            $mail->Body = $noidungthu;

            // Thiết lập kết nối SMTP
            $mail->smtpConnect(array(
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                    "allow_self_signed" => true
                )
            ));

            // Gửi email
            $mail->send();

            unset($_SESSION['cart']);
            unset($_SESSION['voucher']);
            unset($_SESSION['ten_voucher']);
            unset($_SESSION['gia_tri']);
            unset($_SESSION['ma_voucher']);

            echo '<script>window.location.href = "index.php";</script>';
            
            exit();
        } catch (Exception $e) {
            echo 'Mail không gửi được. Lỗi: ', $mail->ErrorInfo;
        }
    }
}
