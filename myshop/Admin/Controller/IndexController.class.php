<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function adminMain(){
    	if(!$_COOKIE['admin_name']){
            $this->error('请先登录','http://localhost/myshop/index.php/Admin/Useradmin/adminlogin',2);
        }
        $this->display();
    }
    public function welcomeAdmin(){
        $this->display();
    }

    public function adminlogout(){
    	cookie('admin_name',null);
        cookie('admin_psw',null);
        $this->redirect('Admin/Useradmin/adminlogin');exit;//页面跳转
    }
}