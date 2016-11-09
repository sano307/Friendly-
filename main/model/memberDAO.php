<?php
include_once "commonLIB.php";

function getMemberIdentification($argInsertID, $argInsertPassword) {
    $db_conn = DBConnectionProcess();
    $sql_main = "SELECT * FROM member WHERE m_id = '".strval($argInsertID)."' AND m_password = '".strval($argInsertPassword)."'";
    $sql_sub  = "SELECT * FROM member WHERE m_id = '".strval($argInsertID)."'";

    $result = mysqli_fetch_assoc(mysqli_query($db_conn, $sql_main));

    if ( $argInsertID &&
        $argInsertID == $result['m_id'] &&
        $argInsertPassword = $result['m_password'] ) {
        $returnValue['level'] = $result['m_level'];
        $returnValue['errorCheck'] = 1;
    } else {
        $result = mysqli_fetch_assoc(mysqli_query($db_conn, $sql_sub));

        if ( $argInsertID && $argInsertID == $result['m_id'] )
            $returnValue['errorCheck'] = -1;
        else
            $returnValue['errorCheck'] = -2;
    }

    mysqli_close($db_conn);
    return $returnValue;
}

function getMemberNicknameByid ( $argInsertID ) {
    $db_conn = DBConnectionProcess();
    $sql = "SELECT m_nickname FROM member WHERE m_id = '" . strval($argInsertID) . "'";
    $selectResult = mysqli_query($db_conn, $sql);

    while ( $row = mysqli_fetch_assoc($selectResult) ) {
        $nicknameOfnowUser = $row;
    }

    mysqli_close($db_conn);
    return $nicknameOfnowUser;
}

function getIsmemberCheck($argTemp) {
    $db_conn = DBConnectionProcess();
    $sql = "SELECT * FROM member WHERE m_id = '".strval($argTemp['m_id'])."'";
    $result = mysqli_num_rows(mysqli_query($db_conn, $sql));

    if ( $result ) {
        $returnValue['errorCheck'] = 1;
    } else {
        $returnValue['errorCheck'] = 2;
    }

    mysqli_close($db_conn);
    return $returnValue;
}

function getNowSeletedProductStock( $argProductNum ) {
    $db_conn = DBConnectionProcess();
    $sql = "SELECT p_stock FROM product WHERE p_num = " . strval($argProductNum);
    $selectResult = mysqli_fetch_assoc(mysqli_query($db_conn, $sql));

    return $selectResult['p_stock'];
}

function getNowMemberBasketInfo( $argMemberNickname ) {
    $db_conn = DBConnectionProcess();
    $sql = "SELECT m_basketInfo FROM member WHERE m_nickname = '" . strval($argMemberNickname) . "'";
    $selectResult = mysqli_fetch_assoc(mysqli_query($db_conn, $sql));

    return $selectResult['m_basketInfo'];
}

function getProductInfoInbasket( $argProductNum ) {
    $db_conn = DBConnectionProcess();
    $sql = "SELECT p_num, p_category, p_name, p_price, p_simage FROM product WHERE p_num = " . strval($argProductNum);
    $selectResult = mysqli_fetch_assoc(mysqli_query($db_conn, $sql));

    return $selectResult;
}

function getNowUserBasketTime( $argUserNickname ) {
    $db_conn = DBConnectionProcess();
    $sql = "SELECT m_basketTime FROm member WHERE m_nickname = '" . strval($argUserNickname) . "'";
    $selectResult = mysqli_fetch_assoc(mysqli_query($db_conn, $sql));

    return $selectResult['m_basketTime'];
}

function getNowUserBasketInfo ( $argUserNickname ) {
    $db_conn = DBConnectionProcess();
    $sql = "SELECT m_basketInfo FROM member WHERE m_nickname = '" . strval($argUserNickname) . "'";
    $selectResult = mysqli_fetch_assoc(mysqli_query($db_conn, $sql));

    return $selectResult['m_basketInfo'];
}
function setRegisterMember($argTemp) {
    $db_conn = DBConnectionProcess();
    $sql = "INSERT INTO member (m_id, m_password, m_name, m_tel, m_nickname) ";
    $sql .= "VALUES ('";
    $sql .= strval($argTemp['m_id']) . "','" . strval($argTemp['m_password']) . "','" . strval($argTemp['m_name']) . "','" . strval($argTemp['m_tel']) . "','" . strval($argTemp['m_nickname']) . "')";

    $resultValue = mysqli_query($db_conn, $sql);
    mysqli_close($db_conn);
    return $resultValue;
}

function setNowUserBasketInfo ( $argUserNickname, $argProductArr ) {
    $db_conn = DBConnectionProcess();
    $sql = "UPDATE member SET m_basketInfo = '" . strval($argProductArr) . "', m_basketTime = now() WHERE m_nickname = '" . strval($argUserNickname) . "'";
    $updateResult = mysqli_query($db_conn, $sql);
    var_dump($sql);

    mysqli_close($db_conn);
    return $updateResult;
}

function setMemberPayment ( $argUserNickname, $argPaymentList, $argCount, $argTotal ) {
    $db_conn = DBConnectionProcess();
    $sql = "INSERT INTO member_payment VALUES (null, now(), '" . strval($argPaymentList) . "', '" . strval($argCount) . "', $argTotal, '결제완료', '" . strval($argUserNickname) . "')";
    $insertResult = mysqli_query($db_conn, $sql);

    mysqli_close($db_conn);
    return $insertResult;
}

function setProductPayment ( $argPaymentInfo ) {
    $db_conn = DBConnectionProcess();
    $sql = "UPDATE product SET p_stock = p_stock - " . strval($argPaymentInfo['p_purchasingQuantity']) . " WHERE p_num = " . strval($argPaymentInfo['p_num']);
    $updateResult = mysqli_query($db_conn, $sql);

    mysqli_close($db_conn);
    return $updateResult;
}

function setEmptyUserBasketInfo ( $argUserNickname ) {
    $db_conn = DBConnectionProcess();
    $sql = "UPDATE member SET m_basketInfo = '', m_basketTime = now() WHERE m_nickname = '" . strval($argUserNickname) . "'";
    $updateResult = mysqli_query($db_conn, $sql);

    mysqli_close($db_conn);
    return $updateResult;
}

function getNowUserPaymentInfo ( $argUserNickname ) {
    $db_conn = DBConnectionProcess();
    $sql = "SELECT * FROM member_payment WHERE mp_userNickname = '" . strval($argUserNickname) . "' ORDER BY mp_num DESC";
    $selectResult = mysqli_query($db_conn, $sql);

    $iCount = 0;
    while ( $row = mysqli_fetch_assoc($selectResult) ) {
        $paymentInfo[$iCount] = $row;
        $iCount++;
    }

    mysqli_close($db_conn);
    return $paymentInfo;
}

function deleteNowUserBasketInfo( $argUserNickname ) {
    $db_conn = DBConnectionProcess();
    $sql = "UPDATE member SET m_basketInfo = '', m_basketTime = now() WHERE m_nickname = '" . strval($argUserNickname) . "'";
    $updateResult = mysqli_query($db_conn, $sql);

    mysqli_close($db_conn);
    return $updateResult;
}
?>