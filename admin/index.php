<?php
include "init.php";
include $tpl . "header.php";
include "includes/languages/en.php";
?>

<body>
    <form class="login-form">
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