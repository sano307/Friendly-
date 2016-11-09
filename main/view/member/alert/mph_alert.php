<?php
$errorCheck = $_REQUEST['error'];
$quantity = $_REQUEST['quantity'];
?>
<script>
    var msg = "<?= $errorCheck ?>の残り水量は <?= $quantity ?>個です！";
    alert(msg);
    history.back();
</script>
