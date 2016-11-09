<?php
$selectedPostInfo = isset($_SESSION['selectedPostInfo']) ? $_SESSION['selectedPostInfo'] : null;
?>
<form class="form-horizontal" action="../controller/mainCTL.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="inputID" class="col-sm-2 control-label">タイトル</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="modifyPostSubject" value="<?=$selectedPostInfo['f_subject']?>">
        </div>
    </div>
    <div class="form-group">
        <label for="inputID" class="col-sm-2 control-label">内容</label>
        <div class="col-sm-10">
            <textarea class="form-control" name="modifyPostContent" rows="10"><?=$selectedPostInfo['f_content']?></textarea>
        </div>
    </div>
<!--    <div class="form-group">
        <label for="inputID" class="col-sm-2 control-label">업로드 파일</label>
        <div class="col-sm-10">
            <input type="file" class="form-control" name="fa_uploadfile[]" accept="image/*" multiple>
        </div>
    </div>-->
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <Button type="button" class="btn btn-default" onclick="history.back();">以前に</Button>
            <Button type="reset" class="btn btn-default">元に戻す</Button>
            <Button type="submit" class="btn btn-default">修正完了</Button>
            <input type="hidden" name="action" value="600">
            <input type="hidden" name="pageNum" value="<?=$_REQUEST['pageNum']?>">
            <input type="hidden" name="postNum" value="<?=$_REQUEST['postNum']?>">
            <input type="hidden" name="comment_pageNum" value="<?=$_SESSION['nowCommentPageNum']?>">
            <input type="hidden" name="mode" value="modifyPost">
        </div>
    </div>
</form>
