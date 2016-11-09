<?php
$errorCheck = $_REQUEST['error'];
switch ( $errorCheck ) {
    case "InsertPostInfoFailed":
        ?>
        <script>
            var msg = "情報入力に失敗しました！";
            alert(msg);
            history.back();
        </script>
        <?php
        break;

    case "InsertPostInfoSucssess":
        ?>
        <script>
            var msg = "情報入力に成功しました！"
            alert(msg);
            location.href='../../../controller/mainCTL.php?action=600';
        </script>
        <?php
        break;
}
?>
