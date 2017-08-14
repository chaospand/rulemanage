<?php
namespace Think\Template\TagLib;

use Think\Template\TagLib;

/**
 * CX标签库解析类
 */
class Code	 extends TagLib
{
protected $tags   =  array(  // 定义标签 
'code'    =>    array('attr'=>'width,height,class,name,url,id','close'=>0), // input标签 
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

