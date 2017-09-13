<?php
namespace Home\Controller;
use Think\Controller;
class CommentController extends Controller {
    public function goodscomment(){
    	$categoryModel = D('Admin/Category');
    	$this->assign('cattree',$categoryModel->gettree());

    	$orderdetail_id = I('orderdetail_id');
    	$orderdetailModel = D('Orderdetail');
    	$info = $orderdetailModel->find($orderdetail_id);
    	// var_dump($info);
    	$this->assign('info',$info);

        $this->display();
    }

    public function addComment(){
    	if(IS_POST){
    		$commentModel = D('Comment');
    		// var_dump($_POST['orderdetail_id']);
            $odinfo = D('Orderdetail')->find($_POST['orderdetail_id']);
            $olinfo = D('Orderlist')->find($odinfo['order_id']);
    		$arr = array('goods_id' => $_POST['goods_id'],
                        'con_id'=>$olinfo['con_id'],
    					'com_content' => $_POST['com_content'],
    					'com_time' => date('Y-m-d H-i-s')
    					);
    		if($commentModel->add($arr)){
    			$orderdetailModel = D('Orderdetail');
    			$orderdetailModel->where('orderdetail_id='.$_POST['orderdetail_id'])->save(array('goods_status'=>'1'));
                $this->redirect('home/order/orderlist');exit;
            }
    	}   	
    }
}