<?php
namespace Common\Model;
/**
 * ModelName
 */
class UserModel extends BaseModel{
    protected $_validate = array(
        array('name','require',1,'账号不能为空'),
        array('name','','账号不能重复',1,unique,3),
        array('password','require','密码不能为空'), // 自定义函数验证密码格式
    );
    
    public function getNickName($openid){
        $data = array(
            'openid' => $openid
        );
        $nickName = $this->field('nickname')->where($data)->select();
        if(empty($nickName)){
            return null;
        }else{
            return $nickName;
        }
    }
    
    /**
     * 绑定账号
     * 在查询出账号后绑定账号
     */
    public function updUser($openid,$id){
        $data = array(
            'openid' => $openid,
        );
        
        return $this->where('id=%d',array($id))->save($data);
    }
}