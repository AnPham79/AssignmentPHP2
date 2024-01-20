<style>
    .form-container {
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0;
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

    img {
        max-width: 100%;
        height: auto;
        margin-bottom: 16px;
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
        background-color: #0056b3;
    }
</style>

<div class="form-container">
    <div class="form-wrapper">
        <form action="?url=product/updatePrd" method="POST" enctype="multipart/form-data">
            <h1>Sửa sản phẩm</h1>

            <input type="hidden" name="ma_sp" value="<?php echo $dataPrd[0]['ma_sp'] ?>">

            <label for="ten_sp">Tên sản phẩm</label>
            <input type="text" name="ten_sp" value="<?php echo $dataPrd[0]['ten_sp'] ?>" required>

            <label for="anh_sp">Ảnh sản phẩm</label>
            <img src="<?php echo $dataPrd[0]['anh_sp']; ?>" alt="Ảnh sản phẩm">
            <input type="file" name="anh_sp">

            <label for="gia_sp">Giá sản phẩm</label>
            <input type="text" name="gia_sp" value="<?php echo $dataPrd[0]['gia_sp'] ?>" required>

            <label for="mota_sp">Mô tả sản phẩm</label>
            <input type="text" name="mota_sp" value="<?php echo $dataPrd[0]['mota_sp'] ?>" required>

            <button type="submit">Sửa sản phẩm</button>
        </form>
    </div>
</div>