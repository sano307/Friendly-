<?php
if ( !@$_SESSION['now_user'] ) { ?>
    <div style="text-align: right; font-size: large; color: red; font-weight: bold;">ログイン後に、文を書くことができます</div>
    <?php
} else { ?>
    <div style="text-align: right;">
        <form action="../controller/mainCTL.php" method="post">
            <button type="submit" class="btn btn-primary">文を書く</button>
            <input type="hidden" name="action" value="602">
            <input type="hidden" name="mode" value="write">
        </form>
    </div>
    <?php
}
?>
