<?php 
    require('config.inc.php');
    require('functions.php');

    // Know when something was posted - Information about what is happening in the server.
    if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['data_type'])) {
        $info['data_type'] = $_POST['data_type'];
        $info['success'] = false;
        
        if($_POST['data_type'] == 'signup') {
            $username = addslashes($_POST['username']);
            $email = addslashes($_POST['email']);
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $date = date("Y-m-d H:i:s");

            // Check if this email already exists.
            $query = "select * from users where email = '$email' limit 1";
            $row = query($query);

            if($row) {
                $info['message'] = "That email already exists.";
            } else {
                $query = "insert into users (username, email, password, date) values ('$username', '$email', '$password', '$date')";
                query($query);

                $query = "select * from users where email = '$email' limit 1";
                $row = query($query);

                $info['success'] = true;
                $ifo['message'] = "your profile was created successfully.";
                authenticate($row);
            } else if($_POST['data_type'] == 'login') {
                $username = addslashes($_POST['username']);
                $email = addslashes($_POST['email']);
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $date = date("Y-m-d H:i:s");
    
                // Check if this email already exists.
                $query = "select * from users where email = '$email' limit 1";
                $row = query($query);
    
                if($row) {
                    $info['message'] = "That email already exists.";
                } else {
                    $query = "insert into users (username, email, password, date) values ('$username', '$email', '$password', '$date')";
                    query($query);
    
                    $query = "select * from users where email = '$email' limit 1";
                    $row = query($query);
    
                    $info['success'] = true;
                    $ifo['message'] = "your profile was created successfully.";
                    authenticate($row);
                }
            } else if($_POST['data_type'] == 'logout') {
                logout();
                $info['message'] = "You were successfully logged out.";
            }
        }
    }

    echo json_encode($info);