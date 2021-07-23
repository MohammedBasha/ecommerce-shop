<?php

ob_start();

session_start();

if (!isset($_SESSION['frontuser'])) {
    header('Location: login.php');
}

// Set the page title
$pageTitle = 'Profile';

// Adding the Page class
$pageClass = 'profile-page';

// include the initialize file
include "init.php";

// Getting the user info
$stmt = $con->prepare("SELECT * FROM users WHERE Username = ?");
$stmt->execute([$_SESSION['frontuser']]);
$user = $stmt->fetch();

?>

    <div class="profile-inner-wrapper">
        <div class="container">
            <div class="row">
                <h1 class="col-12 text-center mb-5">My profile</h1>

                <div class="col-12 mb-5 profile-info">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">My information</h5>

                            <p class="card-text">
                                Name: <?php echo $user['Username']; ?>
                            </p>

                            <p class="card-text">
                                Email: <?php echo $user['Email']; ?>
                            </p>

                            <p class="card-text">
                                FullName: <?php echo $user['FullName']; ?>
                            </p>

                            <p class="card-text">
                                Registered Date: <?php echo $user['Date']; ?>
                            </p>

                            <p class="card-text">
                                Favorite category: <?php ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-5 latest-ads">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Latest ads</h5>

                            <p class="card-text">
                                <?php

                                $items = getItems('Member_ID', $user['UserID']);

                                if (!empty($items)) {
                                foreach ($items as $item) { ?>

                            <div class="category-item-name">
                                <h3><?php echo $item['Name']; ?></h3>

                                <div class="category-item-image"></div>
                                <div class="category-item-description">
                                    <?php echo $item['Description']; ?>
                                </div>
                                <div class="category-item-price">
                                    <?php echo $item['Price']; ?>
                                </div>
                            </div>
                            <?php
                            }
                            } else {
                                echo 'No Ads.';
                            }
                            ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-5  latest-comments">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Latest comments</h5>

                            <p class="card-text">
                                <?php

                                $limit = 5;

                                // Select all the comments
                                $cmtStmt = $con->prepare("SELECT * FROM comments WHERE member_id = ?");
                                $cmtStmt->execute([$user['UserID']]); // execute the sql statement
                                $comments = $cmtStmt->fetchAll(); // get all the records

                                if (!empty($comments)) {
                                foreach ($comments as $comment) {
                                ?>

                            <p class="comment-text">
                                <?php echo $comment['comment']; ?>
                            </p>

                            <p class="comment-control">
                                <a href="comments.php?do=edit&commentid=<?php echo $comment['comment_id']; ?>"
                                   title="Edit" class="btn btn-success">Edit</a>
                                <?php
                                if ($comment['status'] == 0) {
                                    ?>
                                    <a href="comments.php?do=approve&commentid=<?php echo $comment['comment_id'] ?>"
                                       title="Approve" class="btn btn-info">Approve</a>
                                    <?php
                                };
                                ?>
                            </p>
                            <?php };
                            } else {
                                echo 'No comments.';
                            }
                            ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php

include $tpl . "footer.php"; // Include the Footer file

ob_end_flush();