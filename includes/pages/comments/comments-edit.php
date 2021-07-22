<?php

// Checking if the comment id is valid
$commentid = isset($_GET['commentid']) && is_numeric($_GET['commentid']) ?
    intval($_GET['commentid']) : '0';

// Checking if the comment id exists in the database and edit its data
$stmt = $con->prepare("SELECT * FROM comments WHERE comment_id = ?");
$stmt->execute([$commentid]);
$comment = $stmt->fetch();
$commentCount = $stmt->rowCount();
?>
<div class="comments-edit comments-inner-content">
    <div class="container">
        <div class="row">
            <?php
            if ($commentCount > 0) {
                ?>
                <h1 class="col-12 text-center">Edit comment</h1>
                <form class="col-8 edit-comment-form" method="post" action="?do=update">
                    <input type="hidden" name="commentid" value="<?php echo $commentid; ?>">
                    <div class="form-group">
                        <label for="comment">Comment:</label>
                        <textarea class="form-control form-control-lg" id="comment" name="comment" required><?php echo $comment['comment']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-inline-block btn-lg">Save</button>
                    </div>
                </form>
                <?php
            } else {
                $msg = '<div class="col-12 alert alert-danger text-center mt-5 mb-3">There\'s no comment</div>';
                redirectHome($msg);
            }
            ?>

        </div>
    </div>
</div>
