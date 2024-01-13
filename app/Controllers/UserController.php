<?php

class UserController extends CoreController
{
    protected $user;

    public function __construct()
    {
        $this->user = $this->createModel('user');
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $result = $this->user->login($_POST['email'], $_POST['matkhau']);
            if ($result) {
                $_SESSION['user'] = $result;
                $_SESSION['hovaten'] = $result['hovaten'];
                $_SESSION['diachi'] = $result['diachi'];
                $_SESSION['sodienthoai'] = $result['sodienthoai'];
                $_SESSION['quyen'] = $result['quyen'];
                if ($result['quyen'] === 'user') {
                    header("Location: " . APPURL . '?url=page/index');
                    exit();
                } elseif ($result['quyen'] === 'admin') {
                    header("Location: " . APPURL . '?url=page/adminPage');
                    exit();
                }
            } else {
                echo 'Sai tên đăng nhập hoặc mật khẩu';
            }
        }
        $this->renderView('login');
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $result = $this->user->register($_POST['hovaten'], $_POST['diachi'], $_POST['sodienthoai'], $_POST['email'], $_POST['matkhau']);
            if ($result) {
                $_SESSION['user'] = $result;
                $_SESSION['hovaten'] = $result['hovaten'];
                $_SESSION['diachi'] = $result['diachi'];
                $_SESSION['sodienthoai'] = $result['sodienthoai'];
                $_SESSION['quyen'] = $result['quyen'];
                header("Location:" . APPURL . '?url=user/login');
            }
        }
        $this->renderView('register');
    }

    public function logout()
    {
        $_SESSION = array();

        session_destroy();

        header("Location:" . APPURL . '../index.php');
        exit();
    }
}
