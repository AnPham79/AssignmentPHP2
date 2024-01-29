<?php
class UserModel
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

    public function emailExists($email)
    {
        $sql = "SELECT COUNT(*) FROM taikhoan WHERE email = ?";
        $count = $this->conndb->pdo_query_value($sql, $email);
        return $count > 0;
    }

    public function login($email, $matkhau)
    {
        return $this->conndb->pdo_query_one("SELECT * FROM taikhoan 
        WHERE email = ? AND matkhau = ?", $email, $matkhau);
    }

    public function register($hovaten, $diachi, $sodienthoai, $anhnguoidung, $email, $matkhau)
    {
        if ($this->emailExists($email)) {
            error_log("Email $email đã tồn tại.");

            header("Location: " . APPURL . '?url=user/register&error=Email của bạn vừa đăng kí đã được sử dụng');
            exit();
        }

        $target_dir = "imageUser/";
        $target_file = $target_dir . basename($_FILES["anhnguoidung"]["name"]);


        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }

        var_dump($target_file);

        if (move_uploaded_file($_FILES["anhnguoidung"]["tmp_name"], $target_file)) {
            $sql = "INSERT INTO taikhoan (hovaten, diachi, sodienthoai, anhnguoidung, email, matkhau) 
            VALUES ('$hovaten', '$diachi', '$sodienthoai', '$target_file', '$email', '$matkhau')";
            return $this->conndb->pdo_execute($sql);
        } else {
            echo "Có lỗi khi tải lên tệp tin.";
            return false;
        }
    }

    public function updateAccount($anhnguoidung, $hovaten, $diachi, $sodienthoai, $email, $matkhau, $ma_tk)
    {
        $target_dir = "imageUser/";

        if (!empty($anhnguoidung["name"])) {
            $target_file = $target_dir . basename($anhnguoidung["name"]);

            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0755, true);
            }

            if (move_uploaded_file($anhnguoidung["tmp_name"], $target_file)) {
                $sql = "UPDATE taikhoan
                SET matkhau = COALESCE(?, matkhau),
                    hovaten = COALESCE(?, hovaten),
                    diachi = COALESCE(?, diachi),
                    sodienthoai = COALESCE(?, sodienthoai),
                    email = COALESCE(?, email),
                    anhnguoidung = ?
                WHERE ma_tk = ?";
                $params = [$matkhau, $hovaten, $diachi, $sodienthoai, $email, $target_file, $ma_tk];
            } else {
                echo "Có lỗi khi tải lên tệp tin.";
                return false;
            }
        } else {
            $sql = "UPDATE taikhoan
            SET matkhau = COALESCE(?, matkhau),
                hovaten = COALESCE(?, hovaten),
                diachi = COALESCE(?, diachi),
                sodienthoai = COALESCE(?, sodienthoai),
                email = COALESCE(?, email)
            WHERE ma_tk = ?";
            $params = [$matkhau, $hovaten, $diachi, $sodienthoai, $email, $ma_tk];
        }

        return $this->conndb->pdo_execute($sql, ...$params);
    }



    public function getAllOrder($ma_tk)
    {
        $sql = "SELECT * FROM donhang WHERE FK_ma_taikhoan = $ma_tk";

        return $this->conndb->pdo_query($sql);
    }

    // -------------------------- liên hệ -------------------------------------
    public function contact($ten_nguoilienhe, $email_nguoilienhe, $sdt_nguoilienhe, $noidung_lienhe)
    {
        $sql = "INSERT INTO lienhe(ten_nguoilienhe, email_nguoilienhe, sdt_nguoilienhe, noidung_lienhe)
        VALUES ('$ten_nguoilienhe', '$email_nguoilienhe', '$sdt_nguoilienhe', '$noidung_lienhe')";

        $result = $this->conndb->pdo_execute($sql);

        if ($result) {
            $_SESSION['ten_nguoilienhe'] = $ten_nguoilienhe;
            $_SESSION['email_nguoilienhe'] = $email_nguoilienhe;
            $_SESSION['sdt_nguoilienhe'] = $sdt_nguoilienhe;
            $_SESSION['noidung_lienhe'] = $noidung_lienhe;

            // Gửi email nếu cần
            $this->sendMailContact($_SESSION['email_nguoilienhe']);
        }

        return $result;
    }


    // --------------------------- gửi mail khi post thành công liên hệ --------------------
    function sendMailContact($email)
    {
        @require '../PHPMailer-master/src/PHPMailer.php';
        @require '../PHPMailer-master/src/SMTP.php';
        @require '../PHPMailer-master/src/Exception.php';

        // Tạo đối tượng PHPMailer
        @$mail = new PHPMailer\PHPMailer\PHPMailer(true);

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
            $mail->Subject = 'Thư phản hồi liên hệ';

            // Nội dung email
            if (isset($_SESSION['ten_nguoilienhe']) && isset($_SESSION['email_nguoilienhe']) && isset($_SESSION['sdt_nguoilienhe']) && isset($_SESSION['noidung_lienhe'])) {
                @$noidungthu = '<div style="font-family: Arial, sans-serif; color: #333;">
                    <p>Chào bạn,</p>
                    <p>Chúng tôi xin gửi lời cảm ơn chân thành đến bạn vì đã quan tâm đến cửa hàng chúng tôi.</p>
                    <p>Bạn sẽ nhận được phản hồi từ nhân viên cửa hàng sớm nhất để giải đáp thắc mắc của bạn qua thông tin bạn đã cung cấp</p>
            
                    <p>Dưới đây là thông tin bạn đã cung cấp:</p>';

                @$noidungthu .= '<p>Thông tin khách hàng:</p>
                    <ul>
                        <li>Tên khách hàng: ' . $_SESSION['ten_nguoilienhe'] . '</li>
                        <li>email: ' . $_SESSION['email_nguoilienhe'] . '</li>
                        <li>số điện thoại: ' . $_SESSION['sdt_nguoilienhe'] . '</li>
                        <li>Nội dung: ' . $_SESSION['noidung_lienhe'] . '</li>
                    </ul>

                    <ul>
                        <p>Để cảm ơn bạn đã quan tâm đến shop chúng tôi, chúng tôi sẽ tặng bạn Voucher</p>
                        <li>giam20%: nhập vào bạn sẽ giảm đi 20% tổng hóa đơn.</li>
                        <li>giam10%: nhập vào bạn sẽ giảm đi 10% tổng hóa đơn.</li>
                        <li>FREESHIP: nhập vào bạn sẽ được free toàn bộ ship.</li>
                    </ul>
            
                    <p>Cảm ơn bạn đã ủng hộ chúng tôi!</p>
            
                    <p>Trân trọng,<br>Phạm An Paradigm</p>
                </div>';
            }

            @$mail->Body = $noidungthu;

            // Thiết lập kết nối SMTP
            @$mail->smtpConnect(array(
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                    "allow_self_signed" => true
                )
            ));

            // Gửi email
            @$mail->send();

            unset($_SESSION['ten_nguoilienhe']);
            unset($_SESSION['email_nguoilienhe']);
            unset($_SESSION['sdt_nguoilienhe']);
            unset($_SESSION['noidung_lienhe']);

            echo '<script>window.location.href = "index.php";</script>';

            exit();
        } catch (Exception $e) {
            echo 'Mail không gửi được. Lỗi: ', $mail->ErrorInfo;
        }
    }

    // -------------------------- quên mật khẩu ----------------------------------
    public function getPassword($email)
    {
        $sql = "SELECT matkhau FROM taikhoan WHERE email = '$email'";

        $result = $this->conndb->pdo_query($sql);

        if ($result) {
            $_SESSION['email'] = $email;
            $_SESSION['matkhau'] = $result[0]['matkhau'];

            $this->sendPass($_SESSION['email']);
        }

        return $result;
    }

    // ------------------------ gửi mật khẩu về mail -----------------------
    function sendPass($email)
    {
        @require '../PHPMailer-master/src/PHPMailer.php';
        @require '../PHPMailer-master/src/SMTP.php';
        @require '../PHPMailer-master/src/Exception.php';

        // Tạo đối tượng PHPMailer
        @$mail = new PHPMailer\PHPMailer\PHPMailer(true);

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
            $mail->Subject = 'Mật khẩu của bạn đã quên';

            // Nội dung email
            if (isset($_SESSION['email']) && isset($_SESSION['matkhau'])) {
                @$noidungthu = '<div style="font-family: Arial, sans-serif; color: #333;">
                    <p>Chào bạn,</p>';

                @$noidungthu .= '<p>Mật khẩu của bạn là</p>
                    <ul>
                        <li>Mật khẩu: ' . $_SESSION['matkhau'] . '</li>

                        <p>Đừng quên nữa nhé :)))</p>
                    </ul>
            
                    <p>Cảm ơn bạn đã ủng hộ chúng tôi!</p>
            
                    <p>Trân trọng,<br>Phạm An Paradigm</p>
                </div>';
            }

            @$mail->Body = $noidungthu;

            // Thiết lập kết nối SMTP
            @$mail->smtpConnect(array(
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                    "allow_self_signed" => true
                )
            ));

            // Gửi email
            @$mail->send();

            unset($_SESSION['email']);
            unset($_SESSION['matkhau']);

            echo '<script>window.location.href = "?url=user/login";</script>';

            exit();
        } catch (Exception $e) {
            echo 'Mail không gửi được. Lỗi: ', $mail->ErrorInfo;
        }
    }

    // ------------------------ lấy chi tiết sản phẩm ----------------------------
    public function getProductDetailsByOrder($ma_donhang)
    {
        $sql = "SELECT chitietdonhang.soluong_chitiet, sanpham.*, sanpham.ten_sp as FK_ten_sanpham
                FROM chitietdonhang
                JOIN sanpham ON chitietdonhang.FK_ma_sanpham = sanpham.ma_sp
                WHERE FK_ma_donhang = '$ma_donhang'";

        $result = $this->conndb->pdo_query($sql);

        return $result;
    }
}
