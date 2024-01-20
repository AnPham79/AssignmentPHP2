<style>
    .form-container {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }

    .form-wrapper {
        background-color: #ffffff;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 400px;
    }

    h1 {
        color: orange;
        text-align: center;
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
    }

    input,
    select {
        width: 100%;
        padding: 10px;
        margin-bottom: 16px;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-sizing: border-box;
    }

    button {
        background-color: orange;
        color: #fff;
        padding: 12px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: 100%;
    }

    button:hover {
        background-color: gray;
        transition: 0.5s;
    }
</style>

<div class="form-container">
    <div class="form-wrapper">
        <form action="?url=product/storePrd" method="POST" enctype="multipart/form-data">
            <h1>Thêm sản phẩm</h1>

            <label for="ten_sp">Tên sản phẩm</label>
            <input type="text" name="ten_sp" required>

            <label for="anh_sp">Ảnh sản phẩm</label>
            <input type="file" name="anh_sp" required>

            <label for="gia_sp">Giá sản phẩm</label>
            <input type="text" name="gia_sp" required>

            <label for="mota_sp">Mô tả sản phẩm</label>
            <input type="text" name="mota_sp" required>

            <label for="FK_ma_danhmuc">Danh mục sản phẩm</label>
            <select name="FK_ma_danhmuc" required>
                <?php foreach ($listCategory as $each) { ?>
                    <option value="<?php echo $each['ma_danhmuc'] ?>"><?= $each['ten_danhmuc'] ?></option>
                <?php } ?>
            </select>

            <label for="FK_ma_xuatxu">Xuất sứ sản phẩm</label>
            <select name="FK_ma_xuatxu" required>
                <?php foreach ($listOrigins as $each) { ?>
                    <option value="<?php echo $each['ma_xuatxu'] ?>"><?php echo $each['noi_xuatxu'] ?></option>
                <?php } ?>
            </select>

            <button type="submit">Thêm sản phẩm</button>
        </form>
    </div>
</div>