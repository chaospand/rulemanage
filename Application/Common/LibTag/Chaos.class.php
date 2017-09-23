<?php
/** 
* @author 作者 Chaos: 
* @version 创建时间：2017年9月6日 下午5:35:15 
*/ 

namespace Common\LibTag;
use Think\Template\TagLib;
use Util\Str;
//自定义标签库
class Chaos extends TagLib{

	protected $tags = array(
	'sitetitle' => array('close' => 0),
    'position'        => array(
        'attr'  => 'typeid,ismobile,sname,surl,delimiter',
        'close' => 0,
    ),
	'test' => array('close' => 0),
	);
	
	public function _test($attr,$content){
	    return 'test';
	}
	
	public function _sitetitle($attr,$content){
		return C('CFG_WEBTITLE');
	}

	public function _position($attr, $content){
	    $str = <<<str
<?php
        \$_typeid = I('id', 0, 'intval');
		echo \$_typeid;	
?>
str;
	    return $str;
	}
	
}