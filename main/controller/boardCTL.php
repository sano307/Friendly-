<?php
include_once "../model/commonLIB.php";
include_once "../model/boardDAO.php";

// 게시판 출력 프로세스
function boardListProcessing( $action ) {
    switch ( $action ) {
        case 600:   // 게시물 출력
            // 현재 페이지번호를 받아온다.
            $pageNum = isset($_REQUEST['pageNum']) ? $_REQUEST['pageNum'] : 1;
            unset($_SESSION['nowPostNum']);
            unset($_SESSION['nowCommentInfo']);
            unset($_SESSION['selectedPostInfo']);
            unset($_SESSION['selectedCommentInfo']);
            unset($_SESSION['nowCommentPageNum']);
            unset($_SESSION['pageInfo']);

            // 현재 페이지정보와 페이지의 레코드 정보
            $cnt = getCountWholeBoard();
            $_SESSION['pageInfo'] = getPageInfo($pageNum, $cnt, 10, 10);
            $_SESSION['boardInfo'] = getNowPageBoardInfo($_SESSION['pageInfo']);

            header("Location: ../view/mainView.php?action=$action&pageNum=$pageNum");
            break;

        case 602:   // 게시판에서 글 쓰기 클릭
            $mode = isset($_REQUEST['mode']) ? $_REQUEST['mode'] : null;
            header("Location: ../view/mainView.php?action=$action&mode=$mode");
            break;

        case 603:   // 글 쓰기 후, 글 정보 삽입
            // 세션에 저장되어 있는 현재 사용자의 아이디 정보를 받아와서
            $nowUserNickname = isset($_SESSION['now_user']) ? $_SESSION['now_user'] : null;

            // 현재 사용자의 고유한 번호를 받아온다.
            $nowUserUserNum = getUserNumOfNowNickname($nowUserNickname);
            $insertPostInfo['f_mnum'] = $nowUserUserNum['m_num'];
            $insertPostInfo['f_subject'] = isset($_REQUEST['f_subject']) ? $_REQUEST['f_subject'] : null;
            $insertPostInfo['f_content'] = isset($_REQUEST['f_content']) ? $_REQUEST['f_content'] : null;
            $insertPostImageInfo = $_FILES['fa_uploadfile'];

            $saveFilePath = "../../img/board/";

            $countImages = count($insertPostImageInfo['name']);
/*            $newInsertProductNum = getNewInsertBoardNum() + 1;
            $nowTimeInfo = date("YmdHis", time());
            $insertProductInfo['p_code'] = "BOARD" . $newInsertProductNum . "_" . $nowTimeInfo;*/

            foreach ($insertPostImageInfo["error"] as $key => $error) {
                $message = IsUploadErrorCheck($insertPostImageInfo["error"]);
                echo $message . "<br>";
            }

            $result = insertNewPostInfo($insertPostInfo);
            if ( !$result ) {
                header("Location: ../view/board/alert/bi_alert.php?error=InsertPostInfoFailed");
            } else {
                $newPostNum = getNewPostNum();
                setNewPostInfo($newPostNum);
                header("Location: ../view/board/alert/bi_alert.php?error=InsertPostInfoSucssess");
            }
            break;

        default:
            break;
    }
}

// 특정 게시물을 보여주는 프로세스
function boardViewProcessing( $action ) {
    $pageNum = isset($_REQUEST['pageNum']) ? $_REQUEST['pageNum'] : 1;
    $nowCommentPageNum = isset($_REQUEST['comment_pageNum']) ? $_REQUEST['comment_pageNum'] : 1;
    $_SESSION['nowCommentPageNum'] = $nowCommentPageNum;
    $nowPostNum = $_REQUEST['postNum'];

    if ( !@$_SESSION['nowPostNum'] ) {
        $_SESSION['nowPostNum'] = $nowPostNum;
        setCertainPostHitcount($nowPostNum);
    }

    $_SESSION['selectedPostInfo'] = getCertainPostInfo($nowPostNum);

    $cnt = getCountCertainCommentInfo($nowPostNum);
    $_SESSION['commentpageInfo'] = getPageInfo($nowCommentPageNum, $cnt, 3, 5);
    $_SESSION['commentInfo'] = getCertainCommentInfo($nowPostNum, $_SESSION['commentpageInfo']);
    unset($_SESSION['selectedCommentInfo']);
    header("Location: ../view/MainView.php?action=$action&pageNum=$pageNum&postNum=$nowPostNum&comment_pageNum={$_SESSION['commentpageInfo']['currentPageNum']}");
}

