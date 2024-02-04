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
                $_SESSION['anhnguoidung'] = $result['anhnguoidung'];
                $_SESSION['quyen'] = $result['quyen'];
                if ($result['quyen'] === 'user') {
                    header("Location: " . APPURL . '?url=page/index');
                    exit();
                } elseif ($result['quyen'] === 'admin') {
                    header("Location: " . APPURL . '?url=product/viewPrdManager');
                    exit();
                }
            } else {
                header("Location: " . APPURL . '?url=user/login&error=Sai tên đăng nhập hoặc mật khẩu');
                exit();
            }
        }
        $this->renderView('login');
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $result = $this->user->register(
                $_POST['hovaten'],
                $_POST['diachi'],
                $_POST['sodienthoai'],
                $_POST['email'],
                $_FILES['anhnguoidung'],
                $_POST['matkhau']
            );
            if ($result) {
                header("Location:" . APPURL . '?url=user/login');
            }
        }
        $this->renderView('register');
    }

    public function logout()
    {
        unset($_SESSION['user']);

        session_destroy();

        header("Location:" . APPURL . '?url=page/index');
        exit();
    }

    // ------------------------- đổi mật khẩu ---------------------------------
    public function editAccount()
    {
        $this->renderView('editAccount');
    }

    public function updateAccount()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $result = $this->user->updateAccount(
                $_FILES['anhnguoidung'],
                $_POST['hovaten'],
                $_POST['diachi'],
                $_POST['sodienthoai'],
                $_POST['email'],
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

    // ------------------------ lịch sử mua hàng ------------------------
    public function pageOrderHistory()
    {
        $this->createModel('user');
        $data['orderHistory'] = $this->user->getAllOrder($_SESSION['ma_tk']);

        // var_dump($data['orderHistory']);

        $this->renderView('page_orderHistory', $data);
    }

    // ------------------------ profile ---------------------------------
    public function ViewProfile()
    {
        $this->renderView('page_profile');
    }

    // ---------------------------- user ----------------------------------------
    public function ViewUserManager()
    {
        $data['result'] = $this->user->ViewUserManager();
        return $this->renderAdmin('page_UserManager', $data);
    }

    // --------------------------- liên hệ ------------------------------------
    public function contact()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $result = $this->user->contact(
                $_POST['ten_nguoilienhe'],
                $_POST['email_nguoilienhe'],
                $_POST['sdt_nguoilienhe'],
                $_POST['noidung_lienhe'],
            );
        }
    }

    // ---------------------------- quên mật khẩu -------------------------------
    public function forgotPass()
    {
        $this->renderView('forgotPass');
    }

    // ----------------------------- lấy lại mật khẩu ---------------------------
    public function getPassword()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $result = $this->user->getPassword(
                $_POST['email']
            );
        }
    }
}
