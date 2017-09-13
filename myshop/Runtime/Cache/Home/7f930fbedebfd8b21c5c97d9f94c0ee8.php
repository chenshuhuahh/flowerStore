<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--移动设备优先-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>购物车</title>
    <link href="/myshop/Public/Home/css/bootstrap.min.css" rel="stylesheet">
    <link href="/myshop/Public/Home/css/indexstyle.css" rel="stylesheet" type="text/css" media="all" />
    <link href="/myshop/Public/Home/css/tipstyle.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="/myshop/Public/Home/font-awesome/css/font-awesome.min.css">
    <script type="application/javascript" src="/myshop/Public/Home/js/jquery-3.2.1.min.js"></script>
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
            <li class="active">购物车</li>
        </ol>
    </div>
</div>
<!--面包屑导航结束-->
<!--购物车介绍开始-->
<div class="checkout">
    <div class="container">
        <h3>你的购物车中有: <span><i id="tycount"><?php echo ($typecount); ?></i>&nbsp;件商品</span></h3>
        <div class="checkout-right">
            <table class="timetable_sub">
                <thead>
                <tr>
                    <th><input type="checkbox" id="chk_all" name="allcheck"></th>
                    <th>商品编号</th>
                    <th>商品图片</th>
                    <th>商品名称</th>
                    <th>商品数量</th>                   
                    <th>单价</th>
                    <th>总价</th>
                    <th>移除</th>
                </tr>
                </thead>
                <tbody class="mytbody">
                <?php if(is_array($cart)): foreach($cart as $k=>$c): ?><tr class="rem<?php echo ($k); ?>">
                    <td><input type="checkbox" name="chk_list" id="chk<?php echo ($k); ?>"></td>
                    <td class="invert myid"><?php echo ($k); ?></td>
                    <td class="invert-image"><a target="_blank" href="<?php echo U('Home/goods/goodsdetail',array('goods_id'=>$k));?>"><img src="<?php echo ($c['goods_img']); ?>" alt="<?php echo ($c['goods_name']); ?> " class="img-responsive" style="width: 80px;height:80px;"/></a></td>
                    <td class="invert"><?php echo ($c['goods_name']); ?></td>
                    <td class="invert">
                        <div class="quantity">
                            <div class="quantity-select">
                                <div class="entry value-minus" onclick="minus(<?php echo ($k); ?>)">&nbsp;</div>
                                <div class="entry value"><span id="num_<?php echo ($k); ?>"><?php echo ($c['num']); ?></span></div>
                                <div class="entry value-plus active" onclick="plus(<?php echo ($k); ?>)">&nbsp;</div>
                            </div>
                        </div>
                    </td>
                    <td class="invert" id="price_<?php echo ($k); ?>"><?php echo ($c['shop_price']); ?></td>
                    <td class="invert" id="total_<?php echo ($k); ?>"><?php echo ($c['shop_price']*$c['num']); ?></td>
                    <td class="invert">
                        <div class="rem">
                            <div class="close<?php echo ($k); ?> glyphicon glyphicon-remove"> </div>
                        </div>
                        <script>
                        $(document).ready(function(c) {
                            $('.close<?php echo ($k); ?>').on('click', function(c){
                                var myid = $('.rem<?php echo ($k); ?> .myid').text();
                                var tynum = parseInt($('#tycount').text());
                                var tynewNum = tynum -1;
                                $('#tycount').text(tynewNum);
                                $('.rem<?php echo ($k); ?>').fadeOut('normal', function(c){
                                    $('.rem<?php echo ($k); ?>').remove();
                                    $.ajax({
                                        url: "<?php echo U('Home/Order/delgoods');?>",
                                        type: 'post',
                                        data: {goods_id: myid},
                                    });
                                });
                            });
                        });
                        </script>
                    </td>
                </tr><?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
        <div class="pull-right">
            <div class="allprice">
                订单总价：<span class="glyphicon glyphicon-yen" id="allTotal"><?php echo ($allprice); ?></span>
            </div>
            <div style="margin-top: 10px">
                <a href="<?php echo U('Home/index/userMain');?>"><span class="glyphicon glyphicon-menu-left"></span>继续购物</a>
            </div>
        </div>

        <div class="checkout-left">
            <div class="checkout-left-basket animated wow slideInLeft" data-wow-delay=".5s">
                <h4>填写收件信息</h4>
                <form action="<?php echo U('Home/Order/done');?>" method="post">
                    <div class="form-group">
                        <div class="tip1"></div>
                        <input type="text" name="order_name" id="order_name" class="form-control" placeholder="收件人">
                        
                    </div>
                    <div class="form-group">
                    <div class="tip2"></div>
                        <input type="text" name="order_address" id="order_address" class="form-control" placeholder="收货地址" required="required">
                    </div>
                    <div class="form-group">
                    <div class="tip3"></div>
                        <input type="tel" name="phonenum" id="phonenum" class="form-control" placeholder="手机号" required="required">
                    </div>
                    <div class="form-group">
                    <div class="tip4"></div>
                        <input type="text" name="message" id="message" class="form-control" placeholder="您的留言(可以为空)">
                    </div>
                    <button type="submit" class="btn btn-primary form-control" id="send">提交订单</button>
                </form>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<!-- //checkout -->
