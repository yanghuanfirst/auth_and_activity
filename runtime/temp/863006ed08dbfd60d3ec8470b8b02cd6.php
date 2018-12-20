<?php /*a:1:{s:57:"D:\localhost\auth\application\admin\view\index\index.html";i:1545281602;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>后台布局demo </title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="apple-mobile-web-app-status-bar-style" content="black"> 
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="format-detection" content="telephone=no">
  
  <link rel="stylesheet" href="/static/layui/css/layui.css"  media="all">
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
  <div class="layui-header">
    <div class="layui-logo">layui 后台布局</div>
    <!-- 头部区域（可配合layui已有的水平导航） -->
    <ul class="layui-nav layui-layout-left header">
    <?php if(is_array($left_nav) || $left_nav instanceof \think\Collection || $left_nav instanceof \think\Paginator): if( count($left_nav)==0 ) : echo "" ;else: foreach($left_nav as $key=>$v): if($v['is_show'] == '1'): ?>
      <li class="layui-nav-item"><a href="javascript:;"><?php echo htmlentities($v['controller_action_name']); ?></a></li>
    <?php endif; ?>
    <?php endforeach; endif; else: echo "" ;endif; ?>
<!--       <li class="layui-nav-item"> -->
<!--         <a href="javascript:;">其它系统</a> -->
<!--         <dl class="layui-nav-child"> -->
<!--           <dd><a href="">邮件管理</a></dd> -->
<!--           <dd><a href="">消息管理</a></dd> -->
<!--           <dd><a href="">授权管理</a></dd> -->
<!--         </dl> -->
<!--       </li> -->
    </ul>
    <ul class="layui-nav layui-layout-right">
      <li class="layui-nav-item">
        <a href="javascript:;">
          <img src="//tva1.sinaimg.cn/crop.0.0.118.118.180/5db11ff4gw1e77d3nqrv8j203b03cweg.jpg" class="layui-nav-img">
          贤心
        </a>
        <dl class="layui-nav-child">
          <dd><a href="">基本资料</a></dd>
        </dl>
      </li>
      <li class="layui-nav-item"><a href="<?php echo url('login/logout'); ?>">退了</a></li>
    </ul>
  </div>
  
  <div class="layui-side layui-bg-black">
    <div class="layui-side-scroll change_left_nav">
      <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
      	<?php if(is_array($left_nav) || $left_nav instanceof \think\Collection || $left_nav instanceof \think\Paginator): if( count($left_nav)==0 ) : echo "" ;else: foreach($left_nav as $sk=>$sv): ?>
      <ul class="layui-nav layui-nav-tree"  lay-filter="test" <?php if($sk == '0'): ?>style="display:block;"<?php else: ?>style="display:none;"<?php endif; ?>>
      <?php if(is_array($sv['son']) || $sv['son'] instanceof \think\Collection || $sv['son'] instanceof \think\Paginator): if( count($sv['son'])==0 ) : echo "" ;else: foreach($sv['son'] as $key=>$v): if($v['is_show'] == '1'): ?>
        <li class="layui-nav-item layui-nav-itemed">
          <a class="" href="javascript:;"><?php echo htmlentities($v['controller_action_name']); ?></a>
          <dl class="layui-nav-child">
          <?php if(is_array($v['son']) || $v['son'] instanceof \think\Collection || $v['son'] instanceof \think\Paginator): if( count($v['son'])==0 ) : echo "" ;else: foreach($v['son'] as $key=>$vv): if($vv['is_show'] == '1'): ?>
            <dd data-name="test">
            	<a href="<?php echo url(str_replace('-','/',$vv['controller_action'])); ?>" target="iframe_content"><?php echo htmlentities($vv['controller_action_name']); ?></a>
            </dd>
           <?php endif; ?>
          <?php endforeach; endif; else: echo "" ;endif; ?>
          </dl>
        </li>
        <?php endif; ?>
        <?php endforeach; endif; else: echo "" ;endif; ?>
      </ul>
      <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
  </div>
  
  <div class="layui-body">
		<iframe src="<?php echo url('index/blank'); ?>" name="iframe_content" frameborder="0" id="demoAdmin"  style="width: 100%; height: 100%;"></iframe>
  </div>
  
  <div class="layui-footer">
    <!-- 底部固定区域 -->
    © layui.com - 底部固定区域
  </div>
</div>
<script src="/static/layui/layui.js" charset="utf-8"></script>
<script src="/static/js/jquery-2.1.4.min.js"></script>
<script>
//JavaScript代码区域
layui.use('element', function(){
  var element = layui.element;
});
$('.header .layui-nav-item').on('click',function(){
	console.log($(this).index());
	$('.change_left_nav ul').eq($(this).index()).show();
	$('.change_left_nav ul').eq($(this).index()).siblings().hide();
	
})
</script>

</body>
</html>
