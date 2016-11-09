<form class="form-horizontal" action="../controller/mainCTL.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="input-p_num" class="col-sm-2 control-label">商品の番号</label>
        <div class="col-sm-10">
            <input type="text" name="p_num" class="form-control" value="<?= $_SESSION['certainProductInfo'][0]['p_num'] ?>" readonly>
        </div>
    </div>
    <div class="form-group">
        <label for="input-p_category" class="col-sm-2 control-label">商品の種類</label>
        <div class="col-sm-10">
            <input type="text" name="p_category" class="form-control" value="<?= $_SESSION['certainProductInfo'][0]['p_category'] ?>" readonly>
        </div>
    </div>
    <div class="form-group">
        <label for="input-p_code" class="col-sm-2 control-label">商品のコード</label>
        <div class="col-sm-10">
            <input type="text" name="p_code" class="form-control" value="<?= $_SESSION['certainProductInfo'][0]['p_code'] ?>" readonly>
        </div>
    </div>
    <div class="form-group">
        <label for="input-p_name" class="col-sm-2 control-label">商品の名前</label>
        <div class="col-sm-10">
            <input type="text" name="p_name" class="form-control" value="<?= $_SESSION['certainProductInfo'][0]['p_name'] ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="input-p_stock" class="col-sm-2 control-label">商品の水量</label>
        <div class="col-sm-10">
            <input type="text" name="p_stock" class="form-control" value="<?= $_SESSION['certainProductInfo'][0]['p_stock'] ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="input-p_price" class="col-sm-2 control-label">商品の価格</label>
        <div class="col-sm-10">
            <input type="text" name="p_price" class="form-control" value="<?= $_SESSION['certainProductInfo'][0]['p_price'] ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="input-p_fimage" class="col-sm-2 control-label">商品のイメージ</label>
        <?php
        if ( $_SESSION['certainProductInfo'][0]['p_fimage'] ) {
            $certainProductFimageArr = explode(',', $_SESSION['certainProductInfo'][0]['p_fimage']);
            $countCertainProductFimageArr = count($certainProductFimageArr);

            if (strrpos($_SESSION['certainProductInfo'][0]['p_category'], "_")) {
                $nowCategoryArr = explode('_', $_SESSION['certainProductInfo'][0]['p_category']);
                $nowCategory = $nowCategoryArr[0];
            } else {
                $nowCategory = $_SESSION['certainProductInfo'][0]['p_category'];
            }

            for ($iCount = 0; $iCount < $countCertainProductFimageArr; $iCount++) {
                $nowImagePath = '../../img/product/' . $nowCategory . '/' . $certainProductFimageArr[$iCount];
                if ($iCount % 4 == 0) {
                    echo "<div class='row'>";
                }

                echo "<div class='col-md-2'>";
                echo "<img class='img-thumbnail' src='$nowImagePath' style='width: 125px; height: 125px;'>";
                echo "<input type='checkbox' name='p_dimage[]' value='$certainProductFimageArr[$iCount]'>";
                echo "</div>";

                if ($iCount % 4 == 3) {
                    echo "</div>";
                } elseif ($iCount == $countCertainProductFimageArr - 1) {
                    echo "</div>";
                }
            }
        } else {
            echo "イメージの情報が存在しません！";
        }
        ?>
    </div>
    <div class="form-group">
        <label for="input-p_fimage" class="col-sm-2 control-label"></label>
        <div class="col-sm-10">
            <input type="file" class="btn btn-info" name="p_fimage[]" accept="image/*" multiple>
        </div>
    </div>
    <div class="form-group">
        <label for="input-p_simage" class="col-sm-2 control-label">商品のサムネイル</label>
        <?php
        if ( $_SESSION['certainProductInfo'][0]['p_simage'] ) {
            if (strrpos($_SESSION['certainProductInfo'][0]['p_category'], "_")) {
                $nowCategoryArr = explode('_', $_SESSION['certainProductInfo'][0]['p_category']);
                $nowCategory = $nowCategoryArr[0];
            } else {
                $nowCategory = $_SESSION['certainProductInfo'][0]['p_category'];
            }
            ?>
            <div class="col-sm-10">
                <img class="img-thumbnail"
                     src="../../img/product/<?= $nowCategory ?>/<?= $_SESSION['certainProductInfo'][0]['p_simage'] ?>"
                     style="width: 125px; height: 125px;">
                <input type="file" class="btn btn-info" name="p_simage[]" accept="image/*">
            </div>
            <?php
        } else {
            echo "サムネイルの情報が存在しません。";
        }
        ?>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <Button type="button" class="btn btn-info" onclick="history.back();">以前に</Button>
            <Button type="reset" class="btn btn-primary">元に戻す</Button>
            <Button type="submit" class="btn btn-success" name="submit">修正完了</Button>
            <input type="hidden" name="productNum" value="<?= $_SESSION['certainProductInfo'][0]['p_num'] ?>">
            <input type="hidden" name="action" value="915">
        </div>
    </div>
</form>
