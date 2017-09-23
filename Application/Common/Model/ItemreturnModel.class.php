<?php
namespace Common\Model;
use Common\Model\BaseModel;

/** 
* @author 作者 Chaos
* @version 创建时间：2017年9月16日 下午4:33:24 
*/ 
class ItemreturnModel extends BaseModel{
    protected $_validate = array(
        array('createtime','require','请选择时间'),
        array('bid','number','请选择业务名称'),
        array('comsume','/^([0-9]*)+(.[0-9]{1,2})?$/','消费金额为最多两位小数的数字','regex'),
        array('sid','number','请选择耗材名称'),
        array('scount','number','请输入耗材数量'),
    );
    
    public function countData($condition){
       
        $map = $this->getLikeCondition($condition);
       
        $data = $this
        ->where($map)
        ->field('aga.id')
        ->alias('aga')
        ->join('__BUSINESS__ b ON b.id = bid','LEFT')
        ->join('__FRONT_USER__ u ON u.id = uid','LEFT')
        ->join('__SUPPLIE__ s ON s.id = sid','LEFT')
        ->count();
        return $data;
    }
    
    public function getData($start,$limit,$condition){
        $map = $this->getLikeCondition($condition);
        $data = $this
        ->where($map)
        ->field('aga.id,b.businessname,b.percent,u.front_name,s.suppliename,s.price,aga.comsume,aga.returncash,aga.createtime,aga.scount')
        ->alias('aga')
        ->join('__BUSINESS__ b ON b.id = bid','LEFT')
        ->join('__FRONT_USER__ u ON u.id = uid','LEFT')
        ->join('__SUPPLIE__ s ON s.id = sid','LEFT')
        ->limit($start,$limit)
        ->select();
        return $data;
    }
    
    private function getLikeCondition($condition,$field="keywords"){
        $keywords = $condition[$field];
        if(!empty($keywords)){
            $condition['b.businessname'] = array(
                'like','%'.$keywords.'%'
            );
            $condition['u.front_name'] = array(
                'like','%'.$keywords.'%'
            );
            $condition['s.suppliename'] = array(
                'like','%'.$keywords.'%'
            );
            $condition['_logic'] = 'OR';
        }
        unset($condition[$field]);
        return $condition;
        
    }
    
    public function getPersonData($start,$limit,$condition){
        $data = $this
        ->where($condition)
        ->field('aga.id,b.businessname,b.percent,u.front_name,s.suppliename,s.price,aga.comsume,aga.returncash,aga.createtime,aga.scount')
        ->alias('aga')
        ->join('__BUSINESS__ b ON b.id = bid','LEFT')
        ->join('__FRONT_USER__ u ON u.id = uid','LEFT')
        ->join('__SUPPLIE__ s ON s.id = sid','LEFT')
        ->limit($start,$limit)
        ->select();
        return $data;
    }
}