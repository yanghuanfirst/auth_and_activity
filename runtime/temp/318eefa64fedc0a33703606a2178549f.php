<?php /*a:3:{s:57:"D:\localhost\auth\application\index\view\item\detail.html";i:1545033297;s:59:"D:\localhost\auth\application\index\view\public\header.html";i:1544951395;s:59:"D:\localhost\auth\application\index\view\public\footer.html";i:1544951974;}*/ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>参选人详情</title>
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
<link href="/static/index/css/public.css" rel="stylesheet"/>
<link href="/static/index/css/detail.css" rel="stylesheet"/>
<script src="http://res.wx.qq.com/open/js/jweixin-1.4.0.js"></script>
<script src="/static/index/js/jquery-2.1.4.min.js"></script>
<script src="/static/layui/layui.js" charset="utf-8"></script>
<script src="/static/index/js/index.js"></script>
</head>
<body>
		<div class="header">
		<div class="header-item" onclick="window.history.go(-1);">
			<img src="/static/index/images/return.png"/><span>返回</span>
		</div>
	</div>
	<div class="content-box">
		<div class="item-box">
			<?php echo $item['desc']; ?>
		
		</div>
		<div class="item-box">
			<p class="geted_num">已获得票数：<?php echo htmlentities($item['zan_num']); ?></p>
		</div>
		<div class="item-box">
			<span <?php if(!(empty($zan) || (($zan instanceof \think\Collection || $zan instanceof \think\Paginator ) && $zan->isEmpty()))): ?>is_clicked="1"<?php endif; ?> class="click-piao"  item_id = "<?php echo htmlentities($item['id']); ?>" activity_id = "<?php echo htmlentities($item['activity_id']); ?>" <?php if(in_array($item['id'],$zan)): ?>style="background:#ccc;"<?php endif; ?>>
				<img src="/static/index/images/zan.png"/>
				  投TA一票
			</span>
		</div>
	</div>
			<div class="footer">
			<div>
				<p>主办方:重庆伊莲摄影有限公司，所有解释权归主办方所有</p>
			</div>
		</div>
<script>
wx.config({
    debug: true, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
    appId: '<?php echo htmlentities($param["appId"]); ?>', // 必填，公众号的唯一标识
    timestamp: <?php echo htmlentities($param['param']['timestamp']); ?>, // 必填，生成签名的时间戳
    nonceStr: '<?php echo htmlentities($param['param']['noncestr']); ?>', // 必填，生成签名的随机串
    signature: '<?php echo htmlentities($param['sign']); ?>',// 必填，签名
    jsApiList: ['onMenuShareAppMessage','onMenuShareTimeline'] // 必填，需要使用的JS接口列表
});
wx.ready(function () {   //需在用户可能点击分享按钮前就先调用
	wx.onMenuShareAppMessage({
	    title: '<?php echo htmlentities($item['title']); ?>', // 分享标题
	    desc:'<?php echo htmlentities($item['title']); ?>',
	    link: '<?php echo htmlentities($param['param']['url']); ?>', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
	    imgUrl: '<?php echo htmlentities($item['share_img']); ?>', // 分享图标
	    success: function () {
	    // 用户点击了分享后执行的回调函数
	}
});
	wx.onMenuShareTimeline({
	    title: '<?php echo htmlentities($item['title']); ?>', // 分享标题
	    link: '<?php echo htmlentities($param['param']['url']); ?>', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
	    imgUrl: '<?php echo htmlentities($item['share_img']); ?>', // 分享图标
	    success: function () {
	    // 用户点击了分享后执行的回调函数
	},
});
});
</script>
</body>
</html>