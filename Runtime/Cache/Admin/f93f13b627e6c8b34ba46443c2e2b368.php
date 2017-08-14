<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title>  </title>  
    <link rel="stylesheet" href="/ruleManage/Public/css/pintuer.css">
    <link rel="stylesheet" href="/ruleManage/Public/css/admin.css">
    <script src="/ruleManage/Public/js/jquery.js"></script>   
</head>
<body style="background-color:#f2f9fd;">
<div class="header bg-main">
  <div class="logo margin-big-left fadein-top">
    <h1><img src="/ruleManage/Public/images/y.jpg" class="radius-circle rotate-hover" height="50" alt="" />后台管理中心</h1>
  </div>
  <div class="head-l"><a class="button button-little bg-green" href="" target="_blank"><span class="icon-home"></span> 前台首页</a> &nbsp;&nbsp; &nbsp;&nbsp;<a class="button button-little bg-red" href="<?php echo U('home/index/logout');?>"><span class="icon-power-off"></span> 退出登录</a> </div>
</div>
<div class="leftnav">
  <div class="leftnav-title"><strong><span class="icon-list"></span>菜单列表</strong></div>
  
 <?php if(is_array($nav_data)): foreach($nav_data as $key=>$v): if(empty($v['_data'])): ?><h2 class="on"><span class="icon-home"></span><a href="{U($v['mca'])}"><?php echo ($v['name']); ?></a></h2>
 	<?php else: ?>
 		<h2><span class="icon-home"></span><?php echo ($v['name']); ?></h2>
 		<ul>
 		<?php if(is_array($v[_data])): foreach($v[_data] as $key=>$item): ?><li>
 				<a href="<?php echo U($item['mca']);?>"><span class="icon-caret-right"></span><?php echo ($item['name']); ?></a>
 			</li><?php endforeach; endif; ?>
 		</ul><?php endif; endforeach; endif; ?>
</div>
<script type="text/javascript">
$(function(){
  $(".leftnav h2").click(function(){
	  $(this).next().slideToggle(200);	
	  $(this).toggleClass("on"); 
  })
  $(".leftnav ul li a").click(function(){
	    $("#a_leader_txt").text($(this).text());
  		$(".leftnav ul li a").removeClass("on");
		$(this).addClass("on");
  })
 $(".leftnav").children("ul:last-child").css("padding-bottom","100px");
});
</script>
<ul class="bread">
  <li><a href="<?php echo U('Index/info');?>" target="right" class="icon-home"> 首页</a></li>
  <li><a href="##" id="a_leader_txt">网站信息</a></li>
<div class="admin">
  
   
       
           <table class="table table-striped table-bordered table-hover table-condensed">
               <tr>
                   <th width="10%">用户名</th>
                   <th>用户组</th>
                   <th>操作</th>
               </tr>
               <?php if(is_array($data)): foreach($data as $key=>$v): ?><tr>
                       <td><?php echo ($v['name']); ?></td>
                       <td><?php echo ($v['title']); ?></td>
                       <td>
                           <a href="<?php echo U('Admin/authRule/editUser',array('id'=>$v['id']));?>">修改资料</a>
                           <a href="<?php echo U('Admin/authRule/editUserGroup',array('id'=>$v['id']));?>">修改用户组</a>
                       </td>
                   </tr><?php endforeach; endif; ?>
           </table>

</div>


</body>

</html>