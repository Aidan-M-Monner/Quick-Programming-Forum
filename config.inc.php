<?php 
    define('APP', 'Forum');

    define('DB_HOST', 'localhost');
    define('DB_USER', 'root'); // root is the default value.
    define('DB_PASS', '');
    define('DB_NAME', 'myforum_db');

    // Making a database connection!
    if(!$con = mysqli_connect(DB_HOST, DB_USER,DB_PASS, DB_NAME)) {
        die("Could not connect to the database.");
    }