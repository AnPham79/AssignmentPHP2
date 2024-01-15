<h1>Thây đổi mật khẩu</h1>
<form action="?url=user/updatePass" method="POST">
    Mật khẩu hiện tại
    <br>
    <?php echo $_SESSION['matkhau'] ?>
    <br>
    Mật khẩu mới
    <br>
    <input type="text" name="matkhau">
    <br>
    <button type="submit">Sửa mật khẩu</button>
</form>