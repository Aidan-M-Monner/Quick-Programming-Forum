<?php
    require('config.inc.php');
    require('functions.php');

    if(!logged_in()) {
        header("Location: index.php");
        die;
    }

    $user_id = $_SESSION['USER']['id'];

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $errors = [];
        
        // update
        $username = addslashes($_POST['username']);
        $email = addslashes($_POST['email']);
        $bio = addslashes($_POST['bio']);
        $yt = addslashes($_POST['yt']);
        $tw = addslashes($_POST['tw']);
        $fb = addslashes($_POST['fb']);

        // Check if user left password empty
        if(!empty($_POST['password'])) {
            if($_POST['password'] !== $_POST['retype_password']) {
                $errors['password'] = "Passwords do not match";
            }
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        }

        // Make sure Email is valid
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Email is not valid";
        }

        // Make sure no numbers in username
        if(!preg_match("/[a-zA-Z]+$/", $username)) {
            $errors['username'] = "Username cannot have numbers.";
        }

        // Upload Image
        if(!empty($_FILES['image']['name'])) {
            $allowed = ['image/jpeg', 'image/png', 'image/webp'];
            if(!in_array($_FILES['image']['type'], $allowed)) {
                $errors['image'] = "Image type not supported";
            } else {
                $folder = "uploads/";
                if(!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                }
                $image = $folder . $_FILES['image']['name'];
            }
        }

        // If there are no errors, changes can be made.
        if(empty($errors)) {
            $image_string = "";
            if(!empty($image)) {
                $image_string = ", image = '$image'";
                move_uploaded_file($_FILES['image']['tmp_name'], $image);
            }

            $password_string = "";
            if(!empty($password)) {
                $password_string = ", password = '$password'";
            }

            $query = "update users set username = '$username', email = '$email', bio = '$bio', yt = '$yt', tw = '$tw', fb = '$fb' $image_string $password_string where id = '$user_id' limit 1";
            query($query);

            $query = "select * from users where id = '$user_id' limit 1";
            $row = query($query);

            if($row) {
                authenticate($row[0]);
            }

            header("Location: profile-settings.php");
            die;
        }
    }

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
                    <?php if(!empty($errors)):?>
                        <div class="class_16">
                            <i class="bi bi-exclamation-circle-fill class_14"></i>
                            <?=implode("<br>", $errors)?>
                        </div>
                    <?php endif;?>
                    <!-- *Profile Settings ---------------------------------------------->
                    <?php if(!empty($row)):?>
                        <form method="post" enctype="multipart/form-data" class="class_26">
                            <h1 class="class_27">Profile Settings</h1>

                            <label>
                                <img src="<?=get_image($row['image'])?>" class="class_28 js-image" style="cursor: pointer;">
                                <input onchange="display_image(this.files[0])" type="file" name="image" class="class_29">

                                <script>
                                    function display_image(file) {
                                        let allowed = ['image/jpg', 'image/png', 'image/wepb'];

                                        if(!allowed.includes(file.type)) {
                                            alert("File type is not allowed!");
                                            return;
                                        }

                                        let img = document.querySelector(".js-image");
                                        img.src = URL.createObjectURL(file);
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
                                    <input placeholder="Leave empty to keep old password" type="password" name="password" class="class_33">
                                </div>
                                <div class="class_31">
                                    <label class="class_32">Retype Password:</label>
                                    <input placeholder="" type="password" name="retype_password" class="class_33">
                                </div>

                                <hr>

                                <div class="class_31">
                                    <label class="class_32">FaceBook:</label>
                                    <input value="<?=$row['fb']?>" placeholder="FaceBook Link" type="text" name="fb" class="class_33">
                                </div>
                                <div class="class_31">
                                    <label class="class_32">Twitter:</label>
                                    <input value="<?=$row['tw']?>" placeholder="Twitter Link" type="text" name="tw" class="class_33">
                                </div>
                                <div class="class_31">
                                    <label class="class_32">Youtube:</label>
                                    <input value="<?=$row['yt']?>" placeholder="YouTube Link" type="text" name="yt" class="class_33">
                                </div>

                                <div class="class_31">
                                    <label class="class_32">Bio:</label>
                                    <textarea placeholder="Bio" name="bio" class="class_33"><?=$row['bio']?></textarea>
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