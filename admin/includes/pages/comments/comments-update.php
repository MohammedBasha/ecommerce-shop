<div class="comments-manage comments-inner-content">
    <div class="container">
        <div class="row">
            <h1 class="col-12 text-center">Update comment</h1>
<?php
// Checking if the user browsing the update page via POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Storing the data in variables
    $commentid   = $_POST['commentid'];
    $comment     = $_POST['comment'];

    // Validate the form
    $formErrors = [];

    if (empty($comment)) {
        $formErrors[] = '<div class="error-comment alert alert-warning alert-dismissible fade show mb-3" role="alert">
    Username Can\'t be <strong>Empty</strong>
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
    // Updating the data in the database
        $stmt = $con->prepare("UPDATE comments SET comment = ? WHERE comment_id = ?");
        $stmt->execute([$comment, $commentid]);

        $msg = '<div class="col-12 alert alert-success text-center mt-5 mb-3">' . $stmt->rowCount() . ' Record updated</div>';
        redirectHome($msg, 'back');
    }
} else {
    $msg = '<div class="col-12 alert alert-danger text-center mt-5 mb-3">Sorry, you can\'t browse this page</div>';
    redirectHome($msg);
}
?>
        </div>
    </div>
</div>
