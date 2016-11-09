<?php
include_once "commonLIB.php";

function getWholeMemberInfo() {
    $db_conn = DBConnectionProcess();
    $sql = "SELECT * FROM member";
    $result = mysqli_query($db_conn, $sql);

    $cnt = 0;
    while ( $row = mysqli_fetch_assoc($result) ) {
        $memberInfo[$cnt]['m_num'] = $row['m_num'];
        $memberInfo[$cnt]['m_id'] = $row['m_id'];
        $memberInfo[$cnt]['m_password'] = $row['m_password'];
        $memberInfo[$cnt]['m_name'] = $row['m_name'];
        $memberInfo[$cnt]['m_tel'] = $row['m_tel'];
        $memberInfo[$cnt]['m_level'] = $row['m_level'];
        $cnt++;
    }
    return $memberInfo;
}
function getCountAdminSearch( $argTable, $argSearchSubject, $argSearchWord ) {
    $db_conn = DBConnectionProcess();
    $sql = "SELECT COUNT(*) FROM " . strval($argTable) . " WHERE " . strval($argSearchSubject) . " like '" . strval($argSearchWord) . "'";
    $selectResult = mysqli_query($db_conn, $sql);
    $countResult = mysqli_fetch_row($selectResult);

    return $countResult[0];
}

function getCountAdminCategory( $argTable ) {
    $db_conn = DBConnectionProcess();
    $sql = "SELECT COUNT(*) FROM ".strval($argTable);
    $selectResult = mysqli_query($db_conn, $sql);
    $countResult = mysqli_fetch_row($selectResult);

    return $countResult[0];
}
function getAdminSearch( $argTable, $argOrderByOption, $argSearchSubject, $argSearchWord, $argPageInfo ) {
    $db_conn = DBConnectionProcess();
    $sql = "SELECT * FROM ".strval($argTable)." WHERE ".strval($argSearchSubject)." like '".strval($argSearchWord)."' ORDER BY ".strval($argOrderByOption)." DESC limit ".strval($argPageInfo['startRecord']).", ".strval($argPageInfo['pagePerRecord']);
    $selectResult = mysqli_query($db_conn, $sql);

    $cnt = 0;
    while ( $row = mysqli_fetch_assoc($selectResult) ) {
        $adminRecordInfo[$cnt] = $row;
        $cnt++;
    }

    return $adminRecordInfo;
}

function getAdminCategory( $argTable, $argOrderByOption,  $argPageInfo ) {
    $db_conn = DBConnectionProcess();
    $sql = "SELECT * FROM ".strval($argTable)." ORDER BY ".strval($argOrderByOption)." DESC limit ".strval($argPageInfo['startRecord']).", ".strval($argPageInfo['pagePerRecord']);
    $selectResult = mysqli_query($db_conn, $sql);

    $cnt = 0;
    while ( $row = mysqli_fetch_assoc($selectResult ) ) {
        $adminRecordInfo[$cnt] = $row;
        $cnt++;
    }

    return $adminRecordInfo;
}

function getCertainMemberInfo( $argMemberNum ) {
    $db_conn = DBConnectionProcess();
    $sql = "SELECT * FROM member WHERE m_num = ".strval($argMemberNum);
    $result = mysqli_query($db_conn, $sql);

    $cnt = 0;
    while ( $row = mysqli_fetch_assoc($result) ) {
        $certainMemberInfo[$cnt] = $row;
        $cnt++;
    }
    return $certainMemberInfo;
}

function getCertainMemberIdComparison( $argMemberId ) {
    $db_conn = DBConnectionProcess();
    $sql = "SELECT COUNT(*) FROM member WHERE m_id = '" .strval($argMemberId) ."'";
    $selectResult = mysqli_query($db_conn, $sql);
    $countResult = mysqli_fetch_row($selectResult);

    return $countResult[0];
}

function getNewInsertProductNum() {
    $db_conn = DBConnectionProcess();
    $sql = "SELECT p_num FROM product ORDER BY p_num DESC LIMIT 1";
    $selectResult = mysqli_fetch_row(mysqli_query($db_conn, $sql));

    return $selectResult[0];
}

function getModifyProductImageInfo( $argProductNum ) {
    $db_conn = DBConnectionProcess();
    $sql = "SELECT p_fimage FROM product WHERE p_num = " . strval($argProductNum);
    $selectResult = mysqli_fetch_assoc(mysqli_query($db_conn, $sql));

    return $selectResult['p_fimage'];
}

function getProductImageThumbnail( $argProductNum ) {
    $db_conn = DBConnectionProcess();
    $sql = "SELECT p_simage FROM product WHERE p_num = " .strval($argProductNum);
    $selectResult = mysqli_fetch_assoc(mysqli_query($db_conn, $sql));

    return $selectResult['p_simage'];
}

function insertNewMemberInfo( $argNewMemberInfo ) {
    $db_conn = DBConnectionProcess();
    $sql = "INSERT INTO member (m_id, m_password, m_name, m_tel, m_level) ";
    $sql .= "VALUES ('";
    $sql .= strval($argNewMemberInfo['m_id']) . "','" . strval($argNewMemberInfo['m_password']) . "','" . strval($argNewMemberInfo['m_name']) . "','" . strval($argNewMemberInfo['m_tel']) . "','" . strval($argNewMemberInfo['m_level']) ."')";

    $insertResult = mysqli_query($db_conn, $sql);
    return $insertResult;
}

