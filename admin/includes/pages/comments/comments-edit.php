<?php

// Checking if the userid is valid
$commentid = isset($_GET['commentid']) && is_numeric($_GET['commentid']) ?
    intval($_GET['commentid']) : '0';

// Checking if the userid exists in the database and edit its data
$stmt = $con->prepare("SELECT * FROM comments WHERE comment_id = ?");
$stmt->execute([$commentid]);
$comment = $stmt->fetch();
$commentCount = $stmt->rowCount();
?>
<div class="members-edit memebers-inner-content">
    <div class="container">
        <div class="row">
            <?php
            if ($commentCount > 0) {
                ?>
                <h1 class="col-12 text-center">Edit comment</h1>
                <form class="col-8 edit-comment-form" method="post" action="?do=update">
                    <input type="hidden" name="commentid" value="<?php echo $commentid; ?>">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control form-control-lg" id="username" name="username"
                               autocomplete="off" value="<?php echo $row['Username']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="new-password">Password</label>
                        <input type="hidden" name="old-password" value="<?php echo $row['Password']; ?>">
                        <input type="password" class="form-control form-control-lg" id="new-password"
                               name="new-password" autocomplete="new-password"
                               placeholder="Leave it blank if you won't change">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control form-control-lg" id="email" name="email"
                               autocomplete="off" value="<?php echo $row['Email']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="full-name">Full name</label>
                        <input type="text" class="form-control form-control-lg" id="full-name" name="full-name"
                               autocomplete="off" value="<?php echo $row['FullName']; ?>">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-inline-block btn-lg">Save</button>
                    </div>
                </form>
                <?php
            } else {
                $msg = '<div class="col-12 alert alert-danger text-center mt-5 mb-3">There\'s no User</div>';
                redirectHome($msg);
            }
            ?>

        </div>
    </div>
</div>
