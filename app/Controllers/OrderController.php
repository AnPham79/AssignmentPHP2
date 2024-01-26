<?php

class OrderController extends CoreController
{
    protected $order;
    protected $params = [];

    public function __construct()
    {
        $this->order = $this->createModel('order');
    }

    // ------------------------ Thanh toán --------------------------
    public function checkOut()
    {
        if (!isset($_SESSION['hovaten']) && !isset($_SESSION['email'])) {
            header('location:?url=user/login');
            exit();
        }

        $tennguoidung = $_SESSION['hovaten'] ?? '';
        $diachinguoidung = $_SESSION['diachi'] ?? '';
        $sdtnguoidung = $_SESSION['sodienthoai'] ?? '';
        $emailnguoidung = $_SESSION['email'] ?? '';

        $products = $_SESSION['cart'] ?? [];

        $tongSoLuong = 0;
        $tongTien = 0;

        $orderDetails = [];

        if (!empty($products)) {
            foreach ($products as $ma_sp => $product) {
                $ten_sp = $product['ten_sp'] ?? '';
                $gia_sp = $product['gia_sp'] ?? 0;
                $soLuong = $product['soluong'] ?? 0;

                $tongSoLuong += $soLuong;

                $thanhTien = @($gia_sp * $soLuong);
                $tongTien += $thanhTien;

                if(isset($_SESSION['ten_voucher']) && $_SESSION['ten_voucher'] === 'FREESHIP') {
                    $tienship = 0;
                } else {
                    $tienship = 30000;
                }
                
                $tongTien += $tienship;                

                $orderDetails[] = [
                    'ten_sp' => $ten_sp,
                    'gia_sp' => $gia_sp,
                    'tienship' => $tienship,
                    'soLuong' => $soLuong,
                    'tongThanhToan' => $tongTien,
                ];
            }
        }

        $data['tennguoidung'] = $tennguoidung;
        $data['diachinguoidung'] = $diachinguoidung;
        $data['sdtnguoidung'] = $sdtnguoidung;
        $data['emailnguoidung'] = $emailnguoidung;
        $data['order'] = $products;
        $data['orderDetails'] = $orderDetails;

        $this->renderView('page_order', $data);
    }


    // ----------------------------- payments -----------------------------
    public function Payments()
    {
        $result = $this->order->Payments(
            $_SESSION['hovaten'],
            $_SESSION['diachi'],
            $_SESSION['sodienthoai'],
            $_SESSION['email'],
            $_SESSION['tongtien'],
            $_SESSION['ma_tk'],
        );
        if ($result === true) {
            var_dump($result);
            header("Location: " . APPURL . '?url=page/index');
        }
    }
}
