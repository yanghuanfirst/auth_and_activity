<?php /*a:1:{s:56:"D:\localhost\auth\application\admin\view\role\index.html";i:1545282613;}*/ ?>
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
 		<a class="layui-btn layui-btn-normal" href="<?php echo url('Role/add'); ?>">添加角色</a>
  </div>
  <table class="layui-hide" id="role_list" lay-filter="test"></table>
<script id="status" type="text/html">
  	{{#
		if(d.status == 1)
		{
			return "启用";
		}else{
			return "禁用";
		}
	}}
</script>
<script type="text/html" id="barDemo">
  <a class="layui-btn layui-btn-xs" lay-event="fenpei">分配规则</a>
  <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
  <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>
<script src="/static/layui/layui.js" charset="utf-8"></script>
<script src="/static/js/jquery-2.1.4.min.js"></script>
<script src="/static/js/public.js"></script>
<script src="/static/js/role.js"></script>
</body>
</html>