<?php
namespace Think\Template\TagLib;

use Think\Template\TagLib;

/**
 * CX��ǩ�������
 */
class Code	 extends TagLib
{
protected $tags   =  array(  // �����ǩ 
'code'    =>    array('attr'=>'width,height,class,name,url,id','close'=>0), // input��ǩ 
);
public function _code($tag)   {  
	$width = $tag['width'];
	$height = $tag['height'];
	$class = $tag['class'];
	$name   =   C('VERIFY_CODE');  
	$url = 	C('VERIFY_URL');
	$id    =    $tag['id'];    
$str = '<img src="'+$url+'" />';  
 
var_dump($str);
return $str;
}

}

