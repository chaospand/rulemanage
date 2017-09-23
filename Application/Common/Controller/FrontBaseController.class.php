<?php
namespace Common\Controller;
/** 
* @author 作者 Chaos
* @version 创建时间：2017年9月19日 下午2:03:42 
*/ 
class FrontBaseController extends BaseController{
    
    public function _initialize(){
        parent::_initialize();
       /*  dump($_SESSION['frontUser']);
        dump($_SESSION['user']);
        dump(empty($_SESSION['frontUser'])); */
        if($_SESSION['frontUser']!=null){
            //这是菜单
            $navs = D('FrontNav')->getTreeData('level','order_number,id');
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
            
        }else{
            $this->error('未登录,请登录',U('home/index/frontLogin'));
        }
        
    }
    
  
}