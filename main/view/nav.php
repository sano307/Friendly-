<?php
$mainMenuShortNum = intval($action/100);

if ( !@$_SESSION['mainMenuName'] ) {
    $_SESSION['mainMenuName'] = array(
        100 => "BY BRAND", 200 => "WOMEN", 300 => "MEN", 400 => "BAG&ACC", 500 => "OUTDOOR",
        600 => "掲示板",
    );
}

$countMainMenu = count($_SESSION['mainMenuName']);

echo "<div id='cssmenu'>";

for ( $iCount = 0; $iCount < $countMainMenu; $iCount++ ) {
    $codeNum = ($iCount + 1) * 100;
    echo "<ul>";

    if ( $mainMenuShortNum == ($iCount + 1) ) {
        echo "<li class = 'active'>";
    } else {
        echo "<li>";
    }

    if ( $action == 600 ) {
        echo "<a href = '../controller/mainCTL.php?action=$codeNum'>" . "{$_SESSION['mainMenuName'][$codeNum]}" . "</a>";
    } else {
        echo "<a href = '../controller/mainCTL.php?action=$codeNum&category={$_SESSION['mainMenuName'][$codeNum]}'>" . "{$_SESSION['mainMenuName'][$codeNum]}" . "</a>";
    }
    echo "</li>";
    echo "</ul>";
}
echo "</div>";
?>
