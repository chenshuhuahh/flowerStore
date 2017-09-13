<?php
namespace Home\Controller;
use Think\Controller;
class GoodsController extends Controller {
    public function goodsdetail(){
        $goodsinfo = D('Admin/Goods')->find(I('goods_id'));
        // $goods_num = $_POST['goods_num'];
        // $this->assign('goods_num',$goods_num);
        // var_dump($goods_num);
        $this->assign('bread',$this->breadCrumbs($goodsinfo['cat_id']));
        $this->assign('goodsinfo',$goodsinfo);

    	$categoryModel = D('Admin/Category');
    	$this->assign('cattree',$categoryModel->gettree());

        //开始记录浏览商品
        // $this->history($row);
        if($goodsinfo){//开始记录浏览商品
            $his = $this->his($goodsinfo);
        }

        //评论
        $commentModel = D('Comment');
        $commentinfo = $commentModel->where('goods_id='.I('goods_id'))->select();
        if($commentinfo){
            $this->assign('commentinfo',$commentinfo);
        }
        $this->display();
    }

    // public function changenum(){
    //     $goods_num = $_POST['goods_num'];
    //     $this->assign('goods_num',$goods_num);
    //     $this->display('goodsdetail');
    // }

    public function goodssearch(){
    	$categoryModel = D('Admin/Category');
    	$this->assign('cattree',$categoryModel->gettree());

        if(IS_POST){
            // $str = $_POST['searchtext'];
            $goodsModel = D('Admin/Goods');
            // $data['goods_name'] = array('like','"%'.$str.'%"');
            $goodslist = $goodsModel->field('goods_id,goods_name,goods_img,goods_summary,shop_price,warehouse_num')->order('sale_num desc')->where('goods_summary like"%'.$_POST['searchtext'].'%"')->select();
            if($goodslist){
                // var_dump($goodslist);
                $this->assign('goodsinfo',$goodslist);
                $this->assign('searchstr',$_POST['searchtext']);                 
            }else{
                $this->redirect('Home/Goods/searchwrong');exit;
            }
        }
        $this->display();
       
    }

    public function searchwrong(){
    	$categoryModel = D('Admin/Category');
    	$this->assign('cattree',$categoryModel->gettree());
        $this->display();
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

    //记录浏览历史
    // protected function history($row) {
    //     $history = session('?history') ? session('history') : array();
    //     $g = array();
    //     $g['goods_name'] = $row['goods_name'];
    //     $g['goods_img'] = $row['goods_img'];
    //     $g['goods_summary'] = $row['goods_summary'];
    //     $g['shop_price'] = $row['shop_price'];
    //     $history[$row['goods_id']] = $g;
    //     if(count($history) > 3) {
    //         $key = key($history);
    //         unset($history[$key]);
    //     }
    //     session('history' ,$history);
    // }
    
    //历史
    public function his($goodsinfo){
        $goods_name = $goodsinfo['goods_name'];
        $shop_price = $goodsinfo['shop_price'];
        $goods_id = $goodsinfo['goods_id'];
        $goods_img = $goodsinfo['goods_img'];
        $goods_summary = $goodsinfo['goods_summary'];
        // $his = array();
        $his = session('?his')?session('his'):array();
        if(count($his) > 3){
            $k = key($his);
            unset($his[$k]);
        }
        $his[$goods_id] = array(
            'goods_name' =>$goods_name,
            'shop_price' =>$shop_price,
            'goods_img' =>$goods_img,
            'goods_summary' =>$goods_summary,
        );

        session('his',$his);
    }

    //添加购物车
    public function shoppingcart(){
        // if(!$_COOKIE['con_id']){
        //     $this->error('请先登录','http://localhost/myshop/index.php/Home/consumer/consumerlogin',2);
        // }
        $goodsinfo = D('Admin/Goods')->find(I('get.goods_id'));
        if(!$goodsinfo){
            $this->redirect('/');
            exit;
        }
        // 实例化购物车对象
        $tool = \Home\Tool\CartTool::getIns();
        // 把商品添加到购物车中
        $tool->add($goodsinfo['goods_id'],$goodsinfo['goods_name'],$goodsinfo['shop_price'],$goodsinfo['goods_img']); 
        // var_dump(session('cart'));
        if($_COOKIE['con_id']){
            $carModel = D('Car'); 

            $psw = $_COOKIE['con_id'];
            $name = $_COOKIE['con_name'];
            $usermodel = D('Consumer');       
            $userinfo = $usermodel->where(array('con_psw'=>$psw,'con_name'=>$name))->find();

            $row = array();
            $row['con_id'] = $userinfo['con_id'];
            $row['goods_id'] = $goodsinfo['goods_id'];
            $row['num'] = 1;
            $carModel->add($row);
        }
        // 输出购物车
        $this->redirect('Home/Order/shoppingcar');
    } 
}