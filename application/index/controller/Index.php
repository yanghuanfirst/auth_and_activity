<?php
namespace app\index\controller;
use ticket\Jsapi;
use think\facade\Request;
class Index extends Base
{
    
    public function index()
    {
        $map[] = ['status','eq',2];
        //活动只能有一个开启的
        $activity = db('huodong')->where($map)->find();
        $item = [];
        $zan = [];
        if($activity)
        {
            $username = input('username/s','');
            $imap[] = ['activity_id','eq',$activity['id']];
            if($username)
            {
                $imap[] = ['username','like','%'.$username.'%'];
            }
            //分享的图片链接
            $activity['share_img'] = Request::domain()."/uploads/".str_replace('\\','/',$activity['activity_logo']);
            $item = db('item')->where($imap)->select();
            db('huodong')->where('id',$activity['id'])->setInc('view_num');
            $user_id = session('userinfo.id');
            //查看当天自己为哪个选手点过赞
            $zm[] = ['user_id','eq',$user_id];
            $zm[] = ['huodong_id','eq',$activity['id']];
            $zan =  db('zan')->where($zm)->whereTime('create_time','d')->field('item_id')->select();           
            if($zan)
                $zan = array_column($zan,'item_id');
            
        }
        //获取微信的JSSDK来自定义分享内容
        $jssdk = new Jsapi();
        $param = $jssdk->getSign();
        $param['appId'] = config('param.appid');
        $this->assign('zan',$zan);
        $this->assign('param',$param);
        $this->assign('item',$item);
        $this->assign('activity',$activity);
        return $this->fetch();
    }
    //执行点赞
    function zan(){
        $user_id = session('userinfo.id');
        //$user_id = 1;
        $activity_id = input('activity_id/d',0);
        $item_id = input('item_id/d','');
        if(!$activity_id || !$item_id)
        {
            return ['code'=>-1,'msg'=>'该活动已结束'];
        }
        $activity = db('huodong')->field('start_time,end_time,status')->where('id',$activity_id)->find();
        if(!$activity)
        {
            return ['code'=>-1,'msg'=>'没有该活动'];
        }
        if($activity_id['status'] == 1)
            return ['code'=>-1,'msg'=>'该活动已结束'];
        if($activity['start_time']>time())
            return ['code'=>-1,'msg'=>'该活动还没有开始'];
        if($activity['end_time']<time())
            return ['code'=>-1,'msg'=>'该活动已结束'];
        $m[] = ['huodong_id','eq',$activity_id];
        $m[] = ['user_id','eq',$user_id];
        $is_have = db('zan')
                    ->where($m)
                    ->whereTime('create_time', 'd')
                    ->find();        
        if($is_have)
            return ['code'=>-1,'msg'=>'今天你已经点过赞了，请明天再来吧'];
        $data['user_id'] = $user_id;
        $data['huodong_id'] = $activity_id;
        $data['item_id'] = $item_id;
        $data['create_time'] = time();
        $res = db('zan')->insert($data);
        if($res)
        {
            db('item')->where('id',$item_id)->setInc('zan_num');
            db('huodong')->where('id',$activity_id)->setInc('zan_num');
            //$item = db('item')->where('activity_id',$activity_id)->order('zan_num desc')->select();
            return ['code'=>1,'msg'=>'点赞成功'];
        }else{
            return ['code'=>-1,'msg'=>'请求错误，请稍后再试'];
        }
        
        
        
    }
    
    
    
}
