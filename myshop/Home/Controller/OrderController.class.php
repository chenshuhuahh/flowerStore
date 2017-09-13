<?php
namespace Home\Controller;
use Think\Controller;
class OrderController extends Controller {
    public function done(){
        if(!$_COOKIE['con_id']){
            $this->error('请先登录','http://localhost/myshop/index.php/Home/consumer/consumerlogin',2);
        }
    	$categoryModel = D('Admin/Category');
    	$this->assign('cattree',$categoryModel->gettree());
        if(IS_POST){
            $orderlistModel = D('Orderlist');
            $orderdetailModel = D('Orderdetail');
            // $cart = \Home\Tool\CartTool::getIns();

            $psw = $_COOKIE['con_id']?$_COOKIE['con_id']:0;
            $name = $_COOKIE['con_name']?$_COOKIE['con_name']:0;
            $usermodel = D('Consumer');       
            $userinfo = $usermodel->where(array('con_psw'=>$psw,'con_name'=>$name))->find();

            $carModel = D('Car');
            $goodsModel = D('Admin/Goods');
            $tool = array();
            $n1 = 0;
            $carinfo = $carModel->where('con_id='.$userinfo['con_id'])->select();
            foreach($carinfo as $k=>$v) {
                $goodsinfo = $goodsModel->find($v['goods_id']);
                $row1 = array();
                $row1['goods_id'] = $goodsinfo['goods_id'];
                $row1['goods_name'] = $goodsinfo['goods_name'];
                $row1['shop_price'] = $goodsinfo['shop_price'];
                $row1['goods_img'] = $goodsinfo['goods_img'];
                $row1['num'] = $v['num'];
                $tool[$row1['goods_id']] = $row1;
                $n1 += $row1['num'] * $row1['shop_price'];
            }

            // 写入orderlist表
            // $psw = $_COOKIE['con_id']?$_COOKIE['con_id']:0;
            // $name = $_COOKIE['con_name']?$_COOKIE['con_name']:0;
            // $usermodel = D('Consumer');       
            // $userinfo = $usermodel->where(array('con_psw'=>$psw,'con_name'=>$name))->find();
            // var_dump($userinfo);     
            $_POST['con_id'] = $userinfo['con_id'];
            // $_POST['pay_prices'] = $cart->calcMoney();
            $_POST['pay_prices'] = $n1;
            $_POST['order_time'] = date('Y-m-d H-i-s');
            $order_id = NULL;
            // $orderlistModel->create() && ($order_id=$orderlistModel->add());
            $order_id=$orderlistModel->add($_POST);
            // var_dump($order_id);
            if(!$order_id) {
                $this->error('li下单失败','shoppingcar',3);
                exit;
            }
            // 写入orderdetail表
            $data = array();
            // $tool = session('cart');
            foreach($tool as $k=>$v) {
                $row = array();
                $row['order_id'] = $order_id;
                $row['goods_id'] = $k;
                $row['goods_name'] = $v['goods_name'];
                $row['shop_price'] = $v['shop_price'];
                $row['goods_img'] = $v['goods_img'];
                $row['num'] = $v['num'];
                $data[] = $row;
                $goodsModel = D('Admin/Goods');
                $goodsinfo = $goodsModel->find($row['goods_id']);
                $mydata['warehouse_num'] = $goodsinfo['warehouse_num'] - $row['num'];
                $mydata['sale_num'] = $goodsinfo['sale_num'] + $row['num'];
                $goodsModel->where('goods_id='.$row['goods_id'])->save($mydata);
            }
            // var_dump($data);
            if(!$orderdetailModel->addAll($data)) {

                $tool = session('cart');
                foreach($tool as $k=>$v) {
                    $row = array();
                    $row['order_id'] = $order_id;
                    $row['goods_id'] = $k;
                    $row['goods_name'] = $v['goods_name'];
                    $row['shop_price'] = $v['shop_price'];
                    $row['goods_img'] = $v['goods_img'];
                    $row['num'] = $v['num'];
                    $goodsModel = D('Admin/Goods');
                    $goodsinfo = $goodsModel->find($row['goods_id']);
                    $mydata['warehouse_num'] = $goodsinfo['warehouse_num'] + $row['num'];
                    $mydata['sale_num'] = $goodsinfo['sale_num'] - $row['num'];
                    $goodsModel->where('goods_id='.$row['goods_id'])->save($mydata);
                }
                $orderlistModel->delete($order_id);
                $orderdetailModel->where(array('order_id'=>$order_id))->delete();
                $this->error('未选择商品,下单失败','shoppingcar',3);
                exit;
            }
            $carModel->where(array('con_id'=>$userinfo['con_id']))->delete();
            $this->success('下单成功','orderlist',3);
            // $this->assign('listinfo',$_POST);
            // $this->assign('detailinfo',$data);
            // $this->assign('ord_sn' , $_POST['ord_sn']);
            // $this->assign('money' , $cart->calcMoney());
            // $CBPay = new \Home\Pay\CBPay();
            // $CBPay->v_oid = $_POST['ord_sn'];
            // $CBPay->v_amount = $cart->calcMoney();$this->assign('pay' , $CBPay->form());
            // 购物车清空
            
            // $cart->clear();           
        }
        
    }
    public function orderlist(){
        if(!$_COOKIE['con_id']){
            $this->error('请先登录','http://localhost/myshop/index.php/Home/consumer/consumerlogin',2);
        }
        $psw = $_COOKIE['con_id']?$_COOKIE['con_id']:0;
        $name = $_COOKIE['con_name']?$_COOKIE['con_name']:0;
        $usermodel = D('Consumer');       
        $userinfo = $usermodel->where(array('con_psw'=>$psw,'con_name'=>$name))->find();
        // var_dump($userinfo);     
        $userid = $userinfo['con_id'];
        $this->assign('listcount',D('Orderlist')->where('con_id='.$userid)->count());
        $this->assign('listinfo',D('Orderlist')->where('con_id='.$userid)->order('order_time desc')->select());
        $this->assign('detailinfo',D('Orderdetail')->select());
        $this->display();
    }
    public function shoppingcar(){
        // if(!$_COOKIE['con_id']){
        //     $this->error('请先登录','http://localhost/myshop/index.php/Home/consumer/consumerlogin',2);
        // }
    	$categoryModel = D('Admin/Category');
    	$this->assign('cattree',$categoryModel->gettree());

        if($_COOKIE['con_id']){
            $carModel = D('Car');
            $goodsModel = D('Admin/Goods');

            $psw = $_COOKIE['con_id']?$_COOKIE['con_id']:0;
            $name = $_COOKIE['con_name']?$_COOKIE['con_name']:0;
            $usermodel = D('Consumer');       
            $userinfo = $usermodel->where(array('con_psw'=>$psw,'con_name'=>$name))->find();

            $data1 = array();
            $n1 = 0;
            $carinfo = $carModel->where('con_id='.$userinfo['con_id'])->select();
            foreach($carinfo as $k=>$v) {
                $goodsinfo = $goodsModel->find($v['goods_id']);
                $row1 = array();
                $row1['goods_id'] = $goodsinfo['goods_id'];
                $row1['goods_name'] = $goodsinfo['goods_name'];
                $row1['shop_price'] = $goodsinfo['shop_price'];
                $row1['goods_img'] = $goodsinfo['goods_img'];
                $row1['num'] = $v['num'];
                $data1[$row1['goods_id']] = $row1;
                $n1 += $row1['num'] * $row1['shop_price'];
            }
            $this->assign('allprice',$n1);
            $this->assign('typecount',count($data1)); 
            $this->assign('cart',$data1);
         }else{
            $tool = \Home\Tool\CartTool::getIns();
            $cart = session('cart');
            $this->assign('allprice',$tool->calcMoney());
            $this->assign('typecount',$tool->calcType()); 

            $this->assign('cart',$cart);
         }
        $this->display();
    }

