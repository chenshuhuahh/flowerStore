<?php
namespace Admin\Controller;
use Think\Controller;
class GoodsController extends Controller {
	public $goodsModel;
	public function __construct(){//封装构造函数
		parent::__construct();
		$this->goodsModel = D('goods');
	}
    //商品添加
    public function goods_add(){
    	if(IS_POST){
            // if(!$this->goodsModel->create($_POST)){//自动验证传进来的数据，在model层验证
            //     //如果创建失败，表示验证没有通过，输出错误信息
            //     echo $this->goodsModel->getError();exit;
            // }
            //上传商品图片
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath  =     './Public/Upload/'; // 设置附件上传根目录
            $upload->savePath  =     ''; // 设置附件上传（子）目录
            // 上传文件
            $info   =   $upload->upload();
            if(!$info) {// 上传错误提示错误信息
                $this->error($upload->getError());
            }else{// 上传成功
                var_dump($info);
                $img_path1 = './Public/Upload/'.$info['ori_img']['savepath'];
                $img_path2 = $info['ori_img']['savename'];

                $image = new \Think\Image();
                $image->open($img_path1.$img_path2);
                // 按照原图的比例生成一个最大为350*350的缩略图并保存为$info['ori_img']['savename']

                $img_xiao = './Public/Upload/thumb/'.$img_path2;
                $image->thumb(350, 350)->save($img_xiao);
                $this->goodsModel->goods_name = $_POST['goods_name'];
                $this->goodsModel->cat_id = $_POST['cat_id'];
                $this->goodsModel->buying_price = $_POST['buying_price'];
                $this->goodsModel->shop_price = $_POST['shop_price'];
                $this->goodsModel->market_price = $_POST['market_price'];
                $this->goodsModel->goods_summary = $_POST['goods_summary'];
                $this->goodsModel->goods_desc = $_POST['goods_desc'];
                // $this->goodsModel->goods_place = $_POST['goods_place'];
                $this->goodsModel->goods_weight = $_POST['goods_weight'];
                $this->goodsModel->warehouse_num = $_POST['warehouse_num'];
                $this->goodsModel->goods_save = $_POST['goods_save'];
                
                $this->goodsModel->goods_img = '/myshop/Public/Upload/thumb/'.$img_path2;
                $this->goodsModel->ori_img = '/myshop/Public/Upload/'.$info['ori_img']['savepath'].$img_path2;
            }

            var_dump($_POST);
            //添加数据到数据库
    		if($this->goodsModel->add()){
                $this->redirect('admin/goods/goods_list');exit;//页面跳转
            }
    		// $goodsModel = D('goods');
    		// var_dump($_POST);
    	}
        $categoryModel = D('Category');//分类表category
        $this->assign('getalltree',$categoryModel->gettree());
        $this->display();
    }

    //商品列表
    public function goods_list(){
        $p = I('p')?I('p'):1;
        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
        $list = $this->goodsModel->order('goods_id desc')->page($p.',5')->select();
        $this->assign('goodslist',$list);// 赋值数据集
        $count      = $this->goodsModel->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,5);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
        // var_dump($show);
        $this->assign('count',$count);
        $this->assign('page',$show);// 赋值分页输出

        $this->display(); // 输出模板

