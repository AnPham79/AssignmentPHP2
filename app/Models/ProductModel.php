<?php
class ProductModel
{
    protected $conndb;

    public function __construct()
    {
        $this->conndb = new Database();
    }

    public function __destruct()
    {
        unset($this->conndb);
    }

    // -------------------------------- lấy tất cả sản phẩm -------------------------------------
    public function getAllProducts($FK_ma_danhmuc)
    {
        var_dump($FK_ma_danhmuc);
        if (isset($_POST['search'])) {
            $search = $_POST['search'];
        } else {
            $search = '';
        }

        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }

        $limit = 3;

        $output = '';

        if ($FK_ma_danhmuc) {
            $sql_check = "SELECT COUNT(*) 
            FROM sanpham 
            WHERE FK_ma_danhmuc = '$FK_ma_danhmuc' 
            AND ten_sp LIKE '%$search%'";
            var_dump($sql_check);
            $totalRecords = $this->conndb->pdo_query_one($sql_check);
            $getResult = $totalRecords['COUNT(*)'];
            $num_page = ceil($getResult / $limit);
            $offset = $limit * ($page - 1);

            $sql = "SELECT sanpham.*, danhmuc.ten_danhmuc AS FK_ten_danhmuc, 
                    xuatxu.noi_xuatxu AS FK_noi_xuatxu
            FROM sanpham 
            JOIN danhmuc ON sanpham.FK_ma_danhmuc = danhmuc.ma_danhmuc 
            JOIN xuatxu ON sanpham.FK_ma_xuatxu = xuatxu.ma_xuatxu
            WHERE sanpham.ten_sp LIKE '%$search%' AND FK_ma_danhmuc = '$FK_ma_danhmuc'
            LIMIT $limit OFFSET $offset";
        } else {
            $sql_check = "SELECT COUNT(*) FROM sanpham";
            var_dump($sql_check);
            $totalRecords = $this->conndb->pdo_query_one($sql_check);
            $getResult = $totalRecords['COUNT(*)'];
            $num_page = ceil($getResult / $limit);
            $offset = $limit * ($page - 1);

            $sql = "SELECT sanpham.*, danhmuc.ten_danhmuc AS FK_ten_danhmuc, 
                    xuatxu.noi_xuatxu AS FK_noi_xuatxu
            FROM sanpham 
            JOIN danhmuc ON sanpham.FK_ma_danhmuc = danhmuc.ma_danhmuc 
            JOIN xuatxu ON sanpham.FK_ma_xuatxu = xuatxu.ma_xuatxu
            WHERE sanpham.ten_sp LIKE '%$search%'
            LIMIT $limit OFFSET $offset";
        }

        if ($page > 1) {
            $output .= "<a href='?url=product/productPage&page=" . ($page - 1) . "'>Prev</a>";
        }

        $output .= "<ul class='pagination'>";
        for ($i = 1; $i <= $num_page; $i++) {
            $cls = ($i == $page) ? "class='active'" : '';
            $output .= "<li><a href='?url=product/productPage&page=$i' $cls>$i</a></li>";
        }
        $output .= "</ul>";

        if ($num_page > $page) {
            $output .= "<a href='?url=product/productPage&page=" . ($page + 1) . "'>Next</a>";
        }

        echo $output;