    public function delgoods(){
        $goods_id = $_POST['goods_id'];
        $tool = \Home\Tool\CartTool::getIns();
        $tool->del($goods_id);

        $psw = $_COOKIE['con_id']?$_COOKIE['con_id']:0;
        $name = $_COOKIE['con_name']?$_COOKIE['con_name']:0;
        $usermodel = D('Consumer');       
        $userinfo = $usermodel->where(array('con_psw'=>$psw,'con_name'=>$name))->find();

        if($_COOKIE['con_id']){
            $carModel = D('Car');
            $carModel->where(array('con_id'=>$userinfo['con_id'],'goods_id'=>$goods_id))->delete();
        }
    }

    public function changegoods(){
        $carModel = D('Car');
        $goods_id = $_POST['goods_id'];
        $num = $_POST['num'];
        $tool = \Home\Tool\CartTool::getIns();
        $tool->changenum($goods_id,$num);
        if($_COOKIE['con_id']){

            $psw = $_COOKIE['con_id']?$_COOKIE['con_id']:0;
            $name = $_COOKIE['con_name']?$_COOKIE['con_name']:0;
            $usermodel = D('Consumer');       
            $userinfo = $usermodel->where(array('con_psw'=>$psw,'con_name'=>$name))->find();

            $data['num'] = $_POST['num'];
            $carModel->where(array('con_id'=>$userinfo['con_id'],'goods_id'=>$_POST['goods_id']))->save($data);
        }
    }
}