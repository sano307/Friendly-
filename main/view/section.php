<?php
$sectionShortNum = intval($action/100);

if ( !$productNum ) {
    switch ( $sectionShortNum ) {
        case 0:
            if ( $mode == "signUp" ) {
                include_once "./member/memberSignUp.php";
            } elseif ( $mode == "productBasket" ) {
                include_once "./member/memberProductBasket.php";
            } elseif ( $mode == "paymentHistory" ) {
                include_once "./member/memberPaymentHistory.php";
            }
            break;

        case 1:
            include_once "./product/productList.php";
            break;

        case 2:
            include_once "./product/productList.php";
            break;

        case 3:
            include_once "./product/productList.php";
            break;

        case 4:
            include_once "./product/productList.php";
            break;

        case 5:
            include_once "./product/productList.php";
            break;

        case 6:
            if ( !$postNum ) {
                if ( $mode == "write" ) {
                    include_once "./board/boardInsert.php";
                } else {
                    include_once "./board/boardList.php";
                }
            } else {
                if ( $mode == "modifyPost" ) {
                    include_once "./board/boardModify.php";
                } elseif ( $mode == "insertResponsePost" ) {
                    include_once "./board/boardResponseInsert.php";
                } else {
                    include_once "./board/boardView.php";
                }
            }
            break;

        default:
            break;
    }
} else {
    include_once "./product/productView.php";
}
?>
