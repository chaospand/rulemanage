<?php
namespace Common\Model;
use Common\Model\BaseModel;
/**
 * 权限规则model
 */
class AuthGroupAccessModel extends BaseModel{
    
    public function getUidsByGroupId($group_id){
        $user_ids = $this
        ->where(array('group_id' => $group_id))
        ->getField('uid',true);
        return $user_ids;
    }
    
    /**
     * 获取管理员权限列表
     */
    public function getAllData(){
        $data = $this
            ->field('u.id,u.name,aga.group_id,ag.title')
            ->alias('aga')
            ->join('__USER__ u ON aga.uid = u.id','RIGHT')
            ->join('__AUTH_GROUP__ ag ON aga.group_id = ag.id','LEFT')
            ->select();
       $first = $data[0];
       $first['title'] = array();
       $user_data[$first['id']] = $first;
       
       foreach ($data as $k => $v){
           foreach ($user_data as $m => $n){
               $uids = array_map(function($a){return $a['id'];}, $user_data);
               if(!in_array($v['id'], $uids)){
                   $v['title'] = array();
                   $user_data[$v['id']] = $v;
               }
           }
       }
       foreach ($user_data as $k => $v){
           foreach ($data as $m =>$n){
               if($n['id'] == $k){
                   $user_data[$k]['title'][] = $n['title'];
               }
           }
           $user_data[$k]['title'] = implode('、',$user_data[$k]['title']);
       }
       return $user_data;
    }
}