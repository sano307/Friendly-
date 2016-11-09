<form class="form-horizontal" action="../controller/mainCTL.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="input-p_category" class="col-sm-2 control-label">商品の種類</label>
        <div class="col-sm-10">
            <select name="p_category" class="selectpicker" data-style="btn-primary">
                <option value="">カテゴリー</option>
                <option value="brand_daks">DAKS</option>
                <option value="brand_hazzys">HAZZYS</option>
                <option value="brand_ilcorso">IL CORSO</option>
                <option value="brand_lafuma">LAFUMA</option>
                <option value="women_T-shirt">W_T-SHIRT</option>
                <option value="women_shirt-blouse">W_SHIRT-BLOUSE</option>
                <option value="women_knit-cardigan">W_KNIT-CARDIGAN</option>
                <option value="women_dress">W_DRESS</option>
                <option value="women_pants">W_PANTS</option>
                <option value="man_T-shirt">M_T-SHIRT</option>
                <option value="man_shirt">M_SHIRT</option>
                <option value="man_knit-cardigan">M_KNIT-CARDIGAN</option>
                <option value="man_pants">M_PANTS</option>
                <option value="man_jacket-vest">M_JACKET-VEST</option>
                <option value="bag&acc_w-bag">BA_W-BAG</option>
                <option value="bag&acc_m-bag">BA_M-BAG</option>
                <option value="outdoor_shoes">OUTDOOR_SHOES</option>
                <option value="outdoor_bag">OUTDOOR_BAG</option>
                <option value="outdoor_hat">OUTDOOR_HAT</option>
                <option value="outdoor_goods">OUTDOOR_GOODS</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="input-p_name" class="col-sm-2 control-label">商品の名前</label>
        <div class="col-sm-10">
            <input type="text" name="p_name" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label for="input-p_stock" class="col-sm-2 control-label">商品の水量</label>
        <div class="col-sm-10">
            <input type="text" name="p_stock" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label for="input-p_price" class="col-sm-2 control-label">商品の価格</label>
        <div class="col-sm-10">
            <input type="text" name="p_price" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label for="input-p_fimage" class="col-sm-2 control-label">商品のイメージ</label>
        <div class="col-sm-10">
            <input type="file" name="p_fimage[]" class="btn btn-info" accept="image/*" multiple>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <Button type="button" class="btn btn-info" onclick="history.back();">以前に</Button>
            <Button type="reset" class="btn btn-primary">元に戻す</Button>
            <Button type="submit" class="btn btn-success" name="submit">商品入力</Button>
            <input type="hidden" name="action" value="913">
        </div>
    </div>
</form>
