<?php

$sort = 'ASC'; // DESC
$sortArray = ['ASC', 'DESC'];

if (isset($_GET['sort']) && in_array($_GET['sort'], $sortArray)) {
    $sort = $_GET['sort'];
}

// Select all the categories
$stmt = $con->prepare("SELECT * FROM categories ORDER BY Ordering $sort");
$stmt->execute(); // execute the sql statement
$rows = $stmt->fetchAll(); // get all the records

?>

<div class="categories-manage categories-inner-content mb-5">
    <div class="container">
        <div class="row">
            <h1 class="col-12 mt-3 text-center">Manage categories</h1>
            <h6 class="col-12 mt-5">
                <span>Ordering:</span>
                <a href="?sort=ASC" title="Order ASC">ASC</a>
                <a href="?sort=DESC" title="Order DESC">DESC</a>
            </h6>
            <table class="col-12 table table-bordered mt-5 mb-5">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Ordering</th>
                    <th scope="col">Visibility</th>
                    <th scope="col">Allow Comments</th>
                    <th scope="col">Allow Ads</th>
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
                        <td>
                            <?php echo $row['Name']; ?>
                        </td>
                        <td>
                            <?php echo $row['Description']; ?>
                        </td>
                        <td>
                            <?php echo $row['Ordering']; ?>
                        </td>
                        <td>
                            <?php echo $row['Visibility']; ?>
                        </td>
                        <td>
                            <?php echo $row['Allow_Comment']; ?>
                        </td>
                        <td>
                            <?php echo $row['Allow_ads']; ?>
                        </td>
                        <td>
                            <a href="categories.php?do=edit" title="Edit" class="btn btn-success">Edit</a>
                            <a href="categories.php?do=delete" title="Delete" class="btn btn-danger confirm">Delete</a>
                        </td>
                    </tr>
                <?php }; ?>
                </tbody>
            </table>
            <a href="categories.php?do=add" title="Add new category" class="btn btn-primary btn-lg">
                <i class="fas fa-plus"></i>
                <span>New category<span>
            </a>
        </div>
    </div>
</div>