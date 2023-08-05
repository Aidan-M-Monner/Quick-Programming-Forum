<?php
    require('config.inc.php');
    require('functions.php');
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale-1">
        <title>Single Post - PHP Forum</title>
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
                <h1 class="class_41">Single Post</h1>

                <!-- *Post ---------------------------------------------->
                <div class="class_42">
                    <div class="class_45">
                        <img src="assets/images/59.png" class="class_47">
                        <h2 class="class_48">Jane Name <br></h2>
                    </div>
                    <div class="class_49">
                        <h4 class="class_41">3rd Jan 23 14:35pm <br></h4>
                        <div class="class_15">[Dummy Text]</div>
                        <div class="class_51">
                            <i class="bi bi-chat-left-dots class_52"></i>
                            <div class="class_53">Comments</div>
                        </div>
                    </div>
                </div>

                <!-- *Comments ---------------------------------------------->
                <div class="class_11">
                    <h1 class="class_41" style="font-size: 16px;">Comments</h1>
                    <div class="class_42">
                        <div class="class_43">
                            <textarea placeholder="Write a comment" name="comments" class="class_44"></textarea>
                        </div>
                        <div class="class_45">
                            <button class="class_46">Comment</button>
                        </div>
                    </div>

                    <!-- *Comment ---------------------------------------------->
                    <div class="class_42">
                        <div class="class_45">
                            <img src="assets/images/user.jpg" class="class_47">
                            <h2 class="class_48">Jane Name <br></h2>
                        </div>
                        <div class="class_49">
                            <h4 class="class_41">3rd Jan 23 14:35pm <br></h4>
                            <div class="class_15">[Dummy Text]</div>
                            <div class="class_51">
                                <i class="bi bi-chat-left-dots class_52"></i>
                                <div class="class_53">Comments</div>
                            </div>
                        </div>
                    </div>

                    <!-- *Comments Page Buttons ---------------------------------------------->
                    <div class="class_37">
                        <button class="class_54">Prev Page</button>
                        <button class="class_39">Next Page</button>
                        <div class="class_40"></div>
                    </div>
                </div>
            </div>

            <!-- Signup ---------------------------------------------->
            <?php include('signup.inc.php') ?>

        </section>
    </body>
</html>