<?php

// Checking if the userid is valid
$userid = isset($_GET['userid']) && is_numeric($_GET['userid'])?
intval($_GET['userid']) : '0';

// Checking if the userid exists in the database and edit its data
$stmt = $con->prepare("SELECT * FROM users WHERE UserId = ? LIMIT 1");
$stmt->execute([$userid]);
$row = $stmt->fetch();
$rowCount = $stmt->rowCount();

if ($rowCount > 0) {
?>
<div class="members-edit memebers-inner-content">
    <h1 class="text-center">Edit member</h1>

    <div class="container">
        <div class="row">
            <form class="col-8 edit-member-form" method="post" action="?do=update">
                <input type="hidden" name="userid" value="<?php echo $userid; ?>">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control form-control-lg" id="username" name="username" autocomplete="off" value="<?php echo $row['Username']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="new-password">Password</label>
                    <input type="hidden" name="old-password" value="<?php echo $row['Password']; ?>">
                    <input type="password" class="form-control form-control-lg" id="new-password" name="new-password" autocomplete="new-password" placeholder="Leave it blank if you won't change">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control form-control-lg" id="email" name="email" autocomplete="off" value="<?php echo $row['Email']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="full-name">Full name</label>
                    <input type="text" class="form-control form-control-lg" id="full-name" name="full-name" autocomplete="off" value="<?php echo $row['FullName']; ?>">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-inline-block btn-lg">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
} else {
    echo 'There\'s no User';
}