<?php

class ProductController extends CoreController
{
    protected $product;
    protected $params = [];

    public function __construct()
    {
        $this->product = $this->createModel('product');
    }

    // ---------------------- Trang sản phẩm --------------------------------
    public function productPage()
    {
        $FK_ma_danhmuc = isset($this->params[0]) ? $this->params[0] : null;

        $result = $this->product->getAllProducts($FK_ma_danhmuc);

        $data['listProducts'] = $result['result'];

        $data['paginationOutput'] = $result['output'];

        $this->renderView('page_product', $data);
    }

    // ---------------------- chi tiết sản phẩm --------------------------------
    public function viewProduct($ma_sp)
    {
        $data['product'] = $this->product->viewProduct($ma_sp);
        $data['getCommnet'] = $this->product->GetCommentByFKid($ma_sp);
        $data['dsSP'] = $this->product->getProductsbyLimit(4);

        $this->renderView('product_detail', $data);
    }

    // ---------------------------- Chọn sản phẩm theo danh mục -----------------------------
    public function selectCategory($FK_ma_danhmuc)
    {
        $result = $this->product->getAllProducts($FK_ma_danhmuc);

        $data['listProducts'] = $result['result'];

        $data['paginationOutput'] = $result['output'];

        $this->renderView('page_product', $data);
    }


    //-------------------------- CRUD cho sản phẩm --------------------------------
    // -------------------------- tới form tạo sản phẩm --------------------------------
    public function createPrd()
    {
        $data['listCategory'] = $this->product->getAllCategories();
        $data['listOrigins'] = $this->product->getAllOrigins();
        $this->renderView('createPrd', $data);
    }

