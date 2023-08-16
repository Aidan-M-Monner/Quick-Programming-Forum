<!-- Prevention from being seen -->
<?php defined('APP') or die('direct script access denied!'); ?>

<div class="class_55 js-post-edit-modal hide">
    <div class="class_39" style="background-color: #D20202; margin: 10px; padding: 5px; padding-left: 10px; padding-right: 10px;" onclick="login.hide()">X</div>
    <h1 class="class_27">Edit Post</h1>
    <img src="assets/images/slack.png" class="class_56">
    <form onsubmit="postedit.submit(event)" method="post" class="class_42">
        <div class="class_43">
            <textarea placeholder="Whats on your mind?" name="post" class="class_44 js-post-input"></textarea>
        </div>
        <div class="class_45">
            <button class="class_46">Post</button>
        </div>
    </form>
</div>

<script>
    var postedit = {
        show: function() {
            document.querySelector(".js-post-edit-modal").classList.remove('hide');
            document.querySelector(".js-login-modal").classList.add('hide');
            document.querySelector(".js-signup-modal").classList.add('hide');
        },
        hide: function() {
            document.querySelector(".js-post-edit-modal").classList.add('hide');
        },
        submit : function(e) {
            // Prevents page refresh
            e.preventDefault();

            // Search for all inputs
            let inputs = e.currentTarget.querySelectorAll("input");
            let form = new FormData(); // Create very own form
            for(var i = inputs.length - 1; i >= 0; i--) {
                form.append(inputs[i].name, inputs[i].value);
            }
            form.append('data_type', 'login');

            var ajax = new XMLHttpRequest();
            ajax.addEventListener('readystatechange', function() {
                // Set to 4 to make sure we got a response.
                if(ajax.readyState == 4) {
                    if(ajax.status == 200) {
                        let obj = JSON.parse(ajax.responseText); // Convert JSON back to an array
                        alert(obj.message);
                        
                        if(obj.success) {
                            window.location.reload(); // Refresh page
                        }
                    } else {
                        alert("Please check your internet connection");
                    }
                }
            });
            ajax.open('post','ajax.inc.php', true);
            ajax.send(form);
        }
    };
</script>