<!--购物车结束-->

<script type="application/javascript" src="/myshop/Public/Home/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/myshop/Public/Home/js/slider.js"></script>
<!--quantity数量-->
<script>
$(function(){
    $("#chk_all").click(function(){ 
        if(this.checked){ 
            $("input[name='chk_list']").attr('checked', true);
        }else{ 
            $("input[name='chk_list']").attr('checked', false);
        } 
    });
    //文本框失去焦点后
    $('form :input').blur(function(){
         //验证收件人姓名
         if( $(this).is('#order_name') ){
            if(this.value==""){
                $('.tip1').removeClass("tipright").addClass("tipwrong").text("收件人姓名不能为空");
            }else{
                $('.tip1').removeClass("tipwrong").addClass("tipright").text("通过");
            }
         }
         //验证收件人地址
         if( $(this).is('#order_address') ){
            if(this.value==""){
                $('.tip2').removeClass("tipright").text("").addClass("tipwrong").text("收件人地址不能为空");
            }
            else if(this.value.length < 15){
                $('.tip2').removeClass("tipright").text("").addClass("tipwrong").text("收件人地址尽量详细");
            }else{
                $('.tip2').removeClass("tipwrong").text("").addClass("tipright").text("通过");
            }
         }
         //验证收件人电话
         if( $(this).is('#phonenum') ){
            if(this.value==""){
                $('.tip3').removeClass("tipright").text("").addClass("tipwrong").text("手机号不能为空");
            }
            else if(!(/^1[3-9]\d{9}/.test(this.value))){
                $('.tip3').removeClass("tipright").text("").addClass("tipwrong").text("手机号不正确");
            }else{
                $('.tip3').removeClass("tipwrong").text("").addClass("tipright").text("通过");
            }
         }
    }).keyup(function(){
       $(this).triggerHandler("blur");
    }).focus(function(){
         $(this).triggerHandler("blur");
    });//end blur

    //提交，最终验证。
     $('#send').click(function(){
            $("form :input.required").trigger('blur');
            var numError = $('form .tipwrong').length;
            if(numError){
                return false;
            } 
            if($('#order_name').val()==""){
                $('.tip1').removeClass("tipright").addClass("tipwrong").text("收件人姓名不能为空");
            }
            if($('#order_address').val()==""){
                $('.tip2').removeClass("tipright").addClass("tipwrong").text("收件人地址不能为空");
            }
            if($('#phonenum').val()==""){
                $('.tip3').removeClass("tipright").addClass("tipwrong").text("手机号不能为空");
            }
            if (confirm("是否确认提交？")==true){
                return true;
            }else{
                return false;
            }
     });
});
    
    //增加商品数量
    function plus(id){
        //获取当前商品的数量增加1
        var num = parseInt($('#num_'+id).text());
        var newNum = num +1;
        $('#num_'+id).text(newNum);
        //修改小计
        var price =  parseFloat($('#price_'+id).text());
        var total = newNum * price;
        $('#total_'+id).text(total);
        //获取所有商品的小计的和
        var allTotal = 0;
        $('.mytbody tr').each(function () {
           var ids = $(this).children().eq(1).text();
           // alert(ids);
           allTotal +=parseFloat($('#total_'+ids).text());
        });
        //修改总计
        $('#allTotal').text(allTotal);
        $.ajax({
            url: "<?php echo U('Home/Order/changegoods');?>",
            type: 'post',
            data: {goods_id: id,
                    num: newNum},
        });
    }

    //减少商品数量
    function minus(id){
        //获取当前商品的数量减少1
        var num = parseInt($('#num_'+id).text());
        var newNum = num - 1;
        if(newNum>=1){
            $('#num_'+id).text(newNum);
        }else{
            var myid = $('.rem'+id+' .myid').text();
            var tynum = parseInt($('#tycount').text());
            var tynewNum = tynum -1;
            $('#tycount').text(tynewNum);
            $('.rem'+id).fadeOut('normal', function(c){
                $('.rem'+id).remove();
                $.ajax({
                    url: "<?php echo U('Home/Order/delgoods');?>",
                    type: 'post',
                    data: {goods_id: myid},
                });
            });
        }
        //修改小计
        var price =  parseFloat($('#price_'+id).text());
        var total = newNum * price;
        $('#total_'+id).text(total);
        //获取所有商品的小计的和
        var allTotal = 0;
        $('.mytbody tr').each(function () {
           var ids = $(this).children().eq(1).text();
           allTotal +=parseFloat($('#total_'+ids).text());
        });
        //修改总计
        $('#allTotal').text(allTotal);
        $.ajax({
            url: "<?php echo U('Home/Order/changegoods');?>",
            type: 'post',
            data: {goods_id: id,
                    num: newNum},
        });
        
    }
    // $('.value-plus').on('click', function(){
    //     var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)+1;
    //     divUpd.text(newVal);
    // });

    // $('.value-minus').on('click', function(){
    //     var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)-1;
    //     if(newVal>=1) divUpd.text(newVal);
    // });
</script>
<!--quantity-->
</body>
</html>