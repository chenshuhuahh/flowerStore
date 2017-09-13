<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--移动设备优先-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>评论列表</title>
    <link href="/myshop/Public/Admin/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        *{margin: 0;padding: 0}
        @media (min-width: 768px) {
            th {
                text-align: center;
            }
        }
        .mysearch {
            width: 250px;
            margin: 0 0 10px 10px;
        }
        .respond {
            z-index:9999;
            position:fixed;
            top:30%;
            left:50%;
            width:640px;
            height:400px;
            margin:-100px 0 0 -320px;
            border-radius:5px;
            border:solid 2px #666;
            background-color:#fff;
            box-shadow: 0 0 10px #666;
            display:none
        }
        .respond_header {
            height: 60px;
            border-bottom: 1px solid #ddd;
        }
        .respond_header h3{
            padding: 0 10px;
        }
        .respond_header .close{
            padding: 20px;
        }
        .respond_body .first {/*前面的文字*/
            width: 200px;
            display: inline-block;
            text-align: right;
        }
        .theme-mask {
            z-index: 9998;
            position:fixed;
            top:0;
            left:0;
            width:100%;
            height:100%;
            background:#000;
            opacity:0.4;
            filter:alpha(opacity=40);
            display:none
        }
    </style>
</head>
<body>
<ol class="breadcrumb" style="margin-top: 0">
    <li><a href="../Index/welcomeAdmin"><span class="glyphicon glyphicon-home"></span> 后台</a></li>
    <li><a href="#">评论管理</a></li>
    <li class="active">评论列表</li>
</ol>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">评论列表</div>

            <div class="panel-body">
                <!--搜索框-->
                <form action="<?php echo U('Admin/Comment/comment_search');?>" method="post">
                <div class="input-group mysearch pull-left">
                    <input type="date" class="form-control" id="searchtext" name="searchtext" placeholder="搜索评论日期">
                    <span class="input-group-btn">
                        <button type="submit" id="searchbt" name="searchbt" class="btn btn-default">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </span>
                </div>
                </form>
                <a class="btn btn-default" href="<?php echo U('Admin/Comment/comment_list');?>" style="margin-left:10px">刷新</a>
                <span class="pull-right">共有<?php echo ($count); ?>条记录</span>
                <table class="table table-hover table-bordered" style="text-align: center">
                    <thead>
                    <tr class="success">
                        <th>评论编号</th>
                        <th>商品名称</th>
                        <th>用户编号</th>
                        <th>评论内容</th>
                        <th>评论时间</th>
                        <th>回复内容</th>
                        <th>回复时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(is_array($commentinfo)): foreach($commentinfo as $key=>$comment): ?><tr id="item<?php echo ($comment['com_id']); ?>">
                        <td><?php echo ($comment['com_id']); ?></td>
                        <td><?php echo ($comment['goods_id']); ?></td>
                        <td><?php echo ($comment['con_id']); ?></td>
                        <td><?php echo ($comment['com_content']); ?></td>
                        <td><?php echo ($comment['com_time']); ?></td>
                        <td><?php echo ($comment['res_content']); ?></td>
                        <td><?php echo ($comment['res_time']); ?></td>
                        <td>
                            <a href="javascript:;" alt="回复" title="回复" class="btn btn-primary myrespond<?php echo ($comment['com_id']); ?>" onclick="myRes(<?php echo ($comment['com_id']); ?>)">回复</a>
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
<div class="respond">
    <div class="respond_header">
        <h3 class="pull-left">回复评论</h3>
        <button type="button" class="close pull-right" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
    <div class="respond_body">
        <form action="<?php echo U('Admin/Comment/addmyRes');?>" method="post" class="form-horizontal" style="margin-top: 20px">
            <fieldset>
                <div class="form-group">
                    <label class="col-sm-4 control-label">评论编号：</label>
                    <span style="font-size: 16pt" id="comnumber"></span>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">用户编号：</label>
                    <span style="font-size: 16pt" id="usernumber"></span>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">商品名称：</label>
                    <span style="font-size: 16pt" id="goodname"></span>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">用户评论：</label>
                    <span style="font-size: 16pt" id="usercomment"></span>
                </div>
                <input type="hidden" name="com_id" id="commentid" value="">
                <div class="form-group">
                    <label for="res_content" class="col-sm-4 control-label">我的回复：</label>
                    <div class="col-sm-6">
                        <textarea id="res_content" name="res_content" class="form-control" placeholder="res_content"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label"></label>
                    <div class="col-sm-6">
                        <input type="submit" value="确认回复" class="btn btn-primary">
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
<div class="theme-mask"></div>
<script type="application/javascript" src="/myshop/Public/Admin/js/jquery-3.2.1.min.js"></script>
<script type="application/javascript" src="/myshop/Public/Admin/js/bootstrap.min.js"></script>
<script>
    // jQuery(document).ready(function($) {
        function myRes(id){
            $('.theme-mask').fadeIn(100);
            $('.respond').slideDown(200);
            $('#commentid').val(id);
            $.ajax({
                url: "<?php echo U('admin/comment/respond');?>",
                type: 'post',
                data: {com_id: $('#item'+id).children().eq(0).text()},
                dataType: 'json',
                success: function(res) {
                    comResult(res['data']);                        
                    console.log(1);
                }
            });
        }
        // $('.myrespond<?php echo ($comment['com_id']); ?>').click(function(){
        //     $('.theme-mask').fadeIn(100);
        //     $('.respond').slideDown(200);
        //     $.ajax({
        //         url: "<?php echo U('admin/comment/respond');?>",
        //         type: 'post',
        //         data: {com_id: $('#item<?php echo ($comment['com_id']); ?>').children().eq(0).text()},
        //         dataType: 'json',
        //         error: function(res) {
        //             console.log(2);
        //         },
        //         success: function(res) {
        //             comResult(res['data']);                        
        //             console.log(1);
        //         }
        //     });
        // });
        $('.respond_header .close').click(function(){
            $('.theme-mask').fadeOut(100);
            $('.respond').slideUp(200);
        });

        function comResult(data){
            $('#comnumber').text(data['com_id']);
            $('#usernumber').text(data['con_id']);
            $('#goodname').text(data['goods_name']);
            $('#usercomment').text(data['com_content']);
        }
    // });

</script>
</body>
</html>