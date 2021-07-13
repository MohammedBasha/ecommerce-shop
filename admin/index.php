<?php
session_start();
if (isset($_SESSION['Username'])) {
    header('Location: dashboard.php');
}
include "init.php";

// Checking if the user coming from HTTP post request
if ($_SERVER['REQUEST_METHOD'] == 'POST') { // POST should be uppercase
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashedPass = sha1($password);

    // Checking if the user exists in the database and is an admin (GroupID = 1)
    $stmt = $con->prepare("SELECT Username, Password FROM users WHERE Username = ? AND Password = ? AND GroupID = 1");
    $stmt->execute([$username, $hashedPass]);
    $rowCount = $stmt->rowCount();

    if ($rowCount > 0) {
        $_SESSION['Username'] = $username; // Registering session name
        header('Location: dashboard.php');
        exit();
    }
}
?>

<body>
    <form class="login-form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <h4 class="text-center">Admin login</h4>
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" autocomplete="off">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" autocomplete="new-password">
        </div>
        <button type="submit" class="btn btn-primary btn-block">Login</button>
    </form>



<?php
    include $tpl . "footer.php";
?>