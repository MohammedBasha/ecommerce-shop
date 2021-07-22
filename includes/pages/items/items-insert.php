<div class="items-insert items-inner-content">
    <div class="container">
        <div class="row">
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Checking if comes from POST

                echo '<h1 class="col-12 text-center">Insert item</h1>';

                // Storing the data in variables
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

                // Insert the data in the database if there's no errors
                if (empty($formErrors)) {

                    // Inserting the data in the database
                    $stmt = $con->prepare("INSERT INTO
                        items(Name, Description, Price, Date, Country, Status, Cat_ID, Member_ID)
                        VALUES (:name, :description, :price, now(), :country, :status, :catid, :member_id)");
                    $stmt->execute([
                        'name'          => $name,
                        'description'   => $description,
                        'price'         => $price,
                        'country'       => $country,
                        'status'        => $status,
                        'catid'         => $category,
                        'member_id'     => $member
                    ]);

                    $msg = '<div class="col-12 alert alert-success text-center mt-5 mb-3">' . $stmt->rowCount() . ' Record inserted</div>';
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
