<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--移动设备优先-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>商品评论</title>
    <link href="/myshop/Public/Home/css/bootstrap.min.css" rel="stylesheet">
    <link href="/myshop/Public/Home/css/indexstyle.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="/myshop/Public/Home/font-awesome/css/font-awesome.min.css">
    <script type="application/javascript" src="/myshop/Public/Home/js/jquery-3.2.1.min.js"></script>
    <style type="text/css">
        .row {
            margin-left: 0;
            margin-right: 0;
        }
        .centerrow {
            text-align: center;
            padding: 10px 0;
        }
        .marginrow {
            margin-bottom: 20px;
            border: 1px solid #ccc;
        }
        .firstrow {
            color: #fff;
            background-color: #D8703F;
        }
        .marginimg {
            text-align: left;
            padding-left: 30px;
        }
    </style>
</head>
<body>
<!-- header -->
<div class="header">
    <div class="container">
        <div class="header-grid">
            <div class="header-grid-left animated wow slideInLeft" data-wow-delay=".5s">
                <ul>
                    <?php if(che()): ?><li>
                    <i class="glyphicon glyphicon-tree-deciduous" aria-hidden="true"></i>
                    欢迎您，<b><?php echo (cookie('con_name')); ?></b>
                    </li>
                     <li><i class="glyphicon glyphicon-log-out" aria-hidden="true"></i><a href="<?php echo U('Home/Consumer/logout');?>">退出</a></li>
                    <?php else: ?>
                     <li><i class="glyphicon glyphicon-log-in" aria-hidden="true"></i><a href="<?php echo U('Home/Consumer/consumerlogin');?>">登录/注册</a></li><?php endif; ?>
                    <li><i class="glyphicon glyphicon-list-alt" aria-hidden="true"></i><a href="<?php echo U('Home/order/orderlist');?>">我的订单</a></li>
                    <li><i class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></i><a href="<?php echo U('Home/order/shoppingcar');?>">购物车</a></li>
                </ul>
            </div>
            <div class="clearfix"> </div>
        </div>
        <div class="logo-nav">
            <div class="logo-nav-left">
                <h1><a href="<?php echo U('Home/index/userMain');?>">SH Store <span>Shop anywhere</span></a></h1>
            </div>
            <div class="logo-nav-left1">
                <nav class="navbar navbar-default">
                    <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="<?php echo U('Home/index/userMain');?>" class="act">花店首页</a></li>
                            <li><a href="<?php echo U('Home/Category/allgoods');?>" class="act">全部商品</a></li>
                            <!-- Mega Menu -->
                            <?php if(is_array($cattree)): foreach($cattree as $key=>$v): ?><li class="dropdown">
                            <?php if($v["lv"] == 0): ?><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo ($v["cat_name"]); ?><b class="caret"></b></a>
                                <ul class="dropdown-menu multi-column columns-1">
                                    <div class="row">
                                    <?php if(is_array($cattree)): foreach($cattree as $key=>$s): ?><div class="col-sm-12">
                                            <ul class="multi-column-dropdown">
                                            <?php if($v[cat_id] == $s[parent_id]): ?><h6><?php echo ($s["cat_name"]); ?></h6>
                                                <?php if(is_array($cattree)): foreach($cattree as $key=>$h): if($s[cat_id] == $h[parent_id]): ?><li><a href="<?php echo U('Home/Category/goodscat',array('cat_id'=>$h[cat_id]));?>" target="_blank"><?php echo ($h["cat_name"]); ?></a></li><?php endif; endforeach; endif; endif; ?>
                                            </ul>
                                        </div><?php endforeach; endif; ?>
                                    <div class="clearfix"></div>
                                    </div>
                                </ul><?php endif; ?>
                            </li><?php endforeach; endif; ?>
                            
                        </ul>
                    </div>
                </nav>
            </div>
            <!--<div class="logo-nav-left1 col-lg-4">-->
                <!--<div class="input-group search-box">-->
                    <!--<input type="text" class="form-control" placeholder="Search for...">-->
                    <!--<span class="input-group-btn">-->
                        <!--<button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>-->
                    <!--</span>-->
                <!--</div>&lt;!&ndash; /input-group &ndash;&gt;-->
            <!--</div>-->
        </div>
    </div>
</div>
<!-- //header -->
<!--面包屑导航-->
<div class="breadcrumbs">
    <div class="container">
        <ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
            <li><a href="<?php echo U('Home/index/userMain');?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>花店首页</a></li>
            <li><a href="<?php echo U('Home/order/orderlist');?>">我的订单</a></li>
            <li class="active">商品评论</li>
        </ol>
    </div>
</div>
<!--面包屑导航结束-->
<!--购物车介绍开始-->
<div class="checkout">
    <div class="container">
        <div class="row firstrow centerrow marginrow">
            <div class="col-lg-4">商品</div>
            <div class="col-lg-2">数量</div>
            <div class="col-lg-2">单价(元)</div>
            <div class="col-lg-2">总价(元)</div>
            <div class="col-lg-2">商品状态</div>
        </div>
        <div class="row centerrow">
            <div class="col-lg-4 marginimg">
                <img src="<?php echo ($info['goods_img']); ?>" alt="<?php echo ($info['goods_name']); ?>" width="80px" height="80px">
                <span><?php echo ($info['goods_name']); ?></span>
            </div>
            <div class="col-lg-2"><?php echo ($info['goods_num']); ?></div>
            <div class="col-lg-2">￥<?php echo ($info['shop_price']); ?></div>
            <div class="col-lg-2">￥<?php echo ($info['goods_num'] * $info['shop_price']); ?></div>
            <div class="col-lg-2">
                <?php if($info[goods_status] == 0): ?>待评价
                    <?php else: ?>已评价<?php endif; ?>
            </div>
        </div>
        <div style="margin: 10px;padding: 10px">
        <form action="<?php echo U('Home/Comment/addComment');?>" method="post">
            <div style="margin-bottom: 10px">请输入你的评价：</div>
            <textarea style="width: 500px;height: 100px;margin-bottom: 10px" name="com_content" placeholder="~~不少于10个字~~"></textarea><br>
            <input type="hidden" name="orderdetail_id" value="<?php echo ($info['orderdetail_id']); ?>">
            <input type="hidden" name="goods_id" value="<?php echo ($info['goods_id']); ?>">
            <button type="submit" class="btn btn-primary">提交评价</button>
        </form>
        </div>
    </div>
</div>
<script type="application/javascript" src="/myshop/Public/Home/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/myshop/Public/Home/js/slider.js"></script>
</body>
</html>