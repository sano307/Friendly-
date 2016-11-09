<form name="signUp" class="form-horizontal" action="../controller/mainCTL.php" method="post">
    <div class="form-group">
        <label for="inputID" class="col-sm-2 control-label">アイディー</label>
        <div class="col-sm-10">
            <input type="text" name="m_id" class="form-control" id="m_id" placeholder="アイディーを入力してください。">
        </div>
    </div>
    <div class="form-group">
        <label for="inputID" class="col-sm-2 control-label">ニックネーム</label>
        <div class="col-sm-10">
            <input type="text" name="m_nickname" class="form-control" id="m_nickname" placeholder="ニックネームを入力してください。">
        </div>
    </div>
    <div class="form-group">
        <label for="inputPassword" class="col-sm-2 control-label">パスワード</label>
        <div class="col-sm-10">
            <input type="password" name="m_password" class="form-control" id="m_password" placeholder="パスワードを入力してください。">
        </div>
    </div>
    <div class="form-group">
        <label for="inputName" class="col-sm-2 control-label">名前</label>
        <div class="col-sm-10">
            <input type="text" name="m_name" class="form-control" id="m_name" placeholder="名前を入力してください。">
        </div>
    </div>
    <div class="form-group">
        <label for="inputTel" class="col-sm-2 control-label">連絡先</label>
        <div class="col-sm-10">
            <input type="text" name="m_tel" class="form-control" id="m_tel" placeholder="連絡先を入力してください。">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <Button type="submit" class="btn btn-default">会員加入</Button>
            <input type="hidden" name="action" value="12">
        </div>
    </div>
</form>
<!--<script>
    function valueCheck() {
        if ( document.signUp.m_id == null ) {
            alert('id를 입력하십시오.');
            return false;
        } else if ( document.signUp.m_password == null ) {

        }
        return true;
    }
</script>-->
