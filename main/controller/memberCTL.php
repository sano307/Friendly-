<?php
if ( !isset($_SESSION) ) session_start();
include_once "../model/memberDAO.php";

function memberProcessing( $argAction ) {
    switch ( $argAction ) {
        case 11:    // 회원가입 클릭
            header("Location: ../view/MainView.php?action=12&mode=signUp");
            break;

        case 12:    // 회원정보 입력
            $insertMemberInfo['m_id'] = isset($_REQUEST['m_id']) ? $_REQUEST['m_id'] : null;
            $insertMemberInfo['m_nickname'] = isset($_REQUEST['m_nickname']) ? $_REQUEST['m_nickname'] : null;
            $insertMemberInfo['m_password'] = isset($_REQUEST['m_password']) ? $_REQUEST['m_password'] : null;
            $insertMemberInfo['m_name'] = isset($_REQUEST['m_name']) ? $_REQUEST['m_name'] : null;
            $insertMemberInfo['m_tel'] = isset($_REQUEST['m_tel']) ? $_REQUEST['m_tel'] : null;

            if ( $insertMemberInfo['m_id'] == null ) {
                header("Location: ../view/member/alert/ms_alert.php?error=emptyID");
            }  elseif ( $insertMemberInfo['m_nickname'] == null ) {
                header("Location: ../view/member/alert/ms_alert.php?error=emptyNickname");
            } elseif ($insertMemberInfo['m_password'] == null ) {
                header("Location: ../view/member/alert/ms_alert.php?error=emptyPassword");
            } elseif ( $insertMemberInfo['m_name'] == null ) {
                header("Location: ../view/member/alert/ms_alert.php?error=emptyName");
            } else {
                $result = getIsmemberCheck($insertMemberInfo);

                switch ( $result['errorCheck'] ) {
                    case 1:
                        header("Location: ../view/member/alert/ms_alert.php?error=sameIDExist");
                        break;

                    case 2:
                        setRegisterMember($insertMemberInfo);
                        header("Location: ../view/member/alert/ms_alert.php?error=signUpSuccess");
                        break;
                }
            }
            break;

        case 13:    // 로그인 처리
            $m_id       = isset($_REQUEST['m_id']) ? $_REQUEST['m_id'] : null;
            $m_password = isset($_REQUEST['m_password']) ? $_REQUEST['m_password'] : null;

            if ( $m_id == null ) {
                header("Location: ../view/member/alert/ms_alert.php?error=emptyID");
            } elseif ( $m_password == null ) {
                header("Location: ../view/member/alert/ms_alert.php?error=emptyPassword");
            } else {
                $result = getMemberIdentification($m_id, $m_password);

                if ( $result['errorCheck'] == 1 ) {
                    $temp = getMemberNicknameByid($m_id);
                    $nicknameOfnowUser = $temp['m_nickname'];
                    $_SESSION['now_user'] = $nicknameOfnowUser;
                    $_SESSION['level']    = $result['level'];
                    if ( $_SESSION['level'] == 999 ) {
                        header("Location: ../view/member/alert/ms_alert.php?error=loginManager");
                    } else {
                        $result = getNowMemberBasketInfo($_SESSION['now_user']);
                        // 로그인한 유저의 장바구니 정보가 있다면,
                        if ( $result ) {
                            $currentTime = date(time());    // 로그인 한 시간
                            $basketTime = getNowUserBasketTime($_SESSION['now_user']);  // 장바구니에 마지막으로 상품을 담은 시간

                            // 장바구니에 마지막으로 상품을 담은 시간에서 24시간이 지났다면 장바구니의 정보를 삭제하라.
                            if ( $currentTime > (strtotime($basketTime) + 43200) ) {
                                deleteNowUserBasketInfo($_SESSION['now_user']);
                            }
                        }

                        unset($_SESSION['upToThePresentViewedProduct']);
                        unset($_SESSION['viewedProductInfo']);
                        header("Location: ../view/member/alert/ms_alert.php?error=loginUser");
                    }
                } elseif ( $result['errorCheck'] == -1 ) {
                    header("Location: ../view/member/alert/ms_alert.php?error=wrongPassword");
                } elseif ( $result['errorCheck'] == -2 ) {
                    header("Location: ../view/member/alert/ms_alert.php?error=notExistID");
                }
            }
            break;

        case 14:    // 로그아웃 처리
            unset($_SESSION['now_user']);
            unset($_SESSION['level']);
            unset($_SESSION['nowUserBasketInfo']);
            unset($_SESSION['upToThePresentViewedProduct']);
            unset($_SESSION['viewedProductInfo']);

            header("Location: ../view/member/alert/ms_alert.php?error=logoutSuccess");
            break;

        case 15:    // 회원정보수정 클릭
            header("Location: ./mainCTL.php?action=16");
            break;

        case 16:    // 회원정보수정 처리
            break;

        case 17:    // 장바구니 담기 처리
            $nowProductActionValue = $_REQUEST['nowAction'];
            $nowCategory = $_REQUEST['category'];
            $nowPageNum = $_REQUEST['pageNum'];
            $nowMode = $_REQUEST['mode'];
            $nowProductNum = $_REQUEST['productNum'];
            $purcharsesNum = $_REQUEST['quantityOfpurchases'];

            $result = getNowSeletedProductStock($nowProductNum);
            if ( $purcharsesNum > $result ) {
                header("Location: ../view/member/alert/mpb_alert.php?error=exceedQuantity");
            } else {
                $result = getNowMemberBasketInfo($_SESSION['now_user']);
                // 만약, 현재 유저의 장바구니가 비어있다면,
                if ( !$result ) {
                    $nowProduct = array();
                    $nowProduct[$nowProductNum] = $purcharsesNum;
                } else {  // 현재 유저의 장바구니가 비어있지 않다면,
                    $nowProduct = unserialize($result);
                    $nowProduct = setBasketInfo($nowProduct, $nowProductNum, $purcharsesNum, $nowMode);
                }
                $temp = serialize($nowProduct);
                setNowUserBasketInfo($_SESSION['now_user'], $temp);

                $iCount = 0;
                foreach($nowProduct as $argProductNum => $argPurchasesNum) {
                    $nowbasketInfo[$iCount] = getProductInfoInbasket($argProductNum);
                    $nowbasketInfo[$iCount]['p_purchasingQuantity'] = $argPurchasesNum;
                    $iCount++;
                }

                $_SESSION['nowUserBasketInfo'] = $nowbasketInfo;

                header("Location: ../controller/mainCTL.php?action=$nowProductActionValue&category=$nowCategory&pageNum=$nowPageNum");
            }
            break;

        case 18:    // 장바구니 수정 클릭
            break;

        case 19:    // 장바구니 수정 처리
            break;

        case 20:    // 장바구니 삭제 처리
            $nowProductNum = isset($_REQUEST['productNum']) ? $_REQUEST['productNum'] : null;
            $nowMode = isset($_REQUEST['mode']) ? $_REQUEST['mode'] : null;

            $result = getNowMemberBasketInfo($_SESSION['now_user']);
            $nowProduct = unserialize($result);
            $nowProduct = setBasketInfo($nowProduct, $nowProductNum, '', $nowMode);

            $temp = serialize($nowProduct);
            setNowUserBasketInfo($_SESSION['now_user'], $temp);

            $iCount = 0;
            foreach($nowProduct as $argProductNum => $argPurchasesNum) {
                $nowbasketInfo[$iCount] = getProductInfoInbasket($argProductNum);
                $nowbasketInfo[$iCount]['p_purchasingQuantity'] = $argPurchasesNum;
                $iCount++;
            }

            $_SESSION['nowUserBasketInfo'] = $nowbasketInfo;

            header("Location: ../controller/mainCTL.php?action=22");
            break;

        case 21:    // 장바구니 구매 처리
            $paymentUser = $_SESSION['now_user'];
            $paymentProductInfo = $_SESSION['nowUserBasketInfo'];
            $paymentTotalAmount = $_REQUEST['wholePrice'];

            //var_dump($paymentProductInfo[0]['p_purchasingQuantity']);
            $paymentList = "";
            $paymentQuantity = "";
            $cnt = count($paymentProductInfo);
            for ( $iCount = 0; $iCount < $cnt; $iCount++ ) {
                $argProductStock = getNowSeletedProductStock($paymentProductInfo[$iCount]['p_num']);
                if ( $paymentProductInfo[$iCount]['p_purchasingQuantity'] > $argProductStock ) {
                    header("Location: ../view/member/alert/mph_alert.php?error=$paymentProductInfo[$iCount]['p_name']&quantity=$argProductStock");
                }

                if ( $iCount == 0 ) {
                    $paymentList = $paymentProductInfo[$iCount]['p_name'];
                    $paymentQuantity = $paymentProductInfo[$iCount]['p_purchasingQuantity'];
                } else {
                    $paymentList .= "," . $paymentProductInfo[$iCount]['p_name'];
                    $paymentQuantity .= "," . $paymentProductInfo[$iCount]['p_purchasingQuantity'];
                }
            }

            for ( $iCount = 0; $iCount < $cnt; $iCount++ ) {
                setProductPayment($paymentProductInfo[$iCount]);
            }

            // 주문번호, 주문일자, 상품명, 결제금액과 수량, 진행상태
            setMemberPayment($paymentUser, $paymentList, $paymentQuantity, $paymentTotalAmount);
            setEmptyUserBasketInfo($paymentUser);
            unset($_SESSION['nowUserBasketInfo']);

            header("Location: ../view/MainView.php?action=23&mode=productBasket");
            break;

        case 22:    // 장바구니 클릭
            $result = getNowUserBasketInfo($_SESSION['now_user']);
            $nowProduct = unserialize($result);

            $iCount = 0;
            foreach($nowProduct as $argProductNum => $argPurchasesNum) {
                $nowbasketInfo[$iCount] = getProductInfoInbasket($argProductNum);
                $nowbasketInfo[$iCount]['p_purchasingQuantity'] = $argPurchasesNum;
                $iCount++;
            }

            $_SESSION['nowUserBasketInfo'] = $nowbasketInfo;

            header("Location: ../view/MainView.php?action=23&mode=productBasket");
            break;

        case 23:    // 결제내역 클릭
            $_SESSION['nowUserPaymentInfo'] = getNowUserPaymentInfo($_SESSION['now_user']);
            header("Location: ../view/MainView.php?action=24&mode=paymentHistory");
            break;

        default:
            header("Location: ../view/MainView.php?action=$argAction");
            break;
    }
}


?>