<?php 
    require('config.inc.php');
    require('functions.php');

    $info['data_type'] = "";
    $info['success'] = false;

    // Know when something was posted - Information about what is happening in the server.
    if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['data_type'])) {
        $info['data_type'] = $_POST['data_type'];
        
        if($_POST['data_type'] == 'signup') {
            $username = addslashes($_POST['username']);
            $email = addslashes($_POST['email']);
            $password = $_POST['password'];
            $password_retype = $_POST['retype_password'];
            $date = date("Y-m-d H:i:s");

            // Check if this email already exists.
            $query = "select * from users where email = '$email' limit 1";
            $row = query($query);

            if($row) {
                $info['message'] = "That email already exists.";
            } else if($password !== $password_retype) {
                $info['message'] = "Passwords don't match.";
            } else {
                $password = password_hash($password, PASSWORD_DEFAULT);
                $query = "insert into users (username, email, password, date) values ('$username', '$email', '$password', '$date')";
                query($query);

                $query = "select * from users where email = '$email' limit 1";
                $row = query($query);

                if($row) {
                    $row = $row[0];
                    $info['success'] = true;
                    $info['message'] = "your profile was created successfully.";
                    authenticate($row);
                }
            } 
        } else if($_POST['data_type'] == 'login') {
            $email = addslashes($_POST['email']);

            // Check if this email already exists.
            $query = "select * from users where email = '$email' limit 1";
            $row = query($query);

            if(!$row) {
                $info['message'] = "Wrong email or password";
            } else {
                $row = $row[0];

                if(password_verify($_POST['password'], $row['password'])) {
                    // Correct
                    $info['success'] = true;
                    authenticate($row);
                    $info['message'] = "Successful login!";
                } else {
                    $info['message'] = "Wrong email or password.";
                }
            }
        } else if($_POST['data_type'] == 'logout') {
            logout();
            $info['message'] = "You were successfully logged out.";
        }
    }

    echo json_encode($info);