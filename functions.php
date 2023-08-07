<?php 
    session_start();

    // Makes sure the user cannot go to restricted pages such as functions.php or header.php
    defined('APP') or die('direct script access denied!');

    // Saving the user's row in the session USER.
    function authenticate($row) {
        $_SESSION['USER'] = $row;
    }

    // Query function - grabbing results
    function query($query) {
        global $con;
        $result = mysqli_query($con, $query);
        if(!is_bool($result) && mysqli_num_rows($result) > 0) {
            $data = [];
            while($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    // Checks if logged in
    function logged_in() {
        if(!empty($_SESSION['USER'])) {
            return true;
        }
        return false;
    }

    // Logs user out
    function logout() {
        if(!empty($_SESSION['USER'])) {
            unset($_SESSION['USER']);
        }
    }

    // Adding images to profile 
    function get_image($path) {
        if(!empty($path) && file_exists($path)) {
            return $path;
        }
        return 'assets/images/user.jpg?v1';
    }