    public function storePrd()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $result = $this->product->storePrd(
                $_POST['ten_sp'],
                $_FILES['anh_sp'],
                $_POST['gia_sp'],
                $_POST['mota_sp'],
                $_POST['FK_ma_danhmuc'],
                $_POST['FK_ma_xuatxu'],
            );
            if ($result === true) {
                header("Location: " . APPURL . '?url=product/viewPrdManager');
            } else {
                echo 'Thêm sản phẩm không thành công';
            }
        }
        $this->renderView('createPrd');
    }

    public function editPrd($ma_sp)
    {
        $data['dataPrd'] = $this->product->findPrd($ma_sp);
        $this->renderView('editPrd', $data);
    }

    public function updatePrd()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $result = $this->product->updatePrd(
                $_POST['ma_sp'],
                $_POST['ten_sp'],
                $_FILES['anh_sp'],
                $_POST['gia_sp'],
                $_POST['mota_sp']
            );
            if ($result === true) {
                header("Location: " . APPURL . '?url=product/viewPrdManager');
            } else {
                echo 'Sửa sản phẩm không thành công';
            }
        }
    }

    public function deletePrd($ma_sp)
    {
        $this->product->deleteCmt($ma_sp);
        $this->product->deletePrd($ma_sp);
        header("Location: " . APPURL . '?url=product/viewPrdManager');
        exit();
    }


    // ----------------------------- phần quản lí của admin --------------------------------
    // ----------------------------- xem quản lí sản phẩm --------------------------------
    public function viewPrdManager()
    {
        $data['listAllPrd'] = $this->product->getAllPrdByAdmin();
        $this->renderView('page_prdManager', $data);
    }

    // --------------------------- Thêm sản phẩm vào giỏ hàng --------------------------------
    public function AddtoCart($ma_sp)
    {
        $data['cart'] = $this->product->AddtoCart($ma_sp);
        header("Location: " . APPURL . '?url=product/productPage');
    }

    // --------------------------- Update Quantity ---------------------------------------
    public function UpdateQuantity($ma_sp)
    {
        $type = $_GET['type'] ?? '';

        if ($type === 'decre' && isset($_SESSION['cart'][$ma_sp])) {
            if ($_SESSION['cart'][$ma_sp]['soluong'] > 1) {
                $_SESSION['cart'][$ma_sp]['soluong']--;
            } else {
                unset($_SESSION['cart'][$ma_sp]);
            }
        } elseif ($type === 'incre') {
            $_SESSION['cart'][$ma_sp]['soluong'] = ($_SESSION['cart'][$ma_sp]['soluong'] ?? 0) + 1;
        } elseif ($type === 'remove') {
            unset($_SESSION['cart'][$ma_sp]);
        }

        Header("Location: " . APPURL . '?url=page/ViewCart');
    }

    // ------------------------- Xóa giỏ hàng --------------------------------
    public function DeleteCart($ma_sp)
    {
        unset($_SESSION['cart'][$ma_sp]);
        Header("Location: " . APPURL . '?url=page/ViewCart');
    }

    // -------------------- Thêm sản phẩm vào giỏ hàng tại chi tiết sản phẩm --
    public function AddToCartInPrdDetail($ma_sp)
    {
        $data['cart'] = $this->product->AddToCartInPrdDetail($ma_sp);
        header("Location: " . APPURL . '?url=page/ViewCart');
    }

    // -------------------- bình luận ---------------------------
    public function comment()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $result = $this->product->comment(
                $_SESSION['hovaten'],
                $_POST['ngaybinhluan'],
                $_POST['noidungbinhluan'],
                $_POST['FK_ma_sp'],
                $_SESSION['ma_tk']
            );

            if ($result === true) {
                $productId = $_POST['FK_ma_sp'];
                header("Location: " . APPURL . "?url=product/viewProduct/$productId");
                exit();
            } else {
                echo 'Bình luận không thành công';
            }
        }
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

        // Mảng để lưu thông tin sản phẩm
        $orderDetails = [];

        if (!empty($products)) {
            foreach ($products as $ma_sp => $product) {
                $ten_sp = $product['ten_sp'] ?? '';
                $gia_sp = $product['gia_sp'] ?? 0;
                $soLuong = $product['soluong'] ?? 0;

                $tongSoLuong += $soLuong;

                $thanhTien = @($gia_sp * $soLuong);
                $tongTien += $thanhTien;

                if (isset($_SESSION['ten_voucher'])) {
                    $tienship = 0;
                } else {
                    $tienship = 20000;
                }

                $tongThanhToan = $thanhTien + $tienship;

                // Thêm thông tin vào mảng orderDetails
                $orderDetails[] = [
                    'ten_sp' => $ten_sp,
                    'soLuong' => $soLuong,
                    'tienship' => $tienship,
                    'tongThanhToan' => $tongThanhToan,
                ];
            }
        }

        // Lưu thông tin vào mảng $data
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
        $result = $this->product->Payments(
            $_SESSION['hovaten'],
            $_SESSION['diachi'],
            $_SESSION['sodienthoai'],
            $_SESSION['email'],
            $_SESSION['tongtien'],
            $_SESSION['ma_tk'],
        );
        if ($result === true) {
            // var_dump($result);
            header("Location: " . APPURL . '?url=page/index');
        }
    }

    // ------------------------ get all orders ----------------
    public function getAllOrderAdmin()
    {
        $data['orderList'] = $this->product->getAllOrderAdmin();
        $this->renderView('page_orderManager', $data);
    }

    // ------------------------ thây đổi trạng thái ---------------
    public function changeStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ma_donhang = $_POST['ma_donhang'];
            $trangthai = $_POST['trangthai'];

            $result = $this->product->changeStatus($trangthai, $ma_donhang);

            if ($result) {
                header("Location: " . APPURL . '?url=product/getAllOrderAdmin');
                exit();
            }
        }
    }

    // ----------------------- hủy đơn hàng ---------------------------------
    public function cancelOrder($ma_donhang)
    {
        $trangthai = 'huy-don';

        $result = $this->product->cancelOrder($trangthai, $ma_donhang);

        if ($result) {
            header("Location: " . APPURL . '?url=user/pageOrderHistory');
            exit();
        }
    }

    // ------------------------ sử dụng voucher --------------------------------
    public function UseVoucher()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ten_voucher = $_POST['ten_voucher'];
            $result = $this->product->UseVoucher($ten_voucher);

            if ($result) {
                $_SESSION['ten_voucher'] = $result['ten_voucher'];
                header("Location: " . APPURL . '?url=product/checkOut');
                exit();
            } else {
                echo "Voucher not found!";
            }
        }
    }

    // ---------------------------- lấy tất cả bình luận ------------------------
    public function ViewCmtManager()
    {
        $data['result'] = $this->product->ViewCmtManager();
        return $this->renderView('page_cmtManager', $data);
    }
}
