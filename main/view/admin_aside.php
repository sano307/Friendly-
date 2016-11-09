<?php
$controlShortNum = intval($action/10%10);

$_SESSION['admin_subMenuName'] = array(
    array(902 => "会員入力"),
    array(912 => "商品入力"),
);

if ( @$_SESSION['admin_subMenuName'][$controlShortNum] ) {
    $adminSubMenuInfo = $_SESSION['admin_subMenuName'][$controlShortNum];

    echo "<ul class='subMenu'>";
    foreach ( @$adminSubMenuInfo as $mykey => $myValue ) {
        if ( $action == $mykey ) {
            echo "<li id='selected'>";
        } else {
            echo "<li>";
        }
        echo "<a href='../controller/mainCTL.php?action=$mykey&category=$myValue'>" . $myValue . "</a></li>";
}
    echo "</ul>";
}
?>
