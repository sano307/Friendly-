<?php
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;
$pageInfo = isset($_SESSION['pageInfo']) ? $_SESSION['pageInfo'] : null;
$boardInfo = isset($_SESSION['boardInfo']) ? $_SESSION['boardInfo'] : null;
if( !$boardInfo ) {
    echo "<span style='font-size: 30px;'>作成された文がない</span>";
} else {
    ?>
    <table class="table table-hover" style="font-size:18px;">
        <thead>
        <tr>
            <th>番号</th>
            <th>著者</th>
            <th>タイトル</th>
            <th>登録日</th>
            <th>修正日</th>
            <th>ヒット</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($boardInfo as $board) {
            $nowSubject = strlen($board['f_subject']) > 30 ? substr($board['f_subject'], 0, 30) . "..." : $board['f_subject'];
            echo "<tr>";
            echo "<td>{$board['f_num']}</td>";
            echo "<td>{$board['m_nickname']}</td>";
            echo "<td><a href='../controller/mainCTL.php?action=$action&pageNum={$pageInfo['currentPageNum']}&postNum={$board['f_num']}'>$nowSubject</a></td>";
            echo "<td>{$board['f_registdate']}</td>";
            echo "<td>{$board['f_updatedate']}</td>";
            echo "<td>{$board['f_hitcount']}</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
    <?php
}

include_once "./common/pagenation.php";
setPageNationByBoard($action, $pageInfo);

include_once "./common/writingOption.php";
?>
