<?php
namespace Common\Model;
use Think\Model;

class BaseModel extends Model{
	
    /**
     * 添加数据
     * @param  array $data  添加的数据
     * @return int          新增的数据id
     */
    public function addData($data){
        // 去除键值首尾的空格
        foreach ($data as $k => $v) {
            $data[$k]=trim($v);
        }
        $id=$this->add($data);
        return $id;
    }
    
    /**
     * 修改数据
     * @param   array   $map    where语句数组形式
     * @param   array   $data   数据
     * @return  boolean         操作是否成功
     */
    public function editData($map,$data){
        // 去除键值首位空格
        foreach ($data as $k => $v) {
            $data[$k]=trim($v);
        }
        $result=$this->where($map)->save($data);
        return $result;
    }
    
    /**
     * 查找一个数据
     */
    public function findData($map){
        if(empty($map)){
           // die('where 为空的查找操作');
        }
        $data = $this->where($map)->find();
        return $data;
    }
    
    public function deleteData($map){
        //echo 'xx</br>';
        //var_dump($map);
        if(empty($map)){
            die('where 为空的全删操作！');
        }
        $result = $this->where($map)->delete();
        return $result;
    }
    
    public function orderData($data,$id='id',$order='order_number'){
        foreach ($data as $k => $v) {
            $v=empty($v) ? null : $v;
            $this->where(array($id=>$k))->save(array($order=>$v));
        }
        return true;
    }
    
    public function getTreeData($type='tree',$order='',$name='name',$child='id',$parent='pid'){
           //判断是否需要排序
           if(empty($order)){
               $data = $this->select();
           }else{
               $data = $this->order($order.' is null,'.$order)->select();
           }
           if($type=='tree'){
               $data = \Org\Nx\Data::tree($data,$name,$child,$parent);
           }elseif ($type='level'){
               $data = \Org\Nx\Data::channelLevel($data,0,'&nbsp;',$child);
           }
           return $data;
    }
    
}