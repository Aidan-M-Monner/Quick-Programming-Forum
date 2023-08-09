<!-- Prevention from being seen -->
<?php defined('APP') or die('direct script access denied!'); ?>

<div class="class_55 js-login-modal hide">
    <div class="class_39" style="background-color: #D20202; margin: 10px; padding: 5px; padding-left: 10px; padding-right: 10px;" onclick="login.hide()">X</div>
    <h1 class="class_27">Login</h1>
    <img src="assets/images/slack.png" class="class_56">
    <form onsubmit="login.submit(event)" method="post" class="class_57">
        <div class="class_30">
            <div class="class_58">
                <label class="class_32">Email:</label>
                <input placeholder="Email" type="email" name="email" class="class_33" required="true">
            </div>
            <div class="class_58">
                <label class="class_32">Password:</label>
                <input placeholder="Password" type="password" name="password" class="class_33" required="true">
            </div>
            <div style="padding: 10px;">Don't have an account? <span style="cursor: pointer; color: blue" onclick="signup.show()"> Click here to signup. </span></div>
            <div class="class_59">
                <button class="class_60">Login</button>
                <div class="class_40"></div>
            </div>
        </div>
    </form>
</div>

<script>
    // Removes the hide css, thus allowing the content to be shown - in this case, anything that needs to have user signed up.
    var login = {
        show: function() {
            document.querySelector(".js-login-modal").classList.remove('hide');
            document.querySelector(".js-signup-modal").classList.add('hide');
        },
        hide: function() {
            document.querySelector(".js-login-modal").classList.add('hide');
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