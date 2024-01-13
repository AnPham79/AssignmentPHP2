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
}
