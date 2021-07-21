<div class="items-manage items-inner-content">
    <div class="container">
        <div class="row">
            <h1 class="col-12 text-center">Update item</h1>
<?php
// Checking if the user browsing the update page via POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Storing the data in variables
    $itemid         = $_POST['itemid'];
    $name           = $_POST['name'];
    $description    = $_POST['description'];
    $price          = $_POST['price'];
    $country        = $_POST['country'];
    $status         = $_POST['status'];
    $category       = $_POST['category'];
    $member         = $_POST['member'];

    // Validate the form
    $formErrors = [];

    if (empty($name)) {
        $formErrors[] = '<div class="error-name alert alert-warning alert-dismissible fade show mb-3" role="alert">
    Name Can\'t be <strong>Empty</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>';
    }

    if (empty($description)) {
        $formErrors[] = '<div class="error-description alert alert-warning alert-dismissible fade show mb-3" role="alert">
    Description Can\'t be <strong>Empty</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>';
    }

    if (empty($price)) {
        $formErrors[] = '<div class="error-email alert alert-warning alert-dismissible fade show mb-3" role="alert">
    Price field can\'t be <strong>empty</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>';
    }

    if (empty($country)) {
        $formErrors[] = '<div class="error-fullname alert alert-warning alert-dismissible fade show mb-3" role="alert">
    Country Can\'t be <strong>Empty</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>';
    }

    if ($category == 0) {
        $formErrors[] = '<div class="error-fullname alert alert-warning alert-dismissible fade show mb-3" role="alert">
    You must choose <strong>Category</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>';
    }

    if ($member == 0) {
        $formErrors[] = '<div class="error-fullname alert alert-warning alert-dismissible fade show mb-3" role="alert">
    You must choose <strong>Member</strong>
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
        $stmt = $con->prepare("UPDATE items SET Name = ?, Description = ?, Price = ?, Country = ?, Status = ?, Cat_ID = ?, Member_ID = ? WHERE ID = ?");
        $stmt->execute([$name, $description, $price, $country, $status, $category, $member, $itemid]);

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
