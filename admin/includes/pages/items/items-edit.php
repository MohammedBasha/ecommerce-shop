<?php

// Checking if the item id is valid
$itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ?
    intval($_GET['itemid']) : '0';

// Checking if the item id exists in the database
$stmt = $con->prepare("SELECT * FROM items WHERE ID = ? LIMIT 1");
$stmt->execute([$itemid]);
$items = $stmt->fetch();
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
                    <input type="hidden" name ="itemid" value="<?php echo $itemid; ?>">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control form-control-lg" id="name" name="name" value="<?php echo $items['Name']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control form-control-lg" id="description" name="description" value="<?php echo $items['Description']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" class="form-control form-control-lg" id="price" name="price" value="<?php echo $items['Price']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="country">Country</label>
                        <input type="text" class="form-control form-control-lg" id="country" name="country" value="<?php echo $items['Country']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" required>
                            <option value="new"
                                <?php
                                    echo $items['Status'] == 'new'? 'selected' : '';
                                ?>
                            >
                                New
                            </option>
                            <option value="used"
                                <?php
                                    echo $items['Status'] == 'used'? 'selected' : '';
                                ?>
                            >
                                Used
                            </option>
                            <option value="old"
                                <?php
                                    echo $items['Status']  == 'old'? 'selected' : '';
                                ?>
                            >
                                Old
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="member">Member</label>
                        <select name="member" required>
                            <option value="0">...</option>
                            <?php
                                // Select all the users
                                $stmt = $con->prepare("SELECT * FROM users");
                                $stmt->execute(); // execute the sql statement
                                $users = $stmt->fetchAll(); // get all the records
                                foreach($users as $user) {
                                    ?>
                                    <option
                                        value="<?php echo $user['UserID']; ?>"
                                        <?php
                                            echo $items['Member_ID']  == $user['UserID']? 'selected' : '';
                                        ?>
                                    >
                                        <?php echo $user['Username']; ?>
                                    </option>
                                    <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select name="category" required>
                            <option value="0">...</option>
                            <?php
                                // Select all the users
                                $stmt = $con->prepare("SELECT * FROM categories");
                                $stmt->execute(); // execute the sql statement
                                $cats = $stmt->fetchAll(); // get all the records
                                foreach($cats as $cat) {
                                    ?>
                                    <option
                                        value="<?php echo $cat['ID']; ?>"
                                        <?php
                                        echo $items['Cat_ID']  == $cat['ID']? 'selected' : '';
                                        ?>
                                    >
                                        <?php echo $cat['Name']; ?>
                                    </option>
                                    <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tags">Tags</label>
                        <input type="text" class="form-control form-control-lg" id="tags" name="tags" value="<?php echo $items['Tags']; ?>">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-inline-block btn-lg">Save item</button>
                    </div>
                </form>

                <?php

                // Including the manage comments file from Items directory
                include 'comments-manage.php';

            } else {
                $msg = '<div class="col-12 alert alert-danger text-center mt-5 mb-3">There\'s no item</div>';
                redirectHome($msg);
            }
            ?>

        </div>
    </div>
</div>
