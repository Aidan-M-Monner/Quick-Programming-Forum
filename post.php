<?php
    require('config.inc.php');
    require('functions.php');

    $post_id = $_GET['id'] ?? 0;
    $query = "select * from posts where id = '$post_id' limit 1";
    $row = query($query);

    if($row) {
        $row = $row[0];
        $id = $row['user_id'];
        $query = "select * from users where id = '$id' limit 1";
        $user_row = query($query);
        
        if($user_row){
            $row['user'] = $user_row[0];
            $row['user']['image'] = get_image($user_row[0]['image']);
        }
    }
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
                <?php if(!empty($row)):?>
                    <div id="post_<?=$row['id']?>" row="<?=htmlspecialchars(json_encode($row))?>" class="class_42"> 
                        <a href="profile.php?id=<?=$row['user']['id'] ?? 0?>" class="class_45">
                            <img src="<?=$row['user']['image']?>" class="class_47">
                            <h2 class="class_48" style="font-size: 16px"> <?=$row['user']['username'] ?? 'Unknown';?></h2>
                        </a>
                        <div class="class_49">
                            <h4 class="class_41"><?=date("jS M, Y H:i:s a", strtotime($row['date']))?></h4>
                            <div class="class_15"><?=nl2br(htmlspecialchars($row['post']))?></div>

                            <?php if(i_own_post($row)):?>
                                <div class="class_51">
                                    <div onclick="postedit.show(<?=$row['id']?>)" class="class_53" style="color: green; cursor: pointer;"> Edit </div>
                                    <div onclick="mypost.delete(<?=$row['id']?>)" class="class_53" style="color: red; cursor: pointer;"> Delete </div>
                                </div>
                            <?php endif;?>
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
                        <section class="js-posts">
                            <div style="padding: 10px; text-align: center;">Loading comments...</div>

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
                        </section>

                        <!-- *Comments Page Buttons ---------------------------------------------->
                        <div class="class_37">
                            <button class="class_54">Prev Page</button>
                            <button class="class_39">Next Page</button>
                            <div class="class_40"></div>
                        </div>
                    </div>

                <?php else:?>
                    <div class="class_16">
                        <i class="bi bi-exclamation-circle-fill class_14"></i>
                        <div class="class_15">Post not found!</div>
                    </div>
                <?php endif;?>
            </div>
            <br><br>

            <!-- Signup ---------------------------------------------->
            <?php include('signup.inc.php') ?>
            <?php include('post.edit.inc.php') ?>
        </section>

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
                    <div class="class_53 js-comment-link" style="color: blue; cursor: pointer;"> Comments </div>
                </div>
                
            </div>
        </div>

    </body>
    <script src="./assets/js/mypost.js?v3"></script>
</html>