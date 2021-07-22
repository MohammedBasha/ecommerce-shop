<div class="container">
    <div class="row">
        <?php
        // Checking if the userid is valid
        $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ?
            intval($_GET['userid']) : '0';

        // Checking if the userid exists in the database and delete its data
        $chk = checkItem('UserId', 'users', $userid);

        if ($chk > 0) {
            $stmt = $con->prepare("UPDATE users SET RegStatus = 1 WHERE UserId = :userid");
            $stmt->bindParam(":userid", $userid);
            $stmt->execute();

            $msg = '<div class="col-12 alert alert-success text-center mt-5 mb-3">' . $stmt->rowCount() . ' Record activated</div>';
            redirectHome($msg, 'back');
        } else {
            $msg = '<div class="col-12 alert alert-danger text-center mt-5 mb-3">There\'s no User</div>';
            redirectHome($msg);
        }
        ?>
    </div>
</div>