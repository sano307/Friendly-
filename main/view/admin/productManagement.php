<?php
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;
$pageInfo = isset($_SESSION['pageInfo']) ? $_SESSION['pageInfo'] : null;
$category = isset($_REQUEST['category']) ? $_REQUEST['category'] : null;
$adminInfo = isset($_SESSION['adminInfo']) ? $_SESSION['adminInfo'] : null;

if( !$adminInfo ) {
    echo "<span>商品がないです。</span>";
} else {
    ?>
    <table class="table table-hover" style="font-size:18px;">
        <thead>
        <tr>
            <th>番号</th>
            <th>分類</th>
            <th>コード</th>
            <th>名前</th>
            <th>水量</th>
            <th>価格</th>
            <th>イメージ</th>
            <th>サムネイル</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($adminInfo as $product) {
            echo "<tr>";
            foreach ($product as $myKey => $myValue) {
                echo "<td>";
                if ( $myKey == "p_code" || $myKey == "p_fimage" || $myKey == "p_simage" ) {
                    $myValue = strlen($myValue) > 6 ? substr($myValue, 0, 6) . "..." : $myValue;
                }
                echo "$myValue";
                echo "</td>";
            }
            echo "<td><a href=../controller/mainCTL.php?action=914&productNum={$product['p_num']} class='btn btn-warning btn-block' role='button' style='margin: 0 auto; padding: 0; font-size: 18px'>수정</a></td>";
            echo "<td><a href=../controller/mainCTL.php?action=916&productNum={$product['p_num']}&pageNum={$pageInfo['currentPageNum']} class='btn btn-danger btn-block' role='button' style='margin: 0 auto; padding: 0; font-size: 18px' onclick='return confirm_delete();'>삭제</a></td>";
            ?>
            <script>
                function confirm_delete() {
                    return confirm("削除しますか？");
                }
            </script>
            <?php
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
    <?php
}
include_once "./common/pagenation.php";
setPageNation($action, $pageInfo, $category);

include_once "./common/searchAdminProduct.php";
?>
