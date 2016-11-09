<?php
$mainMenuShortNum = intval($action/100);
$mainMenuSelectNum = intval($action%100);

if ( @!$_SESSION['admin_mainMenuName'] ) {
    $_SESSION['admin_mainMenuName'] = array(
        900 => "会員管理", 910 => "商品管理", 920 => "購買管理",
        930 => "決済管理", 940 => "配送管理", 950 => "売り上げの管理",
        960 => "掲示板の管理",
    );
}

echo "<div id='cssmenu'>";

$adminMainMenuCount = count($_SESSION['admin_mainMenuName']);
for ( $iCount = 0; $iCount < $adminMainMenuCount; $iCount++ ) {
    $codeNum = ($mainMenuShortNum * 100) + ($iCount * 10);
    echo "<ul>";

    if ( $mainMenuSelectNum == ($iCount * 10) ) {
        echo "<li class = 'active'>";
    } else {
        echo "<li>";
    }

    echo "<a href = '../controller/mainCTL.php?action=$codeNum&category={$_SESSION['admin_mainMenuName'][$codeNum]}'>" . "{$_SESSION['admin_mainMenuName'][$codeNum]}" . "</a>";
    echo "</li>";
    echo "</ul>";
}
echo "</div>";
?>
