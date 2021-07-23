<?php
ob_start();

session_start();

if (isset($_SESSION['frontuser'])) {
    header('Location: index.php');
}

// Set the page title
$pageTitle = 'Homepage';

// Adding the Page class
$pageClass = 'home-page';

// include the initialize file
include "init.php";

// Checking if the user coming from HTTP post request
if ($_SERVER['REQUEST_METHOD'] == 'POST') { // POST should be uppercase

    if (isset($_POST['login'])) {
        $frontuser = $_POST['username'];
        $frontpassword = $_POST['password'];
        $hashedPass = sha1($frontpassword); // hashing the password

        // Checking if the user exists in the database
        $stmt = $con->prepare("SELECT UserID, Username, Password
                            FROM users
                            WHERE Username = ?
                            AND Password = ?");
        $stmt->execute([$frontuser, $hashedPass]);
        $row = $stmt->fetch();
        $rowCount = $stmt->rowCount();

        // Checking if there's a user in the database, then create a session with its username, and redirect him to the dashboard.php
        if ($rowCount > 0) {
            $_SESSION['frontuser'] = $frontuser; // Registering session name
            $_SESSION['frontuid'] = $row['UserID']; // Registering session id

            header('Location: index.php');
            exit();
        }
    } else {
        // Assigning the signp form values to variables
        $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        $password = $_POST['password'];
        $password2 = $_POST['password2'];
        $hashedPass = sha1($password); // hashing the password
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

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
    Username must be less than <strong>20</strong> characters long
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>';
        }

        if (empty($password) || empty($password2)) {
            $formErrors[] = '<div class="error-password alert alert-warning alert-dismissible fade show mb-3" role="alert">
    Password Can\'t be <strong>Empty</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>';
        }

        if ($password !== $password2) {
            $formErrors[] = '<div class="error-password alert alert-warning alert-dismissible fade show mb-3" role="alert">
    Passwords didn\'t <strong>Match</strong>
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

        if (filter_var($email, FILTER_VALIDATE_EMAIL) != true) {
            $formErrors[] = '<div class="error-email alert alert-warning alert-dismissible fade show mb-3" role="alert">
    Email is not <strong>valid</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>';
        }

        if (empty($formErrors)) {

            // Checking if the username is found in the database
            $chk = checkItem('Username', 'users', $username);

            if ($chk == 1) { // Redirect him to add member page if username is found in the database
                $formErrors[] = '<div class="col-12 alert alert-warning text-center mb-3">This username already exists</div>';

            } else { // or insert new member

                // Inserting the data in the database
                $stmt = $con->prepare("INSERT INTO
                            users(Username, Password, Email, RegStatus, Date)
                            VALUES (:username, :password, :email, 0, now())");
                $stmt->execute([
                    'username' => $username,
                    'password' => $hashedPass,
                    'email' => $email
                ]);

                $msg = '<div class="col-12 alert alert-success text-center mt-5 mb-3">You\'ve registered successfully</div>';
                redirectHome($msg, 'back');
            }
        }
    }
}

?>

<div class="container">
    <div class="row">
        <h4 class="text-center col-12">Login | Sign up</h4>
        <form class="login-form-front col-12" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
        </form>
        <form class="signup-form-front col-12" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" autocomplete="new-password">
            </div>
            <div class="form-group">
                <label for="password2">Password</label>
                <input type="password" class="form-control" id="password2" name="password2">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <button type="submit" name="signup" class="btn btn-primary btn-block">Sign up</button>
        </form>
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

<?php
include $tpl . "footer.php"; // Include the Footer file

ob_end_flush();