        return $this->conndb->pdo_query($sql);
    }

    // ------------------------------- Xem chi tiết sản phẩm tại mã --------------------------------
    public function viewProduct($ma_sp)
    {
        return $this->conndb->pdo_query_one("SELECT sanpham .*,
        danhmuc.ten_danhmuc AS FK_ten_danhmuc,
        xuatxu.noi_xuatxu AS FK_noi_xuatxu
         FROM sanpham 
         JOIN danhmuc ON sanpham.FK_ma_danhmuc = danhmuc.ma_danhmuc
         JOIN xuatxu ON sanpham.FK_ma_xuatxu = xuatxu.ma_xuatxu
         WHERE ma_sp = ?", $ma_sp);
    }

    // ------------------------- Lấy tất cả danh mục ----------------------------------------------------------------
    public function getAllCategories()
    {
        return $this->conndb->pdo_query("SELECT * FROM danhmuc");
    }

    // -------------------------- Lấy tất cả xuất sứ ----------------------------------------------------------------
    public function getAllOrigins()
    {
        return $this->conndb->pdo_query("SELECT * FROM xuatxu");
    }

    // -------------------------- CRUD cho sản phẩm ------------------------
    public function storePrd($ten_sp, $anh_sp, $gia_sp, $mota_sp, $FK_ma_danhmuc, $FK_ma_xuatxu)
    {
        $target_dir = "imagePrd/";
        $target_file = $target_dir . basename($anh_sp["name"]);

        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }

        if (move_uploaded_file($anh_sp["tmp_name"], $target_file)) {
            return $this->conndb->pdo_execute("INSERT INTO sanpham (ten_sp, anh_sp, gia_sp, mota_sp, FK_ma_danhmuc, FK_ma_xuatxu) 
        VALUES ('$ten_sp', '$target_file', '$gia_sp', '$mota_sp', '$FK_ma_danhmuc', '$FK_ma_xuatxu')");
        } else {
            echo "Có lỗi khi tải lên tệp tin.";
            return false;
        }
    }

    public function findPrd($ma_sp)
    {
        return $this->conndb->pdo_query("SELECT * FROM sanpham WHERE ma_sp = '$ma_sp'");
    }

    public function updatePrd($ma_sp, $ten_sp, $anh_sp, $gia_sp, $mota_sp)
    {
        $target_dir = "imagePrdNew/";

        // Kiểm tra xem có ảnh mới không
        if (!empty($anh_sp["name"])) {
            $target_file = $target_dir . basename($anh_sp["name"]);

            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0755, true);
            }

            if (move_uploaded_file($anh_sp["tmp_name"], $target_file)) {
                $sql = "UPDATE sanpham
                    SET ten_sp = ?, anh_sp = ?, gia_sp = ?, mota_sp = ?
                    WHERE ma_sp = ?";

                $params = [$ten_sp, $target_file, $gia_sp, $mota_sp, $ma_sp];

                return $this->conndb->pdo_execute($sql, ...$params);
            } else {
                echo "Có lỗi khi tải lên tệp tin.";
                return false;
            }
        } else {
            $sql = "UPDATE sanpham
                SET ten_sp = ?, gia_sp = ?, mota_sp = ?
                WHERE ma_sp = ?";

            $params = [$ten_sp, $gia_sp, $mota_sp, $ma_sp];

            return $this->conndb->pdo_execute($sql, ...$params);
        }
    }

    public function deletePrd($ma_sp)
    {
        return $this->conndb->pdo_execute("DELETE FROM sanpham WHERE ma_sp = ?", $ma_sp);
    }

    // ------------------------------- Thao tác người dùng --------------------------------------
    // ------------------------------- Thêm sản phẩm vào giỏ hàng -------------------------------
    public function AddToCart($ma_sp)
    {
        if (empty($_SESSION['cart'][$ma_sp])) {
            $sql = "SELECT * FROM sanpham 
            Where ma_sp = '$ma_sp'";
            $each = $this->conndb->pdo_query_one($sql);

            $_SESSION['cart'][$ma_sp]['ten_sp'] = $each['ten_sp'];
            $_SESSION['cart'][$ma_sp]['anh_sp'] = $each['anh_sp'];
            $_SESSION['cart'][$ma_sp]['gia_sp'] = $each['gia_sp'];
            $_SESSION['cart'][$ma_sp]['mota_sp'] = $each['mota_sp'];
            $_SESSION['cart'][$ma_sp]['soluong'] = 1;
        } else {
            $_SESSION['cart'][$ma_sp]['soluong']++;
        }
    }

    // -------------------------------- Thêm sản phẩm vào giỏ hàng trong chi tiết sản phẩm ----------
    public function AddToCartInPrdDetail($ma_sp)
    {
        if (isset($_POST['soluong'])) {
            $soluong = $_POST['soluong'];

            if (empty($_SESSION['cart'][$ma_sp])) {
                $sql = "SELECT * FROM sanpham 
                Where ma_sp = '$ma_sp'";
                $each = $this->conndb->pdo_query_one($sql);

                $_SESSION['cart'][$ma_sp]['ten_sp'] = $each['ten_sp'];
                $_SESSION['cart'][$ma_sp]['anh_sp'] = $each['anh_sp'];
                $_SESSION['cart'][$ma_sp]['gia_sp'] = $each['gia_sp'];
                $_SESSION['cart'][$ma_sp]['mota_sp'] = $each['mota_sp'];
                $_SESSION['cart'][$ma_sp]['soluong'] = $soluong;
            } else {
                $_SESSION['cart'][$ma_sp]['soluong']++;
            }
        }
    }

    // ------------------------ comment -------------------------------
    public function comment($tennguoibinhluan, $ngaybinhluan, $noidungbinhluan, $FK_ma_sp, $FK_ma_taikhoan)
    {
        $sql = "INSERT INTO binhluan (tennguoibinhluan, ngaybinhluan, noidungbinhluan, FK_ma_sp, FK_ma_taikhoan) 
            VALUES ('$tennguoibinhluan', '$ngaybinhluan', '$noidungbinhluan', '$FK_ma_sp', '$FK_ma_taikhoan')";

        $result = $this->conndb->pdo_execute($sql);
        return $result;
    }

    // =-------------------- in bình luận ra theo tên --------------------------------
    public function GetCommentByFKid($ma_sp)
    {
        $sql = "SELECT * FROM binhluan WHERE FK_ma_sp = '$ma_sp'";
        $result = $this->conndb->pdo_query($sql);
        return $result;
    }

    // ------------------------ Thannh toán ---------------------------------------
    public function Payments($tennguoidung, $diachinguoidung, $sdtnguoidung, $emailnguoidung, $tongtien, $FK_ma_taikhoan)
    {
        $products = $_SESSION['cart'] ?? [];

        $sanpham_name = '';
        $sanpham_quantity = '';
        foreach ($products as $ma_sp => $product) {
            $sanpham_name .= $product['ten_sp'] . " , ";
            $sanpham_quantity .=  $product['soluong'] . " , ";
        }

        $sql = "INSERT INTO 
        donhang(tennguoidung, diachinguoidung, sdtnguoidung, emailnguoidung, tensanpham, soluong , tongtien, FK_ma_taikhoan) 
        VALUES
        ('$tennguoidung', '$diachinguoidung', '$sdtnguoidung', '$emailnguoidung', '$sanpham_name','$sanpham_quantity', '$tongtien', '$FK_ma_taikhoan')";

        $result = $this->conndb->pdo_execute($sql);

        if ($result) {
            unset($_SESSION['cart']);
        }

        return $result;
    }

    // -------------------------------- quản lí sản phẩm admin -----------------------------
    public function getAllPrdByAdmin()
    {
        return $this->conndb->pdo_query("SELECT sanpham.*, danhmuc.ten_danhmuc AS FK_ten_danhmuc, 
        xuatxu.noi_xuatxu AS FK_noi_xuatxu
        FROM sanpham 
        JOIN danhmuc ON sanpham.FK_ma_danhmuc = danhmuc.ma_danhmuc 
        JOIN xuatxu ON sanpham.FK_ma_xuatxu = xuatxu.ma_xuatxu");
    }

    // ---------------------------------- quản lí hóa đơn -------------------------------------
    public function getAllOrderAdmin()
    {
        return $this->conndb->pdo_query("SELECT * FROM donhang");
    }

    // ----------------------------- thây đổi trạng thái ----------------------------------
    public function changeStatus($trangthai, $ma_donhang)
    {
        return $this->conndb->pdo_execute("UPDATE donhang SET trangthai = '$trangthai' WHERE ma_donhang = '$ma_donhang'");
    }

    // ----------------------------- hủy đơn hàng ------------------------------------------
    public function cancelOrder($trangthai, $ma_donhang)
    {
        return $this->conndb->pdo_execute("UPDATE donhang 
        SET trangthai = '$trangthai' 
        WHERE ma_donhang = '$ma_donhang'");
    }

    // ============================= sử dụng voucher ----------------------------------
    public function VoucherAxist($ten_voucher)
    {
        $sql = "SELECT COUNT(*) FROM voucher WHERE ten_voucher = ?";
        $count = $this->conndb->pdo_query_value($sql, $ten_voucher);
        return $count > 0;
    }

    public function UseVoucher($ten_voucher)
    {
        if ($this->VoucherAxist($ten_voucher)) {
            return $this->conndb->pdo_query_one("SELECT * FROM voucher WHERE ten_voucher = ?", $ten_voucher);
        }
        return false;
    }
}
