<?php

// Select all the users
$stmt = $con->prepare("SELECT comments.*,
                      items.Name AS Item_Name,
                      users.Username FROM comments
                      INNER JOIN items ON items.ID = comments.item_id
                      INNER JOIN users ON users.UserID = comments.member_id
                      ORDER BY comments.comment_date DESC ");
$stmt->execute(); // execute the sql statement
$comments = $stmt->fetchAll(); // get all the records

?>

<div class="members-manage members-inner-content mb-5">
    <div class="container">
        <div class="row">
            <h1 class="col-12 mt-5 text-center">Manage comments</h1>
            <table class="col-12 table table-bordered mt-5 mb-5">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Comment</th>
                    <th scope="col">Status</th>
                    <th scope="col">Date</th>
                    <th scope="col">Item</th>
                    <th scope="col">Member</th>
                    <th scope="col">Control</th>
                </tr>
                </thead>
                <tbody>

                <?php
                foreach($comments as $comment) {
                    ?>
                    <tr>
                        <th scope="row">
                            <?php echo $comment['comment_id']; ?>
                        </th>
                        <td>
                            <?php echo $comment['comment']; ?>
                        </td>
                        <td>
                            <?php echo $comment['status']; ?>
                        </td>
                        <td>
                            <?php echo $comment['comment_date']; ?>
                        </td>
                        <td>
                            <?php echo $comment['Item_Name']; ?>
                        </td>
                        <td>
                            <?php echo $comment['Username']; ?>
                        </td>
                        <td>
                            <a href="comments.php?do=edit&commentid=<?php echo $comment['comment_id'] ?>" title="Edit" class="btn btn-success">Edit</a>
                            <a href="comments.php?do=delete&commentid=<?php echo $comment['comment_id'] ?>" title="Delete" class="btn btn-danger confirm">Delete</a>
                            <?php
                                if ($row['RegStatus'] == 0) {
                            ?>
                                    <a href="comments.php?do=approve&commentid=<?php echo $comment['comment_id'] ?>" title="Activate" class="btn btn-info">Activate</a>
                            <?php
                                };
                            ?>
                        </td>
                    </tr>
                <?php }; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>