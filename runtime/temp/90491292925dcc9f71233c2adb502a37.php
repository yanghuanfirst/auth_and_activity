<?php /*a:3:{s:55:"D:\localhost\auth\application\index\view\item\rank.html";i:1545011433;s:59:"D:\localhost\auth\application\index\view\public\header.html";i:1544951395;s:59:"D:\localhost\auth\application\index\view\public\footer.html";i:1544951974;}*/ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>排行榜</title>
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
<link href="/static/index/css/public.css" rel="stylesheet"/>
<link href="/static/index/css/rank.css" rel="stylesheet"/>
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
			<h1 class="a-name"><?php echo htmlentities($activity['activity_name']); ?></h1>
		</div>
		<div class="item-box">
			<div class="item-child">
				<img src="/static/index/images/timer.png"/>
				<span>活动截止时间：<?php echo date('Y-m-d H:i:s',$activity['end_time']); ?></span>
			</div>
			<div class="item-child">
				<img src="/static/index/images/warm.png"/>
				<span>投票规则，每个微信号每天只能投票一次，并且只能投票一个家庭。</span>
			</div>
			<div class="item-child">
				<h1>最新排名</h1>
			</div>
		</div>
		<div class="item-box">
			<?php if(is_array($item) || $item instanceof \think\Collection || $item instanceof \think\Paginator): if( count($item)==0 ) : echo "" ;else: foreach($item as $k=>$v): ?>
			<div class="rank-item">
				<span style="background:<?php echo htmlentities($color[$k]); ?>">第<?php echo htmlentities($k+1); ?>名</span>	
				<span><a href="<?php echo url('index/item/detail',array('id'=>$v['id'])); ?>"><?php echo htmlentities($v['username']); ?></a></span>
				<span><?php echo htmlentities($v['zan_num']); ?> 票</span>
			</div>
			<?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
	</div>


		<div class="footer">
			<div>
				<p>主办方:重庆伊莲摄影有限公司，所有解释权归主办方所有</p>
			</div>
		</div>
</body>
</html>