<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
<meta charset="UTF-8">
<title>用户登录注册界面</title>

<link rel="stylesheet" href="/myshop/Public/Home/css/bgpublic.css">

<!--主要样式-->
<link rel="stylesheet" href="/myshop/Public/Home/css/userloginbg.css">
<link rel="stylesheet" type="text/css" href="/myshop/Public/Home/css/userlogin.css">
<script type="text/javascript" src="/myshop/Public/Home/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="/myshop/Public/Home/js/bganimate.js"></script>

</head>
<body>

<div class="bannerbox">

    <div class="nav">
        <dl>
            <dd class=""></dd>
            <dd class=""></dd>
            <dd class=""></dd>
        </dl>
    </div>
    <ul>
        <li class="fst-li">
            <div class="logo"></div>
            <div class="containt-div">
               <div class="baner-01-a"><img src="/myshop/Public/Home/images/banner-01-a1.png" alt=""></div>
               <div class="baner-01-b"><img src="/myshop/Public/Home/images/banner-01-b1.png" alt=""></div>
            </div>
        </li>
        <li class="sec-li">
            <div class="logo"></div>
            <div class="containt-div">
                <div class="banner2-02"><img src="/myshop/Public/Home/images/banner2-021.png" alt=""></div>
                <div class="banner2-01"><img src="/myshop/Public/Home/images/banner2-011.png" alt=""></div>
                <div class="banner2-03"><img src="/myshop/Public/Home/images/banner2-031.png" alt=""></div>
            </div>
        </li>
        <li class="third-li">
            <div class="logo"></div>
            <div class="containt-div">
                <div class="banner3-01"><img src="/myshop/Public/Home/images/banner3-011.png" alt=""></div>
                <div class="banner3-02"><img src="/myshop/Public/Home/images/banner3-021.png" alt=""></div>
                <div class="banner3-03"><img src="/myshop/Public/Home/images/banner3-03.png" alt=""></div>
                <div class="banner3-04"><img src="/myshop/Public/Home/images/banner3-04.png" alt=""></div>
            </div>
        </li>
    </ul>
    <div class="container">
        <div class="login-wrap">
            <div class="login-html">
                <input id="tab-1" type="radio" name="tab" class="sign-in" checked=""><label for="tab-1" class="tab">登录</label>
                <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">注册</label>
                <div class="login-form">
                    <div class="sign-in-htm">
                    <form action="<?php echo U('Home/Consumer/conlogin');?>" method="post" name="formlogin">
                        <div class="group">
                            <label for="user_in" class="label">用户名</label>
                            <input id="user_in" name="con_name" type="text" class="input">
                        </div>
                        <div class="group">
                            <label for="psw_in" class="label">密码</label>
                            <input id="psw_in" name="con_psw" type="password" class="input" data-type="password">
                        </div>
                        <div class="group">
                            <label for="checknum" class="label">验证码</label>
                            <input id="checknum" name="checknum" type="text" class="input" style="width:120px;display:inline-block">
                            <span>
                                <img src="<?php echo U('Home/Consumer/checknumber');?>" onClick="this.src=this.src+'?'+Math.random()">
                                <span style="font-size:10pt" href="">看不清,点图刷新</span>
                            </span>

                        </div>
                        <!-- <div class="group">
                            <input id="check" type="checkbox" class="check" checked="">
                            <label for="check"><span class="icon"></span>记住我</label>
                        </div> -->
                        <div class="group">
                            <input type="submit" class="button" value="登录">
                        </div>
                        <div class="hr"></div>
                        <!-- <div class="foot-lnk">
                            <a href="#forgot">忘记密码?</a>
                        </div> -->
                    </form>
                    </div>
                    <div class="sign-up-htm">
                    <form action="<?php echo U('Home/Consumer/conregister');?>" method="post" name="formregister">
                        <div class="group">
                            <label for="user_up" class="label">用户名</label>
                            <input id="user_up" name="con_name" type="text" class="input">
                        </div>
                        <div class="group">
                            <label for="psw_up" class="label">输入密码</label>
                            <input id="psw_up" name="con_psw" type="password" class="input" data-type="password">
                        </div>
                        <div class="group">
                            <label for="psw_again" class="label">再次输入密码</label>
                            <input id="psw_again" name="psw_again" type="password" class="input" data-type="password">
                        </div>
                        <div class="group">
                            <label for="email" class="label">邮箱</label>
                            <input id="email" name="con_email" type="email" class="input">
                        </div>
                        <div class="group">
                            <input type="submit" class="button" value="注册">
                        </div>
                        <div class="hr"></div>
                        <div class="foot-lnk">
                            <!--<label for="tab-1">Already Member?</label>-->
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>