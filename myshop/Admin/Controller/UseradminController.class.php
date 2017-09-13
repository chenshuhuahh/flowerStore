<?php 
namespace Admin\Controller;
use Think\Controller;

class UseradminController extends Controller
{
	public function adminlogin(){
        $this->display();
    }

    public function adlogin(){
    	if(IS_POST){
    		$username = $_POST['username'];
    		$userpsw = $_POST['userpsw'];
    		if($username=='user' && $userpsw=='123'){
                cookie('admin_name',$_POST['username']);
                cookie('admin_psw',$_POST['userpsw']);
    			$this->redirect('admin/index/adminmain');exit;
    		}else{
    		$this->error('用户名密码不正确','',2);
    	}
    	}
    	else{
    		$this->error('未输入用户名密码','',2);
    	}
    }
}
 ?>