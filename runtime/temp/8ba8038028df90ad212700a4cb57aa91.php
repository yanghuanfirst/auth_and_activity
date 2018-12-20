<?php /*a:1:{s:58:"D:\localhost\auth\application\admin\view\huodong\edit.html";i:1545011684;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>添加活动</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="apple-mobile-web-app-status-bar-style" content="black"> 
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="format-detection" content="telephone=no">
  <link rel="stylesheet" href="/static/layui/css/layui.css"  media="all">
  <link rel="stylesheet" href="/static/kindeditor/themes/default/default.css?t=20120318.css" />
<link rel="stylesheet" href="/static/kindeditor/themes/simple/simple.css" />
</head>
<body>
<form class="layui-form" action="">
  <div class="layui-form-item">
    <label class="layui-form-label">活动名</label>
    <div class="layui-input-block">
      <input type="text" value="<?php echo htmlentities($info['activity_name']); ?>" name="activity_name" required  lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">logo</label>
    <div class="layui-input-block">
			<button type="button" class="layui-btn" id="logo-img-id">
			  <i class="layui-icon">&#xe67c;</i>上传图片
			</button>
			<input type="hidden" name="activity_logo" value="<?php echo htmlentities($info['activity_logo']); ?>"/>
    </div>
    <label class="layui-form-label"></label>
    <div class="logo-img">
    	<img src="__UPLOAD__/<?php echo htmlentities($info['activity_logo']); ?>" style="width:100px;height:100px"/>
    </div>
  </div>
  	<div class="layui-form-item">
	    <label class="layui-form-label">开始时间</label>
	    <div class="layui-input-block">
	      <input type="text" value="<?php echo date('Y-m-d H:i:s',$info['start_time']); ?>" name="start_time" id="start_time" required  lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
	    </div>
	  </div>
	    <div class="layui-form-item">
	    <label class="layui-form-label">结束时间</label>
	    <div class="layui-input-block">
	      <input type="text" value="<?php echo date('Y-m-d H:i:s',$info['end_time']); ?>" name="end_time" id="end_time" required  lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
	    </div>
	  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">状态</label>
    <div class="layui-input-block">
       <input type="radio" name="status" value="2" title="启用" <?php if($info['status'] == '2'): ?>checked<?php endif; ?>>
       <input type="radio" name="status" value="1" title="禁用" <?php if($info['status'] == '1'): ?>checked<?php endif; ?>>
    </div>
  </div>
  <div class="layui-form-item layui-form-text">
    <label class="layui-form-label">描述</label>
    <div class="layui-input-block">
      <textarea name="desc" id="desc" style="width:700px;height:280px;" placeholder="请输入内容" class="layui-textarea"><?php echo htmlentities($info['desc']); ?></textarea>
    </div>
  </div>
  <div class="layui-form-item">
    <div class="layui-input-block">
    	<input type="hidden" value="<?php echo htmlentities($info['id']); ?>" name="id"/>
      <button class="layui-btn" lay-submit lay-filter="formEdit">立即提交</button>
    </div>
  </div>
</form>	
	
	
	
<script src="/static/layui/layui.js" charset="utf-8"></script>
<script src="/static/index/js/jquery-2.1.4.min.js"></script>
<script src="/static/admin/js/public.js"></script>
<script src="/static/admin/js/huodong.js"></script>
<script charset="utf-8" src="/static/kindeditor/kindeditor-all-min.js"></script>
<script charset="utf-8" src="/static/kindeditor/lang/zh-CN.js"></script>
<script>
	KindEditor.ready(function(K) {
	        window.editor = K.create('#desc',{
	        	items:[
	        	        'source', '|', 'undo', 'redo', '|', 'preview', 'print', 'template', 'cut', 'copy', 'paste',
	        	        'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
	        	        'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
	        	        'superscript', 'clearhtml', 'quickformat', 'selectall', '|', 'fullscreen', '/',
	        	        'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
	        	        'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'multiimage',
	        	          'insertfile', 'table', 'hr', 'emoticons', 'baidumap', 'pagebreak',
	        	        'anchor', 'link', 'unlink', '|'
	        	],
	        	imageSizeLimit:'3M',
	        	imageUploadLimit:5,
	        	allowImageRemote:false,
	        	filePostName:"desc_img",
	        	uploadJson : '/admin/Item/uploadImg',
                allowFileManager : true
	        });
	});
</script>
</body>
</html>