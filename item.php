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
                    <?php
                } else {
                    ?>
                    <div class="col-12 text-center">No Items.</div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>

<?php

include $tpl . "footer.php"; // Include the Footer file

ob_end_flush();