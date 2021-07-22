<div class="container">
    <div class="row">
        <?php
        // Checking if the comment id is valid
        $commentid = isset($_GET['commentid']) && is_numeric($_GET['commentid']) ?
            intval($_GET['commentid']) : '0';

        // Checking if the comment id exists in the database and delete its data
        $chk = checkItem('comment_id', 'comments', $commentid);

        if ($chk > 0) {
            $stmt = $con->prepare("DELETE FROM comments WHERE comment_id = :commentid");
            $stmt->bindParam(":commentid", $commentid);
            $stmt->execute();

            $msg = '<div class="col-12 alert alert-success text-center mt-5 mb-3">' . $stmt->rowCount() . ' Record deleted</div>';
            redirectHome($msg, 'back');
        } else {
            $msg = '<div class="col-12 alert alert-danger text-center mt-5 mb-3">There\'s no User</div>';
            redirectHome($msg);
        }
        ?>
    </div>
</div>