// 특정 게시물 수정 프로세스
function postModifyProcessing( $action ) {
    $nowPostSubject = isset($_REQUEST['postSubject']) ? $_REQUEST['postSubject'] : null;
    $nowPostContent = isset($_REQUEST['postContent']) ? $_REQUEST['postContent'] : null;

    if ( $nowPostSubject && $nowPostContent ) {
        $pageNum = isset($_REQUEST['pageNum']) ? $_REQUEST['pageNum'] : 1;
        $nowMode = isset($_REQUEST['mode']) ? $_REQUEST['mode'] : null;
        $nowPostNum = $_REQUEST['postNum'];

        $_SESSION['selectedPostInfo'] = getCertainPostInfo($nowPostNum);
        header("Location: ../view/MainVIew.php?action=$action&pageNum=$pageNum&postNum=$nowPostNum&mode=$nowMode");

    } else {
        $pageNum = isset($_REQUEST['pageNum']) ? $_REQUEST['pageNum'] : 1;
        $modifyPostInfo['postNum'] = isset($_REQUEST['postNum']) ? $_REQUEST['postNum'] : null;
        $modifyPostInfo['postSubject'] = isset($_REQUEST['modifyPostSubject']) ? $_REQUEST['modifyPostSubject'] : null;
        $modifyPostInfo['postContent'] = isset($_REQUEST['modifyPostContent']) ? $_REQUEST['modifyPostContent'] : null;

        $result = setCertainPostInfo($modifyPostInfo);
        if ( !$result ) {

        } else {
            header("Location: ../controller/mainCTL.php?action=$action&pageNum=$pageNum&postNum={$modifyPostInfo['postNum']}");
        }
    }
}

// 특정 게시물 삭제 프로세스
function postDeleteProcessing( $action ) {
    $pageNum = isset($_REQUEST['pageNum']) ? $_REQUEST['pageNum'] : 1;
    $nowPostNum = $_REQUEST['postNum'];

    deleteCommentInpost($nowPostNum);   // 포스트에 쓰여진 댓글 삭제
    // 포스트에 있는 이미지 삭제
    deleteNowPost($nowPostNum);// 포스트 삭제

    header("Location: ./mainCTL.php?action=$action&pageNum=$pageNum");
}

// 특정 게시물 답글 입력 프로세스
function responsePostInsertProcessing( $action ) {
    $pageNum = isset($_REQUEST['pageNum']) ? $_REQUEST['pageNum'] : 1;
    $nowPostNum = $_REQUEST['postNum'];
    $nowMode = isset($_REQUEST['mode']) ? $_REQUEST['mode'] : null;

    header("Location: ../view/MainView.php?action=$action&pageNum=$pageNum&postNum=$nowPostNum&mode=$nowMode");
}

function responsePostRegisterProcessing( $action ) {
    $pageNum = isset($_REQUEST['pageNum']) ? $_REQUEST['pageNum'] : 1;
    $nowUser = $_SESSION['now_user'];
    $nowPostNum = $_REQUEST['postNum'];
    $nowSubject = $_REQUEST['subject'];
    $nowContent = $_REQUEST['content'];

    $nowIndentNum = getIndentNum($nowPostNum);
    $nowGroupNum = getGroupNum($nowPostNum);
    $nowUserNum = getUserNumOfNowNickname($nowUser);
    insertNewResponsePostInfo($nowUserNum , $nowGroupNum, $nowIndentNum, $nowSubject, $nowContent);

    header("Location: ../controller/mainCTL.php?action=$action&pageNum=$pageNum");
}

