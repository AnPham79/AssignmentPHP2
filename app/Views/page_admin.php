<div class="admin-container">
    <h1>Đây là trang admin</h1>

    <?php
    if (isset($_SESSION['user']['hovaten'])) {
        $hovaten = $_SESSION['user']['hovaten'];
        echo 'Xin chào' . " " . $hovaten;
        echo '<a class="logout" href="?url=user/logout">Đăng xuất</a>';
    }
    ?>

    <br>

    <ul>
        <li><a href="?url=page/adminPage">pageAdmin</a></li>
        <li><a href="?url=product/viewPrdManager">Quản lý sản phẩm</a></li>
        <li><a href="?url=user/ViewUserManager">Quản lý tài khoản</a></li>
        <li><a href="?url=product/ViewCmtManager">Quản lý bình luận</a></li>
        <li><a href="?url=product/getAllOrderAdmin">Quản lý hóa đơn</a></li>
    </ul>
</div>