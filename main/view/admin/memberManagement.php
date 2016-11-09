<?php
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;
$pageInfo = isset($_SESSION['pageInfo']) ? $_SESSION['pageInfo'] : null;
$category = isset($_REQUEST['category']) ? $_REQUEST['category'] : null;
$adminInfo = isset($_SESSION['adminInfo']) ? $_SESSION['adminInfo'] : null;

if( !$adminInfo ) {
    echo "<span>会員がないです。</span>";
} else {
    ?>
    <table class="table table-hover" style="font-size:18px;">
        <thead>
        <tr>
            <th>番号</th>
            <th>アイディー</th>
            <th>パスワード</th>
            <th>名前</th>
            <th>連絡先</th>
            <th>レベル</th>
            <th>ニックネーム</th>
            <th>B</th>
            <th>BT</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($adminInfo as $member) {
            echo "<tr>";
            foreach ($member as $myKey => $myValue) {
                if ($myKey == "m_nickname") {
                    $temp = $myValue;
                }

                if ( $myKey == "m_password" || $myKey == "m_tel" || $myKey == "m_basketInfo" || $myKey == "m_basketTime" ) {
                    $myValue = strlen($myValue) > 6 ? substr($myValue, 0, 6) . "..." : $myValue;
                }
                echo "<td>";
                echo "$myValue";
                echo "</td>";
            }

            if ($temp == $_SESSION['now_user']) {
                echo "<td><a href=../controller/mainCTL.php?action=904&memberNum={$member['m_num']} class='btn btn-warning btn-block' role='button' style='margin: 0 auto; padding: 0; font-size: 18px'>修正</a></td>";
                echo "<td><a href=../controller/mainCTL.php?action=906&memberNum={$member['m_num']} class='btn btn-danger btn-block disabled' role='button' style='margin: 0 auto; padding: 0; font-size: 18px' onclick='return confirm_delete();'>削除</a></td>";
            } else {
                echo "<td><a href=../controller/mainCTL.php?action=904&memberNum={$member['m_num']} class='btn btn-warning btn-block' role='button' style='margin: 0 auto; padding: 0; font-size: 18px'>修正</a></td>";
                echo "<td><a href=../controller/mainCTL.php?action=906&memberNum={$member['m_num']} class='btn btn-danger btn-block' role='button' style='margin: 0 auto; padding: 0; font-size: 18px' onclick='return confirm_delete();'>削除</a></td>";
            }
            ?>
            <script>
                function confirm_delete() {
                    return confirm("削除しますか？");
                }
            </script>
            <?php
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
    <?php
}
include_once "./common/pagenation.php";
setPageNation($action, $pageInfo, $category);

include_once "./common/searchAdminMember.php";
?>
