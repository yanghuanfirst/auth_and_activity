layui.use(['laydate', 'laypage', 'layer', 'table', 'carousel', 'upload', 'element', 'slider'], function(){
  laypage = layui.laypage //分页
  ,layer = layui.layer //弹层
  ,table = layui.table //表格
  ,upload = layui.upload //上传
  ,element = layui.element //元素操作
  ,slider = layui.slider//滑块
  ,form = layui.form
  ,laydate = layui.laydate
  
  //向世界问个好
  //layer.msg('Hello World');
  
  laydate.render({
	    elem: '#bespeak_time' //指定元素
});
  //执行一个 table 实例
  var tableins = table.render({
    elem: '#role_list'
    ,height: 420
    ,url: 'lists' //数据接口
    ,title: '预约表'
   	,page: true //开启分页
   	,limits: limits//，每页显示多少条记录的选项，3,5,10表示的是用户有这3种选择
    ,limit: limit //每页默认显示的数量
    //,page: { //支持传入 laypage 组件的所有参数（某些参数除外，如：jump/elem） - 详见文档
     //   layout: ['limit', 'count', 'prev', 'page', 'next', 'skip'] //自定义分页布局
    //,curr: 5 //设定初始在第 5 页
    //,groups: 2 //只显示 2 个连续页码
    //,first: false //不显示首页
    //,last: false //不显示尾页
    
  //}
    //,toolbar: 'default' //开启工具栏，此处显示默认图标，可以自定义模板，详见文档
    ,totalRow: false //开启合计行
    ,cols: [[ //表头
       {field: 'username',width: '30%',  title: '用户名',align:'center'}
       ,{field: 'activity_name',width: '10%',  title: '活动名称',align:'center'}
       ,{field: 'sex',width: '10%',  title: '性别',align:'center',templet:"#sex"}
       ,{field: 'telphone',width: '10%',  title: '性别',align:'center'}
       ,{field: 'bespeak_time',width: '20%',  title: '预约时间',align:'center',templet:'#createTime'}
      ,{title:"操作",width: '20%', align:'center', toolbar: '#barDemo'}
      
    ]]
  ,id:"table_list"
  });
//监听行工具事件
  table.on('tool(test)', function(obj){ //注：tool 是工具条事件名，test 是 table 原始容器的属性 lay-filter="对应的值"
    var data = obj.data //获得当前行数据
    ,layEvent = obj.event; //获得 lay-event 对应的值
    if(layEvent === 'fenpei'){
    	window.location.href="Fenpei/id/"+data.id;
    	
    } else if(layEvent === 'del'){
      layer.confirm('真的删除行么', function(index){
    	  //var cur = tableins.config.page.curr;
    	  var cur = $('.layui-laypage-curr').not('.layui-laypage-em').find('em').text();
    	  var limit = tableins.config.limit;
    	  //向服务端发送删除指令
    	$.ajax({
    		url:'del/id/'+data.id,
    		type:"post",
    		data:{id:data.id,page:cur,limit:limit},
    		dataType:"json",
    		success:function(r){
    			if(r.code == 1){
    				 layer.msg(r.msg,{icon:6});
    				 obj.del(); //删除对应行（tr）的DOM结构
    			     layer.close(index);
    			     tableins.reload({
    			    	 page: {
 						    curr: r.ccur //重新从第 1 页开始
 						  }
    			     })
    			}else
    			{
    				layer.msg(r.msg,{icon:5});
    			}
    		}
    	}) 
    	  
    	  
       
      });
    } else if(layEvent === 'backup'){
    	var id = obj.data.id;
    	layer.open({
    		 title:'编辑',
    		 area: ['600px', '400px'], //宽高
			 type: 2, 
			 content:'backup/id/'+id  //这里是一个url地址
    	});
    }
  });
  //搜索
  form.on('submit(formDemos)',function(data){
	   let param = {
			 username:data.field.username,
			 bespeak_time:data.field.bespeak_time
	  };
	  tableins.reload({
		  where:param
	  });
	  return false;
  });
  //监听增加备注动作
  form.on('submit(formDemo)',function(data){
	  var p_data = data.field;
	  $.ajax({
		  url:'/admin/Bespeak/doBackup',
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
				  var cur = $('.layui-laypage-curr').not('.layui-laypage-em').find('em').text();
				  setTimeout(function(){
					  //window.parent.location.reload();
					  var index = parent.layer.getFrameIndex(window.name);
					  parent.layer.close(index);
					  tableins.reload({
						  page: {
						    curr: cur 
						  }
						});
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
  //监听添加动作
   form.on('submit(formAdd)',function(data){
	  var p_data = data.field;
	  if(p_data['status'] == 'on')
	  {
		  p_data['status'] = 1;
	  }else{
		  p_data['status'] = 0;
	  }
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
					  window.location.href=$('.base_url1').val();
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
  //监听分配动作(注意点，form的class必须是layui-form，这样监听提交的时候才会有数据)
   form.on('submit(formFen)',function(data){
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
					  window.location.href=$('.base_url1').val();
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

//分配规则
$(function(){
	$('.role_id_c').on('click',function(){
		var  k_index = $(this).attr('k_index');
		var is_checked = '';
		$.each($('.role_id_c'),function(k,v){
			if($(this).prop('checked'))
			{
				is_checked += $(this).val(); 
			}
		})
	if(is_checked)
	{
		$('.role_id_c_'+k_index).prop('checked','checked');
	}else{
		$('.role_id_c_'+k_index).prop('checked','');
	}
		
	})
	
})