function insertNewProductInfo( $argNewProductInfo, $argNewProductImageName ) {
    $db_conn = DBConnectionProcess();
    $sql = "INSERT INTO product (p_category, p_code, p_name, p_stock, p_price, p_fimage) ";
    $sql .= "VALUES ('";
    $sql .= strval($argNewProductInfo['p_category']) . "','" . strval($argNewProductInfo['p_code']) . "','" . strval($argNewProductInfo['p_name']) . "','" . strval($argNewProductInfo['p_stock']) . "','" . strval($argNewProductInfo['p_price']) . "','" . strval($argNewProductImageName) . "')";

    $insertResult = mysqli_query($db_conn, $sql);
    return $insertResult;
}

function updateNewProductInfo( $argNewProductNum, $argThumnailName ) {
    $db_conn = DBConnectionProcess();
    $sql = "UPDATE product SET p_simage = '" .strval($argThumnailName) . "' WHERE p_num = " . strval($argNewProductNum);
    $updateResult = mysqli_query($db_conn, $sql);

    return $updateResult;
}

function updateProductImage( $argProductNum, $argProductImageName ) {
    $db_conn = DBConnectionProcess();
    $sql = "UPDATE product SET p_fimage = '" . strval($argProductImageName) . "' WHERE p_num = " . strval($argProductNum);
    $updateResult = mysqli_query($db_conn, $sql);

    return $updateResult;
}

function changeProductImage( $argProductNum, $argProductImageName ) {
    $db_conn = DBConnectionProcess();
    $sql = "UPDATE product SET p_fimage = CONCAT(p_fimage, '" . strval($argProductImageName) . "') WHERE p_num = " .strval($argProductNum);
    $updateResult = mysqli_query($db_conn, $sql);

    return $updateResult;
}

function updateProductImageThumbnail( $argProductNum, $argProductImageThumbnailName ) {
    $db_conn = DBConnectionProcess();
    $sql = "UPDATE product SET p_simage = '" . strval($argProductImageThumbnailName) . "' WHERE p_num = " . strval($argProductNum);
    $updateResult = mysqli_query($db_conn, $sql);

    return $updateResult;
}

function setCertainMemberInfo( $argCertainMemberInfo ) {
    $db_conn = DBConnectionProcess();
    $sql = "UPDATE member SET m_password = '".strval($argCertainMemberInfo['m_password'])."',";
    $sql .= "m_name = '".strval($argCertainMemberInfo['m_name'])."',";
    $sql .= "m_tel = '".strval($argCertainMemberInfo['m_tel'])."',";
    $sql .= "m_level = '".strval($argCertainMemberInfo['m_level'])."' ";
    $sql .= "WHERE m_num = ".strval($argCertainMemberInfo['m_num']);

    $updateResult = mysqli_query($db_conn, $sql);
    return $updateResult;
}

function deleteCertainMemberInfo( $argCertainMemberInfo ) {
    $db_conn = DBConnectionProcess();
    $sql = "DELETE FROM member WHERE m_num = '".strval($argCertainMemberInfo['m_num'])."'";
    $deleteResult = mysqli_query($db_conn, $sql);

    return $deleteResult;
}

function getWholeProductInfo() {
    $db_conn = DBConnectionProcess();
    $sql = "SELECT * FROM product";
    $selectResult = mysqli_query($db_conn, $sql);

    $cnt = 0;
    while ( $row = mysqli_fetch_assoc($selectResult) ) {
        $productInfo[$cnt] = $row;
        $cnt++;
    }

     return $productInfo;
}

function getCertainProductInfo ( $argProductNum ) {
    $db_conn = DBConnectionProcess();
    $sql = "SELECT * FROM product WHERE p_num = ".strval($argProductNum);
    $selectResult = mysqli_query($db_conn, $sql);

    $cnt = 0;
    while ( $row = mysqli_fetch_assoc($selectResult) ) {
        $certainProductInfo[$cnt] = $row;
        $cnt++;
    }
    return $certainProductInfo;
}

function setCertainProductInfo ( $argCertainProductInfo ) {
    $db_conn = DBConnectionProcess();
    $sql = "UPDATE product SET p_name = '".strval($argCertainProductInfo['p_name'])."',";
    $sql .= "p_stock = '".strval($argCertainProductInfo['p_stock'])."',";
    $sql .= "p_price = '".strval($argCertainProductInfo['p_price'])."',";
    $sql .= "p_fimage = '".strval($argCertainProductInfo['p_fimage'])."',";
    $sql .= "p_simage = '".strval($argCertainProductInfo['p_simage'])."' ";
    $sql .= "WHERE p_num = ".strval($argCertainProductInfo['p_num']);

    $updateResult = mysqli_query($db_conn, $sql);
    return $updateResult;
}

function deleteCertainProductInfo ( $argCertainProductInfo ) {
    $db_conn = DBConnectionProcess();
    $sql = "DELETE FROM product WHERE p_num = '".strval($argCertainProductInfo['p_num'])."'";
    $deleteResult = mysqli_query($db_conn, $sql);

    return $deleteResult;
}
?>