<h1>Sửa sản phẩm</h1>
<form action="?url=product/updatePrd" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="ma_sp" value="<?php echo $dataPrd[0]['ma_sp'] ?>">
    <br>
    Tên sản phẩm
    <br>
    <input type="text" name="ten_sp" value="<?php echo $dataPrd[0]['ten_sp'] ?>">
    <br>
    Ảnh sản phẩm
    <br>
    <img src="<?php echo $dataPrd[0]['anh_sp']; ?>" alt="Ảnh sản phẩm" style="max-width: 100px;">
    <br>
    <input type="file" name="anh_sp">
    <br>
    Giá sản phẩm
    <br>
    <input type="text" name="gia_sp" value="<?php echo $dataPrd[0]['gia_sp'] ?>">
    <br>
    Mô tả sản phẩm
    <br>
    <input type="text" name="mota_sp" value="<?php echo $dataPrd[0]['mota_sp'] ?>">
    <br>
    <button type="submit">Sửa sản phẩm</button>
</form>

