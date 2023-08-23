<?php
    require('config.inc.php');
    require('functions.php');

    if(!logged_in()) {
        header("Location: index.php");
        die;
    }

    $user_id = $_GET['id'] ?? $_SESSION['USER']['id'];
    $query = "select * from users where id = '$user_id' limit 1";
    $row = query($query);

    if($row) {
        $row = $row[0];
    }
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale-1">
        <title>Profile Settings - PHP Forum</title>
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-icons.css">
        <link rel="stylesheet" type="text/css" href="assets/css/class_styles.css">
        <link rel="stylesheet" type="text/css" href="assets/css/extra_styles.css">
    </head>

    <body>
        <section class="class_1">
            <!-- Top Bar ---------------------------------------------->
            <?php include('header.inc.php'); ?>
            <div class="class_11">
                <div class="class_12">
                    <?php include('success.alert.inc.php'); ?>
                    <?php include('failure.alert.inc.php'); ?>
                    <!-- *Profile Settings ---------------------------------------------->
                    <?php if(!empty($row)):?>
                        <form method="post" enctype="multipart/form-data" class="class_26">
                            <h1 class="class_27">Profile Settings</h1>

                            <label>
                                <img src="<?=get_image($row['image'])?>" class="class_28 js-image" style="cursor: pointer;">
                                <input type="file" name="image" class="class_29">

                                <script>
                                    function display_image(file) {
                                        let img = document.querySelector(".js-image");
                                        img.src = file;
                                    }
                                </script>
                            </label>

                            <div class="class_30">
                                <div class="class_31">
                                    <label class="class_32">Username:</label>
                                    <input value="<?=$row['username']?>" placeholder="Username" type="text" name="username" class="class_33" required="true">
                                </div>
                                <div class="class_31">
                                    <label class="class_32">Email:</label>
                                    <input value="<?=$row['email']?>" placeholder="Email" type="text" name="email" class="class_33" required="true">
                                </div>
                                <div class="class_31">
                                    <label class="class_32">Password:</label>
                                    <input placeholder="Leave empty to keep old password" type="text" name="password" class="class_33">
                                </div>
                                <div class="class_31">
                                    <label class="class_32">Retype Password:</label>
                                    <input placeholder="" type="text" name="retype_password" class="class_33">
                                </div>
                                <div class="class_37 grey">
                                    <button class="class_38">Save</button>
                                    <a href="profile.php"><button class="class_39">Cancel</button></a>
                                    <div class="class_40"></div>
                                </div>
                            </div>
                    </form>
                    <?php else:?>
                        <div class="class_16">
                            <i class="bi bi-exclamation-circle-fill class_14"></i>
                            <div class="class_15">Profile not found!</div>
                        </div>
                    <?php endif;?>
                </div>
            <!-- Signup ---------------------------------------------->
            <?php include('signup.inc.php') ?>

        </section>
    </body>
</html>