        // $this->assign('goodslist',$this->goodsModel->select());
        // $this->display();
    }

    public function goods_search(){
        $p = I('p')?I('p'):1;
        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
        $list = $this->goodsModel->field('goods_id,goods_name,goods_img,buying_price,shop_price,market_price,sale_num,warehouse_num,cat_id')->order('goods_id desc')->where('goods_name like"%'.$_POST['searchtext'].'%"')->page($p.',5')->select();
        // $list = $this->goodsModel->order('goods_id desc')->page($p.',5')->select();
        $this->assign('goodslist',$list);// 赋值数据集
        $count      = $this->goodsModel->field('goods_id,goods_name,goods_img,buying_price,shop_price,market_price,sale_num,warehouse_num,cat_id')->order('goods_id desc')->where('goods_name like"%'.$_POST['searchtext'].'%"')->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,5);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
        // var_dump($show);
        $this->assign('count',$count);
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('searchstr',$_POST['searchtext']);

        $this->display(); // 输出模板
    }

    //商品修改
    public function goods_change(){
        $goods_id = I('goods_id');
        if(IS_POST){
            //上传商品图片
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath  =     './Public/Upload/'; // 设置附件上传根目录
            $upload->savePath  =     ''; // 设置附件上传（子）目录
            // 上传文件
            $info1   =   $upload->upload();
            if(!$info1) {// 上传错误提示错误信息
                // $this->error($upload->getError());
                $this->goodsModel->goods_name = $_POST['goods_name'];
                $this->goodsModel->cat_id = $_POST['cat_id'];
                $this->goodsModel->buying_price = $_POST['buying_price'];
                $this->goodsModel->shop_price = $_POST['shop_price'];
                $this->goodsModel->market_price = $_POST['market_price'];
                $this->goodsModel->goods_summary = $_POST['goods_summary'];
                $this->goodsModel->goods_desc = $_POST['goods_desc'];
                // $this->goodsModel->goods_place = $_POST['goods_place'];
                $this->goodsModel->goods_weight = $_POST['goods_weight'];
                $this->goodsModel->warehouse_num = $_POST['warehouse_num'];
                $this->goodsModel->goods_save = $_POST['goods_save'];
                
                $this->goodsModel->goods_img = $_POST['hiddenimg'];;
                $this->goodsModel->ori_img = $_POST['hiddenori'];
                var_dump($_POST);
                //添加数据到数据库
                if($this->goodsModel->where('goods_id='.$goods_id)->save()){
                    $this->redirect('admin/goods/goods_list');exit;//页面跳转
                }
            }else{// 上传成功
                var_dump($info1);
                $img_path1 = './Public/Upload/'.$info1['ori_img']['savepath'];
                $img_path2 = $info1['ori_img']['savename'];

                $image = new \Think\Image();
                $image->open($img_path1.$img_path2);
                // 按照原图的比例生成一个最大为350*350的缩略图并保存为$info['ori_img']['savename']

                $img_xiao = './Public/Upload/thumb/'.$img_path2;
                $image->thumb(350, 350)->save($img_xiao);
                $this->goodsModel->goods_name = $_POST['goods_name'];
                $this->goodsModel->cat_id = $_POST['cat_id'];
                $this->goodsModel->buying_price = $_POST['buying_price'];
                $this->goodsModel->shop_price = $_POST['shop_price'];
                $this->goodsModel->market_price = $_POST['market_price'];
                $this->goodsModel->goods_summary = $_POST['goods_summary'];
                $this->goodsModel->goods_desc = $_POST['goods_desc'];
                // $this->goodsModel->goods_place = $_POST['goods_place'];
                $this->goodsModel->goods_weight = $_POST['goods_weight'];
                $this->goodsModel->warehouse_num = $_POST['warehouse_num'];
                $this->goodsModel->goods_save = $_POST['goods_save'];
                
                $this->goodsModel->goods_img = '/myshop/Public/Upload/thumb/'.$img_path2;
                $this->goodsModel->ori_img = '/myshop/Public/Upload/'.$info1['ori_img']['savepath'].$img_path2;
                var_dump($_POST);
                //添加数据到数据库
                if($this->goodsModel->where('goods_id='.$goods_id)->save()){
                    $this->redirect('admin/goods/goods_list');exit;//页面跳转
                }
            }

            
            // $goodsModel = D('goods');
            // var_dump($_POST);
        }
        $categoryModel = D('Category');
        $this->assign('gettree',$categoryModel->gettree());
        $this->assign('goodsinfo',$this->goodsModel->find(I('goods_id')));
        $this->display();
    }

    //商品删除
    public function goods_delete(){
        if($this->goodsModel->delete(I('get.goods_id'))){
            $this->redirect('admin/goods/goods_list');exit;
        }
    }
}