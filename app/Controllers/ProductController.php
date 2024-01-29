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
        $data['product'] = $this->product->updateViewUser($ma_sp);
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
        $this->renderAdmin('createPrd', $data);
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
        $this->renderAdmin('createPrd');
    }

    public function editPrd($ma_sp)
    {
        $data['dataPrd'] = $this->product->findPrd($ma_sp);
        $this->renderAdmin('editPrd', $data);
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
        $this->renderAdmin('page_prdManager', $data);
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

    // ------------------------ get all orders ----------------
    public function getAllOrderAdmin()
    {
        $data['totalquantity'] = $this->product->getTotalQuantityOfAllOrders();

        $data['totalPrice'] = $this->product->getTotalPriceOfAllOrders();

        $data['totalproduct'] = $this->product->getTotalQuantityOfAllProduct();

        $data['orderList'] = $this->product->getAllOrderAdmin();

        $this->renderAdmin('page_analytic', $data);
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
}
