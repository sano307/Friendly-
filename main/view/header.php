<div id="title">
    <h1>Friendly</h1>
</div>

<?php
if ( @!$_SESSION['now_user'] ) {
?>
    <div id="login">
        <ul>
            <li>
                <form action="../controller/mainCTL.php" method="post">
                <input type="text" name="m_id" placeholder="アイディーを入力してください。">
                <input type="password" name="m_password" placeholder="パスワードを入力してください。">
                <input type="submit" value="ログイン">
                <input type="hidden" name="action" value="13">
                </form>
            </li>
            <li id="signUp">
                <form action="../controller/mainCTL.php" method="post">
                    <input type="submit" value="会員加入">
                    <input type="hidden" name="action" value="11">
                </form>
            </li>
        </ul>
    </div>
<?php
} else {
    ?>
    <div id="logout">
        <div><h2><?= $_SESSION['now_user'] . "(レベル : " . $_SESSION['level'] .")"; ?></h2></div>
        <form action="../controller/mainCTL.php" method="post">
            <input type="submit" value="ログ・アウト">
            <input type="hidden" name="action" value="14">
        </form>
        <?php
            if ( !($_SESSION['level'] == 999) ) { ?>
                <form action="../controller/mainCTL.php" method="post">
                    <input type="submit" value="ショッピングカート">
                    <input type="hidden" name="action" value="22">
                </form>
                <form action="../controller/mainCTL.php" method="post">
                    <input type="submit" value="決済の内訳">
                    <input type="hidden" name="action" value="23">
                </form>
        <?php  }
        ?>
    </div>
    <?php
}
?>
