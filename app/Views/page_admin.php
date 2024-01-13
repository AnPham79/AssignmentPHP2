<h1>Đây là trang admin</h1>

<?php
if (isset($_SESSION['user']['hovaten'])) {
    $hovaten = $_SESSION['user']['hovaten'];
    echo 'Xin chào' . " " . $hovaten;
    echo '<a href="?url=user/logout">Đăng xuất</a>';
}
?>

<br>

<ul>
    <li><a href="?url=page/adminPage">adminPage</a></li>
    <li><a href="?url=product/viewPrdManager">Quản lí sản phẩm</a></li>
    <li><a href="?url=user/ViewUserManager">Quản lí tài khoản</a></li>
    <li><a href="?url=product/ViewCmtManager">Quản lí bình luận</a></li>
    <li><a href="?url=product/ViewOrderManager">Quản lí hóa đơn</a></li>
</ul>