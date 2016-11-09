<form class="form-horizontal" action="../controller/mainCTL.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="inputID" class="col-sm-2 control-label">タイトル</label>
        <div class="col-sm-10">
            <input type="text" name="f_subject" class="form-control" id="f_subject" placeholder="タイトル">
        </div>
    </div>
    <div class="form-group">
        <label for="inputID" class="col-sm-2 control-label">内容</label>
        <div class="col-sm-10">
            <textarea class="form-control" name="f_content" id="f_content" rows="10" placeholder="内容"></textarea>
        </div>
    </div>
<!--    <div class="form-group">
        <label for="inputID" class="col-sm-2 control-label">업로드 파일</label>
        <div class="col-sm-10">
            <input type="file" class="form-control" name="fa_uploadfile[]" id="fa_uploadfile" accept="image/*" multiple>
        </div>
    </div>-->
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <Button type="button" class="btn btn-default" onclick="history.back();">以前に</Button>
            <Button type="reset" class="btn btn-default">消す</Button>
            <Button type="submit" class="btn btn-default">確認</Button>
            <input type="hidden" name="action" value="603">
            <input type="hidden" name="m_nickname" value="<?=$_SESSION['now_user']?>">
        </div>
    </div>
</form>
