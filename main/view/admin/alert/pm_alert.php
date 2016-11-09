<?php
$errorCheck = $_REQUEST['error'];
    switch ( $errorCheck ) {
        case "productNumInsert" :
            ?>
            <script>
                var msg = "商品の名前を入力してください！";
                alert(msg);
                location.href='../../../controller/mainCTL.php?action=914';
            </script>
            <?php
            break;

        case "productStockInsert" :
            ?>
            <script>
                var msg = "商品の水量を入力してください！";
                alert(msg);
                history.back();
            </script>
            <?php
            break;

        case "productPriceInsert" :
            ?>
            <script>
                var msg = "商品の価格を入力してください！";
                alert(msg);
                history.back();
            </script>
            <?php
            break;

        case "UpdateFailed" :
            ?>
            <script>
                var msg = "イメージの情報修正でエラーが発生しました！";
                alert(msg);
                location.href='../../../controller/mainCTL.php?action=910';
            </script>
            <?php
            break;

        case "ChangeFailed" :
            ?>
            <script>
                var msg = "イメージの情報変更でエラーが発生しました！";
                alert(msg);
                location.href='../../../controller/mainCTL.php?action=910';
            </script>
            <?php
            break;

        case "UpdateImageThumbnailFailed" :
            ?>
            <script>
                var msg = "サムネイルの情報変更でエラーが発生しました！";
                alert(msg);
                location.href='../../../controller/mainCTL.php?action=910';
            </script>
            <?php
            break;

        case "ProductModifySuccess" :
            ?>
            <script>
                var msg = "選択した商品の修正に成功しました！";
                alert(msg);
                location.href='../../../controller/mainCTL.php?action=910';
            </script>
            <?php
            break;
    }
?>
