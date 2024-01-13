<h1>Đây là trang admin</h1>

<?php
if (isset($_SESSION['user']['hovaten'])) {
    $hovaten = $_SESSION['user']['hovaten'];
    echo 'Xin chào' . " " . $hovaten;
    echo '<a href="?url=user/logout">Đăng xuất</a>';
}
?>