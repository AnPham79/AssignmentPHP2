<?php

class VoucherController extends OrderController
{
    protected $voucher;
    protected $params = [];

    public function __construct()
    {
        $this->voucher = $this->createModel('voucher');
    }

    // ------------------------ sử dụng voucher --------------------------------
    public function UseVoucher()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ten_voucher = $_POST['ten_voucher'];

            $result = $this->voucher->UseVoucher($ten_voucher);

            if ($result) {
                // var_dump($result);
                header("Location: " . APPURL . '?url=order/checkOut');
                // var_dump($_SESSION);
            } else {
                error_log("Mã $ten_voucher không tồn tại hoặc không hợp lệ.");
                header("Location: " . APPURL . '?url=order/checkOut');
                exit();
            }
        }
    }
}
