<?php

class ProductController extends CoreController
{
    protected $product;

    public function __construct()
    {
        $this->product = $this->createModel('product');
    }

    // ---------------------- Trang sản phẩm --------------------------------
    public function productPage()
    {
        $data['listProducts'] = $this->product->getAllProducts();
        $this->renderView('page_product', $data);
    }

    // ---------------------- chi tiết sản phẩm --------------------------------
    public function viewProduct($ma_sp)
    {
        $data['product'] = $this->product->viewProduct($ma_sp);

        $this->renderView('product_detail', $data);
    }

    // ---------------------------- Chọn sản phẩm theo danh mục -----------------------------
    public function selectCategory($FK_ma_danhmuc) {
        $data['product'] = $this->product->getAllProducts($FK_ma_danhmuc);
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
}
