<?php /*a:1:{s:62:"D:\localhost\auth\application\admin\view\admin_role\index.html";i:1542088078;}*/ ?>
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
</style>
</head>
<body>
  <div class="head-nav">
 		<a class="layui-btn">角色列表</a>
  </div>
  <form action="" class="layui-form">
  	  <div class="layui-form-item">
    <label class="layui-form-label">角色</label>
    <div class="layui-input-block">
    <?php if(is_array($roles) || $roles instanceof \think\Collection || $roles instanceof \think\Paginator): if( count($roles)==0 ) : echo "" ;else: foreach($roles as $key=>$v): if(in_array($v['id'],$is_selected)): ?>
      		<input type="checkbox" name="role_id[]" checked value="<?php echo htmlentities($v['id']); ?>" title="<?php echo htmlentities($v['name']); ?>">
      	<?php else: ?>
      		<input type="checkbox" name="role_id[]" value="<?php echo htmlentities($v['id']); ?>" title="<?php echo htmlentities($v['name']); ?>">
      	<?php endif; ?>
    <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
  </div>
	<div class="layui-form-item">
    <div class="layui-input-block">
    	<input type="hidden" value="<?php echo htmlentities($admin_id); ?>" name="admin_id"/>
    	<input type="hidden"  value="<?php echo url('admin_role/doAdd'); ?>" class="base_url"/>
      <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
    </div>
  </div>
  </form>
  
  
  
  
  
  
  
  
  
  
<script src="/static/layui/layui.js" charset="utf-8"></script>
<script src="/static/js/jquery-2.1.4.min.js"></script>
<script src="/static/js/public.js"></script>
<script src="/static/js/admin_role.js"></script>
</body>
</html>