<?php

/*
 * Manage Members page:
 * You can Add, edit and delete members from here
 * */

// Starting the session to remember the user
session_start();

$pageTitle = 'Members';

// Checking if the session named by the username is set, welcome him or redirect to the login page (index.php)
if (isset($_SESSION['Username'])) {

    // include the initialize file
    include "init.php";

    // Checking the value of 'do' button and store it or set to manage
    $do = isset($_GET['do'])? $_GET['do'] : 'manage';

    // If the page is the manage page
    if ($do == 'manage') { // Manage page

        // Selectd all the users
        $stmt = $con->prepare("SELECT * FROM users");
        $stmt->execute(); // execute the sql statement
        $rows = $stmt->fetchAll(); // get all the records
        ?>
        <div class="members-page insert-members inner-content">
            <div class="container">
                <div class="row">
                    <h1 class="col-12 mt-5 text-center">Manage members</h1>
                    <table class="col-12 table table-bordered mt-5 mb-5">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">Full Name</th>
                            <th scope="col">Registered Date</th>
                            <th scope="col">Control</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                            foreach($rows as $row) {
                        ?>
                            <tr>
                                <th scope="row">
                                    <?php echo $row['UserID'] ?>
                                </th>
                                <td>
                                    <?php echo $row['Username'] ?>
                                </td>
                                <td>
                                    <?php echo $row['Email'] ?>
                                </td>
                                <td>
                                    <?php echo $row['FullName'] ?>
                                </td>
                                <td>
                                    <?php  ?>
                                </td>
                                <td>
                                    <a href="members.php?do=edit&userid=<?php echo $row['UserID'] ?>" title="Edit" class="btn btn-success">Edit</a>
                                    <a href="#" title="Delete" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        <?php }; ?>
                        </tbody>
                    </table>
                    <a href="members.php?do=add" title="Add new member" class="btn btn-primary btn-lg">
                        <i class="fas fa-plus"></i>
                        <span>Add new member<span>
                    </a>
                </div>
            </div>
        </div>
        <?php
    } elseif ($do == 'add') { // Add members page
        ?>
        <div class="members-page-inner-content-wrapper add-members inner-content">
            <h1 class="text-center">Add new member</h1>

            <div class="container">
                <div class="row">
                    <form class="col-8 edit-member-form" method="post" action="?do=insert">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control form-control-lg" id="username" name="username" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control form-control-lg" id="password" name="password" autocomplete="new-password" placeholder="" required>
                            <i class="fas fa-eye show-password hidden"></i>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control form-control-lg" id="email" name="email" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="full-name">Full name</label>
                            <input type="text" class="form-control form-control-lg" id="full-name" name="full-name" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-inline-block btn-lg">Add member</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
    } elseif ($do == 'insert') {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Checking if comes from POST

            echo '<h1 class="text-center">Insert member</h1>';

            // Storing the data in variables
            $username       = $_POST['username'];
            $password       = $_POST['password'];
            $hashedPassword = sha1($password);
            $email          = $_POST['email'];
            $fullname       = $_POST['full-name'];

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

            // Loop through the errors and print them
            foreach ($formErrors as $error) {
                echo $error . '<br>';
            }

            // Insert the data in the database if there's no errors
            if (empty($formErrors)) {
                // Inserting the data in the database
                $stmt = $con->prepare("INSERT INTO
                        users(Username, Password, Email, FullName)
                        VALUES (:username, :password, :email, :fullname)");
                $stmt->execute([
                    'username' => $username,
                    'password' => $hashedPassword,
                    'email'    => $email,
                    'fullname' => $fullname
                ]);

                echo $stmt->rowCount() . ' Record inserted';

            }
        } else {
            echo 'Sorry, you can\'t browse this page';
        }

    } elseif ($do == 'edit') { // Edit page

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
            <div class="members-page-inner-content-wrapper edit-members inner-content">
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
    } elseif ($do == 'update') { // update page that redirected from the edit page form's action
        echo '<h1 class="text-center">Update member</h1>';

        // Checking if the user browsing the update page via POST request
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Storing the data in variables
            $id         = $_POST['userid'];
            $username   = $_POST['username'];
            $email      = $_POST['email'];
            $fullname   = $_POST['full-name'];

            // Updating the password
            $password = empty($_POST['new-password'])? $_POST['old-password'] : sha1($_POST['new-password']);

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
                // Updating the data in the database
                $stmt = $con->prepare("UPDATE users SET Username = ?, Email = ?, FullName = ?, Password = ? WHERE UserID = ?");
                $stmt->execute([$username, $email, $fullname, $password, $id]);

                echo $stmt->rowCount() . ' Record updated';
            }
        } else {
            echo 'Sorry, you can\'t browse this page';
        }
    }

    include $tpl . "footer.php"; // Include the Footer file
} else {
    header('Location: index.php');
    exit();
}