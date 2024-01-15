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

    public function register($hovaten, $diachi, $sodienthoai, $email, $matkhau)
    {
        if ($this->emailExists($email)) {
            error_log("Email $email đã tồn tại.");

            header("Location: " . APPURL . '?url=user/register&error=Email của bạn vừa đăng kí đã được sử dụng');
            exit();
        }

        return $this->conndb->pdo_execute("INSERT INTO taikhoan (hovaten,diachi, sodienthoai, email, matkhau) 
        VALUES (?, ?, ?, ?, ?)", $hovaten, $diachi, $sodienthoai, $email, $matkhau);
    }

    public function updatePass($matkhau, $ma_tk)
    {
        $sql = "UPDATE taikhoan
            SET matkhau = ?
            WHERE ma_tk = ?";

        $params = [$matkhau, $ma_tk];

        return $this->conndb->pdo_execute($sql, ...$params);
    }

    public function getAllOrder($ma_tk)
    {
        $sql = "SELECT * FROM donhang WHERE FK_ma_taikhoan = $ma_tk";

        return $this->conndb->pdo_query($sql);
    }
}
