<?php

// Checking if the category id is valid
$catid = isset($_GET['catid']) && is_numeric($_GET['catid']) ?
    intval($_GET['catid']) : '0';

// Checking if the userid exists in the database and edit its data
$stmt = $con->prepare("SELECT * FROM categories WHERE ID = ?");
$stmt->execute([$catid]);
$row = $stmt->fetch();
$rowCount = $stmt->rowCount();
?>
<div class="categories-edit categories-inner-content">
    <div class="container">
        <div class="row">
            <?php
            if ($rowCount > 0) {
                ?>
                <h1 class="col-12 text-center">Edit category</h1>
                <form class="col-8 edit-member-form" method="post" action="?do=update">
                    <input type="hidden" name="catid" value="<?php echo $catid; ?>">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control form-control-lg" id="name" name="name" required value="<?php echo $row['Name']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control form-control-lg" id="description" name="description" value="<?php echo $row['Description']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="parent">Parent</label>
                        <select name="parent" required>
                            <option value="0">None</option>
                            <?php
                            // Select all the users
                            $parentStmt = $con->prepare("SELECT * FROM categories WHERE Parent = 0 ORDER BY ID");
                            $parentStmt->execute(); // execute the sql statement
                            $parentCats = $parentStmt->fetchAll(); // get all the records
                            foreach($parentCats as $parentCat) {
                                ?>
                                <option
                                    value="<?php echo $parentCat['ID']; ?>"
                                    <?php
                                    if($parentCat['ID'] == $row['Parent']) {
                                        echo 'selected';
                                    }
                                    ?>
                                    >
                                    <?php echo $parentCat['Name']; ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ordering">Ordering</label>
                        <input type="text" class="form-control form-control-lg" id="ordering" name="ordering" value="<?php echo $row['Ordering']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Visibility</label>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="visibility" id="visibility-yes" value="1" <?php echo $row['Visibility'] == 1? 'checked' : ''; ?>>
                            <label class="form-check-label" for="visibility-yes">
                                Yes
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="visibility" id="visibility-no" value="0" <?php echo $row['Visibility'] == 0? 'checked' : ''; ?>>
                            <label class="form-check-label" for="visibility-no">
                                No
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Allow comments</label>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="comments" id="comments-yes" value="1" <?php echo $row['Allow_Comment'] == 1? 'checked' : ''; ?>>
                            <label class="form-check-label" for="comments-yes">
                                Yes
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="comments" id="comments-no" value="0" <?php echo $row['Allow_Comment'] == 0? 'checked' : ''; ?>>
                            <label class="form-check-label" for="comments-no">
                                No
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Allow ads</label>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="ads" id="ads-yes" value="1" <?php echo $row['Allow_ads'] == 1? 'checked' : ''; ?>>
                            <label class="form-check-label" for="ads-yes">
                                Yes
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="ads" id="ads-no" value="0" <?php echo $row['Allow_ads'] == 0? 'checked' : ''; ?>>
                            <label class="form-check-label" for="ads-no">
                                No
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-inline-block btn-lg">Edit category</button>
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
