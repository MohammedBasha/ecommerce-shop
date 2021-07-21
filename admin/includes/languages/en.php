<?php

function lang($phrase) {
    static $lang = [

        // Navbar links
        "HOME_ADMIN"    => "Home",
        "CATEGORIES"    => "Categories",
        "ITEMS"         => "Items",
        "MEMBERS"       => "Members",
        "COMMENTS"      => "Comments",
        "LOGS"          => "Logs"
    ];
    return $lang[$phrase];
}