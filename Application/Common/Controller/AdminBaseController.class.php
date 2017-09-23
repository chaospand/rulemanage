<?php
namespace Common\Controller;

use Think\Auth;

class AdminBaseController extends BaseController{
    /**
     * {@inheritDoc}
     * @see \Common\Controller\BaseController::_initialize()
     */
    public function _initialize()
    {
        parent::_initialize();
        $action = MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME;
        $auth = new Auth();
        // echo $action;
        if(!$auth->check($action, $_SESSION['user']['id'])){
            //echo '你没有权限';
            if($_SESSION['user']['id']==null){
                $this->error('你没有登录,正在返回登录界面',U('home/Index/index'));
            }else{
                $this->error('你没有访问该模块的权限');
            }
           
        }else{
			
			
			//这是菜单
            $navs = D('AdminNav')->getTreeData('level','order_number,id');
            //dump($navs);
            //dump($navs);
            //var_dump($navs);
            
            $current = D('AdminNav')->getParentChannel($action);
            //dump($current);
            $assign = array(
                'nav_data'=>$navs,
                'current' => $current
            );
            $this->assign($assign);
        }
        
       
    }


    
    
}