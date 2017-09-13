<?php 
namespace Admin\Controller;
use Think\Controller;

class CommentController extends Controller
{
	public function comment_list(){
		$commentMedol = D('Comment');
		// $commentinfo = $commentMedol->order('com_time desc')->select();
		// if($commentinfo){
		// 	$this->assign('commentinfo',$commentinfo);
		// }

		$p = I('p')?I('p'):1;
        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
        $commentinfo = $commentMedol->order('com_time desc')->page($p.',5')->select();
        $this->assign('commentinfo',$commentinfo);// 赋值数据集
        $count      = $commentMedol->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,5);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
        // var_dump($show);
        $this->assign('count',$count);
        $this->assign('page',$show);// 赋值分页输出

		$this->display();
	}

	public function comment_search(){
		$commentMedol = D('Comment');

		$p = I('p')?I('p'):1;
        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
        $commentinfo = $commentMedol->order('com_time desc')->where('com_time like"%'.$_POST['searchtext'].'%"')->page($p.',5')->select();
        $this->assign('commentinfo',$commentinfo);// 赋值数据集
        $count      = $commentMedol->order('com_time desc')->where('com_time like"%'.$_POST['searchtext'].'%"')->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,5);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
        // var_dump($show);
        $this->assign('count',$count);
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('searchstr',$_POST['searchtext']);
		$this->display();
	}

	public function respond(){
		$result = D('Comment')->find($_POST['com_id']);
		$data['com_id'] = $_POST['com_id'];
		$data['con_id'] = $result['con_id'];
		$data['com_content'] = $result['com_content'];
		$nameresult = D('Goods')->find($result['goods_id']);
		$data['goods_name'] = $nameresult['goods_name'];
		$this->ajaxReturn(array('data'=>$data,'status'=>'200','info'=>'获取列表成功'));
	}

	public function addmyRes(){
		$commentMedol = D('Comment');
		if($commentMedol->where('com_id='.$_POST['com_id'])->
			save(array('res_content'=>$_POST['res_content'],'res_time'=>date('Y-m-d H-i-s')))){
                $this->redirect('admin/comment/comment_list');exit;//页面跳转
            }//修改数据
	}
}
 ?>