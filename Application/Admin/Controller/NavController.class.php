<?php
namespace Admin\Controller;

use Common\Controller\AdminBaseController;
use Think\Controller;

class NavController extends AdminBaseController
{
    public function index()
    {
        $data = D('AdminNav')->getTreeData('tree','order_number,id');
        
        $assign = array(
            'data' => $data,
        );
        $this->assign($assign);
        $this->display();
    }
    
    public function add(){
        if(IS_POST){
            $data=I('post.');
            //var_dump($data);
          
           
           $result = D('AdminNav')->addData($data);
          // dump($result); 
           D('AuthRule')->addRoleByNav($data);
           if($result){
                $this->success("添加菜单成功",U('admin/nav/index'));
            }else{
                $this->error('添加失败');
            } 
        }else{
            $pid = I('pid');
            if(empty($pid)){
                $Pid =0;
            }
            $assign = array(
                'pid' => $pid,
            );
            $this->assign($assign);
            $this->display();
        }
        
    }
    
    public function edit(){
        if(IS_POST){
            $data = I('post.');
            $map = array(
                'id' => $data['id']
            );
            D('AuthRule')->updateRoleByNav($data);
            $result = D('AdminNav')->editData($map,$data);
            if($result){
                $this->success('修改成功',U('Admin/Nav/index'));
            }else{
                $this->error('修改失败');
            } 
        }else{
            $id = I('id');
            $map = array(
                'id' => $id
            );
            $data =  D('AdminNav')->findData($map);
            //var_dump($data);
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
        $result = D('AdminNav')->deleteData($map);
        if($result){
            $this->success('删除成功');
        }
    }
    
    public function order(){
        $data = I('post.');
        $result = D('AdminNav')->orderData($data);
        if($result){
            $this->success('排序成功',U('Admin/Nav/index'));
        }else{
            $this->error('排序失败');
        }
    }
    
    
}