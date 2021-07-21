<?php

// Starting the session to remember the user
session_start();

// checking if the session named by the username is set, welcome him or redirect to the login page (index.php)
if (isset($_SESSION['Username'])) {

    // Set the page title
    $pageTitle = 'Dashboard';

    // Adding the Page class
    $pageClass = 'dashboard-page';

    // include the initialize file
    include "init.php";
    ?>
    <div class="dashboard-inner-wrapper">
        <div class="container">
            <div class="row">
                <h1 class="col-12 text-center mb-5">Dashboard</h1>

                <div class="col-12 mb-5 cards">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total members</h5>

                            <p class="card-text">
                                <?php echo countItem('UserID', 'users'); ?>
                            </p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Pending members</h5>

                            <p class="card-text">
                                <a href="members.php?do=manage&page=pending" title="Pending members">
                                    <?php echo checkItem('RegStatus', 'users', 0); ?>
                                </a>
                            </p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total items</h5>

                            <p class="card-text">
                                <a href="items.php" title="Items">
                                    <?php echo countItem('ID', 'items'); ?>
                                </a>
                            </p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total comments</h5>

                            <p class="card-text">3500</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 mb-5 latest-registered">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Latest registered users:</h5>

                            <?php
                            $latestUsers = getLatest('*', 'users', 'UserID', 5);
                            foreach ($latestUsers as $latestUser) {
                            ?>
                            <p class="card-text">
                                <?php echo $latestUser['Username']; ?>
                                <a href="members.php?do=edit&userid=<?php echo $latestUser['UserID']; ?>" title="Edit" class="btn btn-success">Edit</a>
                                <?php
                                if ($latestUser['RegStatus'] == 0) {
                                    ?>
                                    <a href="members.php?do=activate&userid=<?php echo $latestUser['UserID'] ?>" title="Activate" class="btn btn-info">Activate</a>
                                    <?php
                                };
                                ?>
                            </p>
                            <?php }; ?>
                        </div>
                    </div>
                </div>
                <div class="col-6 mb-5 latest-items">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Latest items:</h5>
                            <?php
                            $latestItems = getLatest('*', 'items', 'ID', 5);
                            foreach ($latestItems as $latestItem) {
                                ?>
                                <p class="card-text">
                                    <?php echo $latestItem['Name']; ?>
                                    <a href="items.php?do=edit&itemid=<?php echo $latestItem['ID']; ?>" title="Edit" class="btn btn-success">Edit</a>
                                    <?php
                                    if ($latestItem['Approve'] == 0) {
                                        ?>
                                        <a href="items.php?do=approve&itemid=<?php echo $latestItem['ID'] ?>" title="Approve" class="btn btn-info">Approve</a>
                                        <?php
                                    };
                                    ?>
                                </p>
                            <?php }; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    include $tpl . "footer.php"; // Include the Footer file
} else {
    header('Location: index.php');
    exit();
}
?>