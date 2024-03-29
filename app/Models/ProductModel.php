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

        $limit = 9;

        $output = '';

        if ($FK_ma_danhmuc) {
            $sql_check = "SELECT COUNT(*) 
            FROM sanpham 
            WHERE FK_ma_danhmuc = '$FK_ma_danhmuc' 
            AND ten_sp LIKE '%$search%'";

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

        $output .= "<style>";
        $output .= "
            .pagination-group a {
                text-decoration: none;
            }

            .pagination-group {
                display: flex;
                justify-content: center; /* Đưa các phần tử về giữa */
                align-items: center; /* Đưa các phần tử theo chiều dọc về giữa */
            }

            .pagination {
                list-style: none;
                padding: 0;
                margin: 0;
                display: flex;
            }

            .pagination li {
                margin-right: 5px;
            }

            .pagination a {
                text-decoration: none;
                padding: 5px 10px;
                border: 1px solid #ccc;
                background-color: #f5f5f5;
                color: #333;
            }

            .pagination a.active {
                background-color: orange;
                color: #fff;
            }

            .pagination a:hover {
                background-color: #ddd;
            }

            .pagination-nav a {
                text-decoration: none;
                padding: 5px 10px;
                border: 1px solid #ccc;
                background-color: #f5f5f5;
                color: #333;
            }

            .pagination-nav a:hover {
                background-color: #ddd;
            }

            .pagination-nav a.next {
                margin-left: 5px;
            }

            .pagination-nav a.prev {
                margin-right: 5px;
            }
        ";
        $output .= "</style>";

        $output .= "<div class='pagination-group'>";
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
            $output .= "<a href='?url=product/productPage&page=" . ($page + 1) . "' class='pagination-nav next'>Next</a>";
        }

        $output .= "</div>";


        $result = $this->conndb->pdo_query($sql);
        return array('result' => $result, 'output' => $output);
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

    public function deleteCmt($ma_sp)
    {
        return $this->conndb->pdo_execute("DELETE FROM binhluan WHERE FK_ma_sp = ?", $ma_sp);
    }

    // -------------------------------- tăng lượt xem của sản phẩm khi người dùng bấm vào -------

    public function updateViewUser($ma_sp)
    {
        $sql = "UPDATE sanpham
                SET luotxem = luotxem + 1
                WHERE ma_sp = $ma_sp";
        return $this->conndb->pdo_execute($sql);
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

    // -------------------------------- quản lí sản phẩm admin -----------------------------
    public function getAllPrdByAdmin()
    {
        if (isset($_POST['search'])) {
            $search = $_POST['search'];
        } else {
            $search = '';
        }

        return $this->conndb->pdo_query("SELECT sanpham.*, danhmuc.ten_danhmuc AS FK_ten_danhmuc, 
        xuatxu.noi_xuatxu AS FK_noi_xuatxu
        FROM sanpham 
        JOIN danhmuc ON sanpham.FK_ma_danhmuc = danhmuc.ma_danhmuc 
        JOIN xuatxu ON sanpham.FK_ma_xuatxu = xuatxu.ma_xuatxu
        WHERE sanpham.ten_sp LIKE '%$search%'");
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

    // -------------------------- lấy sản phẩm ra nhưng li mit ---------------------------
    public function getProductsbyLimit($limit)
    {
        return $this->conndb->pdo_query("SELECT sanpham.*, danhmuc.ten_danhmuc AS FK_ten_danhmuc, 
                xuatxu.noi_xuatxu AS FK_noi_xuatxu
        FROM sanpham 
        JOIN danhmuc ON sanpham.FK_ma_danhmuc = danhmuc.ma_danhmuc 
        JOIN xuatxu ON sanpham.FK_ma_xuatxu = xuatxu.ma_xuatxu
        ORDER BY RAND()
        LIMIT $limit");
    }

    // --------------------------- lấy 4 sản phẩm với lượt xem cao nhất --------------------
    public function getProductsByHighestViews($limit)
    {
        return $this->conndb->pdo_query("SELECT sanpham.*, danhmuc.ten_danhmuc AS FK_ten_danhmuc, 
                xuatxu.noi_xuatxu AS FK_noi_xuatxu
        FROM sanpham 
        JOIN danhmuc ON sanpham.FK_ma_danhmuc = danhmuc.ma_danhmuc 
        JOIN xuatxu ON sanpham.FK_ma_xuatxu = xuatxu.ma_xuatxu
        ORDER BY luotxem DESC
        LIMIT $limit");
    }

    public function getTotalQuantityOfAllOrders() {
        return $this->conndb->pdo_query("SELECT COUNT(*) 
        as total_quantity FROM donhang");
    }
    
    public function getTotalPriceOfAllOrders() {
        return $this->conndb->pdo_query("SELECT SUM(tongtien) as
         total_price FROM donhang");
    }

    public function getTotalQuantityOfAllProduct() {
        return $this->conndb->pdo_query("SELECT SUM(soluong) as
         total_quantity_product FROM donhang");
    }
    

    // ---------------------- lấy tất cả bình luận ---------------------------------
    public function ViewCmtManager()
    {
        $sql = "SELECT * FROM binhluan";

        return $this->conndb->pdo_query($sql);
    }
}
