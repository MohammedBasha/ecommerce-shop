<?php

ob_start();

session_start();

if (isset($_GET["catid"]) && isset($_GET["catname"])) {

    // Page title
    $pageTitle = 'Categories | ' . ucfirst(str_replace('-', ' ', $_GET["catname"]));

    // Adding the Page class
    $pageClass = 'categories-page-' . strtolower(str_replace(' ', '-', $_GET["catname"]));
}

// include the initialize file
include "init.php";

?>

<div class="categories-page-inner">
    <div class="container">
        <div class="row">
            <?php
            if (isset($_GET["catid"]) && isset($_GET["catname"])) {
            ?>
            <h1 class="text-center col-12 main-heading">
                <?php echo ucfirst(str_replace('-', ' ', $_GET["catname"])); ?>
            </h1>
            <div class="category-items col-12">
                <?php foreach(getItems('Cat_ID', $_GET["catid"]) as $item) { ?>
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