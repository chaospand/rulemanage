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
  
 <div class="panel admin-panel">
  <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>查询添加返款</strong></div>
  <div class="body-content">
    <form method="post" id="form1" class="form-x" action="<?php echo U('admin/front/calculateReturn');?>">
      <div class="form-group">
        <div class="label">
          <label>日期：</label>
        </div>
        <div class="field">
        <input type="text" name="createtime" class="input w50 float-left margin-right" id="dateinfo" data-validate="required:请输入时间" />
		<div class="clear"></div>
        <div class="tips"></div>
        </div>
      </div>
    <div class="form-group">
        <div class="label">
          <label>业务名称：</label>
        </div>
        <div class="field">
		  <select name="bid" class="input w50" >
		   <option value="">请选择业务</option>
		   <?php if(is_array($business)): foreach($business as $key=>$b): ?><option value="<?php echo ($b['id']); ?>"><?php echo ($b['businessname']); ?></option><?php endforeach; endif; ?>
            </select>
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>消费金额：</label>
        </div>
        <div class="field">
         <input type="text" class="input w50" placeholder="请输入消费金额" value="" name="comsume" data-validate="required:请输入消费金额" />
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>耗材名称：</label>
        </div>
        <div class="field">
		  <select name="sid" class="input w50">
            <option value="">请选择耗材</option>
             <!--<?php if(is_array($supplie)): foreach($supplie as $key=>$s): ?><option value="<?php echo ($s['id']); ?>"><?php echo ($s['suppliename']); ?></option><?php endforeach; endif; ?> -->
            </select>
          <div class="tips"></div>
        </div>
      </div>


	   <div class="form-group">
        <div class="label">
          <label>耗材数量：</label>
        </div>
        <div class="field">
         <input type="text" class="input w50" placeholder="请输入耗材数量" value="" name="scount" data-validate="required:请输入耗材数量" />
          <div class="tips"></div>
        </div>
      </div>

      <div class="form-group">
        <div class="label">
          <label></label>
        </div>
        <div class="field">
          <input class="button bg-main icon-check-square-o" onclick="postform(event)" type="submit"/>
        </div>
      </div>
    </form>
    
    <div class="form-group">
        <div class="label">
          <label><strong>返现金额：</strong></label>
         <!-- <div id="result">0元</div> -->
          <label ><strong id="result">0元</strong></label>
        </div>
      
      </div>
  </div>
</div>
 
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