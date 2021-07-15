<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <div class="row">
            <div class="col">
                <a class="navbar-brand" href="#" title="<?php echo lang("HOME_ADMIN"); ?>"><?php echo lang("HOME_ADMIN"); ?></a>
                <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#" title="<?php echo lang("CATEGORIES"); ?>"><?php echo lang("CATEGORIES"); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" title="<?php echo lang("ITEMS"); ?>"><?php echo lang("ITEMS"); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" title="<?php echo lang("MEMBERS"); ?>"><?php echo lang("MEMBERS"); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" title="<?php echo lang("STATISTICS"); ?>"><?php echo lang("STATISTICS"); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" title="<?php echo lang("LOGS"); ?>"><?php echo lang("LOGS"); ?></a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto admin-dropdown">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Admin">
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
