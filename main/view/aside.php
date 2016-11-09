<?php
$selectSubMenuNum = intval($action / 100);
unset($_SESSION['savingSubMenuName']);
if ( @!$_SESSION['subMenuName'] ) {
    $_SESSION['subMenuName'] = array(
        array( 11 => "会員加入" ),
        array( 110 => "DAKS", 120 => "HAZZYS", 130 => "IL CORSO", 140 => "LAFUMA", 150 => "TNGT" ),
        array( 210 => "티셔츠", 220 => "셔츠/블라우스", 230 => "니트/가디건", 240 => "원피스", 250 => "팬츠" ),
        array( 310 => "티셔츠", 320 => "셔츠", 330 => "니트/가디건", 340 => "팬츠", 350 => "자켓/베스트" ),
        array( 410 => "여성가방", 420 => "남성가방" ),
        array( 510 => "아웃도어 슈즈", 520 => "아웃도어 가방", 530 => "아웃도어 모자", 540 => "아웃도어 용품" ),
    );

    $arrCount = count($_SESSION['subMenuName']);

    for ( $iCount = 0; $iCount < $arrCount; $iCount++ ) {
        $_SESSION['subMenuNameCount'][$iCount] = count($_SESSION['subMenuName'][$iCount]);
    }
}


echo "<ul class='subMenu'>";
for ( $iCount = 0; $iCount < @$_SESSION['subMenuNameCount'][$selectSubMenuNum]; $iCount++ ) {
    $selectAction = (floor($action/100) * 100 + 10) + ($iCount * 10);

    if ( $selectSubMenuNum == 0 ) {
        echo "<li><a href='../controller/mainCTL.php?action=11'>" . $_SESSION['subMenuName'][$selectSubMenuNum][11] . "</a></li>";
    } else {
        echo "<li><a href='../controller/mainCTL.php?action=$selectAction&category=" . $_SESSION['subMenuName'][$selectSubMenuNum][$selectAction] ."'>" . $_SESSION['subMenuName'][$selectSubMenuNum][$selectAction] . "</a></li>";
    }
}
echo "</ul>"
?>
