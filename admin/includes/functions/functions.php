<?php

/*
 * Echo the page title if specified in the page $pageTitle or default in another pages
 * */

function getTitle() {
    global $pageTitle;

    echo isset($pageTitle)? $pageTitle : 'Default';
}