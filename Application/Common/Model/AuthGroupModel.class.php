<?php
namespace Common\Model;
use Common\Model\BaseModel;
/**
 * 权限规则model
 */
class AuthGroupModel extends BaseModel{
    
    /**
     * 传递主键删除数据
     *
     */
    public function deleteData($map){
        $result = $this->where($map)->delete();
        $group_map = array(
            'group_id' => $map['id']
        );
        //删除关联表中的组数据
        // 删除关联表中的组数据
       // $result=D('AuthGroupAccess')->deleteData($group_map);
        return $result;
    }
}