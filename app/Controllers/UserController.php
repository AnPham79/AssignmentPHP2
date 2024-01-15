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
                $_SESSION['email'] = $result['email'];
                $_SESSION['hovaten'] = $result['hovaten'];
                $_SESSION['ma_tk'] = $result['ma_tk'];
                $_SESSION['diachi'] = $result['diachi'];
                $_SESSION['matkhau'] = $result['matkhau'];
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
                $_SESSION['email'] = $result['email'];
                $_SESSION['hovaten'] = $result['hovaten'];
                $_SESSION['diachi'] = $result['diachi'];
                $_SESSION['ma_tk'] = $result['ma_tk'];
                $_SESSION['matkhau'] = $result['matkhau'];
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

        header("Location:" . APPURL . '?url=page/index');
        exit();
    }

    // ------------------------- đổi mật khẩu ---------------------------------
    public function editPass()
    {
        $this->renderView('editPass');
    }

    public function updatePass()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $result = $this->user->updatePass(
                $_POST['matkhau'],
                $_SESSION['ma_tk']
            );
        }

        if ($result === true) {
            header("Location:" . APPURL . '?url=page/index');
        } else {
            var_dump($result);
        }
    }

    // ------------------------ public functions ------------------------
    public function pageOrderHistory()
    {
        $data['orderHistory'] = $this->user->getAllOrder($_SESSION['ma_tk']);
        $this->renderView('page_orderHistory', $data);
    }
}
