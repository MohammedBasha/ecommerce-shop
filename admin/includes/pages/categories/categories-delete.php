<div class="container">
    <div class="row">
        <?php
        // Checking if the category id is valid
        $catid = isset($_GET['catid']) && is_numeric($_GET['catid']) ?
            intval($_GET['catid']) : '0';

        // Checking if the category id exists in the database and delete its data
        $chk = checkItem('ID', 'categories', $catid);

        if ($chk > 0) {
            $stmt = $con->prepare("DELETE FROM categories WHERE ID = :id");
            $stmt->bindParam(":id", $catid);
            $stmt->execute();

            $msg = '<div class="col-12 alert alert-success text-center mt-5 mb-3">' . $stmt->rowCount() . ' Record deleted</div>';
            redirectHome($msg, 'back');
        } else {
            $msg = '<div class="col-12 alert alert-danger text-center mt-5 mb-3">There\'s no ID</div>';
            redirectHome($msg, 'back');
        }
        ?>
    </div>
</div>