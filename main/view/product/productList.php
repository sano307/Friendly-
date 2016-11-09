<?php
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;
$pageInfo = isset($_SESSION['pageInfo']) ? $_SESSION['pageInfo'] : null;
$category = isset($_REQUEST['category']) ? $_REQUEST['category'] : null;
$productInfo = isset($_SESSION['productInfo']) ? $_SESSION['productInfo'] : null;
?>

<div class="content">
<ul class="listArea clx">
<?php
include_once "./common/selectSearchOption.php";
if( !$productInfo ) {
    echo "<span style='font-size: 30px;'>登録された商品がありません。</span>";
} else {
    $countWholeProduct = count($productInfo);
    if ( strrpos($category, "_") ) {
        $nowCategoryArr = explode('_', $category);
        $nowCategory = $nowCategoryArr[0];
    } else {
        $nowCategory = $category;
    }
    for ( $iCount = 0; $iCount < $countWholeProduct; $iCount++ ) {
        echo "<li>";
        echo "<div class='unit'>";
        echo "<a href='../controller/mainCTL.php?action=$action&category=$category&pageNum={$_REQUEST['pageNum']}&productNum={$productInfo[$iCount]['p_num']}'>";
        echo "<img class='img-rounded' src='../../img/product/$nowCategory/{$productInfo[$iCount]['p_simage']}' alt='{$productInfo[$iCount]['p_name']}'></a>";
        echo "<div class='star'>";
        echo "<span class='rating'>";
        echo "<p>評点 : <span style='width: 64px;'>4.7 / 5.0</span></p>";
        echo "</span><p>レビュー数 : 116</p>";
        echo "</div>";
        echo "<a href='#' class='info'>";
        echo "<span class='name'>{$productInfo[$iCount]['p_name']}</span>";
        echo "<span class='loca'>{$productInfo[$iCount]['p_category']}</span>";
        echo "<span class='price'>";
        echo number_format($productInfo[$iCount]['p_price']);
        echo "</span>";
        echo "</a>";
        echo "</div>";
        echo "</li>";
    }
}
?>
</ul>
</div>

<?php
include_once "./common/pagenation.php";
setPageNation($action, $pageInfo, $category);
?>
