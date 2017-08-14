<?php
namespace Admin\Controller;

use Common\Controller\AdminBaseController;
use Think\Controller;

class AuthRuleController extends AdminBaseController{
    public function index(){
        
        $data = D('AuthRule')->getTreeData('tree');
        $assign = array(
            'data' => $data
        );
        $this->assign($assign);
        $this->display();
    }
    
    public function add(){
        if(IS_POST){
            $data=I('post.');
            $result = D('AuthRule')->addData($data);
            if($result){
             $this->success("添加菜单成功",U('admin/AuthRule/index'));
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
            $result = D('AuthRule')->editData($map,$data);
            if($result){
                $this->success('修改成功',U('Admin/AuthRule/index'));
            }else{
                $this->error('修改失败');
            }
        }else{
            $id = I('id');
            $map = array(
                'id' => $id
            );
            $data =  D('AuthRule')->findData($map);
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
        $result = D('AuthRule')->deleteData($map);
        if($result){
            $this->success('删除成功');
        }
    }
    
    //********************用户组列表********************
    
    public function group(){
        $data = D('AuthGroup')->select();
        $assign = array(
            'data' => $data,
        );
        $this->assign($assign);
        $this->display();
    }
    
    public function addGroup(){
        if(IS_POST){
            $data = I('post.');
           // dump($data);
            $result = D('AuthGroup')->addData($data);
            if($result){
                $this->success('添加成功',U('admin/AuthRule/group'));
            }else{
                //echo 'error';
                $this->error('添加失败');
            }
        }else{
            $this->display();
        }
        
    }
    
    public function editGroup(){
        if(IS_POST){
            $data = I('post.');
            $map=array(
                'id'=>$data['id']
            );
           // dump($data);
            $result = D('AuthGroup')->editData($map,$data);
            if($result){
                $this->success('修改成功',U('admin/AuthRule/group'));
            }else{
                //echo 'error';
                $this->error('修改失败');
            }
        }else{
            $id = I('id');
            $map = array(
                'id' => $id
            );
            $data =  D('AuthGroup')->findData($map);
            //var_dump($data);
            $assign = array(
                'data' => $data,
            );
            $this->assign($assign);
            $this->display();
        }
    }
    
    public function deleteGroup(){
        $id = I('id');
        $map = array(
            'id' => $id
        );
        $result = D('AuthGroup')->deleteData($map);
        if($result){
            $this->success('删除成功');
        }
    }
    
    public function ruleGroup(){
       
        if(IS_POST){
            $data = I('post.');
            $map = array(
                'id' => $data['id']
            );
            $data['rules'] = implode(',',  $data['rule_ids']);
            $result=D('AuthGroup')->editData($map,$data);
            if ($result) {
                $this->success('操作成功',U('Admin/AuthRule/group'));
            }else{
                $this->error('操作失败');
            }
        }else{
            $id = I('get.id');
            //获取用户组数据
            $group_data = M('Auth_group')->where(array('id'=>$id))->find();
            $group_data['rules'] = explode(',', $group_data['rules']);
            //获取规格数据
            $rule_data = D('AuthRule')->getTreeData('level','id','title');
            $assign=array(
                'group_data'=>$group_data,
                'rule_data'=>$rule_data
            );
            //dump($assign);
            $this->assign($assign);
           $this->display();
        }
    }
    
    //*******************用户列表********************* 
    
    public function adminUserList(){
        $data = D('AuthGroupAccess')->getAllData();
        $assign = array(
            'data' => $data
        );
        $this->assign($assign);
        $this->display();
    }
    
    public function editUser(){
        if(IS_POST){
            $data = I('post.');
            $map=array(
                'id'=>$data['id']
            );
            // dump($data);
            $result = D('User')->editData($map,$data);
            if($result){
                $this->success('修改成功',U('admin/AuthRule/adminUserList'));
            }else{
                //echo 'error';
                $this->error('修改失败');
            }
        }else{
            $id = I('id');
            $map = array(
                'id' => $id,
            );
            $data = D('User')->findData($map);
            $assign = array(
                'data' => $data
            );
            $this->assign($assign);
            $this->display();
        }
       
        
    }
    
    
    public function addUser(){
        if(IS_POST){
            $data = I('post.');
            $data['password'] = md5($data['password']);
            $result = D('User')->addData($data);
            if($result){
                $this->success('修改成功',U('admin/AuthRule/adminUserList'));
            }else{
                //echo 'error';
                $this->error('修改失败');
            }
        }else{
            $this->display();
        }
    }
    
    /**
     * 用于改变用户的权限
     */
  
    public function editUserGroup(){
        if(IS_POST){
            $data=I('post.');
            // 组合where数组条件
            $uid=$data['id'];
            $map=array(
                'id'=>$uid
            );
            // 修改权限
            D('AuthGroupAccess')->deleteData(array('uid'=>$uid));
            foreach ($data['group_ids'] as $k => $v){
                $group = array(
                    'uid' => $uid,
                    'group_id' => $v
                );
                D('AuthGroupAccess')->addData($group);
            }
            $this->success('编辑成功',U('Admin/AuthRule/adminUserList'));
        }else{
            $id = I('id');
            // 获取用户数据
            $user_data=M('User')->find($id);
            // 获取已加入用户组
            $group_data=M('AuthGroupAccess')
            ->where(array('uid'=>$id))
            ->getField('group_id',true);
            // 全部用户组
            $data=D('AuthGroup')->select();
            $assign=array(
                'data'=>$data,
                'user_data'=>$user_data,
                'group_data'=>$group_data
            );
            $this->assign($assign);
            $this->display();
        }
        
    }
    
    
    
    
}