<?php
/** 
* @author 作者 Chaos
* @version 创建时间：2017年9月15日 下午4:47:19 
*/ 
namespace Common\Model;
use Common\Model\BaseModel;

class BusinessModel extends BaseModel{
    protected $_validate = array(    
        array('businessname','require','业务名称不能为空'), 
        array('businessname','','业务名称不能重复',0,unique,3), 
        array('percent','/^([0-9]*)+(.[0-9]{1,2})?$/','业务返款比例必须为数字(例如:40%则输入40)','regex'), // 自定义函数验证密码格式  
       
    );
}