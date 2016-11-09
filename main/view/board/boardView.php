<?php
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;
$pageNum = isset($_REQUEST['pageNum']) ? $_REQUEST['pageNum'] : 1;
$postNum = isset($_REQUEST['postNum']) ? $_REQUEST['postNum'] : null;
$pageInfo = isset($_SESSION['commentpageInfo']) ? $_SESSION['commentpageInfo'] : null;
$selectedPostInfo = isset($_SESSION['selectedPostInfo']) ? $_SESSION['selectedPostInfo'] : null;
$selectedCommentInfo = isset($_SESSION['commentInfo']) ? $_SESSION['commentInfo'] : null;
?>
<form class="form-horizontal" action="../controller/mainCTL.php">
    <div class="form-group">
        <label class="col-sm-2 control-label">タイトル</label>
        <div class="col-sm-10">
            <p class="form-control-static"><?=$selectedPostInfo['f_subject']?></p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">名前</label>
        <div class="col-sm-10">
            <p class="form-control-static"><?=$selectedPostInfo['m_nickname']?></p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">登録日</label>
        <div class="col-sm-10">
            <p class="form-control-static"><?=$selectedPostInfo['f_registdate']?></p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">修正日</label>
        <div class="col-sm-10">
            <p class="form-control-static"><?=$selectedPostInfo['f_updatedate']?></p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">内容</label>
        <div class="col-sm-10">
            <p class="form-control-static"><?=$selectedPostInfo['f_content']?></p>
        </div>
    </div>
    <?php
    if ( @$_SESSION['now_user'] == $selectedPostInfo['m_nickname'] ) { ?>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <Button type="submit" class="btn btn-info btn-block">文の修正</Button>
                <input type="hidden" name="action" value="600">
                <input type="hidden" name="pageNum" value="<?=$_REQUEST['pageNum']?>">
                <input type="hidden" name="postNum" value="<?=$selectedPostInfo['f_num']?>">
                <input type="hidden" name="mode" value="modifyPost">
                <input type="hidden" name="postSubject" value="<?=$selectedPostInfo['f_subject']?>">
                <input type="hidden" name="postContent" value="<?=$selectedPostInfo['f_content']?>">
            </div>
        </div>
    <?php
    }
    ?>
</form>
<?php
if (@$_SESSION['now_user']) { ?>
    <form class="form-control-static" action="../controller/mainCTL.php">
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <Button type="submit" class="btn btn-warning btn-block" onclick="return confirm_delete();">文の削除</Button>
                    <script> function confirm_delete() { return confirm("삭제하시겠습니까?"); } </script>
                <input type="hidden" name="action" value="600">
                <input type="hidden" name="pageNum" value="<?= $_REQUEST['pageNum'] ?>">
                <input type="hidden" name="postNum" value="<?= $selectedPostInfo['f_num'] ?>">
                <input type="hidden" name="mode" value="deletePost">
            </div>
        </div>
    </form>
<?php } ?>
<form class="form-group" action="../controller/mainCTL.php">
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <Button type="submit" class="btn btn-danger btn-block">返事作成</Button>
            <input type="hidden" name="action" value="600">
            <input type="hidden" name="pageNum" value="<?=$_REQUEST['pageNum']?>">
            <input type="hidden" name="postNum" value="<?=$selectedPostInfo['f_num']?>">
            <input type="hidden" name="mode" value="insertResponsePost">
        </div>
    </div>
</form>
<table class="table table-hover" style="font-size:18px;">
    <thead>
    <tr>
        <th>番号</th>
        <th>著者</th>
        <th>コメントの内容</th>
        <th>登録日</th>
        <th>修正日</th>
    </tr>
    </thead>
