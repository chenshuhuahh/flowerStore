<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--移动设备优先-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>订单详情</title>
    <link href="/myshop/Public/Admin/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        @media (min-width: 768px) {
            th {
                text-align: center;
            }
        }
    </style>
</head>
<body>
<ol class="breadcrumb" style="margin-top: 0">
    <li><a href="../Index/welcomeAdmin"><span class="glyphicon glyphicon-home"></span> 后台</a></li>
    <li><a href="#">订单管理</a></li>
    <li><a href="#">订单列表</a></li>
    <li class="active">订单详情</li>
</ol>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">订单详情</div>

            <div class="panel-body">
                <span class="pull-right" style="margin-bottom: 10px">共有<?php echo ($count); ?>条记录</span>
                <table class="table table-hover table-bordered" style="text-align: center">
                    <thead>
                    <tr class="success">
                        <th>详情编号</th>
                        <th>订单编号</th>
                        <th>商品编号</th>
                        <th>单价</th>
                        <th>数量</th>
                        <th>总价</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(is_array($detailinfo)): foreach($detailinfo as $key=>$detail): ?><tr>
                        <td><?php echo ($detail['orderdetail_id']); ?></td>
                        <td><?php echo ($detail['order_id']); ?></td>
                        <td><?php echo ($detail['goods_id']); ?></td>
                        <td><?php echo ($detail['shop_price']); ?></td>
                        <td><?php echo ($detail['num']); ?></td>
                        <td><?php echo ($detail['shop_price'] * $detail['num']); ?></td>
                    </tr><?php endforeach; endif; ?>
                    </tbody>
                </table>
                <div style="margin-bottom: 10px">总价：￥<?php echo ($listinfo['pay_prices']); ?></div>
                <?php if($listinfo['send_status'] == 0): ?><a href="<?php echo U('Admin/Order/changesend',array('order_id'=>$detail['order_id']));?>" alt="确认发货" title="确认发货" class="btn btn-primary">确认发货</a>
                    <?php else: ?>
                    <a type="button" class="btn btn-default" disabled="disabled">已发货</a><?php endif; ?>
                    
                <a href="<?php echo U('Admin/Order/order_list');?>" alt="返回" title="返回" class="btn btn-default">返回</a>
            </div>
        </div>
    </div>
</div>
<script type="application/javascript" src="/myshop/Public/Admin/js/jquery-3.2.1.min.js"></script>
<script type="application/javascript" src="/myshop/Public/Admin/js/bootstrap.min.js"></script>
</body>
</html>