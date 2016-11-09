<?php
$errorCheck = $_REQUEST['error'];
switch ( $errorCheck ) {
    case "exceedQuantity" :
        ?>
        <script>
            var msg = "現在商品の水量を超過しました！";
            alert(msg);
            history.back();
        </script>
        <?php
        break;
}
?>
