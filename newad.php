<?php

ob_start();

session_start();

if (!isset($_SESSION['frontuser'])) {
    header('Location: login.php');
}

// Set the page title
$pageTitle = 'Create Ad';

// Adding the Page class
$pageClass = 'newad-page';

// include the initialize file
include "init.php";

// Checking if the user coming from HTTP post request
if ($_SERVER['REQUEST_METHOD'] == 'POST') { // POST should be uppercase

    // Assigning the signp form values to variables
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
    $price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_INT);
    $country = filter_var($_POST['country'], FILTER_SANITIZE_STRING);
    $status = filter_var($_POST['status'], FILTER_SANITIZE_STRING);
    $category = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);


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

    if (strlen($name) < 3) {
        $formErrors[] = '<div class="error-name alert alert-warning alert-dismissible fade show mb-3" role="alert">
Name Can\'t be less than <strong>3</strong> characters long
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
</button>
</div>';
    }

    if (strlen($name) > 30) {
        $formErrors[] = '<div class="error-name alert alert-warning alert-dismissible fade show mb-3" role="alert">
Name must be less than <strong>30</strong> characters long
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
        $formErrors[] = '<div class="error-price alert alert-warning alert-dismissible fade show mb-3" role="alert">
Price Can\'t be <strong>Empty</strong>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
</button>
</div>';
    }

    if (empty($country)) {
        $formErrors[] = '<div class="error-country alert alert-warning alert-dismissible fade show mb-3" role="alert">
Country Can\'t be <strong>Empty</strong>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
</button>
</div>';
    }

    if (empty($status)) {
        $formErrors[] = '<div class="error-status alert alert-warning alert-dismissible fade show mb-3" role="alert">
Status Can\'t be <strong>Empty</strong>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
</button>
</div>';
    }

    if (empty($category)) {
        $formErrors[] = '<div class="error-category alert alert-warning alert-dismissible fade show mb-3" role="alert">
Category Can\'t be <strong>Empty</strong>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
</button>
</div>';
    }

    if (empty($formErrors)) {

        // Inserting the data in the database
        $stmt = $con->prepare("INSERT INTO
                    items(Name, Description, Price, Date, Country, Status, Cat_ID, Member_ID)
                    VALUES (:name, :desc, :price, now(), :country, :status, :catid, :memberid)");
        $stmt->execute([
            'name'      => $name,
            'desc'      => $description,
            'price'     => $price,
            'country'   => $country,
            'status'    => $status,
            'catid'     => $category,
            'memberid'  => $_SESSION['frontuid']
        ]);

        $msg = '<div class="col-12 alert alert-success text-center mt-5 mb-3">You\'ve added item successfully</div>';
        redirectHome($msg, 'back');
    }
}

?>

    <div class="newad-inner-wrapper">
        <div class="container">
            <div class="row">
                <h1 class="col-12 text-center mb-5">Create Ad</h1>

                <div class="col-12 mb-5 ad-info">
                    <div class="card">
                        <h5 class="card-title">Create Ad</h5>
                        <div class="card-body">
                            <div class="row">
                                <form class="col-8 user-add-item-form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
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
                                        <button type="submit" class="btn btn-primary btn-inline-block btn-lg">Add item</button>
                                    </div>
                                </form>
                                <div class="col-4">
                                    user info
                                </div>
                                <div class="forms-errors col-12 text-center">
                                    <?php
                                    if (!empty($formErrors)) {
                                        foreach($formErrors as $error) {
                                            echo $error;
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php

include $tpl . "footer.php"; // Include the Footer file

ob_end_flush();