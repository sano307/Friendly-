<?php
$errorCheck = $_REQUEST['error'];
    switch ( $errorCheck ) {
        case "NotImageFile" :
            ?>
            <script>
                var msg = "イメージファイルがないです！";
                alert(msg);
                location.href='../../../controller/mainCTL.php?action=912';
            </script>
            <?php
            break;

        case "AlreadyExistsFile" :
            ?>
            <script>
                var msg = "同じ名前のイメージファイルが存在します！";
                alert(msg);
                location.href='../../../controller/mainCTL.php?action=912';
            </script>
            <?php
            break;

        case "OverSizeFile" :
            ?>
            <script>
                var msg = "アップロードできる容量を超過しました！";
                alert(msg);
                location.href='../../../controller/mainCTL.php?action=912';
            </script>
            <?php
            break;

        case "OtherExtensionFile" :
            ?>
            <script>
                var msg = "アップロードできるファイルがないです！";
                alert(msg);
                location.href='../../../controller/mainCTL.php?action=912';
            </script>
            <?php
            break;

        case "UploadFailed" :
            ?>
            <script>
                var msg = "イメージファイルのアップロードに失敗しました!";
                alert(msg);
                location.href='../../../controller/mainCTL.php?action=912';
            </script>
            <?php
            break;

        case "InsertSuccess" :
            ?>
            <script>
                var msg = "商品の登録に成功しました！";
                alert(msg);
                location.href='../../../controller/mainCTL.php?action=910';
            </script>
            <?php
            break;

        case "UploadingFailed" :
        case "InsertFailed" :
            ?>
            <script>
                var msg = "商品の登録に失敗しました！";
                alert(msg);
                location.href='../../../controller/mainCTL.php?action=912';
            </script>
            <?php
            break;
    }
?>
