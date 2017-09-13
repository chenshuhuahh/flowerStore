<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--移动设备优先-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>商品列表</title>
    <link href="/myshop/Public/Admin/css/bootstrap.min.css" rel="stylesheet">
    <script type="application/javascript" src="/myshop/Public/Admin/js/jquery-3.2.1.min.js"></script>
    <script type="application/javascript" src="/myshop/Public/Admin/js/bootstrap.min.js"></script>
    <style type="text/css">
        @media (min-width: 768px) {
            th {
                text-align: center;
            }
        }
        #addgoods {
            margin-bottom: 10px;
        }
        .smallpic {
            width: 40px;
            height: 40px;
        }
        .mysearch {
            width: 250px;
            margin-left: 10px;
        }
    </style>
</head>
<body>
<ol class="breadcrumb" style="margin-top: 0">
    <li><a href="../Index/welcomeAdmin"><span class="glyphicon glyphicon-home"></span> 后台</a></li>
    <li><a href="#">商品管理</a></li>
    <li class="active">商品列表</li>
</ol>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">商品列表</div>

            <div class="panel-body">
                <a class="btn btn-primary pull-left" type="button" id="addgoods" name="addgoods" target="main_frame" href="<?php echo U('admin/goods/goods_add');?>">
                    <span class="glyphicon glyphicon-plus"></span>
                    添加商品
                </a>
                <!--搜索框-->
                <form action="<?php echo U('Admin/Goods/goods_search');?>" method="post">
                <div class="input-group mysearch pull-left">
                    <input type="text" class="form-control" id="searchtext" name="searchtext" placeholder="搜索商品名称">
                    <span class="input-group-btn">
                        <button type="submit" id="searchbt" name="searchbt" class="btn btn-default">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </span>
                </div>
                </form>
                <span class="pull-right">共有<?php echo ($count); ?>条记录</span>
                <table class="table table-hover table-bordered" style="text-align: center">
                    <thead>
                    <tr class="success">
                        <th>商品编号</th>
                        <th>商品图片</th>
                        <th>商品名称</th>
                        <th>进货价</th>
                        <th>本店价</th>
                        <th>市场价</th>
                        <th>销售量</th>
                        <th>库存量</th>
                        <th>分类栏目</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(is_array($goodslist)): foreach($goodslist as $key=>$goods): ?><tr>
                            <td><?php echo ($goods["goods_id"]); ?></td>
                            <!-- ？？？？图片显示不出来 路径是正确的e -->
                            <td><img class="smallpic" src="<?php echo ($goods['goods_img']); ?>" alt=""></td>
                            <td><?php echo ($goods["goods_name"]); ?></td>
                            <td><?php echo ($goods["buying_price"]); ?></td>
                            <td><?php echo ($goods["shop_price"]); ?></td>
                            <td><?php echo ($goods["market_price"]); ?></td>
                            <td><?php echo ($goods["sale_num"]); ?></td>
                            <td><?php echo ($goods["warehouse_num"]); ?></td>
                            <td><?php echo ($goods["cat_id"]); ?></td>
                            <td>
                                <a href="<?php echo U('admin/goods/goods_change',array('goods_id'=>$goods['goods_id']));?>" alt="修改" title="修改"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;
                                <a href="<?php echo U('admin/goods/goods_delete',array('goods_id'=>$goods['goods_id']));?>" alt="删除" title="删除" onclick="javascript:return del();"><span class="glyphicon glyphicon-trash"></span></a>
                            </td>
                            <script type="text/javascript">
                                function del() {
                                    var msg = "确定要删除吗？";
                                    if (confirm(msg)==true){
                                        return true;
                                    }else{
                                        return false;
                                    }
                                }
                            </script>
                        </tr><?php endforeach; endif; ?>
                    </tbody>
                </table>
                <nav aria-label="Page navigation">
                    <ul class="pagination pull-right">
                        <?php echo ($page); ?>
                        <!-- <li>
                            <a href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li>
                            <a href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li> -->
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

</body>
</html>