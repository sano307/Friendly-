<?php
if ( !isset($_SESSION) ) session_start();
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 100;
$now_user = isset($_SESSION['now_user']) ? $_SESSION['now_user'] : null;
$now_level = isset($_SESSION['level']) ? $_SESSION['level'] : null;
$productNum = isset($_REQUEST['productNum']) ? $_REQUEST['productNum'] : null;
$postNum = isset($_REQUEST['postNum']) ? $_REQUEST['postNum'] : null;
$mode = isset($_REQUEST['mode']) ? $_REQUEST['mode'] : null;
?>