<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--移动设备优先-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>分类修改</title>
    <link href="/myshop/Public/Admin/css/bootstrap.min.css" rel="stylesheet">
    <script type="application/javascript" src="/myshop/Public/Admin/js/jquery-3.2.1.min.js"></script>
    <script type="application/javascript" src="/myshop/Public/Admin/js/bootstrap.min.js"></script>
    <link href="/myshop/Public/Admin/css/tipstyle.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
    </style>
</head>
<body>
<ol class="breadcrumb" style="margin-top: 0">
    <li><a href="../Index/welcomeAdmin"><span class="glyphicon glyphicon-home"></span> 后台</a></li>
    <li><a href="#">商品管理</a></li>
    <li><a href="<?php echo U('admin/category/cat_list');?>">分类列表</a></li>
    <li class="active">分类修改</li>
</ol>
<div class="container" style="margin-top: 10px">
    <form action="<?php echo U('admin/category/cat_change');?>" method="post" class="form-horizontal">
        <fieldset>
            <legend>分类修改</legend>
            <div class="form-group">
                <div class="tip1"></div>
                <label for="cat_name" class="col-sm-3 control-label">分类名称：</label>
                <div class="col-sm-6">
                    <input type="text" id="cat_name" name="cat_name" class="form-control" value="<?php echo ($catinfo["cat_name"]); ?>" required="required">
                </div>
            </div>
            <div class="form-group">
                <label for="parent_id" class="col-sm-3 control-label">上级分类：</label>
                <div class="col-sm-3 col-lg-2">
                    <select name="parent_id" class="form-control">
                        <option value="0">顶级分类</option>
                        <?php if(is_array($gettree)): foreach($gettree as $key=>$tree): if($tree['lv'] == 0): ?><option value="<?php echo ($tree["cat_id"]); ?>" <?php echo ($tree['cat_id']==$catinfo['parent_id']?'selected':''); ?>><?php echo ($tree["cat_name"]); ?>--------------</option>
                            <?php elseif($tree['lv'] == 1): ?>
                            <option value="<?php echo ($tree["cat_id"]); ?>" <?php echo ($tree['cat_id']==$catinfo['parent_id']?'selected':''); ?>>&nbsp;&nbsp;&nbsp;<?php echo ($tree["cat_name"]); ?></option>
                            <?php else: ?>
                            <option value="<?php echo ($tree["cat_id"]); ?>" <?php echo ($tree['cat_id']==$catinfo['parent_id']?'selected':''); ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($tree["cat_name"]); ?></option><?php endif; endforeach; endif; ?>          
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="tip2"></div>
                <label for="cat_desc" class="col-sm-3 control-label">分类描述：</label>
                <div class="col-sm-6">
                    <textarea type="" id="cat_desc" name="cat_desc" class="form-control" required="required"><?php echo ($catinfo["cat_desc"]); ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label"></label>
                <div class="col-sm-6">
                    <input type="submit" value="确认修改" class="btn btn-primary" id="send">
                    <a href="<?php echo U('admin/category/cat_list');?>" alt="返回" title="返回" class="btn btn-default">返回</a>
                </div>
            </div>
        </fieldset>
        <input type="hidden" name="cat_id" value="<?php echo ($catinfo["cat_id"]); ?>"><!-- 隐藏域，将这个值传过去category/cat_change方法进行修改 -->
    </form>
</div>
<script>
$(function(){
    //文本框失去焦点后
    $('form :input').blur(function(){
         //验证收件人姓名
         if( $(this).is('#cat_name') ){
            if(this.value==""){
                $('.tip1').removeClass("tipright").addClass("tipwrong").text("分类名称不能为空");
            }else{
                $('.tip1').removeClass("tipwrong").addClass("tipright").text("通过");
            }
         }
         //验证收件人地址
         if( $(this).is('#cat_desc') ){
            if(this.value==""){
                $('.tip2').removeClass("tipright").text("").addClass("tipwrong").text("分类描述不能为空");
            }
            else if(this.value.length < 10){
                $('.tip2').removeClass("tipright").text("").addClass("tipwrong").text("分类描述请尽量详细，不少于10个字");
            }else{
                $('.tip2').removeClass("tipwrong").text("").addClass("tipright").text("通过");
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
            if($('#cat_name').val()==""){
                $('.tip1').removeClass("tipright").addClass("tipwrong").text("分类名称不能为空");
                return false;
            }
            if($('#cat_desc').val()==""){
                $('.tip2').removeClass("tipright").text("").addClass("tipwrong").text("分类描述不能为空");
                return false;
            }
            if (confirm("是否确认添加？")==true){
                return true;
            }else{
                return false;
            } 
            // confirm("是否确认添加？");
     });
});
</script>
</body>
</html>