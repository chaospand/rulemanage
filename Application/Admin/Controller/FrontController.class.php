<?php 
namespace Admin\Controller;
use Common\Controller\FrontBaseController;

/**
 * @author 作者 Chaos
 * @version 创建时间：2017年9月19日 下午2:25:28
 */
class FrontController extends FrontBaseController{
    
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
                    $scount = $data['scount'];
                    $profit = $comsume - $sprice*$scount;
                    
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
                $uid = $_SESSION['frontUser']['id'];
                $data['uid'] = $uid;
                $data['returncash'] = $returncash;
                //dump();
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
    
    public function listData(){
        $business = D('Itemreturn');
        //先获得参数
        $keyword = I('get.keywords')?I('get.keywords'):null; //获取搜索参数，关键字
        //dump($keyword);
        
        if(!empty($keyword)){
            $condition['keywords'] = $keyword;
            $map['keywords'] = $keyword;
        }
        //根据查询条件查询总数
        // dump($condition);
        $count = $business->countData($condition);// 查询满足要求的总记录数
        $Page = new \Think\Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        
        //将条件添加到分页查询里
        if(!empty($map)){
            $Page->parameter = array_map('urlencode',$map);
        }
        
        //$Page->lastSuffix=false;
        //$Page->rollPage=4;
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
        $list = $business->getData($Page->firstRow,$Page->listRows,$condition);
        //dump($list);
        $this->assign('keywords',$keyword);// 赋值数据集
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display(); // 输出模板 
    }
    
    public function edit(){
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
                        $this->error($message);
                    }
                    if(!empty($business)){
                        $percent = $business['percent'];
                        $percent = $percent/100;
                        $returncash = ($profit*$percent);
                    }
                    
                }
                $data['returncash'] = $returncash;
                //dump();
                $map = array(
                    'id' => $data['id']
                );
                $addResult = $itemreturn->editData($map,$data);
                
                $actionResult = new  \Common\Normal\ActionResult(true, $returncash);
                $this->success("修改成功");
            }else{
                $error = $itemreturn->getError();
                $this->error($error);
            }
            
        }else{
            $id = I('id');
            $map = array(
                'id' => $id
            );
            $data =  D('Itemreturn')->findData($map);
            $business = D('Business')->select();
            $thisBusiness =  D('Business')->find($data['bid']);
            if($thisBusiness['sids']!=null){
                $smap['id'] = array('in',$thisBusiness['sids']);
                $supplie = D('Supplie')->where($smap)->select();
            }else{
                
            }
           
            $assign = array(
                'data' => $data,
                'supplie' => $supplie,
                'business' => $business,
            );
            $this->assign($assign);
            $this->display();
        }
    }
    
    public function delete(){
        $id = I('id');
        $map = array(
            'id' => $id
        );
        $result =  D('Itemreturn')->deleteData($map);
        if($result){
            $this->success('删除成功');
        }
    }

    public function test(){
        
        $business = D('Itemreturn');
        //先获得参数
        $keyword = I('get.keywords')?I('get.keywords'):null; //获取搜索参数，关键字
        
        if(!empty($keyword)){
            $condition['businessname'] = array('like','%'.$keyword.'%');
            $map['keywords'] = $keyword;
        }
        //根据查询条件查询总数
        $condition['uid'] = $_SESSION['frontUser']['id'];
        $count = $business->where($condition)->count();// 查询满足要求的总记录数
        $Page = new \Think\Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        
        //将条件添加到分页查询里
        if(!empty($map)){
            $Page->parameter = array_map('urlencode',$map);
        }
        
        //不可以如下面这样子设置，智能在创建类的时候去加入，在初始化的时候计算firstRows
        $Page->setConfig('header','<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;&nbsp;每页<b>%LIST_ROW%</b>条&nbsp;&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('last','末页');
        $Page->setConfig('first','首页');
        $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $show   = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        //根据查询条件分页查询
        $list = $business->getPersonData($Page->firstRow,$Page->listRows,$condition);
        //dump($list);
        $this->assign('keywords',$keyword);// 赋值数据集
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display(); // 输出模板 
        
    }
    
}

?>