<?php if (!defined('THINK_PATH')) exit();?>﻿<!doctype html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>后台管理员登录界面</title>
    <link rel="stylesheet" type="text/css" href="/myshop/Public/Admin/css/adminlogin.css">
</head>
<body>
    <div class="htmleaf-container">
        <div class="wrapper">
            <div class="logo"></div>
            <div class="container">
                <h1>Welcome Administrator</h1>

                <form class="form" action="<?php echo U('Admin/Useradmin/adlogin');?>" method="post">
                    <input type="text" placeholder="Username" name="username">
                    <input type="password" placeholder="Password" name="userpsw">
                    <button type="submit" id="login-button">Login</button>
                </form>
            </div>

            <ul class="bg-bubbles">
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
    </div>

    <script src="/myshop/Public/Admin/js/jquery-2.1.1.min.js" type="text/javascript"></script>
    <!-- <script>
        $('#login-button').click(function (event) {
            event.preventDefault();
            $('form').fadeOut(500);
            $('.wrapper').addClass('form-success');
//            在此添加管理员用户名密码验证
        });
    </script> -->

    <!--<script src="http://www.w2bc.com/scripts/2bc/_gg_980_90.js" type="text/javascript"></script>-->


</body>
</html>