<h1>Thêm sản phẩm</h1>
<form action="?url=product/storePrd" method="POST"
    enctype="multipart/form-data">
    Tên sản phẩm
    <br>
    <input type="text" name="ten_sp">
    <br>
    Ảnh sản phẩm
    <br>
    <input type="file" name="anh_sp">
    <br>
    giá sản phẩm
    <br>
    <input type="text" name="gia_sp">
    <br>
    mô tả sản phẩm
    <br>
    <input type="text" name="mota_sp">
    <br>
    danh mục sản phẩm
    <br>
    <select name="FK_ma_danhmuc" id="">
        <?php foreach($listCategory as $each) { ?>
            <option value="<?php echo $each['ma_danhmuc'] ?>"><?=$each['ten_danhmuc']?></option>
        <?php } ?>
    </select>
    <br>
    xuất sứ sản phẩm
    <br>
    <select name="FK_ma_xuatxu" id="">
        <?php foreach ($listOrigins as $each) { ?>
            <option value="<?php echo $each['ma_xuatxu'] ?>"><?php echo $each['noi_xuatxu'] ?></option>
        <?php } ?>  
    </select>
    <br>
    <button type="submit">Thêm sản phẩm</button>
</form>