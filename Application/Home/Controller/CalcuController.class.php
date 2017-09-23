<?php
namespace Home\Controller;

use Common\Controller\FrontBaseController;

/** 
* @author 作者 Chaos
* @version 创建时间：2017年9月19日 下午2:10:36 
*/ 
class CalcuController extends FrontBaseController{
    public function login(){
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
            $user = M('FrontUser')->where($data)->find();
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
    
    public function index(){
        echo 'xx';
    }
    
    public function calculateReturn(){
        if(IS_POST){
            $data=I('post.');
            //var_dump($data);
            
            foreach ($data as $k => $v) {
                $data[$k]=trim($v);
            }
            $itemreturn =  D('Itemreturn');
            $result = $itemreturn->create($data);
            if($result){
                
                $bid = $data['bid'];
                $sid = $data['sid'];
                $returncash = 0;
                $comsume = $data['comsume'];
                $business = D('Business')->find($bid);
                $supplie = D('Supplie')->find($sid);
                //dump($profit);
                if(!empty($supplie)){
                    $sprice = $supplie['price'];
                    $profit = $comsume - $sprice;
                    
                    if($profit<0){
                        $message = '低于成本价,不进行计算' ;
                        $actionResult = new  \Common\Normal\ActionResult(false, $message);
                        $this->ajaxReturn($actionResult);
                    }
                    if(!empty($business)){
                        $percent = $business['percent'];
                        $percent = $percent/100;
                        $returncash = ($profit*$percent);
                    }
                    
                }
                
                $addResult = $itemreturn->addData($data);
                
                $actionResult = new  \Common\Normal\ActionResult(true, $returncash);
                $this->ajaxReturn($actionResult);
                /* if($addResult){
                 $this->success("成功",U('home/index/calculateReturn'));
                 }else{
                 $this->error('添加失败');
                 } */
            }else{
                $error = $itemreturn->getError();
                $this->error($error);
            }
            
        }else{
            $supplie = D('Supplie')->select();
            $business = D('Business')->select();
            $assign = array(
                'supplie' => $supplie,
                'business' => $business,
            );
            $this->assign($assign);
            $this->display();
        }
    }
}
