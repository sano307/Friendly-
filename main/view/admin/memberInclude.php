<form name="member_include_form" class="form-horizontal" action="../controller/mainCTL.php" method="post">
    <div class="form-group">
        <label for="input-m_id" class="col-sm-2 control-label">アイディー</label>
        <div class="col-sm-10">
            <input type="text" name="m_id" class="form-control" id="m_id" placeholder="アイディーを入力してください。">
<!--            <a href="javascript:id_check();">ID중복체크</a>
            <script>
                function id_check() {
                    var argForm = document.member_include_form;
                    if ( argForm.m_id.value == "" ) {
                        alert("회원 아이디를 입력하세요.");
                        argForm.m_id.focus();
                        return;
                    }
                }
            </script>-->
        </div>
    </div>
    <div class="form-group">
        <label for="input-m_password" class="col-sm-2 control-label">パスワード</label>
        <div class="col-sm-10">
            <input type="password" name="m_password" class="form-control" id="m_password" placeholder="パスワードを入力してください。">
        </div>
    </div>
    <div class="form-group">
        <label for="input-m_name" class="col-sm-2 control-label">名前</label>
        <div class="col-sm-10">
            <input type="text" name="m_name" class="form-control" id="m_name" placeholder="名前を入力してください。">
        </div>
    </div>
    <div class="form-group">
        <label for="input-m_tel" class="col-sm-2 control-label">連絡先</label>
        <div class="col-sm-10">
            <input type="text" name="m_tel" class="form-control" id="m_tel" placeholder="連絡先を入力してください。">
        </div>
    </div>
    <div class="form-group">
        <label for="input-m_level" class="col-sm-2 control-label">レベル</label>
        <div class="col-sm-10">
            <input type="text" name="m_level" class="form-control" id="m_level" placeholder="レベルを入力してください。">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <Button type="reset" class="btn btn-primary">元に戻す</Button>
            <Button type="submit" class="btn btn-success">会員加入</Button>
            <input type="hidden" name="action" value="903">
        </div>
    </div>
</form>
