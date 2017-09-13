<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--移动设备优先-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>商品修改</title>
    <link href="/myshop/Public/Admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="/myshop/Public/Admin/css/tipstyle.css" rel="stylesheet" type="text/css" />
    <script type="application/javascript" src="/myshop/Public/Admin/js/jquery-3.2.1.min.js"></script>
    <script type="application/javascript" src="/myshop/Public/Admin/js/bootstrap.min.js"></script>
    <style type="text/css">
    </style>
</head>
<body>
<ol class="breadcrumb" style="margin-top: 0">
    <li><a href="../Index/welcomeAdmin"><span class="glyphicon glyphicon-home"></span> 后台</a></li>
    <li><a href="#">商品管理</a></li>
    <li><a href="<?php echo U('admin/goods/goods_list');?>">商品列表</a></li>
    <li class="active">商品修改</li>
</ol>
    <div class="container" style="margin-top: 10px">
        <form action="<?php echo U('admin/goods/goods_change');?>" method="post" class="form-horizontal" enctype="multipart/form-data">
            <fieldset>
                <legend>商品修改</legend>
                <div class="form-group">
                    <div class="tip1"></div>
                    <label for="goods_name" class="col-sm-3 control-label">商品名称：</label>
                    <div class="col-sm-6">
                        <input type="text" id="goods_name" name="goods_name" class="form-control" required="required" value="<?php echo ($goodsinfo["goods_name"]); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="cat_id" class="col-sm-3 control-label">商品分类：</label>
                    <div class="col-sm-3 col-lg-2">
                        <select name="cat_id" class="form-control">
                            <?php if(is_array($gettree)): foreach($gettree as $key=>$tree): if($tree['lv'] == 0): ?><option  disabled="disabled" style="font-size:12pt;color:#bbb;" value="<?php echo ($tree["cat_id"]); ?>" <?php echo ($tree['cat_id']==$goodsinfo['cat_id']?'selected':''); ?>><?php echo ($tree["cat_name"]); ?>--------------</option>
                                <?php elseif($tree['lv'] == 1): ?>
                                <option disabled="disabled" style="color:#999;" value="<?php echo ($tree["cat_id"]); ?>" <?php echo ($tree['cat_id']==$goodsinfo['cat_id']?'selected':''); ?>>&nbsp;&nbsp;&nbsp;<?php echo ($tree["cat_name"]); ?></option>
                                <?php else: ?>
                                <option value="<?php echo ($tree["cat_id"]); ?>" <?php echo ($tree['cat_id']==$goodsinfo['cat_id']?'selected':''); ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($tree["cat_name"]); ?></option><?php endif; endforeach; endif; ?>                                       
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="tip3"></div>
                    <label for="buying_price" class="col-sm-3 control-label">进货价：</label>
                    <div class="col-sm-3 col-lg-2">
                        <input type="text" id="buying_price" name="buying_price" class="form-control" required="required" value="<?php echo ($goodsinfo["buying_price"]); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="tip4"></div>
                    <label for="shop_price" class="col-sm-3 control-label">本店价：</label>
                    <div class="col-sm-3 col-lg-2">
                        <input type="text" id="shop_price" name="shop_price" class="form-control" required="required" value="<?php echo ($goodsinfo["shop_price"]); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="tip5"></div>
                    <label for="market_price" class="col-sm-3 control-label">市场价：</label>
                    <div class="col-sm-3 col-lg-2">
                        <input type="text" id="market_price" name="market_price" class="form-control" required="required" value="<?php echo ($goodsinfo["market_price"]); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="tip6"></div>
                    <label for="warehouse_num" class="col-sm-3 control-label">库存量：</label>
                    <div class="col-sm-3 col-lg-2">
                        <input type="text" id="warehouse_num" name="warehouse_num" class="form-control" required="required" value="<?php echo ($goodsinfo["warehouse_num"]); ?>">
                    </div>
                </div>
                <!-- <div class="form-group">
                    <div class="tip2"></div>
                    <label for="goods_place" class="col-sm-3 control-label">商品产地：</label>
                    <div class="col-sm-6">
                        <input type="text" id="goods_place" name="goods_place" class="form-control"  required="required" value="<?php echo ($goodsinfo["goods_place"]); ?>"></textarea>
                    </div>
                </div> -->
                <div class="form-group">
                    <div class="tip7"></div>
                    <label for="goods_weight" class="col-sm-3 control-label">商品规格：</label>
                    <div class="col-sm-3">
                        <input type="text" id="goods_weight" name="goods_weight" class="form-control"  required="required" value="<?php echo ($goodsinfo["goods_weight"]); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="tip8"></div>
                    <label for="goods_summary" class="col-sm-3 control-label">商品简介：</label>
                    <div class="col-sm-6">
                        <input type="text" id="goods_summary" name="goods_summary" class="form-control" required="required" value="<?php echo ($goodsinfo["goods_summary"]); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="tip9"></div>
                    <label for="goods_desc" class="col-sm-3 control-label">商品描述：</label>
                    <div class="col-sm-6">
                        <textarea type="" id="goods_desc" name="goods_desc" class="form-control"  required="required"><?php echo ($goodsinfo["goods_desc"]); ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="tip10"></div>
                    <label for="goods_save" class="col-sm-3 control-label">保养说明：</label>
                    <div class="col-sm-6">
                        <textarea type="" id="goods_save" name="goods_save" class="form-control" required="required"><?php echo ($goodsinfo["goods_save"]); ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="ori_img" class="col-sm-3 control-label">商品图片：</label>
                    <div class="col-sm-6">
                        <input type="file" id="ori_img" name="ori_img">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"></label>
                    <div class="col-sm-6 father">
                        <img src="<?php echo ($goodsinfo["ori_img"]); ?>" id="show_img" name="show_img" width="100" height="100">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"></label>
                    <div class="col-sm-6 father">
                        <input type="submit" value="修改商品" class="btn btn-primary" id="send">
                        <a href="<?php echo U('admin/goods/goods_list');?>" alt="返回" title="返回" class="btn btn-default">返回</a>
                    </div>
                </div>
            </fieldset>
            <input type="hidden" name="goods_id" value="<?php echo ($goodsinfo["goods_id"]); ?>">
            <input type="hidden" name="hiddenimg" value="<?php echo ($goodsinfo["goods_img"]); ?>">
            <input type="hidden" name="hiddenori" value="<?php echo ($goodsinfo["ori_img"]); ?>">
            <!-- 隐藏域，将这个值传过去goods/goods_change方法进行修改 -->
        </form>
    </div>

    <script>
        $(function(){
//            选择图片之后能实时看到图片的样子
            $("#ori_img").change(function(){
                var file = this.files[0];
//                alert("文件大小:"+(file.size / 1024).toFixed(1)+"kB");
                if (window.FileReader) {
                    var reader = new FileReader();
                    reader.readAsDataURL(file);
                    //监听文件读取结束后事件
                    reader.onloadend = function (e) {
                        showXY(e.target.result);
                    };
                }
            });

            //文本框失去焦点后
            $('form :input').blur(function(){
                 //验证商品名称
                 if( $(this).is('#goods_name') ){
                    if(this.value==""){
                        $('.tip1').removeClass("tipright").addClass("tipwrong").text("商品名称不能为空");
                    }else{
                        $('.tip1').removeClass("tipwrong").addClass("tipright").text("通过");
                    }
                 }
                 //验证商品产地
                 // if( $(this).is('#goods_place') ){
                 //    if(this.value==""){
                 //        $('.tip2').removeClass("tipright").text("").addClass("tipwrong").text("商品产地不能为空");
                 //    }else{
                 //        $('.tip2').removeClass("tipwrong").text("").addClass("tipright").text("通过");
                 //    }
                 // }
                 //验证进货价
                 if( $(this).is('#buying_price') ){
                    if(this.value==""){
                        $('.tip3').removeClass("tipright").text("").addClass("tipwrong").text("进货价不能为空");
                    }
                    else if(isNaN(this.value)){
                        $('.tip3').removeClass("tipright").text("").addClass("tipwrong").text("请填写数字");
                    }
                    else if(this.value > 999999999.99){
                        $('.tip3').removeClass("tipright").text("").addClass("tipwrong").text("进货价不能大于999999999.99");
                    }else{
                        $('.tip3').removeClass("tipwrong").text("").addClass("tipright").text("通过");
                    }
                 }
                 //验证本店价
                 if( $(this).is('#shop_price') ){
                    if(this.value==""){
                        $('.tip4').removeClass("tipright").text("").addClass("tipwrong").text("本店价不能为空");
                    }
                    else if(isNaN(this.value)){
                        $('.tip4').removeClass("tipright").text("").addClass("tipwrong").text("请填写数字");
                    }
                    else if(this.value > 999999999.99){
                        $('.tip4').removeClass("tipright").text("").addClass("tipwrong").text("本店价不能大于999999999.99");
                    }else{
                        $('.tip4').removeClass("tipwrong").text("").addClass("tipright").text("通过");
                    }
                 }
                 //验证市场价
                 if( $(this).is('#market_price') ){
                    if(this.value==""){
                        $('.tip5').removeClass("tipright").text("").addClass("tipwrong").text("市场价不能为空");
                    }
                    else if(isNaN(this.value)){
                        $('.tip5').removeClass("tipright").text("").addClass("tipwrong").text("请填写数字");
                    }
                    else if(this.value > 999999999.99){
                        $('.tip5').removeClass("tipright").text("").addClass("tipwrong").text("市场价不能大于999999999.99");
                    }else{
                        $('.tip5').removeClass("tipwrong").text("").addClass("tipright").text("通过");
                    }
                 }
                 //验证库存量
                 if( $(this).is('#warehouse_num') ){
                    if(this.value==""){
                        $('.tip6').removeClass("tipright").text("").addClass("tipwrong").text("库存量不能为空");
                    }
                    else if(isNaN(this.value)){
                        $('.tip6').removeClass("tipright").text("").addClass("tipwrong").text("请填写数字");
                    }
                    else if(this.value > 999999){
                        $('.tip6').removeClass("tipright").text("").addClass("tipwrong").text("市场价不能大于999999");
                    }else{
                        $('.tip6').removeClass("tipwrong").text("").addClass("tipright").text("通过");
                    }
                 }
                 //验证商品规格
                 if( $(this).is('#goods_weight') ){
                    if(this.value==""){
                        $('.tip7').removeClass("tipright").text("").addClass("tipwrong").text("商品规格不能为空");
                    }
                    else{
                        $('.tip7').removeClass("tipwrong").text("").addClass("tipright").text("通过");
                    }
                 }
                 //验证商品简介
                 if( $(this).is('#goods_summary') ){
                    if(this.value==""){
                        $('.tip8').removeClass("tipright").text("").addClass("tipwrong").text("商品简介不能为空");
                    }
                    else if(this.value.length < 10){
                        $('.tip8').removeClass("tipright").text("").addClass("tipwrong").text("商品简介不得少于10个字");
                    }else{
                        $('.tip8').removeClass("tipwrong").text("").addClass("tipright").text("通过");
                    }
                 }
                 //验证商品描述
                 if( $(this).is('#goods_desc') ){
                    if(this.value==""){
                        $('.tip9').removeClass("tipright").text("").addClass("tipwrong").text("商品描述不能为空");
                    }
                    else if(this.value.length < 20){
                        $('.tip9').removeClass("tipright").text("").addClass("tipwrong").text("商品描述不得少于20个字");
                    }else{
                        $('.tip9').removeClass("tipwrong").text("").addClass("tipright").text("通过");
                    }
                 }
                 //验证保养说明
                 if( $(this).is('#goods_save') ){
                    if(this.value==""){
                        $('.tip10').removeClass("tipright").text("").addClass("tipwrong").text("保养说明不能为空");
                    }
                    // else if(this.value.length < 15){
                    //     $('.tip10').removeClass("tipright").text("").addClass("tipwrong").text("保养说明不得少于15个字");
                    // }
                    else{
                        $('.tip10').removeClass("tipwrong").text("").addClass("tipright").text("通过");
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
                    if($('#goods_name').val()==""){
                        $('.tip1').removeClass("tipright").addClass("tipwrong").text("商品名称不能为空");
                        return false;
                    }
                    // if($('#goods_place').val()==""){
                    //     $('.tip2').removeClass("tipright").text("").addClass("tipwrong").text("商品产地不能为空");
                    //     return false;
                    // }
                    if($('#buying_price').val()==""){
                        $('.tip3').removeClass("tipright").text("").addClass("tipwrong").text("进货价不能为空");
                        return false;
                    }
                    if($('#shop_price').val()==""){
                        $('.tip4').removeClass("tipright").text("").addClass("tipwrong").text("本店价不能为空");
                        return false;
                    }
                    if($('#market_price').val()==""){
                        $('.tip5').removeClass("tipright").text("").addClass("tipwrong").text("市场价不能为空");
                        return false;
                    }
                    if($('#warehouse_num').val()==""){
                        $('.tip6').removeClass("tipright").text("").addClass("tipwrong").text("库存量不能为空");
                        return false;
                    }
                    if($('#goods_weight').val()==""){
                        $('.tip7').removeClass("tipright").text("").addClass("tipwrong").text("商品规格不能为空");
                        return false;
                    }
                    if($('#goods_summary').val()==""){
                        $('.tip8').removeClass("tipright").text("").addClass("tipwrong").text("商品简介不能为空");
                        return false;
                    }
                    if($('#goods_desc').val()==""){
                        $('.tip9').removeClass("tipright").text("").addClass("tipwrong").text("商品描述不能为空");
                        return false;
                    }
                    if($('#goods_save').val()==""){
                        $('.tip10').removeClass("tipright").text("").addClass("tipwrong").text("保养说明不能为空");
                        return false;
                    }
                    if (confirm("是否确认修改？")==true){
                        return true;
                    }else{
                        return false;
                    } 
                    // confirm("是否确认添加？");
             });
        });
        function showXY(source){
            var img = document.getElementById("show_img");
            img.src = source;
//            alert("Width:"+img.width+", Height:"+img.height);
        }
    </script>
</body>
</html>