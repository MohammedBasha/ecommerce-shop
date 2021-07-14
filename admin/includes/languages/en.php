<?php

function lang($phrase) {
    static $lang = [

        // Navbar links
        "HOME_ADMIN"    => "Home",
        "CATEGORIES"    => "Categories",
        "ITEMS"         => "Items",
        "MEMBERS"       => "Members",
        "STATISTICS"    => "Statistics",
        "LOGS"          => "Logs"
    ];
    return $lang[$phrase];
}