<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--移动设备优先-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>订单列表</title>
    <link href="/myshop/Public/Admin/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        @media (min-width: 768px) {
            th {
                text-align: center;
            }
        }
        .mysearch {
            width: 250px;
            margin: 0 0 10px 10px;
        }
    </style>
</head>
<body>
<ol class="breadcrumb" style="margin-top: 0">
    <li><a href="../Index/welcomeAdmin"><span class="glyphicon glyphicon-home"></span> 后台</a></li>
    <li><a href="#">订单管理</a></li>
    <li class="active">订单列表</li>
</ol>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">订单列表</div>

            <div class="panel-body">
                <!--搜索框-->
                <form action="<?php echo U('Admin/Order/order_search');?>" method="post">
                <div class="input-group mysearch pull-left">
                    <input type="date" class="form-control" id="searchtext" name="searchtext" placeholder="搜索订单日期">
                    <span class="input-group-btn">
                        <button type="submit" id="searchbt" name="searchbt" class="btn btn-default">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </span>
                </div>
                </form>
                <a class="btn btn-default" href="<?php echo U('Admin/Order/order_list');?>" style="margin-left:10px">刷新</a>
                <span class="pull-right">共有<?php echo ($count); ?>条记录</span>
                <table class="table table-hover table-bordered" style="text-align: center">
                    <thead>
                    <tr class="success">
                        <th>订单编号</th>
                        <th>用户编号</th>
                        <th>收货人姓名</th>
                        <th>收货人地址</th>
                        <th>收货人电话</th>
                        <th>买家留言</th>
                        <th>订单状态</th>
                        <th>总额</th>
                        <th>订单日期</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(is_array($listinfo)): foreach($listinfo as $key=>$list): ?><tr>
                        <td><?php echo ($list['order_id']); ?></td>
                        <td><?php echo ($list['con_id']); ?></td>
                        <td><?php echo ($list['order_name']); ?></td>
                        <td><?php echo ($list['order_address']); ?></td>
                        <td><?php echo ($list['phonenum']); ?></td>
                        <td><?php echo ($list['message']); ?></td>
                        <td>
                            <?php if($list['send_status'] == 1): ?>已发货
                                <?php else: ?>未发货<?php endif; ?>
                        </td>
                        <td><?php echo ($list['pay_prices']); ?></td>
                        <td><?php echo ($list['order_time']); ?></td>
                        <td>
                            <a href="<?php echo U('Admin/Order/order_details',array('order_id'=>$list['order_id']));?>" alt="详情" title="详情" class="btn btn-primary">详情</a>
                        </td>
                    </tr><?php endforeach; endif; ?>
                    </tbody>
                </table>
                <nav aria-label="Page navigation">
                    <ul class="pagination pull-right">
                        <?php echo ($page); ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<script type="application/javascript" src="/myshop/Public/Admin/js/jquery-3.2.1.min.js"></script>
<script type="application/javascript" src="/myshop/Public/Admin/js/bootstrap.min.js"></script>
</body>
</html>