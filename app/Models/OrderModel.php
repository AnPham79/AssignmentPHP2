<?php

class OrderModel {
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
            $sanpham_name .= $product['ten_sp'];
            $sanpham_quantity .=  $product['soluong'];
        }

        if(isset($_SESSION['ma_voucher'])) {
            $ma_voucher = $_SESSION['ma_voucher'] ?? '';
        }

        $sql = "INSERT INTO 
        donhang(tennguoidung, diachinguoidung, sdtnguoidung, emailnguoidung, tensanpham, soluong , tongtien, FK_ma_taikhoan, FK_ma_voucher) 
        VALUES
        ('$tennguoidung', '$diachinguoidung', '$sdtnguoidung', '$emailnguoidung', '$sanpham_name','$sanpham_quantity', '$tongtien', '$FK_ma_taikhoan', '$ma_voucher')";

        $result = $this->conndb->pdo_execute($sql);

        if ($result) {
            unset($_SESSION['cart']);
        }

        return $result;
    }
}