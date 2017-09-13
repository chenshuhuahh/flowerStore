<?php
namespace Admin\Controller;
use Think\Controller;
class CategoryController extends Controller {

    //分类添加
    public function cat_add(){
        $categoryModel = D('Category');
    	if(IS_POST){//如果有数据
    		$categoryModel = D('Category');//实例化CategoryModel，对应数据库中Category表
    		if($categoryModel->add($_POST)){
                 $this->redirect('admin/category/cat_list');exit;//页面跳转
            }//往数据库中的Category表添加数据
    		// var_dump($_POST);//打印提交的数据
    	}
        $this->assign('getalltree',$categoryModel->gettree());
        $this->display();//无论有没有提交数据都要显示这个页面
    }

    //分类列表
    public function cat_list(){
        $categoryModel = D('Category');
        $p = I('p')?I('p'):1;
        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
        $list = $categoryModel->order('cat_id')->page($p.',5')->select();
        $this->assign('catlist',$list);// 赋值数据集
        $count      = $categoryModel->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,5);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
        // var_dump($show);
        $this->assign('count',$count);
        $this->assign('page',$show);// 赋值分页输出
        $this->display(); // 输出模板

    }

    //显示树形图分类
    public function resultCategory() {
        $categoryModel = D('Category');
        $result = $categoryModel->loop();
        $this->ajaxReturn(array('data'=>$result,'status'=>'200','info'=>'获取列表成功'));
    }

    //分类修改
    public function cat_change(){
    	$categoryModel = D('Category');
        if(IS_POST){//如果有数据
            $categoryModel = D('Category');//实例化CategoryModel，对应数据库中Category表
            $cat_id = I('cat_id');//接收隐藏域传过来的值
            if($categoryModel->where('cat_id='.$cat_id)->save($_POST)){
                $this->redirect('admin/category/cat_list');exit;//页面跳转
            }//修改数据
        }
    	$this->assign('gettree',$categoryModel->gettree());
    	$this->assign('catinfo',$categoryModel->find(I('cat_id')));//I函数是接受cat_list.html传过来的id
 		$this->display();
    }

    //分类删除
    public function cat_delete(){
        $categoryModel = D('Category');
        if($categoryModel->delete(I('get.cat_id'))){
             $this->redirect('admin/category/cat_list');exit;//页面跳转
        }
    }

    //分类搜索
    public function cat_search(){
        $categoryModel = D('Category');
        $p = I('p')?I('p'):1;
        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
        // $list = $categoryModel->order('cat_id')->page($p.',5')->select();
        $list = $categoryModel->field('cat_id,cat_name,parent_id,cat_desc')->order('cat_id')->where('cat_name like"%'.$_POST['searchtext'].'%"')->page($p.',10')->select();
        $this->assign('catlist',$list);// 赋值数据集
        $count      = $categoryModel->where('cat_name like"%'.$_POST['searchtext'].'%"')->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
        // var_dump($show);
        $this->assign('count',$count);
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('searchname',$_POST['searchtext']);
        $this->display(); // 输出模板
    } 
}