<?php
namespace Common\Model;
use Common\Model\BaseModel;
use Think\Auth;
/**
 * ModelName
 */
class AdminNavModel extends BaseModel{
    
    public function getTreeData($type='tree',$order=''){
        
        if(empty($order)){
            $data = $this->select();
        }else{
            $data = $this->order('order_number is null,'.$order)->select();
        }
            
        // 获取树形或者结构数据  树型不需要过滤，因为那是展示的
        if($type=='tree'){
            $data=\Org\Nx\Data::tree($data,'name','id','pid');
        }elseif($type="level"){
            $data=\Org\Nx\Data::channelLevel($data,0,'&nbsp;','id');
            foreach ($data as $k => $v){
                $auth = new Auth();
                if($auth->check($v['mca'],$_SESSION['user']['id'])){
                    foreach ($v['_data'] as $m => $n){
                        if(!$auth->check($n['mca'],$_SESSION['user']['id'])){
                            unset($data[$k]['_data'][$m]);
                        }
                    }
                }else{
                    unset($data[$k]);
                }
            }
        }
        
       
        return $data;
        
    }
    
    public function getParentChannel($action){
        $map = array(
            'mca' => $action,
        );
        $url = $this->where($map)->find();
        //dump($url);
        //dump($url['id']);
        $data = $this->select();
        //dump($data);
        $arr=$this->getParent($data,$url['id']);
     
        return $arr; 
    }
    
    public function getParent($data,$id){
        //dump($id);
        if (empty($data)) {
            return $data;
        }
        $arr = array();
        foreach($data as $v){
            //dump($v['id']);
            if($v['id']==$id){
                $arr[] = $v;
                $_n = self::getParent($data,$v['pid']);
                if (!empty($_n)) {
                    $arr = array_merge($arr, $_n);
                }
            }
        }
        $arrOrder = array();
       
        return array_reverse($arr);
    }
    
}