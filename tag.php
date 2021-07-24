<?php

ob_start();

session_start();

if (isset($_GET["name"])) {
    $tag = $_GET["name"];
    // Page title
    $pageTitle = 'Tag | ' . ucfirst(str_replace('-', ' ', $tag));

    // Adding the Page class
    $pageClass = 'tag-page-' . strtolower(str_replace(' ', '-', $tag));
}

// include the initialize file
include "init.php";

?>

<div class="categories-page-inner">
    <div class="container">
        <div class="row">
            <?php
            if (isset($tag)) {
            ?>
            <h1 class="text-center col-12 main-heading">
                <?php echo ucfirst(str_replace('-', ' ', $tag)); ?>
            </h1>
            <div class="tag-items col-12">
                <?php
                $tagItems = $con->prepare("SELECT * FROM items WHERE Tags LIKE '%$tag%' ORDER BY ID");
                $tagItems->execute();
                $rows = $tagItems->fetchAll();
                foreach($rows as $item) { ?>
                    <div class="tag-item-name">
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