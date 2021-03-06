<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--移动设备优先-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>管理员界面</title>
    <link href="/myshop/Public/Admin/css/bootstrap.min.css" rel="stylesheet">
    <script type="application/javascript" src="/myshop/Public/Admin/js/jquery-3.2.1.min.js"></script>
    <style type="text/css">
        @media (min-width: 768px) {
            #slider_sub {
                width: 200px;
                margin-top: 51px;
                position: absolute;
                z-index: 1;
                height: 600px;
                border-right: 1px dashed #00CC99;
            }
            #mydd {
                margin-bottom: 0;
            }
            #page_main {
                margin-left: 200px;
            }
            th {
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <!--导航条, navbar-static-top圆角变尖角充满整个屏幕-->
    <nav class="navbar navbar-default navbar-static-top" id="mydd" style="background:rgba(83,227,166,0.7);">
        <!--导航条前面部分-->
        <div class="navbar-header">
            <!--当屏幕缩小会出现按钮-->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#slider_sub">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="#" class="navbar-brand" style="color: #fff">SHshop网站后台管理</a>
        </div>
        <!--导航条后面注销-->
        <ul class="nav navbar-nav navbar-right" style="margin-right: 25px">
            <li><a href="../zzzzuser/userMain.html" style="color:#fff"><span class="glyphicon glyphicon-tree-deciduous"></span>&nbsp;SHShop首页</a></li>
            <li><a href="#" style="color:#fff"><span class="glyphicon glyphicon-off"></span>&nbsp;注销</a></li>
        </ul>

        <!--侧边功能栏-->
        <div class="navbar-default navbar-collapse" id="slider_sub">
            <ul class="nav">
                <li>
                    <a href="#sub1" data-toggle="collapse" id="sp">商品管理&nbsp;<span class="glyphicon glyphicon-menu-down pull-right"></span></a>
                    <ul id="sub1" class="nav collapse" style="background-color: #fff">
                        <li><a href="../Goods/goods_list.html" target="main_frame">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-sunglasses"></span>&nbsp;商品列表</a></li>
                        <li><a href="../Category/cat_list.html" target="main_frame">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-duplicate"></span>&nbsp;分类管理</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#sub2" data-toggle="collapse">订单管理&nbsp;<span class="glyphicon glyphicon-menu-down pull-right"></span></a>
                    <ul id="sub2" class="nav collapse" style="background-color: #fff">
                        <li><a href="../Order/order_list.html" target="main_frame">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-th-list"></span>&nbsp;订单列表</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#sub3" data-toggle="collapse">评论管理&nbsp;<span class="glyphicon glyphicon-menu-down pull-right"></span></a>
                    <ul id="sub3" class="nav collapse" style="background-color: #fff">
                        <li><a href="../Comment/comment_list.html" target="main_frame">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-info-sign"></span>&nbsp;评论列表</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <div id="page_main">
        <iframe src="welcomeAdmin.html" width="100%" height="600" name="main_frame" frameborder="0"></iframe>
    </div>

    <script type="application/javascript" src="/myshop/Public/Admin/js/bootstrap.min.js"></script>
</body>
</html>