<div class="container">
    <div class="row">
        <?php
        // Checking if the item id is valid
        $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ?
            intval($_GET['itemid']) : '0';

        // Checking if the item id exists in the database
        $chk = checkItem('ID', 'items', $itemid);

        if ($chk > 0) {
            $stmt = $con->prepare("UPDATE items SET Status = 1 WHERE ID = :itemid");
            $stmt->bindParam(":itemid", $itemid);
            $stmt->execute();

            $msg = '<div class="col-12 alert alert-success text-center mt-5 mb-3">' . $stmt->rowCount() . ' Record approved</div>';
            redirectHome($msg, 'back');
        } else {
            $msg = '<div class="col-12 alert alert-danger text-center mt-5 mb-3">There\'s no item</div>';
            redirectHome($msg);
        }
        ?>
    </div>
</div>