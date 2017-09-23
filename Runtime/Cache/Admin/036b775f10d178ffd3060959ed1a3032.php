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
    <h1><img src="/ruleManage/Public/images/y.jpg" class="radius-circle rotate-hover" height="50" alt="" />前台计算中心</h1>
  </div>
  <div class="head-l"> &nbsp;&nbsp; &nbsp;&nbsp;<a class="button button-little bg-red" href="<?php echo U('home/index/frontLogout');?>"><span class="icon-power-off"></span> 退出登录</a> </div>
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
</script>
<div class="admin">
  
<form  method="get" action="/ruleManage/index.php/Admin/Front/index">
  <div class="panel admin-panel">
    <div class="panel-head"><strong class="icon-reorder"> 前台数据列表</strong> <a href="" style="float:right; display:none;">添加字段</a></div>
 <div class="padding border-bottom">
      <ul class="search" style="padding-left:10px;">
        <!-- <li> <a class="button border-main icon-plus-square-o" href="/ruleManage/index.php/Admin/Front/add"> 添加前台用户</a> </li> -->
        <!-- <li>搜索：</li>
		
		<li>
          <input type="text" placeholder="请输入搜索关键字" value="<?php echo ($keywords); ?>" name="keywords" class="input" style="width:250px; line-height:17px;display:inline-block" />
          <button class="button border-main icon-search" type="submit">查询</button></li> -->
          <!-- <a href="javascript:void(0)" class="button border-main icon-search" onclick="changesearch()" > 搜索</a></li> -->
      </ul>
    </div>
    <table class="table table-hover text-center">
      <tr>
      	<th>提交时间</th>
        <th>业务名称</th>
        <th>业务分成比例</th>
        <th>耗材名称</th>
        <th>耗材成本(元)</th>
        <th>耗材数量(元)</th>
        <th>消费金额(元)</th>
        <th>分成金额(元)</th>
        <th width="310">操作</th>
      </tr>
      <?php if(is_array($list)): foreach($list as $key=>$v): ?><tr>
      	 <td><?php echo ($v['createtime']); ?></td>
	        <td><?php echo ($v['businessname']); ?></td>
	        <td><?php echo ($v['percent']); ?>%</td>
	        <td><?php echo ($v['suppliename']); ?></td>
	        <td><?php echo ($v['price']); ?></td>
	        <td><?php echo ($v['scount']); ?></td>
	         <td><?php echo ($v['comsume']); ?></td>
	        <td><?php echo ($v['returncash']); ?></td>
	         <td><div class="button-group">
	          <a class="button border-main" href="<?php echo U('edit',array('id'=>$v['id']));?>"><span class="icon-edit"></span> 修改</a>
	         <a class="button border-red" href="javascript:if(confirm('确定删除？'))location='<?php echo U('delete',array('id' => $v['id']));?>'"><span class="icon-trash-o"></span> 删除</a></div></td>
	    </tr><?php endforeach; endif; ?>
  		<tr>
       	 <td colspan="8"><?php echo ($page); ?></td>
      	</tr>
   
    </table>
  </div>
</form>
 
</div>


  <script src="/ruleManage/Public/js/pintuer.js"></script>
<script type="text/javascript" charset="utf-8" src="/ruleManage/Public/js/umeditor/umeditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/ruleManage/Public/js/umeditor/umeditor.min.js"></script>
<script type="text/javascript" charset="utf-8" src="/ruleManage/Public/js/umeditor/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript" src="/ruleManage/Public/jeDate/jedate.js"></script>
<script type="text/javascript" charset="utf-8" src="/ruleManage/Public/js/jquery.form.js"></script>
<script type="text/javascript">
    var umMonth = UM.getEditor('editor-year');
    $('select').select();
    jeDate({
		dateCell:"#dateinfo",
		format:"YYYY-MM-DD hh:mm:ss",
		isinitVal:true,
		isTime:true, //isClear:false,
		minDate:"2017-01-08 00:00:00",
	})
	
 	 $("select[name='bid']").change(function() {  
		 
		 let bid = $(this).val();
		 console.log(" var selected_value = $(this).val():"+ bid);
		 let data= {'bid':bid};
		 if(bid!=""){
			 $.ajax({
				  type: 'get',
				  url: '/ruleManage/index.php/home/index/getSuppliesBybid',
				  data: data,
				  success: function(data){
					  console.log(data);
					  if(data instanceof Array && data.length!=0){
						  console.log("in add");
						  $("select[name='sid']").empty();
						  for(let i=0;i<data.length;i++){
							  $("select[name='sid']").append("<option value='"+data[i]['id']+"'>"+data[i]['suppliename']+"</option>"); 
						  }  
					  }else{
						  $("select[name='sid']").empty();
						  $("select[name='sid']").append("<option value=''>该业务没有耗材可选</option>"); 
					  }
					  
					  
				  }
				});
		 }
		
	 });
	 
/* 	 function getSupplie(option){
		 console.log(" var selected_value = $(this).val():"+ option.val()  );
	 } */
	
  	function postform(event){
    	event.preventDefault();
        $("#form1").ajaxSubmit(function(result){	
        	console.log(result);
        	if(result.state != undefined){
        		if(result.state){
            		$("#result").html(result.message+"元		数据已添加到后台");
            		
            	}else{
            		$("#result").html(result.message);
            	}
        	}else{
        		$("#result").html(result.info);
        	}
        	
        });
        
    }
	
	
 </script>
 
</body>

</html>