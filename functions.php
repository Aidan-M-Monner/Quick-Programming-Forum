<?php 

    // Makes sure the user cannot go to restricted pages such as functions.php or header.php
    defined('APP') or die('direct script access denied!');

    // Checks if logged in
    function logged_in() {
        return false;
    }