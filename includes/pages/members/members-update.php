<div class="members-manage members-inner-content">
    <div class="container">
        <div class="row">
            <h1 class="col-12 text-center">Update member</h1>
<?php
// Checking if the user browsing the update page via POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Storing the data in variables
    $id         = $_POST['userid'];
    $username   = $_POST['username'];
    $email      = $_POST['email'];
    $fullname   = $_POST['full-name'];

    // Updating the password
    $password = empty($_POST['new-password']) ? $_POST['old-password'] : sha1($_POST['new-password']);

    // Validate the form
    $formErrors = [];

    if (empty($username)) {
        $formErrors[] = '<div class="error-username alert alert-warning alert-dismissible fade show mb-3" role="alert">
    Username Can\'t be <strong>Empty</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>';
    }

    if (strlen($username) < 4) {
        $formErrors[] = '<div class="error-username alert alert-warning alert-dismissible fade show mb-3" role="alert">
    Username Can\'t be less than <strong>4</strong> characters long
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>';
    }

    if (strlen($username) > 20) {
        $formErrors[] = '<div class="error-username alert alert-warning alert-dismissible fade show mb-3" role="alert">
    Username must be more than <strong>20</strong> characters long
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>';
    }

    if (empty($email)) {
        $formErrors[] = '<div class="error-email alert alert-warning alert-dismissible fade show mb-3" role="alert">
    Email field can\'t be <strong>empty</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>';
    }

    if (empty($fullname)) {
        $formErrors[] = '<div class="error-fullname alert alert-warning alert-dismissible fade show mb-3" role="alert">
    Fullname Can\'t be <strong>Empty</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>';
    }

    // Loop through the errors and print them
    foreach ($formErrors as $error) {
        echo $error . '<br>';
    }

    // Update the data in the database if there's no errors
    if (empty($formErrors)) {
        // Checking if the user is already exists
        $stmt1 = $con->prepare("SELECT * FROM users WHERE Username = ? AND UserID != ?");
        $stmt1->execute([$username, $id]);
        $count1 = $stmt1->rowCount();

        if ($count1 == 1) {
            $msg = '<div class="col-12 alert alert-warning text-center mt-5 mb-3">Sorry, the username is already exist</div>';
            redirectHome($msg, 'back');
        } else {
            // Updating the data in the database
            $stmt = $con->prepare("UPDATE users SET Username = ?, Email = ?, FullName = ?, Password = ? WHERE UserID = ?");
            $stmt->execute([$username, $email, $fullname, $password, $id]);

            $msg = '<div class="col-12 alert alert-success text-center mt-5 mb-3">' . $stmt->rowCount() . ' Record updated</div>';
            redirectHome($msg, 'back');
        }
    }
} else {
    $msg = '<div class="col-12 alert alert-danger text-center mt-5 mb-3">Sorry, you can\'t browse this page</div>';
    redirectHome($msg);
}
?>
        </div>
    </div>
</div>
