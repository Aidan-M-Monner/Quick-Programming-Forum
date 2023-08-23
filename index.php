<?php
    require('config.inc.php');
    require('functions.php');
    
    $page = $_GET['page'] ?? 1;
    $page = (int)$page;

    if($page < 1) {
        $page = 1;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale-1">
        <title>Home - PHP Forum</title>
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
                <!-- *Saving Settings ---------------------------------------------->
                <?php include('success.alert.inc.php'); ?>
                <?php include('failure.alert.inc.php'); ?>

                <!-- Posts ---------------------------------------------->
                <h1 class="class_41">Posts</h1>
                <?php if(logged_in()):?>
                <form onsubmit="mypost.submit(event)" method="post" class="class_42">
                    <div class="class_43">
                        <textarea placeholder="Whats on your mind?" name="post" class="class_44 js-post-input"></textarea>
                    </div>
                    <div class="class_45">
                        <button class="class_46">Post</button>
                    </div>
                </form>
                <?php else:?>
                    <div class="class_13">
                        <i class="bi bi-info-circle-fill class_14"></i>
                        <div onclick="login.show()" class="class_15" style="cursor: pointer">
                            You're not logged in <br> Click here to login and post!
                        </div>
                    </div>
                <?php endif;?>

                <!-- *Post ---------------------------------------------->
                <section class="js-posts">
                    <div style="padding: 10px; text-align: center;">Loading posts...</div>
                </section>

                <!-- *Comments Page Buttons ---------------------------------------------->
                <div class="class_37" style="display: flex; justify-content: space-between;">
                    <button onclick="mypost.prev_page()" class="class_54">Prev Page</button>
                    <div class="js-page-number"> Page 1 </div>
                    <button onclick="mypost.next_page()" class="class_39">Next Page</button>
                </div>
            </div>

            <!-- Signup & Login ---------------------------------------------->
            <?php include('signup.inc.php') ?>
            <?php include('login.inc.php') ?>
            <?php include('post.edit.inc.php') ?>

        </section>

        <!-- Post Template ---------------------------------------------->
        <div class="class_42 js-post-card hide" style="animation: appear 3s ease;">
            <a href="#" class="class_45 js-profile-link">
                <img src="assets/images/user.jpg" class="class_47 js-image">
                <h2 class="class_48 js-username" style="font-size: 16px">Jane Name</h2>
            </a>
            <div class="class_49">
                <h4 class="class_41 js-date">3rd Jan 23 14:35 pm </h4>
                <div class="class_15 js-post"> [Dummy Text] </div>
                <div class="class_51">
                    <i class="class_52 bi bi-chat-left-dots"></i>
                    <div class="class_53 js-comment-link" style="color: blue; cursor: pointer;"> Comments 0 </div>
                </div>
                
            </div>
        </div>
    </body>

    <script>
        var page_number = <?=$page?>;
        var home_page = true;
    </script>
    <script src="./assets/js/mypost.js?v2"></script>
</html>