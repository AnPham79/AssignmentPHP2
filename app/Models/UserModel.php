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

    // -------------------------- lấy tất cả tài khoản ---------------------------------
    public function ViewUserManager()
    {
        $sql = "SELECT * FROM taikhoan";

        return $this->conndb->pdo_query($sql);
    }
}
