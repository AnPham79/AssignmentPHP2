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

        $data['listProducts'] = $this->product->getAllProducts($FK_ma_danhmuc);

        $this->renderView('page_product', $data);
    }


    // ---------------------- chi tiết sản phẩm --------------------------------
    public function viewProduct($ma_sp)
    {
        $data['product'] = $this->product->viewProduct($ma_sp);
        $data['getCommnet'] = $this->product->GetCommentByFKid($ma_sp);

        $this->renderView('product_detail', $data);
    }

    // ---------------------------- Chọn sản phẩm theo danh mục -----------------------------
    public function selectCategory($FK_ma_danhmuc)
    {
        $data['listProducts'] = $this->product->getAllProducts($FK_ma_danhmuc);

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
        $data = $this->product->deletePrd($ma_sp);
        header("Location: " . APPURL . '?url=product/viewPrdManager');
    }

    // ----------------------------- phần quản lí của admin --------------------------------
    // ----------------------------- xem quản lí sản phẩm --------------------------------
    public function viewPrdManager()
    {
        $data['listAllPrd'] = $this->product->getAllProducts();
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
                header("Location: " . APPURL . '?url=product/productPage');
            } else {
                echo 'bình luận không thành công';
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

        if (!empty($products)) {
            foreach ($products as $ma_sp => $product) {
                $ten_sp = $product['ten_sp'] ?? '';
                $gia_sp = $product['gia_sp'] ?? 0;
                $soLuong = $product['soluong'] ?? 0;

                $tongSoLuong += $soLuong;

                $thanhTien = @($gia_sp * $soLuong);
                $tongTien += $thanhTien;

                echo "Tên sản phẩm: $ten_sp | Số lượng: $soLuong | Thành tiền: $thanhTien VND<br>";
            }
        }

        $data['tennguoidung'] = $tennguoidung;
        $data['diachinguoidung'] = $diachinguoidung;
        $data['sdtnguoidung'] = $sdtnguoidung;
        $data['emailnguoidung'] = $emailnguoidung;
        $data['order'] = $products;

        $this->renderView('page_order', $data);
    }
}
