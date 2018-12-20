<?php /*a:2:{s:57:"D:\localhost\auth\application\index\view\index\index.html";i:1545292675;s:59:"D:\localhost\auth\application\index\view\public\footer.html";i:1544951974;}*/ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>活动名</title>
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
<link href="/static/index/css/public.css" rel="stylesheet"/>
<link href="/static/index/css/index.css" rel="stylesheet"/>
<script src="http://res.wx.qq.com/open/js/jweixin-1.4.0.js"></script>
<script src="/static/index/js/jquery-2.1.4.min.js"></script>
<script src="/static/layui/layui.js" charset="utf-8"></script>
<script src="/static/index/js/index.js"></script>
</head>
<body>
<?php if(!(empty($activity) || (($activity instanceof \think\Collection || $activity instanceof \think\Paginator ) && $activity->isEmpty()))): ?>
	<div class="content-box">
		<div class="logo-box">
			<img src="/uploads//<?php echo htmlentities($activity['activity_logo']); ?>" class="logo"/>
		</div>
		<div class="item-box">
			<div class="title-box">
				<h2><?php echo htmlentities($activity['activity_name']); ?></h2>
			</div>
			<div class="three-box">
				<ul class="ul-box">
					<li>
						<span>参与家庭</span><br/>
						<span><?php echo count($item); ?></span>
					</li>
					<li>
						<span>累计投票</span><br/>
						<span><?php echo htmlentities($activity['zan_num']); ?></span>
					</li>
					<li>
						<span>访问次数</span><br/>
						<span><?php echo htmlentities($activity['view_num']); ?></span>
					</li>
				</ul>
			</div>
			<div class="time-box">
				<div class="start_time">
					<img src="/static/index/images/timer.png"/> 
					 <span> 开始时间：<?php echo date('Y-m-d H:i:s',$activity['start_time']); ?></span>
				</div>				
				<div class="end_time">
					<img src="/static/index/images/timer.png"/> 
					 <span> 结束时间：<?php echo date('Y-m-d H:i:s',$activity['end_time']); ?></span>
				</div>	
				<div class="warm-box">
					<img src="/static/index/images/warm.png"/>
					 <span>投票规则：每个微信只能投一个家庭，只有一次投票机会</span>
				</div>	
				<div class="jieshao-box">
					<img src="/static/index/images/desc.png"/>
					<span>活动介绍</span>
					<img class="show_or_hide_desc" stat = "0" src="/static/index/images/up.png"/>
				</div>
				<div class="desc-box">
					<?php echo $activity['desc']; ?>
				</div>
			</div>
		</div>
		<div class="item-box" style="height:40px;margin-top:10px">
			<div class="form-box">
				<form method="get" action="<?php echo url('index/index'); ?>">
					<div class="inp-item fl" style="width: 65%;">
						<input type="text"  class="username-box" name="username" placeholder="请输入参选人姓名"/>
					</div>
					<div class="inp-item sub-box fl" >
						<img src="/static/index/images/search.png"/>
						<input type="submit" class="sub-btn" value="搜索"/>
					</div>
				</form>
			</div>
		</div>
		<div class="item-box">
			<div class="paiming-box">
				<a href="<?php echo url('index/item/rank',array('activity_id'=>$activity['id'])); ?>">
					<img src="/static/index/images/paiming.png"/>
					<span>查看排名</span>
				</a>
			</div>
		</div>
		<div class="item-box">
		<?php if(!(empty($item) || (($item instanceof \think\Collection || $item instanceof \think\Paginator ) && $item->isEmpty()))): ?>
		<div class="all-item">
		<?php if(is_array($item) || $item instanceof \think\Collection || $item instanceof \think\Paginator): if( count($item)==0 ) : echo "" ;else: foreach($item as $k=>$v): ?>
			<div class="person-box">
				<a href="<?php echo url('index/item/detail',array('id'=>$v['id'])); ?>"><img class="head-img" src="/uploads//<?php echo htmlentities($v['item_img']); ?>"/></a>
				<div class="info">
					<span>
						<?php echo htmlentities($v['username']); ?>
					</span>
					<span class="click-piao" <?php if(!(empty($zan) || (($zan instanceof \think\Collection || $zan instanceof \think\Paginator ) && $zan->isEmpty()))): ?>is_clicked="1"<?php endif; ?> item_id = "<?php echo htmlentities($v['id']); ?>" activity_id = "<?php echo htmlentities($activity['id']); ?>" <?php if(in_array($v['id'],$zan)): ?>style="background:#ccc;"<?php endif; ?>>
						<img src="/static/index/images/zan.png"/>
						投票
					</span>
					<span class="piao_num_<?php echo htmlentities($v['id']); ?>"><?php echo htmlentities($v['zan_num']); ?> 票</span>
				</div>
			</div>
		<?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
		<?php else: ?>
			<div class="no-data">
				<p>暂无数据</p>
			</div>
		<?php endif; ?>
		</div>

	</div>
	<?php else: ?>
		<div class="no-a">
			<p>暂没有活动进行中<p>
		</div>
	<?php endif; ?>
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
	    title: '<?php echo htmlentities($activity['activity_name']); ?>', // 分享标题
	    desc:'<?php echo htmlentities($activity['activity_name']); ?>',
	    link: '<?php echo htmlentities($param['param']['url']); ?>', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
	    imgUrl: '<?php echo htmlentities($activity['share_img']); ?>', // 分享图标
	    success: function () {
	    // 用户点击了分享后执行的回调函数
	}
});
	wx.onMenuShareTimeline({
	    title: '<?php echo htmlentities($activity['activity_name']); ?>', // 分享标题
	    link: '<?php echo htmlentities($param['param']['url']); ?>', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
	    imgUrl: '<?php echo htmlentities($activity['share_img']); ?>', // 分享图标
	    success: function () {
	    // 用户点击了分享后执行的回调函数
	},
});
});
</script>
</body>
</html>