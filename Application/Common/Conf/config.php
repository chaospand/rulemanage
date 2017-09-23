<?php
return array(
	//'配置项'=>'配置值'
	'LOAD_EXT_CONFIG'=>'db',
    
	//加载自定义标签
    'TAGLIB_PRE_LOAD'=>'Common\LibTag\Chaos',//预加载的tag
    
    'DEFAULT_MODULE'       =>    'admin',  // 默认模块
    'DEFAULT_CONTROLLER'    =>  'front', // 默认控制器名称
    'DEFAULT_ACTION'        =>  'calculateReturn', // 默认操作名称
    'SHOW_PAGE_TRACE' =>true, 
    'URL_HTML_SUFFIX'        => '',  // URL伪静态后缀设置
    'TRACE_PAGE_TABS'=>array(    'base'=>'基本',     'file'=>'文件',     'think'=>'流程',     'error'=>'错误',     'sql'=>'SQL',     'debug'=>'调试'),
    'WXAPPID' => 'wxadc0ce7cac4d8ab0',
    'WXSECRET' => '725fc40d8ce334aa40e25bfa024bfcf3',
    
);