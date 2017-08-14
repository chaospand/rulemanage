<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller
{
    public function index()
    {
		if(IS_POST){
			$data = I('POST.');
			$code = $_POST['code'];
			//var_dump($code);
			$id='';
			$verify = new \Think\Verify;
			if(!$verify->check($code, $id)){
				$this->error('验证码错误');
			}
			unset($data['code']);
			$data['password'] = md5($data['password']);
			$user = M('User')->where($data)->find();
			if(empty($user)){
				$this->error('账号密码错误');
			}else{
                $_SESSION['user']=array(
                    'id'=>$user['id'],
                    'username'=>$user['name'],
                );
                $this->success('登录成功、前往管理后台',U('Admin/Index/index'));
            }
	
		}else{
		    $this->display();
		}
    }
	
	public function verify(){
		$Verify =     new \Think\Verify();
		$Verify->fontSize = 30;
		$Verify->length   = 3;
		$Verify->useNoise = false;
		$Verify->entry();
	}
	
	public function logout(){
	    session(null);
	    $this->success('退出成功',U('Home/Index/index'));
	}
}