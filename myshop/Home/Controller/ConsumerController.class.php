<?php
namespace Home\Controller;
use Think\Controller;
class ConsumerController extends Controller {
    public function consumerlogin(){
    	// var_dump($_POST);
        $this->display();
    }

    //登录
    public function conlogin(){
        if(IS_POST){
            $con_name = I('post.con_name');
            $con_psw = I('post.con_psw');

            $code = I('post.checknum');
            $Verify = new \Think\Verify();
            if(!$Verify->check($code)){
                 $this->error('验证码错误','',3);
            }

            $usermodel = D('Consumer');
            $userinfo = $usermodel->where(array('con_name'=>$con_name))->find();
            if(!$userinfo){
                $this->error('用户名错误','',3);//默认跳转到前一页
            }
            if($userinfo['con_psw'] !== md5($con_psw.$userinfo['salt'])){
                $this->error('密码错误','',3);//默认跳转到前一页
            }
            else{
                cookie('con_id',$userinfo['con_psw']);
                cookie('con_name',$userinfo['con_name']);

                $coo_kie = encrypt($userinfo['con_name'].$userinfo['con_psw'].C('COO_KIE'));
                cookie('key',$coo_kie);

                $this->redirect('home/index/userMain');exit;//页面跳转
            }
        }
        

    }

    public function checknumber(){
        $Verify = new \Think\Verify();
        $Verify->imageW = 150; 
        $Verify->fontSize = 20;
        $Verify->length = 4;
        $Verify->entry();
    }
    //注册
    public function conregister(){
    	if (IS_POST) {
    		$usermodel = D('Consumer');
            $s = $this->addsalt();
            $usermodel->con_name = $_POST['con_name'];
            $usermodel->con_psw = md5($_POST['con_psw'].$s);
            $usermodel->salt = $s;
            $usermodel->con_email = $_POST['con_email'];
    		if($usermodel->add()){
                $this->success('注册成功','',3);
            }else{
                $this->error('用户名已注册','',3);
            }
    	}
    }

    public function addsalt(){
        $str = 'asdfjlask09[uuqtoi*&^*43hq5kja94230597(*&)]';
        return substr(str_shuffle($str),0,8);//打乱字符串
    }

    //退出 删除cookie
    public function logout(){
        cookie('con_name',null);
        cookie('con_id',null);
        cookie('key',null);
        $this->redirect('home/index/userMain');exit;//页面跳转
    }
}