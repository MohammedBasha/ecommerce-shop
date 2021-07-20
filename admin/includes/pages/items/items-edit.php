<?php

// Checking if the item id is valid
$itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ?
    intval($_GET['itemid']) : '0';

// Checking if the item id exists in the database
$stmt = $con->prepare("SELECT * FROM items WHERE ID = ? LIMIT 1");
$stmt->execute([$itemid]);
$row = $stmt->fetch();
$rowCount = $stmt->rowCount();
?>
<div class="items-edit items-inner-content">
    <div class="container">
        <div class="row">
            <?php
            if ($rowCount > 0) {
                ?>
                <h1 class="col-12 text-center">Edit item</h1>
                <form class="col-8 edit-item-form" method="post" action="?do=update">
                    <input type="hidden" name="itemid" value="<?php echo $itemid; ?>">
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
                $msg = '<div class="col-12 alert alert-danger text-center mt-5 mb-3">There\'s no item</div>';
                redirectHome($msg);
            }
            ?>

        </div>
    </div>
</div>
