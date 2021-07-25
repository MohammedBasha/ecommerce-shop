<div class="members-insert members-inner-content">
    <div class="container">
        <div class="row">
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Checking if comes from POST

                echo '<h1 class="col-12 text-center">Insert member</h1>';

                // Storing the data in variables
                $username       = $_POST['username'];
                $password       = $_POST['password'];
                $hashedPassword = sha1($password);
                $email          = $_POST['email'];
                $fullname       = $_POST['full-name'];

                // Getting the image data in variables
                $image = $_FILES['image'];
                $image_name = $image['name'];
                $image_type = $image['type'];
                $image_temp = $image['tmp_name'];
                $image_size = $image['size'];
                $image_error = $image['error'];

                // Setting the allowed image extensions
                $allowed_extensions = ['jpg', 'gif', 'jpeg', 'png'];

                // Getting the images types
                $image_extension = explode('.', $image_name);
                $refined_image_extension = strtolower(end($image_extension));

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

                if (empty($password)) {
                    $formErrors[] = '<div class="error-password alert alert-warning alert-dismissible fade show mb-3" role="alert">
    Password Can\'t be <strong>Empty</strong>
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

                 // checking th image field
                if (empty($image_name)) {
                    $formErrors[] = '<div class="error-image alert alert-warning alert-dismissible fade show mb-3" role="alert">
    Image filed is <strong>required</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>';
                }

                // Checking the valid images types
                if (!empty($image_name) && !in_array($refined_image_extension, $allowed_extensions)) {
                    $formErrors[] = '<div class="error-image alert alert-warning alert-dismissible fade show mb-3" role="alert">
    Image types are <strong>jpg, gif, jpeg and png</strong> only
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>';
                }

                // Checking the valid images types
                if ($image_size > 4194304) {
                    $formErrors[] = '<div class="error-image alert alert-warning alert-dismissible fade show mb-3" role="alert">
    Image Can\'t be more than <strong>4 MB</strong> only
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

                    // Setting a new name for each image image
                    $lastImageName = rand(0, 1000000000000) . '.' . $refined_image_extension;

                    // moving the image file to uploads directory
                    move_uploaded_file($image_temp, "uploads\\users\\" . $lastImageName);

                    // Checking if the username is found in the database
                    $chk = checkItem('Username', 'users', $username);

                    if ($chk == 1) { // Redirect him to add member page if username is found in the database
                        $msg = '<div class="col-12 alert alert-warning text-center mb-3">This username already exists</div>';
                        redirectHome($msg, 'back');

                    } else { // or insert new member

                        // Inserting the data in the database
                        $stmt = $con->prepare("INSERT INTO
                            users(Username, Password, Email, FullName, RegStatus, Date, Image)
                            VALUES (:username, :password, :email, :fullname, 1, now(), :image)");
                        $stmt->execute([
                            'username' => $username,
                            'password' => $hashedPassword,
                            'email' => $email,
                            'fullname' => $fullname,
                            'image' => $lastImageName
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
