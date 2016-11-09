<?php
$selectShortNum = intval($action/10);

switch ( $selectShortNum ) {
    case 90:
        if ( $action == 900 ) {
            include_once "../view/admin/memberManagement.php";
        } elseif ( $action == 903 ) {
            include_once "../view/admin/memberInclude.php";
        } elseif ( $action == 905 ) {
            include_once "../view/admin/memberModify.php";
        }
        break;

    case 91:
        if ( $action == 910 ) {
            include_once "../view/admin/productManagement.php";
        } elseif ( $action == 912 ) {
            include_once "../view/admin/productInsert.php";
        } elseif ( $action == 915 ) {
            include_once "../view/admin/productModify.php";
        }
        break;

    default:
        break;
}
?>