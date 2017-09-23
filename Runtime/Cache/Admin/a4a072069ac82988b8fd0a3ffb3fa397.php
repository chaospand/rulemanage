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
  <div class="head-l"><a class="button button-little bg-green" href="<?php echo U('admin/front/calculateReturn');?>" target="_blank"><span class="icon-home"></span> 前台首页</a> &nbsp;&nbsp; &nbsp;&nbsp;<a class="button button-little bg-red" href="<?php echo U('home/index/logout');?>"><span class="icon-power-off"></span> 退出登录</a> </div>
</div>
<div class="leftnav">
  <div class="leftnav-title"><strong><span class="icon-list"></span>菜单列表</strong></div>
  
 <?php if(is_array($nav_data)): foreach($nav_data as $key=>$v): if(empty($v['_data'])): if($v['mca'] == $current[0]['mca']): ?><h2 class="on"><span class="icon-home"></span><a href="<?php echo U($v['mca']);?>"><?php echo ($v['name']); ?></a></h2>
 		<?php else: ?>
 			<h2><span class="icon-home"></span><a href="<?php echo U($v['mca']);?>"><?php echo ($v['name']); ?></a></h2><?php endif; ?>
 	<?php else: ?>
 		<?php if($v['mca'] == $current[0]['mca']): ?><h2 class="on"><span class="icon-home"></span><?php echo ($v['name']); ?></h2>
 			<ul style="display:block;">
 		<?php else: ?>
 			<h2><span class="icon-home"></span><?php echo ($v['name']); ?></h2>
 			<ul><?php endif; ?>
 		<!-- <h2><span class="icon-home" ></span><?php echo ($v['name']); ?></h2> -->
 		
 		<?php if(is_array($v[_data])): foreach($v[_data] as $key=>$item): if($item['mca'] == $current[1]['mca']): ?><li>
 					<a class="on" href="<?php echo U($item['mca']);?>"><span class="icon-caret-right"></span><?php echo ($item['name']); ?></a>
 				</li>	
 			<?php else: ?>
				<li>
 					<a href="<?php echo U($item['mca']);?>"><span class="icon-caret-right"></span><?php echo ($item['name']); ?></a>
 				</li><?php endif; endforeach; endif; ?>
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
	<?php if(is_array($current)): foreach($current as $key=>$item): ?><li>
 				<a href="<?php echo U($item['mca']);?>"><span class=""></span><?php echo ($item['name']); ?></a>
 			</li><?php endforeach; endif; ?>
<!--  <li><a href="<?php echo U('Index/info');?>" target="right" class="icon-home"> 首页</a></li>
   <li><a href="##" id="a_leader_txt">网站信息</a></li>
  <li><?php
 $_typeid = I('id', 0, 'intval'); echo $_typeid; ?></li> -->
 </ul>
<div class="admin">
  
 <div class="panel admin-panel">
  <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>修改业务</strong></div>
  <div class="body-content">
    <form method="post" class="form-x" action="<?php echo U('admin/business/edit');?>">
      <input type="hidden"  value="<?php echo ($data['id']); ?>" name="id" /> 
      <div class="form-group">
        <div class="label">
          <label>业务名称：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" placeholder="请输入业务名称" value="<?php echo ($data['businessname']); ?>" name="businessname" data-validate="required:请输入业务名称" />
          <div class="tips"></div>
        </div>
      </div>
    <div class="form-group">
        <div class="label">
          <label>业务返款比例：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" placeholder="输入返款比例 例如 :40%则输入40,最多两位小数" value="<?php echo ($data['percent']); ?>" name="percent" data-validate="required: 输入返款比例 例如 :40%则输入40" />
          <div class="tips"></div>
        </div>
      </div>
      
	<div class="form-group product-mulde margin-small-top ">
      <div class="label">
          <label>选择该业务的耗材：</label>
        </div>
         <div class="field ">
      	<ul>
      	<li>
      	<?php if(is_array($supplie)): $k = 0; $__LIST__ = $supplie;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 5 );++$k; if(($mod) == "4"): ?></li><li><?php endif; ?>
      	<input type="checkbox" name="supplie_ids[]" <?php if(in_array($vo['id'],$data['sids'])): ?>checked="checked"<?php endif; ?> value="<?php echo ($vo["id"]); ?>"><label><?php echo ($vo["suppliename"]); ?></label><?php endforeach; endif; else: echo "" ;endif; ?>
      	<li>	
      	</ul>
      	</div>
	  </div>


      <div class="form-group">
        <div class="label">
          <label></label>
        </div>
        <div class="field">
          <button class="button bg-main icon-check-square-o" type="submit"> 提交</button>
            <a class="button" href="#" type="button">返回</button>
        </div>
      </div>
    </form>
  </div>
</div>
 
</div>


  <script src="/ruleManage/Public/js/pintuer.js"></script>
<script type="text/javascript" charset="utf-8" src="/ruleManage/Public/js/umeditor/umeditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/ruleManage/Public/js/umeditor/umeditor.min.js"></script>
<script type="text/javascript" charset="utf-8" src="/ruleManage/Public/js/umeditor/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript">
    var umMonth = UM.getEditor('editor-year');
    $('select').select();
 </script>
 
</body>

</html>