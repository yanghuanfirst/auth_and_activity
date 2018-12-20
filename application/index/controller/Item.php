<?php
namespace app\index\controller;
use ticket\Jsapi;
use think\facade\Request;
class Item extends Base
{
    //详情页
    function detail(){
        $id = input('id/d',0);
        if(!$id)
            return $this->error('缺少参数');
        $item = db('item')->field('id,desc,zan_num,activity_id,title,item_img')->where('id',$id)->find();
        $item['share_img'] = Request::domain()."/uploads/".str_replace('\\','/',$item['item_img']);
        $user_id = session('userinfo.id');
        $zm[] = ['user_id','eq',$user_id];
        $zm[] = ['huodong_id','eq',$item['activity_id']];
        $zan =  db('zan')->where($zm)->whereTime('create_time','d')->field('item_id')->select();
        if($zan)
            $zan = array_column($zan,'item_id');
        $jssdk = new Jsapi();
        $param = $jssdk->getSign();
        $param['appId'] = config('param.appid');
        $this->assign('zan',$zan);
        $this->assign('param',$param);
        $this->assign('item',$item);
        return $this->fetch();
    }
    //排行
    function rank()
    {
        $activity_id = input('activity_id/d',0);
        if(!$activity_id)
            return $this->error('请求有误，请稍后再试');
        $item = db('item')
                    ->field('id,username,zan_num')
                    ->where('activity_id',$activity_id)
                    ->order('zan_num desc')
                    ->limit(10)
                    ->select();
        $activity = db('huodong')->field('id,end_time,activity_name')->where('id',$activity_id)->find();
        $color = config('param.rank_color');
        
        $this->assign('color',$color);
        $this->assign('activity',$activity);
        $this->assign('item',$item);
        return $this->fetch();
    }
    
    
}