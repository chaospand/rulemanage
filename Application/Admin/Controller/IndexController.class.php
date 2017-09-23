<?php
namespace Admin\Controller;

use Think\Controller;
use Common\Controller\AdminBaseController;

class IndexController extends AdminBaseController
{
    public function index()
    {
       /*  $User = M('User'); // 实例化User对象
        
        //先获得参数
        $keyword = I('get.keywords')?I('get.keywords'):null; //获取搜索参数，关键字
        //dump($keyword);
        if(!empty($keyword)){
            $condition['name'] = array('like','%'.$keyword.'%');
            $map['keywords'] = $keyword;
        }
        //根据查询条件查询总数
        //dump($condition);
        $count = $User->where($condition)->count();// 查询满足要求的总记录数
        $Page = new \Think\Page($count,2);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        
        //将条件添加到分页查询里
        if(!empty($map)){
            $Page->parameter = array_map('urlencode',$map);  
        }
       
        //$Page->lastSuffix=false;
        $Page->rollPage=4;
        //不可以如下面这样子设置，智能在创建类的时候去加入，在初始化的时候计算firstRows
       // $Page->listRows=2;
        $Page->setConfig('header','<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;&nbsp;每页<b>%LIST_ROW%</b>条&nbsp;&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('last','末页');
        $Page->setConfig('first','首页');
        $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $show   = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        //根据查询条件分页查询
        $list = $User->where($condition)->limit($Page->firstRow.','.$Page->listRows)->select();
        //dump($list);
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出 */
        $this->display(); // 输出模板
    }
    
    
    
}