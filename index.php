<?php

// Ӧ������ļ�
// ����Ƿ����°�װ
 if(file_exists("./Public/install") && !file_exists("./Public/install/install.lock")){
  //  ��װ��װurl
    $url=$_SERVER['HTTP_HOST'].trim($_SERVER['SCRIPT_NAME'],'index.php').'Public/install/index.php';
      // ʹ��http://������ʽ���ʣ�����./Public/install ·����ʽ�ļ����Ժ�������������
     header("Location:http://$url");
     die;
 }
// ���PHP����
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

// ��������ģʽ ���鿪���׶ο��� ����׶�ע�ͻ�����Ϊfalse
define('APP_DEBUG',true);

// ����Ӧ��Ŀ¼
define('APP_PATH','./Application/');

/**
 * ����Ŀ¼����
 * ��Ŀ¼�����д�������ƶ�����WEBĿ¼
 */
define('RUNTIME_PATH','./Runtime/');

// ����oss��url
define("OSS_URL","");

//define('BIND_MODULE','Home');

// ����ģ���ļ�Ĭ��Ŀ¼
define("TMPL_PATH","./tpl/");


// ����ThinkPHP����ļ�
require './ThinkPHP/ThinkPHP.php';