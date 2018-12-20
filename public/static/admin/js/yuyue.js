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
//创建一个上传组件
  upload.render({
    elem: '#logo-img-id'
    ,accept:"images"
    ,field:"logo_img"
    ,size: 1024 //最大允许上传的文件大小
    ,url: '/admin/Item/uploadLogo'
    ,done: function(res, index, upload){ //上传后的回调
    	if(res.error == 0)
		{
    		$('.logo-img').html('<img src="'+res.url+'" style="width:100px;height:100px"/>');
    		$('input[name="item_img"]').val(res.data_url);
		}else{
			layer.msg(res.msg,{
				icon:5
			});
		}
    } 
    //,accept: 'file' //允许上传的文件类型
    //,size: 50 //最大允许上传的文件大小
    //,……
  })
  laydate.render({
	    elem: '#start_time' //指定元素
	    	 ,type: 'datetime'
});
  laydate.render({
	    elem: '#end_time' //指定元素
	    	 ,type: 'datetime'
});
  //执行一个 table 实例
  var tableins = table.render({
    elem: '#role_list'
    ,height: 420
    ,url: 'lists' //数据接口
    ,title: '活动表'
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
       {field: 'username',width: '10%',  title: '预约人',align:'center'}
       ,{field: 'mobile',width: '10%',  title: '电话',align:'center'}
       ,{field: 'activity_name',width: '20%',  title: '活动名',align:'center'}
       ,{field: 'shoot_person',width: '10%',  title: '拍摄人数',align:'center'}
       ,{field: 'status',width: '10%',  title: '是否支付',align:'center',templet:'#sex'}
       ,{field: 'yuyue_time',width: '20%',  title: '预约时间',align:'center',templet:'#createTime'}
       ,{field: 'backup',width: '10%',  title: '备注',align:'center'}
      ,{title:"操作",width: '10%', align:'center', toolbar: '#barDemo'}
      
    ]]
  ,id:"table_list"
  ,done:function(res,curr,count){
      hoverOpenImg();//显示大图
//      $('table tr').on('click',function(){
//          $('table tr').css('background','');
//          //$(this).css('background','<%=PropKit.use("config.properties").get("table_color")%>');
//      });
  }
  });
  
  form.on('switch(statusDemo)', function(obj){
	    //layer.tips(this.value + ' ' + this.name + '：'+ obj.elem.checked, obj.othis);
	    let param;
	    if(obj.elem.checked)
	    {
	    	param = {status:2,id:this.value};
	    }else{
	    	param = {status:1,id:this.value};
	    }
	    $.ajax({
	    	url:'changeStatus',
	    	type:"post",
	    	data:param,
	    	dataType:"json",
	    	success:function(res)
	    	{
	    		if(res.code==1)
	    		{
	    			layer.msg(res.msg,{
	    				icon:6
	    			});
	    		}else{
	    			layer.msg(res.msg,{
	    				icon:5
	    			});
	    			var cur = $('.layui-laypage-curr').not('.layui-laypage-em').find('em').text();
	    			tableins.reload({
	    				page:cur
	    			});
	    		}
	    	}
	    	
	    })
	    
	    
  });
//监听行工具事件
  table.on('tool(test)', function(obj){ //注：tool 是工具条事件名，test 是 table 原始容器的属性 lay-filter="对应的值"
    var data = obj.data //获得当前行数据
    ,layEvent = obj.event; //获得 lay-event 对应的值
    if(layEvent === 'edit'){
    	window.location.href="edit/id/"+data.id;
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
	  var desc = editor.html();
	  p_data['desc'] = desc;
	  $.ajax({
		  url:'/admin/Item/doAdd',
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
					  window.location.href="/admin/Item/index";
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
   form.on('submit(formEdit)',function(data){
	  var p_data = data.field;
	  var desc = editor.html();
	  p_data['desc'] = desc;
	  $.ajax({
		  url:'/admin/Item/doEdit',
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
					  window.location.href="/admin/Item/index";
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


 
function hoverOpenImg(){
    var img_show = null; // tips提示
    $('td img').hover(function(){
        var kd=$(this).width();
        var beishu = 3;//放大倍数
        if(kd > 400)
        {
        	beishu = 1;
        }
        kd1=kd*beishu;          //图片放大倍数
        console.log(kd);
//        if(kd1>200)
//        {
//        	kd1 = 200;//最大不超过200
//        }
        kd2=kd*beishu+30;       //图片放大倍数
        var img = "<img class='img_msg' src='"+$(this).attr('src')+"' style='width:"+kd1+"px;' />";
        img_show = layer.tips(img, this,{
            tips:[2, 'rgba(41,41,41,.5)']
            ,area: [kd2+'px']
        });
        //$('td img').attr('style','max-width:70px;display:block!important');
    },function(){
        layer.close(img_show);
    });
    
}





