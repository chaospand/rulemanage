<?php
namespace Common\Model;

class AuthRuleModel extends BaseModel{
    
    /**
     * 用于当菜单修改时，更新权限菜单
     * @param unknown $data
     * @return boolean
     */
    public function updateRoleByNav($data){
        //开启事务，给auth_role也做更新
        // M()->startTrans();
        $map = array(
            'id' => $data['id']
        );
        $oldData = D('AdminNav')->findData($map);
        $authMap = array(
            'name' => $oldData['mca'],
            'title' => $oldData['name'],
        );
        $authRule =  D('AuthRule')->findData($authMap);
        
        $newAuthRule['name'] = $data['mca'];
        $newAuthRule['title'] = $data['name'];
        // var_dump($newAuthRule);
        if(!empty($authRule)){
            $authMap = array(
                'id' => $authRule['id'],
            );
            //var_dump($authMap);
            $result = D('AuthRule')->editData($authMap,$newAuthRule);
            if($result){
                return true;
            }
        }
        return false;
    }
    
    public function addRoleByNav($data){
        if(empty($data['pid'])){
            
        }else{
            $map = array(
                'id' => $data['pid']
            );
            $nav = D('AdminNav')->findData($map);
            //dump($nav);
            $dataMap = array(
                'name' => $nav['mca']
            );
           // dump($dataMap);
            $auth = D('AuthRule')->findData($dataMap);
            //dump($auth);
            $authData = array(
                'pid' => $auth['id'],
                'name' => $data['mca'],
                'title' => $data['name'],
            );
            //dump($authData);
            $resultOfRule = D('AuthRule')->addData($authData);
        }
       
    }
    
}