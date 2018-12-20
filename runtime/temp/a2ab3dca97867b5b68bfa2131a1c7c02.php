<?php /*a:1:{s:56:"D:\localhost\auth\application\admin\view\admin\edit.html";i:1542005630;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>编辑</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="apple-mobile-web-app-status-bar-style" content="black"> 
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="format-detection" content="telephone=no">
  <link rel="stylesheet" href="/static/layui/css/layui.css"  media="all">
</head>
<body>
<form class="layui-form" action="">
  <div class="layui-form-item">
    <label class="layui-form-label">用户名</label>
    <div class="layui-input-block">
      <input type="text" value="<?php echo htmlentities($info['name']); ?>" name="name" required  lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">密码</label>
    <div class="layui-input-block">
      <input type="password" value="" name="password" required   placeholder="请输入" autocomplete="off" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <div class="layui-input-block">
    	<input type="hidden" value="<?php echo htmlentities($info['id']); ?>" name="id"/>
    	<input type="hidden"  value="<?php echo url('admin/doEdit'); ?>" class="base_url"/>
      <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
    </div>
  </div>
</form>	
	
	
	
<script src="/static/layui/layui.js" charset="utf-8"></script>
<script src="/static/js/jquery-2.1.4.min.js"></script>
<script src="/static/js/admin.js"></script>
</body>
</html>