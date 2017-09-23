<?php
/** 
* @author 作者 Chaos
* @version 创建时间：2017年9月16日 下午3:13:21 
*/ 
namespace Common\Model;
use Common\Model\BaseModel;

class SupplieModel extends BaseModel{
    protected $_validate = array(
        array('suppliename','require','耗材名称不能为空'),
        array('price','/^([0-9]*)+(.[0-9]{1,2})?$/','耗材价格必须为数字,最多两位小数','regex'), // 自定义函数验证密码格式
        array('bid','require','业务不能为空'), 
        array('bid','number','业务未选择'), 
    );
}