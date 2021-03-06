<?php if (!defined('THINK_PATH')) exit();?> <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--移动设备优先-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>分类列表</title>
    <link href="/myshop/Public/Admin/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/myshop/Public/Admin/css/SimpleTree.css"/>
    <!-- <script type="text/javascript" src="/myshop/Public/Admin/js/jquery-1.6.min.js"></script> -->
    <script type="text/javascript" src="/myshop/Public/Admin/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/myshop/Public/Admin/js/SimpleTree.js"></script>
    <script type="application/javascript" src="/myshop/Public/Admin/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(function(){
            $(".st_tree").SimpleTree({
                click:function(a){
                    if(!$(a).attr("hasChild"))
                        alert($(a).attr("ref"));
                }
            });
        });
    </script>
    <style type="text/css">
        @media (min-width: 768px) {
            th {
                text-align: center;
            }
        }
        #addcat {
            margin-bottom: 10px;
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
    <li><a href="#">分类管理</a></li>
    <li class="active">分类列表</li>
</ol>
<div class="row">
    <div class="col-sm-2">
        <div class="st_tree">
            <ul id="menu"></ul>
            <script>
                $(function() {                 
                     // 递归列表函数
                    function recursion(selector,data){
                        if(!data) return false;
                        for(var i=0;i<data.length;i++){
                            var li=$('<li>'+data[i]['cat_name']+'</li>'); 
                            selector.append(li);                            
                            if(data[i]['son'] && data[i]['son'].length>0){
                                var ul=$('<ul></ul>');
                                selector.append(ul);
                                recursion(ul,data[i]['son']);
                                
                            }                             
                            
                        }
                    }
                     
                     // ajax请求 用$.post() 会更方便
                    $.ajax({
                        url: "<?php echo U('admin/category/resultCategory');?>",
                        type: 'post',
                        dataType: 'json',
                        error: function(res) {
                            console.log(2);
                        },
                        success: function(res) {
                            recursion($('#menu'),res['data']);                        
                            console.log(1);
                        }
                    });
                });
            </script>
            <!-- <ul>
                <li>绿植花卉</li>
                <ul show="true">
                    <li>花花园艺</li>
                    <ul show="true">
                        <li>鲜花速递</li>
                        <li>商务用花</li>
                        <li>卡通花</li>
                        <li>干花</li>
                    </ul>
                    <li>绿植盆栽</li>
                    <ul show="true">
                        <li>多肉小萌植</li>
                        <li>苔藓微景观</li>
                    </ul>
                </ul>
                <li>园艺用品</li>
                <ul show="true">
                    <li>养植必备</li>
                    <ul show="true">
                        <li>洒水壶</li>
                        <li>营养土</li>
                        <li>肥料</li>
                        <li>花器</li>
                    </ul>
                </ul>
            </ul> -->
        </div>
    </div>
    <div class="col-sm-10">
        <div class="panel panel-default">
            <div class="panel-heading">分类列表</div>

            <div class="panel-body">
                <a class="btn btn-primary pull-left" type="button" id="addcat" name="addcat" target="main_frame" href="<?php echo U('admin/category/cat_add');?>">
                    <span class="glyphicon glyphicon-plus"></span>
                    添加分类
                </a>
                <!--搜索框-->
                <form action="<?php echo U('Admin/Category/cat_search');?>" method="post">
                <div class="input-group mysearch pull-left">
                    <input type="text" class="form-control" id="searchtext" name="searchtext" placeholder="搜索分类名称">
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
                        <th>分类编号</th>
                        <th>分类名称</th>
                        <th>分类描述</th>
                        <th>上级分类</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(is_array($catlist)): foreach($catlist as $key=>$cat): ?><tr>
                            <td><?php echo ($cat["cat_id"]); ?></td>
                            <td><?php echo ($cat["cat_name"]); ?></td>
                            <td><?php echo ($cat["cat_desc"]); ?></td>
                            <td><?php echo ($cat["parent_id"]); ?></td>
                            <td>
                                <a href="<?php echo U('admin/category/cat_change',array('cat_id'=>$cat['cat_id']));?>" alt="修改" title="修改"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;
                                <a href="<?php echo U('admin/category/cat_delete',array('cat_id'=>$cat['cat_id']));?>" alt="删除" title="删除" onclick="javascript:return del();"><span class="glyphicon glyphicon-trash"></span></a>
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
<!--<script type="application/javascript" src="js/jquery-3.2.1.min.js"></script>-->


</body>
</html>