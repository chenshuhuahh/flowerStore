<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--移动设备优先-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>商品搜索失败页</title>
    <link href="/myshop/Public/Home/css/bootstrap.min.css" rel="stylesheet">
    <link href="/myshop/Public/Home/css/indexstyle.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="/myshop/Public/Home/font-awesome/css/font-awesome.min.css">
    <style type="text/css">

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
                            <li><a href="<?php echo U('Home/index/userMain');?>">花店首页</a></li>
                            <!-- Mega Menu -->
                            <?php if(is_array($cattree)): foreach($cattree as $key=>$v): ?><li class="dropdown">
                            <?php if($v["lv"] == 0): ?><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo ($v["cat_name"]); ?><b class="caret"></b></a>
                                <ul class="dropdown-menu multi-column columns-1">
                                    <div class="row">
                                    <?php if(is_array($cattree)): foreach($cattree as $key=>$s): ?><div class="col-sm-12">
                                            <ul class="multi-column-dropdown">
                                            <?php if($v[cat_id] == $s[parent_id]): ?><h6><?php echo ($s["cat_name"]); ?></h6>
                                                <?php if(is_array($cattree)): foreach($cattree as $key=>$h): if($s[cat_id] == $h[parent_id]): ?><li><a href="<?php echo U('Home/Category/goodscat',array('cat_id'=>$h[cat_id]));?>" target="_blank"><?php echo ($h["cat_name"]); ?></a></li><?php endif; endforeach; endif; ?>
                                                <!-- <li><a href="goodscat.html">商务用花</a></li>
                                                <li><a href="goodscat.html">卡通花</a></li>
                                                <li><a href="goodscat.html">干花</a></li> --><?php endif; ?>
                                            </ul>
                                        </div><?php endforeach; endif; ?>
                                       <!--  <div class="col-sm-6">
                                            <ul class="multi-column-dropdown">
                                                <h6>绿植盆栽</h6>
                                                <li><a href="goodscat.html">多肉小萌植</a></li>
                                                <li><a href="goodscat.html">苔藓微景观</a></li>
                                            </ul>
                                        </div> -->
                                        <div class="clearfix"></div>
                                    </div>
                                </ul><?php endif; ?>
                            </li><?php endforeach; endif; ?>
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="logo-nav-left1 col-lg-4">
                <form action="<?php echo U('Home/Goods/goodssearch');?>" method="post">
                <div class="input-group search-box">
                    <input type="text" class="form-control" id="searchtext" name="searchtext" placeholder="搜索：花名（如小雏菊）">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit" id="searchbt" name="searchbt"><span class="glyphicon glyphicon-search"></span></button>
                    </span>                
                </div><!-- /input-group -->
            </form>
            </div>
        </div>
    </div>
</div>
<!-- //header -->
<!--面包屑导航-->
<div class="breadcrumbs">
    <div class="container">
        <ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
            <li><a href="<?php echo U('Home/index/userMain');?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>花店首页</a></li>
            <li class="active">搜索结果</li>
        </ol>
    </div>
</div>
<!--面包屑导航结束-->
<!--商品搜索错误介绍开始-->
<div class="container" style="margin-top: 20px;text-align: center;height: 600px">
    <img src="/myshop/Public/Home/images/timg.gif">
    <div style="font-size: 15pt;color: #d8703f;"><span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;抱歉 没搜索到您需要的商品</div>
</div>
<!--商品搜索错误介绍结束-->
<!-- footer -->
<div class="footer">
    <div class="container">
        <div class="footer-grids">
            <div class="col-md-3 footer-grid">
                <h3>购物指南</h3>
                <ul>
                    <li><i class="glyphicon glyphicon-th-list" aria-hidden="true"></i>购物流程</li>
                    <li><i class="glyphicon glyphicon-info-sign" aria-hidden="true"></i>意见反馈</li>
                    <li><i class="glyphicon glyphicon-question-sign" aria-hidden="true"></i>常见问题</li>
                </ul>
            </div>
            <div class="col-md-3 footer-grid">
                <h3>联系方式</h3>
                <ul>
                    <li><i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i>China, 广东省, <span>东莞市.</span></li>
                    <li><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i>1124203375@qq.com</li>
                    <li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i>+1234 567 890</li>
                </ul>
            </div>
            <div class="col-md-3 footer-grid">
                <h3>支付方式</h3>
                <ul>
                    <li><i class="glyphicon glyphicon-hand-right" aria-hidden="true"></i>微信支付</li>
                    <li><i class="glyphicon glyphicon-hand-right" aria-hidden="true"></i>支付宝支付</li>
                    <li><i class="glyphicon glyphicon-hand-right" aria-hidden="true"></i>货到付款</li>
                </ul>
            </div>
            <div class="col-md-3 footer-grid">
                <h3>权益保障</h3>
                <ul>
                    <li>全国包邮</li>
                    <li>七天无理由退货</li>
                    <li>退货运费补贴</li>
                    <li>限时发货</li>
                </ul>
            </div>
            <div class="clearfix"> </div>
        </div>
        <div class="footer-logo">
            <h2><a href="userMain.html">SH Store <span>shop anywhere</span></a></h2>
        </div>
    </div>
</div>
<!-- //footer -->
<script type="application/javascript" src="/myshop/Public/Home/js/jquery-3.2.1.min.js"></script>
<script type="application/javascript" src="/myshop/Public/Home/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/myshop/Public/Home/js/slider.js"></script>
</body>
</html>