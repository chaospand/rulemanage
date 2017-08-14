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
            $this->error('你没有访问该模块的权限');
        }else{
            $navs = D('AdminNav')->getTreeData('level','order_number,id');
            //var_dump($navs);
            $assign = array(
                'nav_data'=>$navs
            );
            $this->assign($assign);
        }
        
       
    }


    
    
}