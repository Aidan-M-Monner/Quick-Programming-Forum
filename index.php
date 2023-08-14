<?php
    require('config.inc.php');
    require('functions.php');
    // logout();
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
                            You're not logged in <br> Click here to login and post 
                        </div>
                    </div>
                <?php endif;?>

                <!-- *Post ---------------------------------------------->
                <section class="js-posts">
                    <div style="padding: 10px; text-align: center;">Loading posts...</div>
                </section>

                <!-- *Comments Page Buttons ---------------------------------------------->
                <div class="class_37" style="display: flex; justify-content: space-between;">
                    <button class="class_54">Prev Page</button>
                    <div> Page 1 </div>
                    <button class="class_39">Next Page</button>
                </div>
            </div>

            <!-- Signup & Login ---------------------------------------------->
            <?php include('signup.inc.php') ?>
            <?php include('login.inc.php') ?>

        </section>

        <!-- Post Template ---------------------------------------------->
        <div class="class_42 js-post-card hide" style="animation: appear 3s ease;">
            <div class="class_45">
                <img src="assets/images/user.jpg" class="class_47 js-image">
                <h2 class="class_48 js-username" style="font-size: 16px">Jane Name</h2>
            </div>
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

    <script>
        var mypost = {
            submit : function(e) {
                // Prevents page refresh
                e.preventDefault();

                // Search for all inputs
                let text = document.querySelector('.js-post-input').value.trim();

                // Make sure post contains content.
                if(text == "") {
                    alert("Please type something to post.");
                    return;
                }

                let form = new FormData(); // Create very own form
                form.append('post', text);
                form.append('data_type', 'add_post');
                var ajax = new XMLHttpRequest();

                ajax.addEventListener('readystatechange', function() {
                    // Set to 4 to make sure we got a response.
                    if(ajax.readyState == 4) {
                        if(ajax.status == 200) {
                            let obj = JSON.parse(ajax.responseText);
                            alert(obj.message);

                            if(obj.success) {
                                mypost.load_posts();
                            }
                        } else {
                            alert("Please check your internet connection");
                        }
                    }
                });
                ajax.open('post','ajax.inc.php', true);
                ajax.send(form);
            },

            load_posts : function(e) {

                let form = new FormData(); // Create very own form
                form.append('data_type', 'load_posts');
                var ajax = new XMLHttpRequest();

                ajax.addEventListener('readystatechange', function() {
                    // Set to 4 to make sure we got a response.
                    if(ajax.readyState == 4) {
                        if(ajax.status == 200) {
                            let obj = JSON.parse(ajax.responseText);

                            if(obj.success) {
                                let post_holder = document.querySelector(".js-posts");
                                
                                post_holder.innerHTML = "";
                                let template = document.querySelector(".js-post-card");

                                for (var i = 0; i < obj.rows.length; i++) {
                                    template.querySelector(".js-post").innerHTML = obj.rows[i].post;
                                    template.querySelector(".js-date").innerHTML = obj.rows[i].date;
                                    template.querySelector(".js-comment-link").setAttribute('onclick', `mypost.view_comments(${obj.rows[i].id})`);
                                    template.querySelector(".js-username").innerHTML = (typeof obj.rows[i].user == 'object') ? obj.rows[i].user.username : 'User';

                                    if(typeof obj.rows[i].user == 'object') {
                                        template.querySelector(".js-image").src = obj.rows[i].user.image;
                                    }

                                    let clone = template.cloneNode(true);
                                    clone.classList.remove('hide');
                                    post_holder.appendChild(clone);
                                }
                            }
                        } 
                    }
                });
                ajax.open('post','ajax.inc.php', true);
                ajax.send(form);
            },

            view_comments: function(id) {
                window.location.href = "post.php?id=" + id;
            }
        }

        mypost.load_posts();
    </script>
</html>