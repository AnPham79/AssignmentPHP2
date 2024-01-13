<?php
// xử lý điều hướng các trang như trang chủ, giới thiệu, liên hệ
class PageController extends CoreController
{
    public function index()
    {

        $this->renderView('home');
    }
    public function ProductPage()
    {
        $this->renderView('page_product');
    }
    public function contactPage()
    {
        $this->renderView('page_contact');
    }
    public function aboutPage()
    {
        $this->renderView('page_about');
    }

    public function adminPage() {
        $this->renderView('page_admin');
    }
}
