<div class="items-add items-inner-content">
    <div class="container">
        <div class="row">
            <h1 class="col-12 text-center">Add new item</h1>
            <form class="col-8 edit-item-form" method="post" action="?do=insert">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control form-control-lg" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control form-control-lg" id="description" name="description" required>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" class="form-control form-control-lg" id="price" name="price" required>
                </div>
                <div class="form-group">
                    <label for="country">Country</label>
                    <input type="text" class="form-control form-control-lg" id="country" name="country" required>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" required>
                        <option value="new">New</option>
                        <option value="used">Used</option>
                        <option value="old">Old</option>
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
                        $rows = $stmt->fetchAll(); // get all the records
                        foreach($rows as $row) {
                            ?>
                            <option
                                value="<?php echo $row['UserID']; ?>"
                            >
                                <?php echo $row['Username']; ?>
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
                        $rows = $stmt->fetchAll(); // get all the records
                        foreach($rows as $row) {
                            ?>
                            <option
                                value="<?php echo $row['ID']; ?>"
                                >
                                <?php echo $row['Name']; ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tags">Tags</label>
                    <input type="text" class="form-control form-control-lg" id="tags" name="tags">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-inline-block btn-lg">Add item</button>
                </div>
            </form>
        </div>
    </div>
</div>