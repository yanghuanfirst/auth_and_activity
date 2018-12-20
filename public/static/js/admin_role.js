layui.use(['laydate', 'laypage', 'layer', 'table', 'carousel', 'upload', 'element', 'slider'], function(){
  laypage = layui.laypage //分页
  ,layer = layui.layer //弹层
  ,table = layui.table //表格
  ,upload = layui.upload //上传
  ,element = layui.element //元素操作
  ,slider = layui.slider//滑块
  ,form = layui.form
  
  //监听修改动作
  form.on('submit(formDemo)',function(data){
	  var p_data = data.field;
	  $.ajax({
		  url:$('.base_url').val(),
		  type:"post",
		  data:p_data,
		  dataType:'json',
		  success:function(res)
		  {
			  if(res.code == 1)
			  {
				  layer.msg(res.msg,{
					  icon:6
				  })
				  
				  
				  setTimeout(function(){
					  window.location.reload();
					  var index = parent.layer.getFrameIndex(window.name);
					  parent.layer.close(index);
					  console.log(tableins);
//					  tableins.reload({
//						  page: {
//						    curr: 1 //重新从第 1 页开始
//						  }
//						});
				  },2000);
			  }else{
				  layer.msg(res.msg,{
					  icon:5
				  })
			  }
		  }
	  })
	  
	  
	  return false;
  })
  
  
  
  
  
  
  
  
  
  
});