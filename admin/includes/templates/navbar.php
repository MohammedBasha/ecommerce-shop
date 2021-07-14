<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <div class="row">
            <div class="col">
                <a class="navbar-brand" href="#"><?php echo lang("HOME_ADMIN"); ?></a>
                <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#"><?php echo lang("CATEGORIES"); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><?php echo lang("ITEMS"); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><?php echo lang("MEMBERS"); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><?php echo lang("STATISTICS"); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><?php echo lang("LOGS"); ?></a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto admin-dropdown">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Mohammed
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Edit profile</a>
                                <a class="dropdown-item" href="#">Settings</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
