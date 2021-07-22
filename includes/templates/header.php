<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php getTitle(); ?></title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link type="text/css" rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/themes/base/jquery-ui.css" />
    <link type="text/css" rel="stylesheet" href="http://gregfranko.com/jquery.selectBoxIt.js/css/jquery.selectBoxIt.css" />

    <!-- Custom Styles -->
    <link rel="stylesheet" href="<?php echo $css; ?>admin.min.css" />

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="<?php echo isset($pageClass)? $pageClass : ''; ?>">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <div class="row">
            <div class="col">
                <a class="navbar-brand" href="dashboard.php" title="<?php echo lang("HOME_ADMIN"); ?>"><?php echo lang("HOME_ADMIN"); ?></a>
                <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="categories.php" title="<?php echo lang("CATEGORIES"); ?>"><?php echo lang("CATEGORIES"); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="items.php" title="<?php echo lang("ITEMS"); ?>"><?php echo lang("ITEMS"); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="members.php" title="<?php echo lang("MEMBERS"); ?>"><?php echo lang("MEMBERS"); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="comments.php" title="<?php echo lang("COMMENTS"); ?>"><?php echo lang("COMMENTS"); ?></a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto admin-dropdown">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="dashboard.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Admin">
                                Mohammed
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="members.php?do=edit&userid=<?php echo $_SESSION['ID'] ?>" title="Edit">Edit profile</a>
                                <a class="dropdown-item" href="#" title="Settings">Settings</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php" title="Logout">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
