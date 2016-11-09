<?php
include_once "commonLIB.php";

function getProductCategory( $argCategory, $argPageInfo, $argSelectSearch ) {
    $db_conn = DBConnectionProcess();
    $sql = "SELECT * FROM product WHERE p_category like '$argCategory' ORDER BY {$argSelectSearch} limit {$argPageInfo['startRecord']}, {$argPageInfo['pagePerRecord']}";
    var_dump($sql);
    $selectresult = mysqli_query($db_conn, $sql);

    $cnt = 0;
    while ( $row = mysqli_fetch_assoc($selectresult) ) {
        $returnValue[$cnt] = $row;
        $cnt++;
    }

    return $returnValue;
}

function getCountProductCategory( $argCategory ) {
    $db_conn = DBConnectionProcess();
    $sql = "SELECT COUNT(*) FROM product WHERE p_category like '$argCategory'";
    $result = mysqli_query($db_conn, $sql);
    $returnValue = mysqli_fetch_row($result);

    return $returnValue[0];
}

function getCountSearchProductCategory( $argCategory, $argSelectSearch ) {
    $db_conn = DBConnectionProcess();
    $sql = "SELECT COUNT(*) FROM product WHERE p_category like '$argCategory' ORDER BY " . strval($argSelectSearch);
    $result = mysqli_query($db_conn, $sql);
    $returnValue = mysqli_fetch_row($result);

    return $returnValue[0];
}

function getSelectedProductInfo( $argProductNum ) {
    $db_conn = DBConnectionProcess();
    $sql = "SELECT * FROM product WHERE p_num = $argProductNum";
    $selectResult = mysqli_query($db_conn, $sql);

    while ( $row = mysqli_fetch_assoc($selectResult) ) {
        $selectedProductInfo = $row;
    }

    return $selectedProductInfo;
}

function getViewedProductInfo( $argProductNum ) {
    $db_conn = DBConnectionProcess();
    $sql = "SELECT p_num, p_category, p_name, p_price, p_simage FROM product WHERE p_num = " . strval($argProductNum);
    $selectRseult = mysqli_fetch_assoc(mysqli_query($db_conn, $sql));

    mysqli_close($db_conn);
    return $selectRseult;
}
?>