// 특정 게시물의 코멘트 입력 프로세스
function commentInsertProcessing( $action ) {
    $pageNum = isset($_REQUEST['pageNum']) ? $_REQUEST['pageNum'] : 1;
    $nowPostCommentInfo['fr_content'] = isset($_REQUEST['content']) ? htmlspecialchars($_REQUEST['content'], ENT_QUOTES) : null;
    $nowPostCommentInfo['fr_fnum'] = isset($_REQUEST['postNum']) ? $_REQUEST['postNum'] : null;
    $nowUserNickname = isset($_SESSION['now_user']) ? $_SESSION['now_user'] : null;
    $nowUserUserNum = getUserNumOfNowNickname($nowUserNickname);
    $nowPostCommentInfo['fr_mnum'] = $nowUserUserNum['m_num'];
    $nowCommentPageNum = isset($_REQUEST['comment_pageNum']) ? $_REQUEST['comment_pageNum'] : 1;

    $result = insertNewCommentInfo($nowPostCommentInfo);
    if ( !$result ) {

    } else {
        header("Location: ./mainCTL.php?action=$action&pageNum=$pageNum&postNum={$_REQUEST['postNum']}&comment_pageNum=$nowCommentPageNum");
    }
}

// 특정 게시물의 특정 댓글 삭제 프로세스
function commentDeleteProcessing( $action ) {
    $pageNum = isset($_REQUEST['pageNum']) ? $_REQUEST['pageNum'] : 1;
    $nowCommentNum = isset($_REQUEST['commentNum']) ? $_REQUEST['commentNum'] : null;
    $nowCommentPageNum = isset($_REQUEST['comment_pageNum']) ? $_REQUEST['comment_pageNum'] : 1;

    $result = deleteSelectedCommentInfo($nowCommentNum);
    if ( !$result ) {

    } else {
        header("Location: ./mainCTL.php?action=$action&pageNum=$pageNum&postNum={$_REQUEST['postNum']}&comment_pageNum=$nowCommentPageNum");
    }
}

// 특정 게시물의 특정 댓글 수정 프로세스
function commentModifyProcessing( $action ) {
    $modifyCommentContent = ($_REQUEST['modifyCommentContent']) ? $_REQUEST['modifyCommentContent'] : null;
    if ( !$modifyCommentContent ) {
        $pageNum = isset($_REQUEST['pageNum']) ? $_REQUEST['pageNum'] : 1;
        $nowCommentInfo['commentNum'] = isset($_REQUEST['commentNum']) ? $_REQUEST['commentNum'] : null;
        $nowCommentInfo['commentContent'] = isset($_REQUEST['commentContent']) ? htmlspecialchars($_REQUEST['commentContent'], ENT_QUOTES) : null;
        $nowCommentInfo['comment_pageNum'] = isset($_SESSION['nowCommentPageNum']) ? $_SESSION['nowCommentPageNum'] : null;

        $_SESSION['nowCommentInfo'] = $nowCommentInfo;
        header("Location: ./mainCTL.php?action=$action&pageNum=$pageNum&postNum={$_REQUEST['postNum']}&comment_pageNum={$nowCommentInfo['comment_pageNum']}");
    } else {
        $pageNum = isset($_REQUEST['pageNum']) ? $_REQUEST['pageNum'] : 1;
        $modifyCommentInfo['commentNum'] = isset($_REQUEST['commentNum']) ? $_REQUEST['commentNum'] : null;
        $modifyCommentInfo['modifyCommentContent'] = isset($_REQUEST['modifyCommentContent']) ? htmlspecialchars($_REQUEST['modifyCommentContent'], ENT_QUOTES) : null;
        $modifyCommentInfo['comment_pageNum'] = isset($_SESSION['nowCommentPageNum']) ? $_SESSION['nowCommentPageNum'] : null;

        $result = setSeletedCommentInfo($modifyCommentInfo);
        if ( !$result ) {

        } else {
            $_SESSION['nowCommentInfo'] = null;
            header("Location: ./mainCTL.php?action=$action&pageNum=$pageNum&postNum={$_REQUEST['postNum']}&comment_pageNum={$modifyCommentInfo['comment_pageNum']}");
        }
    }
}
?>