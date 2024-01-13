<h1>Đăng kí</h1>
<?php
if (isset($_GET['error'])) {
    $errorMessage = $_GET['error'];
    echo "<p style='color: red;'>$errorMessage</p>";
}
?>
<form action="" method="POST">
    <input type="text" name="hovaten" placeholder="nhập hovaten của bạn">
    <input type="text" name="diachi" placeholder="nhập địa chỉ của bạn">
    <input type="text" name="sodienthoai" placeholder="nhập số điện thoại của bạn">
    <input type="email" name="email" placeholder="nhập email của bạn">
    <input type="password" name="matkhau" placeholder="nhập mật khẩu của bạn">
    <button type="submit">Đăng kí</button>
</form>