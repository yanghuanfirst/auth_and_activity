layui.use(['laydate', 'laypage', 'layer', 'table', 'carousel', 'upload', 'element', 'slider'], function(){
  layer = layui.layer //弹层
});
$(function(){
	//现实还是隐藏简介
	  $(".show_or_hide_desc").click(function(){
		  $(".desc-box").toggle(100);
		  $(this).toggleClass('totate');
	});
	 //点赞
	$(document).on('click','.click-piao',function(){
		var that = $(this);
		var activity_id = $(this).attr('activity_id');
		var item_id = $(this).attr('item_id');
		var is_clicked = $(this).attr('is_clicked');
		if(is_clicked)
		{
			layer.msg('今天您已经点过赞了,明天再来吧', {icon: 5});
			return false;
		}
		layer.confirm('确定为该选手点赞吗?', {
			  btn: ['确定','取消'] //按钮
			}, function(){
			  
				$.ajax({
					url:"/index/index/zan",
					type:"post",
					dataType:"json",
					data:{activity_id:activity_id,item_id:item_id},
					success:function(res)
					{
						if(res.code == 1){
							layer.msg(res.msg, {icon: 1});
							//create_html(res.data,activity_id);
							var piao = parseInt($('.piao_num_'+item_id).text());
							piao = piao+1;
							$('.piao_num_'+item_id).html(piao+' 票');
							that.css({"background":"#ccc"});
							$('.click-piao').attr('is_clicked',1);
						}else{
							layer.msg(res.msg, {icon: 5});
						}
					}
				})
			}, function(){
			});

		
	})
})



function create_html(obj,activity_id)
{
	var html = '';
	$.each(obj,function(k,v){
		html += '<div class="person-box">';
		html += '<img class="head-img" src="/uploads/'+v['item_img']+'"/>';
		html += '<div class="info">';
		html += '<span>'+v['username']+'</span>';
		html += '<span class="click-piao" item_id = "'+v['id']+'" activity_id = "'+activity_id+'">';
		html += '<img src="/static/index/images/zan.png"/> 投票</span>';
		html += '<span class="piao_num">'+v.zan_num+' 票</span>';
		html += '</div>';
		html += '</div>';
	})
	$('.all-item').html(html);
	
	
	
}












