<?php
namespace Admin\Controller;
use Think\Controller;
class OrderController extends Controller {
    public function order_list(){
    	
    	$orderlistModel = D('Orderlist');
    	// $listinfo = $orderlistModel->order('order_time desc')->select();
    	// if($listinfo){
    	// 	$this->assign('listinfo',$listinfo);
    	// }

    	$p = I('p')?I('p'):1;
        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
        $listinfo = $orderlistModel->order('order_time desc')->page($p.',5')->select();
        $this->assign('listinfo',$listinfo);// 赋值数据集
        $count      = $orderlistModel->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,5);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
        // var_dump($show);
        $this->assign('count',$count);
        $this->assign('page',$show);// 赋值分页输出

        $this->display();
    }

    public function order_search(){
        $orderlistModel = D('Orderlist');

        $p = I('p')?I('p'):1;
        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
        $listinfo = $orderlistModel->order('order_time desc')->where('order_time like"%'.$_POST['searchtext'].'%"')->page($p.',5')->select();
        // var_dump($_POST['searchtext']);
        $this->assign('listinfo',$listinfo);// 赋值数据集
        $count      = $orderlistModel->order('order_time desc')->where('order_time like"%'.$_POST['searchtext'].'%"')->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,5);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
        // var_dump($show);
        $this->assign('count',$count);
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('searchstr',$_POST['searchtext']);
        $this->display();
    }

    public function order_details(){
    	$orderdetailModel = D('Orderdetail');
    	$order_id = I('get.order_id');
    	$detailinfo = $orderdetailModel->where('order_id='.$order_id)->select();
    	if($detailinfo){
    		$this->assign('detailinfo',$detailinfo);
    	}
    	$this->assign('listinfo',D('Orderlist')->find($order_id));
        $this->assign('count',$orderdetailModel->where('order_id='.$order_id)->count());
        $this->display();
    }

    public function changesend(){
    	$order_id = I('get.order_id');
    	$orderlistModel = D('Orderlist');
    	$sendok = $orderlistModel->where('order_id='.$order_id)->save(array('send_status'=>'1'));
    	if($sendok){
    		$this->redirect('Admin/Order/order_list');exit;
    	}
    }
}