<!-- Prevention from being seen -->
<?php defined('APP') or die('direct script access denied!'); ?>

<div class="class_55 js-post-edit-modal hide" style="min-width: 600px; min-height: auto;">
    <div class="class_39" style="background-color: #D20202; margin: 10px; padding: 5px; padding-left: 10px; padding-right: 10px;" onclick="postedit.hide()">X</div>
    <h1 class="class_27">Edit Post</h1>
    <form onsubmit="postedit.submit(event)" method="post" class="class_42">
        <div class="class_43">
            <textarea placeholder="Whats on your mind?" name="post" class="class_44 js-post-edit-input"></textarea>
        </div>
        <div class="class_45">
            <button class="class_46">Save</button>
        </div>
    </form>
</div>

<script>
    var postedit = {
        edit_id : 0,

        show: function(id) {
            postedit.edit_id = id; // Gives the id of whatever post we are trying to edit.

            let data = document.querySelector("#post_"+id).getAttribute("row");
            data = data.replaceAll('\\"', '"'); // Replacing all quotes to get JSON data
            data = JSON.parse(data);

            if(typeof data == 'object') {
                document.querySelector(".js-post-edit-input").value = data.post;
            } else {
                alert("Invalid post data!");
            }

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
            let post = document.querySelector(".js-post-edit-input").value.trim();
            let form = new FormData(); // Create very own form
            
            form.append('id', postedit.edit_id);
            form.append('post', post);
            form.append('data_type', 'edit_post');

            var ajax = new XMLHttpRequest();
            ajax.addEventListener('readystatechange', function() {
                // Set to 4 to make sure we got a response.
                if(ajax.readyState == 4) {
                    if(ajax.status == 200) {
                        console.log(ajax.responseText);
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