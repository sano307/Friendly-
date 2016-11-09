<?php
$paymentInfo = isset($_SESSION['nowUserPaymentInfo']) ? $_SESSION['nowUserPaymentInfo'] : null;

if ( !$paymentInfo ) {
    echo "<span style='font-size: 30px;'>決済の情報が存在しません！</span>";
} else {
    ?>
    <table class="table table-hover" style="font-size:18px;">
        <thead>
        <tr>
            <th>購買日</th>
            <th>商品の名前</th>
            <th>水量</th>
            <th>決済金額</th>
            <th>注文状態</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $iCount = 0;
        foreach ( $paymentInfo as $key ) {
            echo "<tr>";
            echo "<td>{$paymentInfo[$iCount]['mp_dateOforder']}</td>";
            echo "<td>{$paymentInfo[$iCount]['mp_productName']}</td>";
            echo "<td>{$paymentInfo[$iCount]['mp_paymentQuantity']}</td>";
            echo "<td>{$paymentInfo[$iCount]['mp_totalpayment']}</td>";
            echo "<td>{$paymentInfo[$iCount]['mp_stateOforder']}</td>";
            echo "</tr>";
            $iCount++;
        }
        ?>
        </tbody>
    </table>

    <?php
}
?>
