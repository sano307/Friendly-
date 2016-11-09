<form class="form-horizontal" action="../controller/mainCTL.php" method="post">
    <div class="form-group">
        <label for="inputID" class="col-sm-2 control-label">アイディー</label>
        <div class="col-sm-10">
            <input type="text" name="m_id" class="form-control" value="<?= $_SESSION['certainMemberInfo'][0]['m_id'] ?>" disabled>
        </div>
    </div>
    <div class="form-group">
        <label for="inputPassword" class="col-sm-2 control-label">パスワード</label>
        <div class="col-sm-10">
            <input type="password" name="m_password" class="form-control" value="<?= $_SESSION['certainMemberInfo'][0]['m_password'] ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="inputName" class="col-sm-2 control-label">名前</label>
        <div class="col-sm-10">
            <input type="text" name="m_name" class="form-control" value="<?= $_SESSION['certainMemberInfo'][0]['m_name'] ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="inputTel" class="col-sm-2 control-label">連絡先</label>
        <div class="col-sm-10">
            <input type="text" name="m_tel" class="form-control" value="<?= $_SESSION['certainMemberInfo'][0]['m_tel'] ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="inputLevel" class="col-sm-2 control-label">レベル</label>
        <div class="col-sm-10">
            <?php
            if ( $_SESSION['certainMemberInfo'][0]['m_id'] == $_SESSION['now_user'] ) {
                ?>
                <input type="text" name="m_level" class="form-control"
                       value="<?= $_SESSION['certainMemberInfo'][0]['m_level'] ?>" readonly>
                <?php
            } else {
                ?>  <input type="text" name="m_level" class="form-control"
                           value="<?= $_SESSION['certainMemberInfo'][0]['m_level'] ?>">
                <?php
            }
            ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <Button type="reset" class="btn btn-primary">元に戻す</Button>
            <Button type="submit" class="btn btn-success">修正完了</Button>
            <input type="hidden" name="memberNum" value="<?= $_SESSION['certainMemberInfo'][0]['m_num'] ?>">
            <input type="hidden" name="action" value="905">
        </div>
    </div>
</form>
