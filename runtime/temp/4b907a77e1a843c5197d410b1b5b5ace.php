<?php /*a:1:{s:57:"D:\localhost\auth\application\admin\view\role\fenpei.html";i:1545294026;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>layout 后台大布局 - Layui</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="apple-mobile-web-app-status-bar-style" content="black"> 
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="format-detection" content="telephone=no">
  <link rel="stylesheet" href="/static/layui/css/layui.css"  media="all">
  <style>
	.head-nav{
		margin-top:20px;
		margin-left:20px;
	}
	.margin20{
		margin-top:20px;
	}
	.layui-form{
		margin-left:20px;
	}
	.layui-input-blocks{
	    height: 40px;
	    line-height: 40px;
	    font-size: 18px;
	}
	.layui-input-blocks input{
		width: 20px;
	    height: 40px;
	    vertical-align: top;
	}
	.layui-form .layui-input-blocks:nth-child(2),.layui-form .layui-input-blocks:nth-child(3){
		margin-left:20px;
	}
</style>
</head>
<body>
  <div class="head-nav">
 		<a class="layui-btn" href="<?php echo url('Role/index'); ?>">角色列表</a>
 		<a class="layui-btn layui-btn-normal" href="<?php echo url('Role/add'); ?>">添加角色</a>
  </div>
  <div class="margin20">
  	<form class="layui-form" action="">
  	<?php if(is_array($rules) || $rules instanceof \think\Collection || $rules instanceof \think\Paginator): if( count($rules)==0 ) : echo "" ;else: foreach($rules as $kk=>$v): ?>
		  <div class="layui-form-items">
		  <?php if($v['pid'] == 0): ?>
		    <div class="layui-input-blocks">
		    	<input type="checkbox"  title="<?php echo htmlentities($v['controller_action_name']); ?>" value="<?php echo htmlentities($v['id']); ?>" class="role_id_c_<?php echo htmlentities($kk); ?>" name="rule_id[]" lay-filter="head_box" title="" lay-skin="primary" <?php if(in_array($v['id'],$allow_rules)): ?>checked<?php endif; ?>> 
		    </div>
		  <?php endif; if(is_array($v['son']) || $v['son'] instanceof \think\Collection || $v['son'] instanceof \think\Paginator): if( count($v['son'])==0 ) : echo "" ;else: foreach($v['son'] as $key=>$vv): ?>
		    <div class="layui-input-blocks">
		      <input type="checkbox" title="<?php echo htmlentities($vv['controller_action_name']); ?>" value="<?php echo htmlentities($vv['id']); ?>" k_index="<?php echo htmlentities($kk); ?>" class="role_id_c" name="rule_id[]"   title="" lay-skin="primary" <?php if(in_array($vv['id'],$allow_rules)): ?>checked<?php endif; ?>> 
		    </div>
		     <div class="layui-input-blocks">
		     <?php if(is_array($vv['son']) || $vv['son'] instanceof \think\Collection || $vv['son'] instanceof \think\Paginator): if( count($vv['son'])==0 ) : echo "" ;else: foreach($vv['son'] as $key=>$vvv): ?>
		      	<input type="checkbox" title="<?php echo htmlentities($vvv['controller_action_name']); ?>" value="<?php echo htmlentities($vvv['id']); ?>" name="rule_id[]" k_index="<?php echo htmlentities($kk); ?>"  class="rule_id_c"  title="" lay-skin="primary" <?php if(in_array($vvv['id'],$allow_rules)): ?>checked<?php endif; ?>> 
		     <?php endforeach; endif; else: echo "" ;endif; ?>
		    </div>
		  <?php endforeach; endif; else: echo "" ;endif; ?>
		  </div>
	<?php endforeach; endif; else: echo "" ;endif; ?>
	<div class="layui-form-items" style="margin-top:60px">
    <div class="layui-input-block">
    	<input type="hidden"  value="<?php echo url('Role/doFenpei'); ?>" class="base_url"/>
    	<input type="hidden"  value="<?php echo url('Role/index'); ?>" class="base_url1"/>
    	<input type="hidden"  value="<?php echo htmlentities($role_id); ?>" name="r_role_id"/>
      <button class="layui-btn" lay-submit lay-filter="formFen">立即提交</button>
    </div>
  </div>
	</form>
 </div>
  
<script src="/static/layui/layui.js" charset="utf-8"></script>
<script src="/static/js/jquery-2.1.4.min.js"></script>
<script src="/static/js/public.js"></script>
<script src="/static/js/role.js"></script>
</body>
</html>