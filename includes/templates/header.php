<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php getTitle(); ?></title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
          integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link type="text/css" rel="stylesheet"
          href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/themes/base/jquery-ui.css"/>
    <link type="text/css" rel="stylesheet"
          href="http://gregfranko.com/jquery.selectBoxIt.js/css/jquery.selectBoxIt.css"/>

    <!-- Custom Styles -->
    <link rel="stylesheet" href="<?php echo $css; ?>styles.min.css"/>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="<?php echo isset($pageClass) ? $pageClass : ''; ?>">

<div class="upper-bar">
    <div class="container">
        <div class="row">
            <?php
            if (isset($_SESSION['frontuser'])) {
                echo 'Welcome ' . $_SESSION['frontuser'];
                $status = checkUserStatus($_SESSION['frontuser']);
                echo $status == 1? ' Your membership needs activation' : '';
            } else {
            ?>
            <a href="login.php" title="Login / Sign up">
                Login / Sign up
            </a>
            <?php } ?>
        </div>
    </div>
</div>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <div class="row">
            <div class="col">
                <a class="navbar-brand" href="dashboard.php"
                   title="<?php echo lang("HOME_ADMIN"); ?>"><?php echo lang("HOME_ADMIN"); ?></a>
                <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse ml-auto" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <?php
                            foreach(getCategories() as $category) {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link"
                               href="categories.php?catid=<?php echo $category["ID"]; ?>&catname=<?php echo strtolower(str_replace(' ', '-', $category["Name"])); ?>" title="<?php echo $category["Name"]; ?>">
                                <?php echo $category["Name"]; ?>
                            </a>
                        </li>
                        <?php }; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
