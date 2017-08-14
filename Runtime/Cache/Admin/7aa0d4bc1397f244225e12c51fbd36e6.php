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
  
<h1 class="text-center">为<span style="color:red"><?php echo ($group_data['title']); ?></span>分配权限</h1>
<form class="" action="<?php echo U('Admin/AuthRule/ruleGroup');?>" method="post">

     <table class="table table-border table-bordered table-bg table-hover table-sort" id="sample-table">
     <input type="hidden" name="id" value="<?php echo ($group_data['id']); ?>">
	  <?php if(is_array($rule_data)): foreach($rule_data as $key=>$v): if(empty($v['_data'])): ?><tr class="b-group">
	  			<th  width="10%">
	  				<label>
	  					<?php echo ($v['title']); ?>
	  					<input type="checkbox" name="rule_ids[]" value="<?php echo ($v['id']); ?>" <?php if(in_array($v['id'],$group_data['rules'])): ?>checked="checked"<?php endif; ?> onclick="checkAll(this)">
	  				</label>
	  			</th>
	  			<td></td>
	  		</tr>
	  	<?php else: ?>
	  		<tr class="b-group">
	  			<th>
	  				<label>
	  					<?php echo ($v['title']); ?>
	  					<input type="checkbox" name="rule_ids[]" value="<?php echo ($v['id']); ?>" <?php if(in_array($v['id'],$group_data['rules'])): ?>checked="checked"<?php endif; ?> onclick="checkAll(this)">
	  				</label>
	  			</th>
	  			<td>
	  				<?php if(is_array($v['_data'])): foreach($v['_data'] as $key=>$n): ?><table class="table table-striped table-bordered table-hover table-condensed">
	  						<tr  class="b-group">
	  							<th width="20%">
	  								<label>
	  									<?php echo ($n['title']); ?>  	<input type="checkbox" name="rule_ids[]" value="<?php echo ($n['id']); ?>" <?php if(in_array($n['id'],$group_data['rules'])): ?>checked="checked"<?php endif; ?> onclick="checkAll(this)">
	  								</label>
	  							</th>
	  							<td>
								<?php if(!empty($n['_data'])): if(is_array($n['_data'])): $i = 0; $__LIST__ = $n['_data'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$c): $mod = ($i % 2 );++$i;?><label>
											&emsp;<?php echo ($c['title']); ?> <input type="checkbox" name="rule_ids[]" value="<?php echo ($c['id']); ?>" <?php if(in_array($c['id'],$group_data['rules'])): ?>checked="checked"<?php endif; ?> >
										</label><?php endforeach; endif; else: echo "" ;endif; endif; ?>
								</td>
	  						</tr>
	  					</table><?php endforeach; endif; ?>
	  			</td>
	  		</tr><?php endif; endforeach; endif; ?>
	  <tr>
		<th></th>
		<td>
			<input class="btn btn-success" type="submit" value="提交">
		</td>
	</tr>
  </table>
  </form>
 
</div>


	<script>
	function checkAll(obj){
		$(obj).parents('.b-group').eq(0).find("input[type='checkbox']").prop('checked',$(obj).prop('checked'));
	}
	</script>

</body>

</html>