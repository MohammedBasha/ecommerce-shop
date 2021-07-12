<?php

function lang($phrase) {
    static $lang = [
        "Message" => "Welcome",
        "Admin" => "Administrator"
    ];
    return $lang[$phrase];
}