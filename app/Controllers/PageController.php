<?php
// xử lý điều hướng các trang như trang chủ, giới thiệu, liên hệ
class PageController extends CoreController
{
    public function index()
    {
        $product = $this->createModel('product');
        $data['dsSP'] = $product->getProductsbyLimit(4);
        $data['dsSP2'] = $product->getProductsByHighestViews(4);
        $this->renderView('home', $data);
    }
    public function contactPage()
    {
        $this->renderView('page_contact');
    }
    public function aboutPage()
    {
        $this->renderView('page_about');
    }

    public function ViewCart() {
        $this->renderView('page_cart');
    }
}
