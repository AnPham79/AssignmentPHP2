<?php
// xử lý điều hướng các trang như trang chủ, giới thiệu, liên hệ
class PageController extends CoreController
{
    public function index()
    {

        $this->renderView('home');
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

    public function ViewCart() {
        $this->renderView('page_cart');
    }
}
