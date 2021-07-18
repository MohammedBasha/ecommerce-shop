<div class="container">
    <div class="row">
        <?php
        // Checking if the userid is valid
        $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ?
            intval($_GET['userid']) : '0';

        // Checking if the userid exists in the database and delete its data
        $stmt = $con->prepare("SELECT * FROM users WHERE UserId = ? LIMIT 1");
        $stmt->execute([$userid]);
        $rowCount = $stmt->rowCount();

        if ($rowCount > 0) {
            $stmt = $con->prepare("DELETE FROM users WHERE UserId = :userid");
            $stmt->bindParam(":userid", $userid);
            $stmt->execute();

            $successMsg = $stmt->rowCount() . ' Record deleted';
            redirectHome($successMsg, '');
        } else {
            $errorMsg = 'There\'s no User';
            redirectHome('', $errorMsg);
        }
        ?>
    </div>
</div>