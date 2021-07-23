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
    $frontuser = $_POST['username'];
    $frontpassword = $_POST['password'];
    $hashedPass = sha1($frontpassword); // hashing the password

    // Checking if the user exists in the database and is an admin (GroupID = 1)
    $stmt = $con->prepare("SELECT Username, Password
                            FROM users
                            WHERE Username = ?
                            AND Password = ?");
    $stmt->execute([$frontuser, $hashedPass]);
    $rowCount = $stmt->rowCount();

    // Checking if there's a user in the database, then create a session with its username, and redirect him to the dashboard.php
    if ($rowCount > 0) {
        $_SESSION['frontuser'] = $frontuser; // Registering session name

        header('Location: index.php');
        exit();
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
            <button type="submit" class="btn btn-primary btn-block">Login</button>
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
            <button type="submit" class="btn btn-primary btn-block">Sign up</button>
        </form>
    </div>
</div>

<?php
include $tpl . "footer.php"; // Include the Footer file

ob_end_flush();