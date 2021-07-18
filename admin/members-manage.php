<?php

// Selectd all the users
$stmt = $con->prepare("SELECT * FROM users");
$stmt->execute(); // execute the sql statement
$rows = $stmt->fetchAll(); // get all the records

?>

<div class="members-manage memebers-inner-content mb-5">
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
                            <a href="members.php?do=delete&userid=<?php echo $row['UserID'] ?>" title="Delete" class="btn btn-danger confirm">Delete</a>
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