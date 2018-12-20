<?php /*a:1:{s:57:"D:\localhost\auth\application\admin\view\admin\index.html";i:1542088067;}*/ ?>
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
 		<a class="layui-btn">用户列表</a>
 		<a class="layui-btn layui-btn-normal" href="<?php echo url('Admin/add'); ?>">添加用户</a>
  </div>
  <table class="layui-hide" id="role_list" lay-filter="test"></table>
<script type="text/html" id="barDemo">
  <a class="layui-btn layui-btn-xs" lay-event="fenpei">分配角色</a>
  <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
  <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>
<script src="/static/layui/layui.js" charset="utf-8"></script>
<script src="/static/js/jquery-2.1.4.min.js"></script>
<script src="/static/js/public.js"></script>
<script src="/static/js/admin.js"></script>
</body>
</html>