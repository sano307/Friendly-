<?php
$basketInfo = isset($_SESSION['nowUserBasketInfo']) ? $_SESSION['nowUserBasketInfo'] : null;

if( !$basketInfo ) {
    echo "<span style='font-size: 30px;'>入っている商品がありません！</span>";
} else {
    ?>
    <table class="table table-hover" style="font-size:18px;">
        <thead>
        <tr>
            <th>商品のイメージ</th>
            <th>商品の名前</th>
            <th>購買水量</th>
            <th>商品の価格</th>
            <th>計価格</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php
        $wholeProductSum = 0;
        foreach ($basketInfo as $basket) {
            if ( strrpos($basket['p_category'], "_") ) {
                $nowCategoryArr = explode('_', $basket['p_category']);
                $nowCategory = $nowCategoryArr[0];
            } else {
                $nowCategory = $basket['p_category'];
            }

            $argProductWholePrice = $basket['p_purchasingQuantity'] * $basket['p_price'];
            $wholeProductSum += $argProductWholePrice;

            echo "<tr>";
            echo "<td><img src='../../img/product/$nowCategory/{$basket['p_simage']}' style='width: 100px; height: 100px;'></td>";
            echo "<td>{$basket['p_name']}</td>";
            echo "<td>{$basket['p_purchasingQuantity']}</td>";
            echo "<td>" . number_format($basket['p_price']) . "</td>";
            echo "<td>" . number_format($argProductWholePrice) . "</td>";
            echo "<td></td>"; //<a href='../controller/mainCTL.php' class='btn btn-warning btn-block' role='button' style='margin: 0 auto; padding: 0; font-size: 18px'>수정</a>
            echo "<td><a href='../controller/mainCTL.php?action=20&productNum={$basket['p_num']}&mode=deleteProductInbasket' class='btn btn-danger btn-block' role='button' style='margin: 0 auto; padding: 0; font-size: 18px' onclick='return confirm_delete();'>削除</a></td>";
            echo "</tr>";
        }
        ?>
        <script>
            function confirm_delete() {
                return confirm("削除しますか？");
            }

            function confirm_payment() {
                return confirm("購買しますか？");
            }
        </script>
        <tr>
            <td style="font-weight: bold; font-size: xx-large;">計</td>
            <td></td>
            <td></td>
            <td></td>
            <td><?= number_format($wholeProductSum) ?></td>
            <td></td>
            <td><a href='../controller/mainCTL.php?action=21&wholePrice=<?=$wholeProductSum?>' class='btn btn-danger btn-block' role='button' style='margin: 0 auto; padding: 0; font-size: 18px' onclick='return confirm_payment();'>購買する</a></td>
        </tr>
        </tbody>
    </table>
    <?php
}
