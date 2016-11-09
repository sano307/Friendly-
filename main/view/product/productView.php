<?php
$selectedProductInfo = isset($_SESSION['selectedProductInfo']) ? $_SESSION['selectedProductInfo'] : null;
$selectedProductImageInfo = explode(',', $selectedProductInfo['p_fimage']);
$viewedProductInfo = isset($_SESSION['viewedProductInfo']) ? $_SESSION['viewedProductInfo'] : null;
?>
<form class="form-horizontal">
    <div class="form-group">
        <div class="col-sm-10">
            <?php
            $countImage = count($selectedProductImageInfo);

            if (strrpos($selectedProductInfo['p_category'], "_")) {
                $nowCategoryArr = explode('_', $selectedProductInfo['p_category']);
                $nowCategory = $nowCategoryArr[0];
            } else {
                $nowCategory = $selectedProductInfo['p_category'];
            }

            for ($iCount = 0; $iCount < $countImage; $iCount++) {
                ?>
                <img src='../../img/product/<?= $nowCategory ?>/<?= $selectedProductImageInfo[$iCount] ?>'
                     style="width: 200px; height: 200px;">
                <?php
            }
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">商品の名前</label>

        <div class="col-sm-10">
            <p class="form-control-static"><?= $selectedProductInfo['p_name'] ?></p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">商品の分類</label>

        <div class="col-sm-10">
            <p class="form-control-static"><?= $selectedProductInfo['p_category'] ?></p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">商品のコード</label>

        <div class="col-sm-10">
            <p class="form-control-static"><?= $selectedProductInfo['p_code'] ?></p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">残り水量</label>

        <div class="col-sm-10">
            <p class="form-control-static"><?= $selectedProductInfo['p_stock'] ?></p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">商品の価格</label>

        <div class="col-sm-10">
            <p class="form-control-static"><?= $selectedProductInfo['p_price'] ?></p>
        </div>
    </div>
</form>
<div>
    <?php
    if ( @$_SESSION['now_user'] ) { ?>
        <form action="../../main/controller/mainCTL.php" method="post">
            <select name="quantityOfpurchases" class="form-control input-lg">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <Button type="submit" class="btn btn-danger btn-block">ショッピングカートに入れる</Button>
            <input type="hidden" name="action" value="17">
            <input type="hidden" name="nowAction" value="<?= $_REQUEST['action'] ?>">
            <input type="hidden" name="category" value="<?= $_REQUEST['category'] ?>">
            <input type="hidden" name="pageNum" value="<?= $_REQUEST['pageNum'] ?>">
            <input type="hidden" name="productNum" value="<?= $_REQUEST['productNum'] ?>">
            <input type="hidden" name="mode" value="putProductInbasket">
        </form>
    <?php }
    ?>
    <Button type="button" class="btn btn-primary btn-block" onclick="history.back()">以前に</Button>
</div>
<div class="row">
    <?php
    if ( !$viewedProductInfo ) {
        echo "商品が存在しません！";
    } else {
        $cnt = count($viewedProductInfo);
        for ($iCount = 0; $iCount < $cnt; $iCount++) {
            if (strrpos($viewedProductInfo[$iCount]['p_category'], "_")) {
                $viewCategoryArr = explode('_', $viewedProductInfo[$iCount]['p_category']);
                $viewCategory = $viewCategoryArr[0];
            } else {
                $viewCategory = $viewedProductInfo[$iCount]['p_category'];
            }

            if ($_REQUEST['productNum'] != $viewedProductInfo[$iCount]['p_num']) {
                $viewProductActionValue = $_SESSION['menuActionValueArr'][$viewedProductInfo[$iCount]['p_category']];
                ?>
                <div class="col-xs-6 col-md-3" style="width: 150px; height: 150px;">
                    <div class="thumbnail">
                        <a href="../../main/controller/mainCTL.php?action=<?=$viewProductActionValue?>&category=<?=$viewedProductInfo[$iCount]['p_category']?>&productNum=<?=$viewedProductInfo[$iCount]['p_num']?>" class="thumbnail">
                            <img src="../../img/product/<?= $viewCategory ?>/<?= $viewedProductInfo[$iCount]['p_simage'] ?>">
                        </a>
                        <div class="caption" style="font-weight: bold;">
                            <h4><?= $viewedProductInfo[$iCount]['p_name'] ?></h4>
                            <p><?= number_format($viewedProductInfo[$iCount]['p_price']) ?></p>
                        </div>
                    </div>
                </div>
            <?php }
        }
    }
    ?>
</div>
