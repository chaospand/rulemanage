<?php
/** 
* @author 作者 Chaos
* @version 创建时间：2017年9月16日 下午3:17:47 
*/ 
namespace Admin\Controller;

use Common\Controller\AdminBaseController;
class SupplieController extends AdminBaseController{
    const INDEX = 'admin/supplie/index';
    public function index(){
        $business = D('Supplie');
        //先获得参数
        $keyword = I('get.keywords')?I('get.keywords'):null; //获取搜索参数，关键字
        //dump($keyword);
        if(!empty($keyword)){
            $condition['suppliename'] = array('like','%'.$keyword.'%');
            $map['keywords'] = $keyword;
        }
        //根据查询条件查询总数
        //dump($condition);
        $count = $business->where($condition)->count();// 查询满足要求的总记录数
        $Page = new \Think\Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        
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
        $list = $business->where($condition)->limit($Page->firstRow.','.$Page->listRows)->select();
        //dump($list);
        $this->assign('keywords',$keyword);// 赋值数据集
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display(); // 输出模板
    }
    
    public function add(){
        // 去除键值首尾的空格
        if(IS_POST){
            $data=I('post.');
            //var_dump($data);
            
            foreach ($data as $k => $v) {
                $data[$k]=trim($v);
            }
            $business =  D('Supplie');
            $result = $business->create($data);
            
            if($result){
                $addResult = $business->addData($data);
                if($addResult){
                    $this->success("成功",U('admin/supplie/index'));
                }else{
                    $this->error('添加失败');
                }
            }else{
                $error = $business->getError();
                $this->error($error);
            }
        }else{
            $this->assign($assign);
            $this->display();
        }
    }
    
    public function edit(){
        if(IS_POST){
            $data=I('post.');
            //var_dump($data);
            
            foreach ($data as $k => $v) {
                $data[$k]=trim($v);
            }
            $map = array(
                'id' => $data['id']
            );
            $supplie = D('Supplie');
            $validate = $supplie->create($data);
            if($validate){
                $result = $supplie->editData($map,$data);
                if($result){
                    $this->success('修改成功',U('admin/supplie/index'));
                }else{
                    $this->error('修改失败');
                }
            }else{
                $error = $supplie->getError();
                $this->error($error);
            }
            
        }else{
            $id = I('id');
            $map = array(
                'id' => $id
            );
            $data =  D('Supplie')->findData($map);
            $assign = array(
                'data' => $data,
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
        $result = D('Supplie')->deleteData($map);
        if($result){
            $this->success('删除成功');
        }
    }
    
    
}