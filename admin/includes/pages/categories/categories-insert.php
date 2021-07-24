<div class="categories-insert categories-inner-content">
    <div class="container">
        <div class="row">
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Checking if comes from POST request

                echo '<h1 class="col-12 text-center">Insert Category</h1>';

                // Storing the data in variables
                $name           = $_POST['name'];
                $description    = $_POST['description'];
                $parent         = $_POST['parent'];
                $ordering       = $_POST['ordering'];
                $visibility     = $_POST['visibility'];
                $comments       = $_POST['comments'];
                $ads            = $_POST['ads'];

                // Insert the data in the database if there's no errors
                if (!empty($name)) {

                    // Checking if the category is found in the database
                    $chk = checkItem('Name', 'categories', $name);

                    if ($chk == 1) { // Redirect add category page if name is found in the database
                        $msg = '<div class="col-12 alert alert-warning text-center mb-3">This category name already exists</div>';
                        redirectHome($msg, 'back');

                    } else { // or insert new member

                        // Inserting the data in the database
                        $stmt = $con->prepare("INSERT INTO
                            categories(Name, Description, Parent, Ordering, Visibility, Allow_Comment, Allow_ads)
                            VALUES (:name, :description, :parent, :ordering, :visibility, :allow_comment, :allow_ads)");
                        $stmt->execute([
                            'name' => $name,
                            'description' => $description,
                            'parent' => $parent,
                            'ordering' => $ordering,
                            'visibility' => $visibility,
                            'allow_comment' => $comments,
                            'allow_ads' => $ads
                        ]);

                        $msg = '<div class="col-12 alert alert-success text-center mt-5 mb-3">' . $stmt->rowCount() . ' Record inserted</div>';
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
