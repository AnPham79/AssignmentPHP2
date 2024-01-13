<?php
class ProductModel
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

    public function getAllProducts()
    {
        $sql = "SELECT sanpham.*, danhmuc.ten_danhmuc AS FK_ten_danhmuc, 
                                    xuatxu.noi_xuatxu AS FK_noi_xuatxu
                FROM sanpham 
                JOIN danhmuc ON sanpham.FK_ma_danhmuc = danhmuc.ma_danhmuc 
                JOIN xuatxu ON sanpham.FK_ma_xuatxu = xuatxu.ma_xuatxu";
        return $this->conndb->pdo_query($sql);
    }


    public function viewProduct($ma_sp)
    {
        return $this->conndb->pdo_query_one("SELECT sanpham .*,
        danhmuc.ten_danhmuc AS FK_ten_danhmuc,
        xuatxu.noi_xuatxu AS FK_noi_xuatxu
         FROM sanpham 
         JOIN danhmuc ON sanpham.FK_ma_danhmuc = danhmuc.ma_danhmuc
         JOIN xuatxu ON sanpham.FK_ma_xuatxu = xuatxu.ma_xuatxu
         WHERE ma_sp = ?", $ma_sp);
    }
}
