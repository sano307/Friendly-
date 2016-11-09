<form class="form-horizontal" action="../controller/mainCTL.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="inputID" class="col-sm-2 control-label">タイトル</label>
        <div class="col-sm-10">
            <input type="text" name="subject" class="form-control" id="f_subject" placeholder="タイトル">
        </div>
    </div>
    <div class="form-group">
        <label for="inputID" class="col-sm-2 control-label">内容</label>
        <div class="col-sm-10">
            <textarea class="form-control" name="content" id="f_content" rows="10" placeholder="内容"></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <Button type="button" class="btn btn-default" onclick="history.back();">以前に</Button>
            <Button type="reset" class="btn btn-default">消す</Button>
            <Button type="submit" class="btn btn-default">確認</Button>
            <input type="hidden" name="action" value="600">
            <input type="hidden" name="pageNum" value="<?= $_REQUEST['pageNum'] ?>">
            <input type="hidden" name="postNum" value="<?= $_REQUEST['postNum'] ?>">
            <input type="hidden" name="mode" value="registerResponsePost">
        </div>
    </div>
</form>
