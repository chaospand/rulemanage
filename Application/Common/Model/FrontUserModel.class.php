<?php
/** 
* @author 作者 Chaos
* @version 创建时间：2017年9月19日 下午2:19:18 
*/ 
namespace Common\Model;
use Common\Model\BaseModel;
class FrontUserModel extends  BaseModel{
    protected $_validate = array(
        array('frontName','require','名称不能为空'),
        array('frontName','','名称不能重复',0,unique,3),
        array('password','require','密码不能为空'), // 自定义函数验证密码格式
    );
}