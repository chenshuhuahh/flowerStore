<?php
namespace Home\Controller;
use Think\Controller;
class CategoryController extends Controller {
    public function goodscat(){
    	$goodsModel = D('Admin/Goods');//实例化goods对象
    	//查询满足要求的总记录数
    	$count = $goodsModel->field('goods_id,goods_name,goods_img,goods_summary,shop_price')->order('goods_addtime desc')->where('cat_id='.I('cat_id'))->count();
    	//实例化分页类 传入总记录数和每页显示的记录数(1)
    	$Page = new \Think\Page($count,12);
    	$show = $Page->show();//分页显示输出
    	//进行分页数据查询 注意limit方法的参数要使用page类的属性
    	$goodslist = $goodsModel->field('goods_id,goods_name,goods_img,goods_summary,shop_price')->order('goods_addtime desc')->where('cat_id='.I('cat_id').' and warehouse_num>0')->limit($Page->firstRow.','.$Page->listRows)->select();
    	$this->assign('goodslist',$goodslist);//赋值数据集
    	$this->assign('page',$show);//赋值分页输出
    	$this->assign('count',$count);//总记录数

        $this->assign('bread',$this->breadCrumbs(I('cat_id')));

    	$categoryModel = D('Admin/Category');
    	$this->assign('cattree',$categoryModel->gettree());
        $this->display();//输出模板
    }

    public function allgoods(){
        $goodsModel = D('Admin/Goods');//实例化goods对象
        //查询满足要求的总记录数
        $count = $goodsModel->field('goods_id,goods_name,goods_img,goods_summary,shop_price,warehouse_num')->order('sale_num desc')->count();
        //实例化分页类 传入总记录数和每页显示的记录数(1)
        $Page = new \Think\Page($count,12);
        $show = $Page->show();//分页显示输出
        //进行分页数据查询 注意limit方法的参数要使用page类的属性
         $alllist = $goodsModel->field('goods_id,goods_name,goods_img,goods_summary,shop_price,warehouse_num')->order('sale_num desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('alllist',$alllist);
        $this->assign('page',$show);//赋值分页输出
        $this->assign('count',$count);//总记录数

        $categoryModel = D('Admin/Category');
        $this->assign('cattree',$categoryModel->gettree());
        $this->display();//输出模板
    }

    //面包屑导航
    public function breadCrumbs($cat_id){
        $categoryModel = D('Admin/Category'); 
        $fm = array();
        while ($cat_id>0) {
            foreach ($categoryModel->select() as $k => $v) {
                if($cat_id == $v['cat_id']){
                    $fm[] = $v;
                    $cat_id = $v['parent_id'];
                    break;
                }
            }
        }
        return array_reverse($fm);
    }
}