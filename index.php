<?php

ob_start();

session_start();

// Set the page title
$pageTitle = 'Homepage';

// Adding the Page class
$pageClass = 'home-page';

// include the initialize file
include "init.php";
?>

<div class="home-page-inner">
        <div class="container">
            <div class="row">
                <?php
                $allItems = getAllFrom('items', 'Approve', 'ID');
                if (!empty($allItems)) {
                    ?>
                    <div class="category-items col-12">
                        <?php foreach($allItems as $item) { ?>
                            <div class="category-item-name">
                                <h3>
                                    <a href="item.php?itemid=<?php echo $item['ID']; ?>" title="<?php echo $item['Name']; ?>">
                                        <?php echo $item['Name']; ?>
                                    </a>
                                </h3>
                                <div class="category-item-image"></div>
                                <div class="category-item-description">
                                    <?php echo $item['Description']; ?>
                                </div>
                                <div class="category-item-price">
                                    <?php echo $item['Price']; ?>
                                </div>
                            </div>
                        <?php } ?>
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