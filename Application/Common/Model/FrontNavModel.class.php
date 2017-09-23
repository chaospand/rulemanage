<?php
/** 
* @author 作者 Chaos
* @version 创建时间：2017年9月20日 下午5:31:53 
*/ 
namespace Common\Model;
use Common\Model\BaseModel;
class FrontNavModel extends  BaseModel{
    
    public function getTreeData($type='tree',$order=''){
        
        if(empty($order)){
            $data = $this->select();
        }else{
            $data = $this->select();
        }
        
        // 获取树形或者结构数据  树型不需要过滤，因为那是展示的
        if($type=='tree'){
            $data=\Org\Nx\Data::tree($data,'name','id','pid');
        }elseif($type="level"){
            $data=\Org\Nx\Data::channelLevel($data,0,'&nbsp;','id');
        }
        
        
        return $data;
        
    }
}