<?php
if( $selectedCommentInfo ) { ?>
    <tbody>
        <?php
        foreach ($selectedCommentInfo as $commentInfo) {
            $nowCommentContent = htmlspecialchars_decode($commentInfo['content']);
            ?>
            <tr>
                <td><?= $commentInfo['fr_num'] ?></td>
                <td><?= $commentInfo['m_nickname'] ?></td>
                    <?php
                    if ( @$_SESSION['nowCommentInfo'] && $_SESSION['nowCommentInfo']['commentNum'] == $commentInfo['fr_num'] ) { ?>
                        <form action="../controller/mainCTL.php">
                        <td><textarea name="modifyCommentContent" rows="10" placeholder="내용"><?=$_SESSION['nowCommentInfo']['commentContent']?></textarea></td>
                    <?php } else { ?>
                        <td><?= $nowCommentContent ?></td>
                        <?php
                    } ?>
                <td><?= $commentInfo['registdate'] ?></td>
                <td><?= $commentInfo['updatedate'] ?></td>
                <?php
                if ( @$_SESSION['now_user'] == $commentInfo['m_nickname'] && !@$_SESSION['nowCommentInfo'] ) { ?>
                    <td>
                    <form action="../controller/mainCTL.php?">
                    <button type="submit" class="btn btn-warning btn-block" style="margin:0 auto; padding:0;">수정</button>
                    <input type="hidden" name="action" value="600">
                    <input type="hidden" name="pageNum" value="<?=$_REQUEST['pageNum']?>">
                    <input type="hidden" name="postNum" value="<?=$_REQUEST['postNum']?>">
                    <input type="hidden" name="commentNum" value="<?=$commentInfo['fr_num']?>">
                    <input type="hidden" name="commentContent" value="<?=$commentInfo['content']?>">
                    <input type="hidden" name="comment_pageNum" value="<?=$_REQUEST['comment_pageNum']?>">
                    <input type="hidden" name="mode" value="modifyComment">
                    </form>
                    </td>
                    <td>
                    <form action="../controller/mainCTL.php?">
                    <button type="submit" class="btn btn-danger btn-block" style="margin:0 auto; padding:0;" onclick="return confirm_delete();">削除</button>
                    <input type="hidden" name="action" value="600">
                    <input type="hidden" name="pageNum" value="<?=$_REQUEST['pageNum']?>">
                    <input type="hidden" name="postNum" value="<?=$_REQUEST['postNum']?>">
                    <input type="hidden" name="commentNum" value="<?=$commentInfo['fr_num']?>">
                    <input type="hidden" name="comment_pageNum" value="<?=$_REQUEST['comment_pageNum']?>">
                    <input type="hidden" name='mode' value="deleteComment">
                    </form>
                    </td>
                    <script>
                        function confirm_delete() {
                            return confirm("削除しますか?");
                        }
                    </script>
                <?php
                } elseif ( @$_SESSION['now_user'] == $commentInfo['m_nickname'] && @$_SESSION['nowCommentInfo'] && $_SESSION['nowCommentInfo']['commentNum'] == $commentInfo['fr_num'] ) { ?>
                    <td>
                        <button type="submit" class="btn btn-warning btn-block" style="margin:0 auto; padding:0;">セーブ</button>
                        <input type="hidden" name="action" value="600">
                        <input type="hidden" name="pageNum" value="<?= $_REQUEST['pageNum'] ?>">
                        <input type="hidden" name="postNum" value="<?= $_REQUEST['postNum'] ?>">
                        <input type="hidden" name="commentNum" value="<?= $commentInfo['fr_num'] ?>">
                        <input type="hidden" name="comment_pageNum" value="<?=$_REQUEST['comment_pageNum']?>">
                        <input type="hidden" name="mode" value="modifyComment">
                    </td>
                    </form>
                    </tr>
                    <?php
                }

        }
        ?>
        </tbody>
    <?php
}
?>
</table>
<?php
include_once "./common/pagenation.php";
setPageNationByComment($action, $pageNum, $postNum, $pageInfo);

if ( @$_SESSION['now_user'] ) {
    ?>
    <form class="form-horizontal" action="../controller/mainCTL.php" method="post">
        <div class="form-group">
            <label class="col-sm-2 control-label">댓글</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="content" rows="10" placeholder="내용"></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <Button type="submit" class="btn btn-default btn-block">저장</Button>
                <input type="hidden" name="action" value="600">
                <input type="hidden" name="postNum" value="<?=$_REQUEST['postNum']?>">
                <input type="hidden" name="comment_pageNum" value="<?=$_REQUEST['comment_pageNum']?>">
                <input type="hidden" name="mode" value="insertComment">
            </div>
        </div>
    </form>
    <?php
}
?>
<Button type="submit" class="btn btn-primary btn-block" onclick="history.back();">뒤로가기</Button>
