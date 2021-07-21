<?php

// Select all the items
$stmt = $con->prepare("SELECT * FROM items");
$stmt->execute(); // execute the sql statement
$rows = $stmt->fetchAll(); // get all the records

?>

<div class="members-manage members-inner-content mb-5">
    <div class="container">
        <div class="row">
            <h1 class="col-12 mt-5 text-center">Manage items</h1>
            <table class="col-12 table table-bordered mt-5 mb-5">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Price</th>
                    <th scope="col">Date</th>
                    <th scope="col">Country</th>
                    <th scope="col">Control</th>
                </tr>
                </thead>
                <tbody>

                <?php
                foreach($rows as $row) {
                    ?>
                    <tr>
                        <th scope="row">
                            <?php echo $row['ID']; ?>
                        </th>
                        <th scope="row">
                            <?php echo $row['Name']; ?>
                        </th>
                        <td>
                            <?php echo $row['Description']; ?>
                        </td>
                        <td>
                            <?php echo $row['Price']; ?>
                        </td>
                        <td>
                            <?php echo $row['Date']; ?>
                        </td>
                        <td>
                            <?php echo $row['Country']; ?>
                        </td>
                        <td>
                            <a href="items.php?do=edit&itemid=<?php echo $row['ID'] ?>" title="Edit" class="btn btn-success">Edit</a>
                            <a href="items.php?do=delete&itemid=<?php echo $row['ID'] ?>" title="Delete" class="btn btn-danger confirm">Delete</a>
                            <?php
                                if ($row['Status'] == 0) {
                            ?>
                                    <a href="items.php?do=approve&itemid=<?php echo $row['ID'] ?>" title="Activate" class="btn btn-info">Approve</a>
                            <?php
                                };
                            ?>
                        </td>
                    </tr>
                <?php }; ?>
                </tbody>
            </table>
            <a href="items.php?do=add" title="Add new member" class="btn btn-primary btn-lg">
                <i class="fas fa-plus"></i>
                <span>New item<span>
            </a>
        </div>
    </div>
</div>