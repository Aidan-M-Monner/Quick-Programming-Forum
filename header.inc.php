<!-- Prevention from being seen -->
<?php defined('APP') or die('direct script access denied!'); ?>

<header class="class_2">
    <div class="class_3">
        <img src="assets/images/slack.png" class="class_4">
    </div>
    <div class="item_class_0 class_5">
        <div class="item_class_1 class_6">
            <svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="m22 16.75c0-.414-.336-.75-.75-.75h-18.5c-.414 0-.75.336-.75.75s.336.75.75.75h18.5c.414 0 .75-.336.75-.75zm0-5c0-.414-.336-.75-.75-.75h-18.5c-.414 0-.75.336-.75.75s.336.75.75.75h18.5c.414 0 .75-.336.75-.75zm0-5c0-.414-.336-.75-.75-.75h-18.5c-.414 0-.75.336-.75.75s.336.75.75.75h18.5c.414 0 .75-.336.75-.75z" fill-rule="nonzero"></path>
            </svg>
        </div>
        <div class="item_class_2 class_7">
            <a href="index.php" class="class_8">Home</a>
            <a href="#" class="class_8">About</a>
            <a href="#" class="class_8">Contact</a>
        </div>
    </div>
    <div class="class_9">
        <img src="<?= get_image($_SESSION['USER']['image'])?>" class="class_10">
        Hi, User
    </div>
</header>