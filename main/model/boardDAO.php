<?php
include_once "commonLIB.php";

function getCountWholeBoard() {
    $db_conn = DBConnectionProcess();
    $sql = "SELECT COUNT(*) FROM freeboard";
    $selectResult = mysqli_query($db_conn, $sql);
    $countResult = mysqli_fetch_row($selectResult);

    return $countResult[0];
}

function getNowPageBoardInfo( $argPageInfo ) {
    $db_conn = DBConnectionProcess();
    $sql = "SELECT f.f_num, f.f_mnum, f.f_subject, f.f_content, f.f_registdate, f.f_updatedate, f.f_hitcount, f.f_ishtml, m.m_nickname ";
    $sql .= "FROM member m, freeboard f ";
    $sql .= "WHERE m.m_num = f.f_mnum ";
    $sql .= "ORDER BY f_groupnum DESC ";
    $sql .= "LIMIT " . strval($argPageInfo['startRecord']) . "," . strval($argPageInfo['pagePerRecord']);
    $selectResult = mysqli_query($db_conn, $sql);

    $cnt = 0;
    while ( $row = mysqli_fetch_assoc($selectResult) ) {
        $boardInfo[$cnt] = $row;
        $cnt++;
    }

    return $boardInfo;
}

function getCertainPostInfo( $argPostNum ) {
    $db_conn = DBConnectionProcess();
    $sql = "SELECT f.f_num, f.f_mnum, f.f_subject, f.f_content, f.f_registdate, f.f_hitcount, f.f_ishtml, f.f_updatedate, m.m_nickname ";
    $sql .= "FROM member m, freeboard f ";
    $sql .= "WHERE m.m_num = f.f_mnum ";
    $sql .= "AND f_num = " . strval($argPostNum);
    $selectResult = mysqli_query($db_conn, $sql);

    while ( $row = mysqli_fetch_assoc($selectResult) ) {
        $certainPostInfo = $row;
    }

    mysqli_close($db_conn);
    return $certainPostInfo;
}

function setCertainPostInfo( $argPostInfo ) {
    $db_conn = DBConnectionProcess();
    $sql = "UPDATE freeboard SET f_subject = '" . strval($argPostInfo['postSubject']) . "', f_content = '" . strval($argPostInfo['postContent']) . "', f_updatedate = now() WHERE f_num = " .strval($argPostInfo['postNum']);
    $updateResult = mysqli_query($db_conn, $sql);
    var_dump($sql);

    mysqli_close($db_conn);
    return $updateResult;
}

function getCountCertainCommentInfo ( $argPostNum ) {
    $db_conn = DBConnectionProcess();
    $sql = "SELECT COUNT(*) FROM free_reply WHERE fr_fnum = " . strval($argPostNum);
    $selectResult = mysqli_query($db_conn, $sql);
    $countResult = mysqli_fetch_row($selectResult);

    mysqli_close($db_conn);
    return $countResult[0];
}

function getCertainCommentInfo ( $argPostNum, $argPageInfo ) {
    $db_conn = DBConnectionProcess();
    $sql = "SELECT fr.fr_num, fr.fr_mnum, fr.fr_fnum, fr.content, fr.registdate, fr.updatedate, m.m_nickname ";
    $sql .= "FROM member m, free_reply fr ";
    $sql .= "WHERE m.m_num = fr.fr_mnum ";
    $sql .= "AND fr.fr_fnum = " . strval($argPostNum) . " ORDER BY fr.registdate DESC ";
    $sql .= "LIMIT " . strval($argPageInfo['startRecord']) . ", " . strval($argPageInfo['pagePerRecord']);
    $selectResult = mysqli_query($db_conn, $sql);

    $cnt = 0;
    while ( $row = mysqli_fetch_assoc($selectResult) ) {
        $commentInfo[$cnt] = $row;
        $cnt++;
    }

    mysqli_close($db_conn);
    return $commentInfo;
}

// 게시판에 새로운 게시글을 작성할 때, 첨부한 이미지 파일에 들어갈 고유번호 중 게시글 번호를 리턴
function getNewInsertBoardNum ( $arg ) {

}

function setCertainPostHitcount ( $argPostNum ) {
    $db_conn = DBConnectionProcess();
    $sql = "UPDATE freeboard SET f_hitcount = f_hitcount + 1 WHERE f_num = " . strval($argPostNum);
    $updateResult = mysqli_query($db_conn, $sql);

    mysqli_close($db_conn);
    return $updateResult;
}

function getUserNumOfNowNickname( $argNickname ) {
    $db_conn = DBConnectionProcess();
    $sql = "SELECT m_num FROM member WHERE m_nickname = '" .strval($argNickname) . "'";
    $selectResult = mysqli_fetch_assoc(mysqli_query($db_conn, $sql));

    mysqli_close($db_conn);
    return $selectResult['m_num'];
}

