<?php
class VoucherModel
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

    public function VoucherAxist($ten_voucher)
    {
        $sql = "SELECT COUNT(*) FROM voucher WHERE ten_voucher = ?";
        $count = $this->conndb->pdo_query_value($sql, $ten_voucher);
        return $count > 0;
    }

    public function UseVoucher($ten_voucher)
    {
        if ($this->VoucherAxist($ten_voucher)) {
            $result = $this->conndb->pdo_query_one("SELECT solansudung, ngayketthuc , giatri, ma_voucher
            FROM voucher 
            WHERE 
            ten_voucher = ?", $ten_voucher);

            $ma_voucher = $result['ma_voucher'];
            $giatri = $result['giatri'];
            $ngayGioHienTai = date("Y-m-d H:i:s");
            $solansudung = $result['solansudung'];
            $ngayketthuc = $result['ngayketthuc'];

            if ($solansudung <= 0 || $ngayGioHienTai > $ngayketthuc) {
                return false;
            }

            $this->conndb->pdo_execute("UPDATE voucher SET solansudung = solansudung - 1 WHERE ten_voucher = ?", $ten_voucher);

            $_SESSION['ten_voucher'] = $ten_voucher;

            $_SESSION['gia_tri'] = $giatri;

            $_SESSION['ma_voucher'] = $ma_voucher;

            return $result;
        }

        return false;
    }
}
