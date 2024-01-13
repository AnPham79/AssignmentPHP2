<?php

class ProductController extends CoreController
{
    protected $product;

    public function __construct()
    {
        $this->product = $this->createModel('product');
    }

    public function productPage()
    {
        $data['listProducts'] = $this->product->getAllProducts();
        $this->renderView('page_product', $data);
    }

    public function viewProduct($ma_sp)
    {
        $data['product'] = $this->product->viewProduct($ma_sp);

        $this->renderView('product_detail', $data);
    }
}
