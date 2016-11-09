<?php
if ( !isset($_SESSION) ) session_start();
include_once "../model/commonLIB.php";
include_once "../model/productDAO.php";

function productListProcessing( $argAction )
{
    // $_SESSION['mainMenuName']
    // $_SESSION['subMenuName']
    $pageNum = isset($_REQUEST['pageNum']) ? $_REQUEST['pageNum'] : 1;
    $selectMenuNum = intval($argAction / 100);

    if ( isset($_REQUEST['selectSearch']) ) {
        $selectSearch = $_REQUEST['selectSearch'];
        $_SESSION['selectSearch'] = $selectSearch;
    } elseif ( isset($_SESSION['selectSearch']) ) {
        $selectSearch = $_SESSION['selectSearch'];
    } else {
        $selectSearch = "sequenceOfnewer";
    }

    if ( $_SESSION['nowActionValue'] != $argAction ) {
        $selectSearch = "sequenceOfnewer";
        $_SESSION['selectSearch'] = $selectSearch;
        $_SESSION['nowActionValue'] = $argAction;
    }

    $productCategoryArr = array(
        array("BY BRAND" => "brand", "DAKS" => "brand_daks", "HAZZYS" => "brand_hazzys", "IL CORSO" => "brand_ilcorso", "LAFUMA" => "brand_lafuma", "TNGt" => "brand_tngt"),
        array("WOMEN" => "women", "티셔츠" => "women_T-shirt", "셔츠/블라우스" => "women_shirt-blouse", "니트/가디건" => "women_knit-cardigan", "원피스" => "women_dress", "팬츠" => "women_pants"),
        array("MEN" => "man", "티셔츠" => "man_T-shirt", "셔츠" => "man_shirt", "니트/가디건" => "man_knit-cardigan", "팬츠" => "man_pants", "자켓/베스트" => "man_jacket-vest"),
        array("BAG&ACC" => "bag&acc", "여성가방" => "bag&acc_w-bag", "남성가방" => "bag&acc_m-bag"),
        array("OUTDOOR" => "outdoor", "아웃도어 슈즈" => "outdoor_shoes", "아웃도어 가방" => "outdoor_bag", "아웃도어 모자" => "outdoor_hat", "아웃도어 용품" => "outdoor_goods"),
    );

    $productPagePatternArr = array(
        array(4, 5),
        array(4, 5),
        array(4, 5),
        array(4, 5),
        array(4, 5),
    );

    $_SESSION['menuActionValueArr'] = array(
        "brand" => "100", "brand_daks" => "110", "brand_hazzys" => "120", "brand_ilcorso" => "130", "brand_lafuma" => "140", "brand_tngt" => "150",
        "women" => "200", "women_T-shirt" => "210", "women_shirt-blouse" => "220", "women_knit-cardigan" => "230", "women_dress" => "240", "women_pants" => "250",
        "man" => "300", "man_T-shirt" => "310", "man_shirt" => "320", "man_knit-cardigan" => "330", "man_pants" => "340", "man_jacket-vest" => "350",
        "bag&acc" => "400", "bag&acc_w-bag" => "410", "bag&acc_m-bag" => "420",
        "outdoor" => "500", "outdoor_shoes" => "510", "outdoor_bag" => "520", "outdoor_hat" => "530", "outdoor_goods" => "540",
    );

    if ( $argAction % 100 == 0 ) {
        $argCategory = $_SESSION['mainMenuName'][$argAction];
        $selectCategoryName = "%" . $productCategoryArr[$selectMenuNum - 1][$argCategory] . "%";
    } else {
        $argCategory = $_SESSION['subMenuName'][$selectMenuNum][$argAction];
        $selectCategoryName = $productCategoryArr[$selectMenuNum - 1][$argCategory];
    }

    if ( $selectSearch == "sequenceOfnewer" ) {
        $selectSearch = "p_num DESC";
        $cnt = getCountSearchProductCategory($selectCategoryName, $selectSearch);
    } elseif ( $selectSearch == "sequenceOfhigher" ) {
        $selectSearch = "p_price DESC";

        $cnt = getCountSearchProductCategory($selectCategoryName, $selectSearch);
    } elseif ( $selectSearch == "sequenceOflower" ) {
        $selectSearch = "p_price";
        $cnt = getCountSearchProductCategory($selectCategoryName, $selectSearch);
    }

    $_SESSION['pageInfo'] = getPageInfo($pageNum, $cnt, $productPagePatternArr[$selectMenuNum - 1][0], $productPagePatternArr[$selectMenuNum - 1][1]);
    $_SESSION['productInfo'] = getProductCategory($selectCategoryName, $_SESSION['pageInfo'], $selectSearch);

    var_dump($_SESSION['productInfo']);
    if ( $argAction % 100 == 0 ) {
        $selectCategoryName = str_replace("%", "", $selectCategoryName);
    }

    header("Location: ../view/MainView.php?action=$argAction&category=$selectCategoryName&pageNum=$pageNum");
}

function productViewProcessing( $argAction ) {
    $pageNum = isset($_REQUEST['pageNum']) ? $_REQUEST['pageNum'] : 1;
    $nowCategory = isset($_REQUEST['category']) ? $_REQUEST['category'] : null;
    $nowProductNum = $_REQUEST['productNum'];

    if ( !$_SESSION['upToThePresentViewedProduct'] ) {
        $_SESSION['upToThePresentViewedProduct'][0] = $nowProductNum;
    } else {
        $_SESSION['upToThePresentViewedProduct'] = setViewedList( $_SESSION['upToThePresentViewedProduct'], $nowProductNum );
    }

    $cnt = count($_SESSION['upToThePresentViewedProduct']);
    for ( $iCount = 0; $iCount < $cnt; $iCount++ ) {
        $viewedProductInfo[$iCount] = getViewedProductInfo($_SESSION['upToThePresentViewedProduct'][$iCount]);
    }

    $_SESSION['selectedProductInfo'] = getSelectedProductInfo($nowProductNum);
    $_SESSION['viewedProductInfo'] = $viewedProductInfo;
    header("Location: ../view/MainView.php?action=$argAction&category=$nowCategory&pageNum=$pageNum&productNum=$nowProductNum");
}
?>
