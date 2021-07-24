<div class="categories-manage categories-inner-content">
    <div class="container">
        <div class="row">
            <h1 class="col-12 text-center">Update category</h1>
<?php
// Checking if the user browsing the update page via POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Storing the data in variables
    $id             = $_POST['catid'];
    $name           = $_POST['name'];
    $description    = $_POST['description'];
    $parent         = $_POST['parent'];
    $ordering       = $_POST['ordering'];
    $visibility     = $_POST['visibility'];
    $comments       = $_POST['comments'];
    $ads            = $_POST['ads'];

    // Update the data in the database if there's no errors
    if (!empty($name)) {
    // Updating the data in the database
        $stmt = $con->prepare("UPDATE categories SET Name = ?, Description = ?, Parent = ?, Ordering = ?, Visibility = ?, Allow_Comment = ?, Allow_ads = ? WHERE ID = ?");
        $stmt->execute([$name, $description, $parent, $ordering, $visibility, $comments, $ads, $id]);

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
