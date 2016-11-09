<?php
if ( !isset($_SESSION) ) session_start();
include_once "memberCTL.php";
include_once "productCTL.php";
include_once "adminCTL.php";
include_once "boardCTL.php";

if( !$_SESSION['nowActionValue'] ) $_SESSION['nowActionValue'] = 100;
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 110;
$is_Login = isset($_SESSION['now_user']) ? $_SESSION['now_user'] : null;
$is_level = isset($_SESSION['level']) ? $_SESSION['level'] : null;
$productNum = isset($_REQUEST['productNum']) ? $_REQUEST['productNum'] : null;
$postNum = isset($_REQUEST['postNum']) ? $_REQUEST['postNum'] : null;
$mode = isset($_REQUEST['mode']) ? $_REQUEST['mode'] : null;
$mainSelection = intval($action/100);

switch ( $mainSelection ) {
    case 0: // 회원가입 & 로그인 처리
        memberProcessing($action);
        break;

    case 1: // By Brand 제품 소개 페이지
        if ( !$productNum ) {
            productListProcessing($action);
        } else {
            productViewProcessing($action);
        }
        break;

    case 2: // Women 제품 소개 페이지
        if ( !$productNum ) {
            productListProcessing($action);
        } else {
            productViewProcessing($action);
        }
        break;

    case 3: // Man 제품 소개 페이지
        if ( !$is_Login || $is_level < 3 ) {
            $msg = "レベル3以上だけアクセスすることができます！";
            echo "<script>alert('{$msg}'); history.back();</script>";
        } else {
            if ( !$productNum ) {
                productListProcessing($action);
            } else {
                productViewProcessing($action);
            }
        }
        break;

    case 4: // Bag & Acc 제품 소개 페이지
        if ( !$is_Login || $is_level < 6 ) {
            $msg = "レベル6以上だけアクセスすることができます！";
            echo "<script>alert('{$msg}'); history.back();</script>";
        } else {
            if ( !$productNum ) {
                productListProcessing($action);
            } else {
                productViewProcessing($action);
            }
        }
        break;

    case 5: // Outdoor 제품 소개 페이지
        if ( !$is_Login || $is_level < 10 ) {
            $msg = "レベル10以上だけアクセスすることができます！";
            echo "<script>alert('{$msg}'); history.back();</script>";
        } else {
            if ( !$productNum ) {
                productListProcessing($action);
            } else {
                productViewProcessing($action);
            }
        }
        break;

    case 6: // 자유게시판
        if ( !$postNum ) {
            boardListProcessing($action);
        } else {
            switch ( $mode ) {
                case "modifyPost" :
                    postModifyProcessing($action);
                    break;

                case "deletePost" :
                    postDeleteProcessing($action);
                    break;

                case "insertResponsePost" :
                    responsePostInsertProcessing($action);
                    break;

                case "registerResponsePost" :
                    responsePostRegisterProcessing($action);
                    break;

                case "insertComment" :
                    commentInsertProcessing($action);
                    break;

                case "deleteComment" :
                    commentDeleteProcessing($action);
                    break;

                case "modifyComment" :
                    commentModifyProcessing($action);
                    break;

                default :
                    boardViewProcessing($action);
                    break;
            }
        }
        break;

    case 9: // 관리자 처리
        adminProcessing($action);
        break;

    default:
        header("Location: ../view/MainView.php?action=$action");
        break;
}
?>