function insertNewPostInfo ( $argInsertPostInfo ) {
    $db_conn = DBConnectionProcess();
    $sql = "INSERT INTO freeboard (f_mnum, f_subject, f_content, f_registdate, f_ishtml) VALUES ('";
    $sql .= strval($argInsertPostInfo['f_mnum']) . "','" . strval($argInsertPostInfo['f_subject']) . "','" . strval($argInsertPostInfo['f_content']) . "', now(), '0')";
    $insertResult = mysqli_query($db_conn, $sql);

    mysqli_close($db_conn);
    return $insertResult;
}

function insertNewCommentInfo ( $argInsertCommentInfo ) {
    $db_conn = DBConnectionProcess();
    $sql = "INSERT INTO free_reply (fr_mnum, fr_fnum, content, registdate) VALUES (";
    $sql .= strval($argInsertCommentInfo['fr_mnum']) . "," . strval($argInsertCommentInfo['fr_fnum']) . ",'" . strval($argInsertCommentInfo['fr_content']) . "', now())";
    $insertResult = mysqli_query($db_conn, $sql);

    mysqli_close($db_conn);
    return $insertResult;
}

function deleteSelectedCommentInfo ( $argCommentNum ) {
    $db_conn = DBConnectionProcess();
    $sql = "DELETE FROM free_reply WHERE fr_num = " . strval($argCommentNum);
    $deleteResult = mysqli_query($db_conn, $sql);

    mysqli_close($db_conn);
    return $deleteResult;
}

function setSeletedCommentInfo ( $argCommentInfo ) {
    $db_conn = DBConnectionProcess();
    $sql = "UPDATE free_reply SET content = '" . strval($argCommentInfo['modifyCommentContent']) . "' , updatedate = now() WHERE fr_num = " . strval($argCommentInfo['commentNum']);
    $updateResult = mysqli_query($db_conn, $sql);

    mysqli_close($db_conn);
    return $updateResult;
}

function countWholeComment () {
    $db_conn = DBConnectionProcess();
    $sql = "SELECT COUNT(*) FROM free_reply";
    $seleteResult = mysqli_fetch_row(mysqli_query($db_conn, $sql));

    return $seleteResult[0];
}

function getNewPostNum() {
    $db_conn = DBConnectionProcess();
    $sql = "SELECT f_num FROM freeboard ORDER BY f_num DESC LIMIT 1";
    $selectResult = mysqli_fetch_assoc(mysqli_query($db_conn, $sql));

    mysqli_close($db_conn);
    return $selectResult['f_num'];
}

function setNewPostInfo( $argPostNum ) {
    $db_conn = DBConnectionProcess();
    $sql = "UPDATE freeboard SET f_groupnum = " . strval($argPostNum) . ", f_indentnum = 1 WHERE f_num = " . strval($argPostNum);
    $updateResult = mysqli_query($db_conn, $sql);

    mysqli_close($db_conn);
    return $updateResult;
}

function deleteCommentInpost( $argPostNum ) {
    $db_conn = DBConnectionProcess();
    $sql = "DELETE FROM free_reply WHERE fr_fnum = " . strval($argPostNum);
    $deleteResult = mysqli_query($db_conn, $sql);

    mysqli_close($db_conn);
    return $deleteResult;
}

function deleteNowPost( $argPostNum ) {
    $db_conn = DBConnectionProcess();
    $sql = "DELETE FROM freeboard WHERE f_num = " . strval($argPostNum);
    $deleteResult = mysqli_query($db_conn, $sql);

    mysqli_close($db_conn);
    return $deleteResult;
}

function getIndentNum( $argPostNum ) {
    $db_conn = DBConnectionProcess();
    $sql = "SELECT f_indentnum FROM freeboard WHERE f_groupnum = " . strval($argPostNum) . " ORDER BY f_indentNum DESC limit 1";
    $selectResult = mysqli_fetch_assoc(mysqli_query($db_conn, $sql));

    mysqli_close($db_conn);
    return $selectResult['f_indentnum'];
}

function getGroupNum( $argPostNum ) {
    $db_conn = DBConnectionProcess();
    $sql = "SELECT f_groupnum FROM freeboard WHERE f_num = " . strval($argPostNum) . " limit 1";
    $selectResult = mysqli_fetch_assoc(mysqli_query($db_conn, $sql));

    mysqli_close($db_conn);
    return $selectResult['f_groupnum'];
}

function insertNewResponsePostInfo( $argUserNum, $argGroupNum, $argIndentNum, $argSubject, $argContent ) {
    $db_conn = DBConnectionProcess();
    $sql = "INSERT INTO freeboard VALUES (null, " . strval($argUserNum) . ", '" . strval($argSubject) . "', '" . strval($argContent) . "', now(), 0, '0', '', " . strval($argGroupNum) . ", " . strval($argIndentNum + 1) . ")";
    $insertResult = mysqli_query($db_conn, $sql);
    var_dump($sql);

    mysqli_close($db_conn);
    return $insertResult;
}
?>