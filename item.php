<?php

ob_start();

session_start();

// Set the page title
$pageTitle = 'Items';

// Adding the Page class
$pageClass = 'items-page';

// include the initialize file
include "init.php";

// Checking if the item id is valid
$itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ?
    intval($_GET['itemid']) : '0';

// Checking if the item id exists in the database
$stmt = $con->prepare("
SELECT items.*,
categories.Name AS Cetegory_Name,
users.Username FROM items
INNER JOIN categories ON categories.ID = items.Cat_ID
INNER JOIN users ON users.UserID = items.Member_ID
WHERE items.ID = ?
AND Approve = 1
ORDER BY items.Date DESC
");
$stmt->execute([$itemid]);
$item = $stmt->fetch();
$itemCount = $stmt->rowCount();

?>

    <div class="items-inner-wrapper">
        <div class="container">
            <div class="row">
                <?php
                if ($itemCount > 0) {
                    ?>
                    <h1 class="col-12 text-center mb-5">
                        <?php echo $item['Name']; ?>
                    </h1>
                    <div class="col-12 item-desc">
                        <?php echo $item['Description']; ?>
                    </div>
                    <div class="col-12 item-price">
                        $<?php echo $item['Price']; ?>
                    </div>
                    <div class="col-12 item-date">
                        <?php echo $item['Date']; ?>
                    </div>
                    <div class="col-12 item-country">
                        <?php echo $item['Country']; ?>
                    </div>
                    <div class="col-12 item-category">
                        <a href="categories.php?catid=<?php echo $item['Cat_ID']; ?>&catname=<?php echo strtolower(str_replace(' ', '-', $item['Cetegory_Name'])); ?>" title="<?php echo $item['Cetegory_Name']; ?>">
                            <?php echo $item['Cetegory_Name']; ?>
                        </a>
                    </div>
                    <div class="col-12 item-user">
                        <?php echo $item['Username']; ?>
                    </div>
                    <div class="col-12 item-user">
                        Tags: <?php
                        $tags = $item['Tags'];
                        if (!empty($tags)) {
                            $allTags = explode(', ', $tags);
                            foreach ($allTags as $tag) {
                                echo "<a href='tag.php?name={$tag}' title='{$tag}'>$tag</a><br>";
                            }
                        }
                        ?>
                    </div>
                    <?php
                    if (isset($_SESSION['frontuser'])) {
                    ?>
                    <form class="comment-form-front col-12" method="post" action="<?php echo $_SERVER['PHP_SELF'] . '?itemid=' . $item['ID']; ?>">
                        <div class="form-group">
                            <label for="comment">Comment:</label>
                            <textarea class="form-control" id="comment" name="comment" required></textarea>
                        </div>
                        <button type="submit" name="addcomment" class="btn btn-primary btn-block">Add comment</button>
                    </form>
                    <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Checking if comes from POST
                            // Storing the data in variables
                            $comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);
                            $citemid = $item['ID'];
                            $cmemberid = $_SESSION['frontuid'];

                            // Insert the data in the database if there's no errors
                            if (!empty($comment)) {

                                // Inserting the data in the database
                                $stmt = $con->prepare("INSERT INTO
                        comments(comment, status, comment_date, item_id, member_id)
                        VALUES (:comment, 0, now(), :item_id, :member_id)");
                                $stmt->execute([
                                    'comment'   => $comment,
                                    'item_id'   => $citemid,
                                    'member_id' => $cmemberid
                                ]);

                                if ($stmt->rowCount() > 0) {
                                    echo '<div class="col-12 alert alert-success alert-dismissible fade show mb-3" role="alert">
    Comment addedd <strong>succeessfully</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>';
                                }
                            } else {
                                echo '<div class="col-12 alert alert-warning alert-dismissible fade show mb-3" role="alert">
    Comment Can\'t be <strong>Empty</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>';
                            }
                        }
                    } else {
                        echo 'Please <a href="login.php" title="Login">login</a> or <a href="login.php" title="Register">Register</a> to add a comment';
                    }
                    ?>
                    <div class="col-12">
                        <h3 class="text-center">Item comments</h3>
                        <?php
                        $citemid = $item['ID'];

                        // Select all the users
                        $stmt = $con->prepare("SELECT comments.*,
                      users.Username FROM comments
                      INNER JOIN users ON users.UserID = comments.member_id
                      WHERE comments.item_id = $citemid
                      AND comments.status = 1
                      ORDER BY comments.comment_date DESC ");
                        $stmt->execute(); // execute the sql statement
                        $comments = $stmt->fetchAll(); // get all the records

                        if (!empty($comments)) {
                            foreach($comments as $comment) {
                                ?>
                                <div class="comment-text">
                                    <?php echo $comment['comment']; ?>
                                </div>
                                <div class="comment-user">
                                    <?php echo $comment['Username']; ?>
                                </div>
                            <?php };
                        } else {
                            ?>
                            <tr class="text-center">
                                <td colspan="5">
                                    No comments
                                </td>
                            </tr>
                            <?php
                        }

                        ?>
                    </div>
                    <?php
                } else {

                    $msg = '<div class="col-12 text-center">No Item or need approval.</div>';
                    redirectHome($msg, 'back');
                }
                ?>
            </div>
        </div>
    </div>

<?php

include $tpl . "footer.php"; // Include the Footer file

ob_end_flush();