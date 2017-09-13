<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	public function index(){
        echo "Home";
    }

    public function userMain(){
    	$categoryModel = D('Admin/Category');
        //最近浏览
        $his = array_reverse(session('his'),true);
        $this->assign('his',$his);
        
    	$this->assign('cattree',$categoryModel->gettree());//商品分类

    	$goodsModel = D('Admin/Goods');
        //新品
    	$new = $goodsModel->field('goods_id,goods_name,goods_img,goods_summary,shop_price')->order('goods_addtime desc')->where('warehouse_num>0')->limit('0,4')->select();
    	$this->assign('new',$new);

        //热销
    	$hot = $goodsModel->field('goods_id,goods_name,goods_img,goods_summary,shop_price')->order('sale_num desc')->where('warehouse_num>0')->limit('0,4')->select();
    	$this->assign('hot',$hot);
    	// var_dump($hot);
        
        // $this->assign('history' , array_reverse(session('history') , true));
         
        $this->display();
    }
}