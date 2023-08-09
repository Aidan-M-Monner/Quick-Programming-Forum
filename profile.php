<?php
    require('config.inc.php');
    require('functions.php');

    if(!logged_in()) {
        header("Location: index.php");
        die;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale-1">
        <title>Profile - PHP Forum</title>
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-icons.css">
        <link rel="stylesheet" type="text/css" href="assets/css/class_styles.css">
        <link rel="stylesheet" type="text/css" href="assets/css/extra_styles.css">
    </head>

    <body>
        <section class="class_1">
            <!-- Top Bar ---------------------------------------------->
            <?php include('header.inc.php'); ?>

            <!-- Settings ---------------------------------------------->
            <div class="class_11">
                <div class="class_12">
                    <!-- *Saving Settings ---------------------------------------------->
                    <?php include('success.alert.inc.php'); ?>
                    <?php include('failure.alert.inc.php'); ?>
                    <div class="class_19"></div>

                    <!-- *Profile ---------------------------------------------->
                    <div class="class_20">
                        <img src="assets/images/57.png" class="class_21">
                        <div class="class_22">
                            <h1 class="class_23">Mary Jane <br></h1>
                            <i class="bi bi-facebook class_24"></i>
                            <i class="bi bi-twitter class_24"></i>
                            <i class="bi bi-youtube class_24"></i>
                            <div class="class_15"> [Text Goes Here] <br></div>
                        </div>
                    </div>
                    <a href="profile-settings.php"><button class="class_39">Edit Profile</button></a>
                    <button class="class_39" onclick="user.logout()">Logout</button>
                    <div style="clear: both"></div>
                </div>
            </div>
            <!-- Signup ---------------------------------------------->
            <?php include('signup.inc.php') ?>

        </section>
    </body>
</html>