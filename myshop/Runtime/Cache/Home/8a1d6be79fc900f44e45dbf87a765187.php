<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--移动设备优先-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SHshop首页</title>
    <link href="/myshop/Public/Home/css/bootstrap.min.css" rel="stylesheet">
    <link href="/myshop/Public/Home/css/indexstyle.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="/myshop/Public/Home/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/myshop/Public/Home/css/lunbonormalize.css">
    <link rel="stylesheet" href="/myshop/Public/Home/css/lunbostyles.css">
    <script type="application/javascript" src="/myshop/Public/Home/js/jquery-3.2.1.min.js"></script>
    <script type="application/javascript" src="/myshop/Public/Home/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/myshop/Public/Home/js/slider.js"></script>
    <style type="text/css">
        .leftsead{
            width:47px;
            height:49px;
            background:url("/myshop/Public/Home/images/top1.png");
            position:fixed;
            bottom:80px;
            right: 0;
            color:white;
            z-index:2;
            cursor:pointer;
            display:none;
            /*_position:absolute;*/
            /*_top:expression(eval(document.documentElement.scrollTop || document.body.scrollTop) +eval(document.documentElement.clientHeight || document.body.clientHeight)*0.7 +'px');*/
        }
        .leftsead:hover{
            background:url("/myshop/Public/Home/images/top2.png");
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
        <div class="logo-nav1">
            <div class="logo-nav-left">
                <h1><a href="userMain.html">SH Store <span>Shop anywhere</span></a></h1>
            </div>
            <div class="logo-nav-left1">
                <nav class="navbar navbar-default">
                    <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="userMain.html" class="act">花店首页</a></li>
                            <li><a href="<?php echo U('Home/Category/allgoods');?>" class="act">全部商品</a></li>
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
                            <!-- <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">园艺用品 <b class="caret"></b></a>
                                <ul class="dropdown-menu multi-column columns-1">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <ul class="multi-column-dropdown">
                                                <h6>养植必备</h6>
                                                <li><a href="goodscat.html">洒水壶</a></li>
                                                <li><a href="goodscat.html">营养土</a></li>
                                                <li><a href="goodscat.html">肥料</a></li>
                                                <li><a href="goodscat.html">花器</a></li>
                                            </ul>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </ul>
                            </li> -->
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
            <!-- <script>
                $(function(){
                    $('#searchbt').click(function(){
                        var search_str = $('#searchtext').val();
                        $.ajax({
                            url:"<?php echo U('Home/Goods/goodssearch');?>",
                            type: 'post',
                            data: {str: search_str},
                        });
                    });
                });
            </script> -->
        </div>
    </div>
</div>
<!-- //header -->
<!--<div class="clearfix"></div>-->
<!-- banner -->
<div class="banner">
    <div class="myycontainer">
        <div class="slider" id="slider">
            <button type="button" class="button button-prev">
                <i class="fa fa-chevron-left" aria-hidden="true"></i>
            </button>
            <button type="button" class="button button-next">
                <i class="fa fa-chevron-right" aria-hidden="true"></i>
            </button>
        </div>
    </div>
</div>
<!-- //banner -->
<!-- collections -->
<div class="new-collections">
    <div class="container">
        <h3>新品上市</h3>
        <p class="est">Here, every week with a new, special and unique bouquet, you can choose what you like.</p>
        <div class="new-collections-grids">
        <?php if(is_array($new)): foreach($new as $key=>$n): ?><div class="col-md-3 new-collections-grid">
                <div class="new-collections-grid1">
                    <div class="new-collections-grid1-image">
                        <a href="<?php echo U('Home/goods/goodsdetail',array('goods_id'=>$n['goods_id']));?>" class="product-image" target="_blank"><img src="<?php echo ($n[goods_img]); ?>" alt="<?php echo ($n[goods_name]); ?>" class="img-responsive" style="width: 100%;height: 250px" /></a>
                        <div class="new-collections-grid1-image-pos">
                            <a href="<?php echo U('Home/goods/goodsdetail',array('goods_id'=>$n['goods_id']));?>" target="_blank">商品详情</a>
                        </div>
                    </div>
                    <h4><a href="<?php echo U('Home/goods/goodsdetail',array('goods_id'=>$n['goods_id']));?>" target="_blank"><?php echo ($n[goods_name]); ?></a></h4>
                    <p><?php echo ($n[goods_summary]); ?></p>
                    <div class="new-collections-grid1-left simpleCart_shelfItem">
                        <p><span class="item_price glyphicon glyphicon-jpy"><?php echo ($n[shop_price]); ?></span><a class="item_add" target="_blank" href="<?php echo U('Home/Goods/shoppingcart',array('goods_id'=>$n['goods_id']));?>">添加到购物车 </a></p>
                    </div>
                </div>
            </div><?php endforeach; endif; ?>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<!-- //collections -->
<!-- collections -->
<div class="new-collections">
    <div class="container">
        <h3>热销商品</h3>
        <p class="est">Many people like the following kinds of goods, you can refer to it.</p>
        <div class="new-collections-grids">
        <?php if(is_array($hot)): foreach($hot as $key=>$h): ?><div class="col-md-3 new-collections-grid">
                <div class="new-collections-grid1">
                    <div class="new-collections-grid1-image">
                        <a href="<?php echo U('Home/goods/goodsdetail',array('goods_id'=>$h['goods_id']));?>" class="product-image" target="_blank"><img src="<?php echo ($h[goods_img]); ?>" alt="<?php echo ($h['goods_name']); ?>" class="img-responsive" style="width: 100%;height: 250px"/></a>
                        <div class="new-collections-grid1-image-pos">
                            <a href="<?php echo U('Home/goods/goodsdetail',array('goods_id'=>$h['goods_id']));?>" target="_blank">商品详情</a>
                        </div>
                    </div>
                    <h4><a href="<?php echo U('Home/goods/goodsdetail',array('goods_id'=>$h['goods_id']));?>" target="_blank"><?php echo ($h['goods_name']); ?></a></h4>
                    <p><?php echo ($h['goods_summary']); ?></p>
                    <div class="new-collections-grid1-left simpleCart_shelfItem">
                        <p><span class="item_price glyphicon glyphicon-jpy"><?php echo ($h['shop_price']); ?></span><a class="item_add" target="_blank" href="<?php echo U('Home/Goods/shoppingcart',array('goods_id'=>$h['goods_id']));?>">添加到购物车 </a></p>
                    </div>
                </div>
            </div><?php endforeach; endif; ?>
            
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<div class="new-collections">
    <div class="container">
        <h3>最近浏览</h3>
        <p class="est">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
            deserunt mollit anim id est laborum.</p>
        <div class="new-collections-grids">
        <?php if(is_array($his)): foreach($his as $k=>$g): ?><div class="col-md-3 new-collections-grid">
                <div class="new-collections-grid1">
                    <div class="new-collections-grid1-image">
                        <a href="<?php echo U('Home/goods/goodsdetail',array('goods_id'=>$k));?>" class="product-image" target="_blank"><img src="<?php echo ($g[goods_img]); ?>" alt="<?php echo ($g['goods_name']); ?>" class="img-responsive" style="width: 100%;height: 250px"/></a>
                        <div class="new-collections-grid1-image-pos">
                            <a href="<?php echo U('Home/goods/goodsdetail',array('goods_id'=>$k));?>" target="_blank">商品详情</a>
                        </div>
                    </div>
                    <h4><a href="<?php echo U('Home/goods/goodsdetail',array('goods_id'=>$k));?>" target="_blank"><?php echo ($g['goods_name']); ?></a></h4>
                    <p><?php echo ($g['goods_summary']); ?></p>
                    <div class="new-collections-grid1-left simpleCart_shelfItem">
                        <p><span class="item_price glyphicon glyphicon-jpy"><?php echo ($g['shop_price']); ?></span><a class="item_add" target="_blank" href="<?php echo U('Home/Goods/shoppingcart',array('goods_id'=>$g['goods_id']));?>">添加到购物车 </a></p>
                    </div>
                </div>
            </div><?php endforeach; endif; ?>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<!-- //collections -->
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
<!--other-->
<div class="leftsead"></div>
<!--//other-->
   
<script type="application/javascript">
    //置顶按钮
    $(window).scroll(function(){if($(document).scrollTop()>160){
        $('.leftsead').fadeIn();
    }else{
        $('.leftsead').fadeOut();
    }});
    $('.leftsead').click(function(){
        var timer=setInterval(function(){
            if($(document).scrollTop()==0){
                clearInterval(timer);
            }else{
                $(document).scrollTop($(document).scrollTop()-30);
            }
        },5);
    });
</script>
</body>
</html>