<?php /*a:1:{s:54:"D:\localhost\auth\application\admin\view\rule\add.html";i:1542250986;}*/ ?>
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
    <label class="layui-form-label">所属上级</label>
    <div class="layui-input-block">
      <select name="pid" lay-verify="required">
        <option value="0">无</option>
        <?php if(is_array($level) || $level instanceof \think\Collection || $level instanceof \think\Paginator): if( count($level)==0 ) : echo "" ;else: foreach($level as $key=>$v): ?>
        	<option value="<?php echo htmlentities($v['id']); ?>"><?php echo htmlentities($v['controller_action_name']); ?></option>
        <?php endforeach; endif; else: echo "" ;endif; ?>
      </select>
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">路径</label>
    <div class="layui-input-block">
      <input type="text" value="" name="controller_action" required  lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">名称</label>
    <div class="layui-input-block">
      <input type="text" value="" name="controller_action_name" required  lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
    </div>
  </div>
 <div class="layui-form-item">
    <label class="layui-form-label">是否显示</label>
    <div class="layui-input-block">
      <input type="checkbox" name="is_show" lay-text="显示|不显示"  lay-skin="switch">
    </div>
  </div>
  <div class="layui-form-item">
    <div class="layui-input-block">
    	<input type="hidden"  value="<?php echo url('Rule/doAdd'); ?>" class="base_url"/>
    	<input type="hidden"  value="<?php echo url('Rule/index'); ?>" class="base_url1"/>
      <button class="layui-btn" lay-submit lay-filter="formAdd">立即提交</button>
    </div>
  </div>
</form>	
	
<script src="/static/layui/layui.js" charset="utf-8"></script>
<script src="/static/js/jquery-2.1.4.min.js"></script>
<script src="/static/js/public.js"></script>
<script src="/static/js/rule.js"></script>
</body>
</html>