<?php

// Starting the session to remember the user
session_start();

// Adding the $noNavbar variable to remove the Navbar from the Login page (index.php)
$noNavbar = '';

// Set the page title
$pageTitle = 'Login';

// checking if the session named by the username is set, redirect to the dashboard.php
if (isset($_SESSION['Username'])) {
    header('Location: dashboard.php');
}

// include the initialize file
include "init.php";

// Checking if the user coming from HTTP post request
if ($_SERVER['REQUEST_METHOD'] == 'POST') { // POST should be uppercase
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashedPass = sha1($password); // hashing the password

    // Checking if the user exists in the database and is an admin (GroupID = 1)
    $stmt = $con->prepare("SELECT UserId, Username, Password
                            FROM users
                            WHERE Username = ?
                            AND Password = ?
                            AND GroupID = 1
                            LIMIT 1");
    $stmt->execute([$username, $hashedPass]);
    $row = $stmt->fetch();
    $rowCount = $stmt->rowCount();

    // Checking if there's an admin in the database, then create a session with its username, and redirect him to the dashboard.php
    if ($rowCount > 0) {
        $_SESSION['Username'] = $username; // Registering session name
        $_SESSION['ID'] = $row['UserId']; // Registering session ID
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
    include $tpl . "footer.php"; // Include the Footer file
?>