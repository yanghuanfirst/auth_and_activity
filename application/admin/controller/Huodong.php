<?php
namespace app\admin\controller;
use think\Validate;
class Huodong extends Error{
    function index()
    {
        return $this->fetch();
    }
    
    //列表
    function lists()
    {
        $username = input('activity_name/s','');
        $map = [];
        if($username)
        {
            $map[] = ['activity_name','like','%'.$username.'%'];
        }
        $limit = input('limit/d',1);
        $page = input('page/d',1);
        $data['data'] = db('huodong')
                    ->where($map)
                    ->page($page)
                    ->limit($limit)
                   ->select();
        $data['count'] = db('huodong')->where($map)->count();
        $data['code'] = 0;
        return $data;
    }
    
    function changeStatus()
    {
        $id = input('id/d',0);
        $status = input('status/d',1);
        if($status == 2)
        {
            $map[] = ['status','eq',2];
            $map[] = ['id','neq',$id];
            $have = db('huodong')->where($map)->find();
            if($have)
            {
                return ['code'=>-1,'msg'=>'活动最多只能开启一个'];
            }
        }
        $data['id'] = $id;
        $data['status'] = $status;
        $res = db('huodong')->update($data);
        if($res)
        {
            return ['code'=>1,'msg'=>'操作成功'];
        }else{
            return ['code'=>-1,'msg'=>'操作失败'];
        }
        
    }
    //添加
    function add()
    {
        return $this->fetch();
    }
    
    function doAdd()
    {
        $data = input('post.');
        $rule =   [
            'activity_name'  => 'require',
            //'yuyue_money'   => 'require',
            'start_time'   => 'require|date|lt:end_time',
            'end_time' => 'require|date|gt:start_time',
            'activity_logo'=>'require',
            'desc'=>"require"
        ];
        $message  =   [
            'activity_name.require' => '活动名必须',
            'yuyue_money.require'     => '预约金额必须',
            'start_time.lt'=>'开始时间必须小于结束时间',
            'end_time.gt'=>'结束时间必须大于开始时间',
            'desc.require'     => '描述必须',
        ];
        $validate   = Validate::make($rule,$message);
        
        if (!$validate->check($data)) {
            return ['code'=>-1,'msg'=>$validate->getError()];
        }
        if($data['status'] == 2){ 
            $map[] = ['status','eq',2];
            $have = db('huodong')->where($map)->value('id');
            if($have)
            {
                return ['code'=>-1,'msg'=>'活动只能开启 一个'];
            }
        }
        unset($data['logo_img']);
        $data['start_time'] = strtotime($data['start_time']);
        $data['end_time'] = strtotime($data['end_time']);
        $data['create_time'] = time();
        $res = db('huodong')->insert($data);
        if($res)
        {
            return ['code'=>1,'msg'=>'操作成功'];
        }else{
            return ['code'=>-1,'msg'=>'操作失败'];
        }
        
        
        
    }
    
    function del()
    {
        $id = input('id/s',0);
        $limit = input('limit/d',1);
        $cur = input('page/d',1);
        if(!$id)
        {
            return ['code'=>-1,'msg'=>'缺少参数'];
        }
        $res = db('huodong')->delete(explode(',',$id));
        if($res)
        {
            $is_have = db('huodong')->page($cur)->limit($limit)->field('id')->select();
            if(empty($is_have))
            {
                $cur = (($cur - 1))>0?($cur - 1):1;
            }
            return ['code'=>1,'msg'=>'删除成功','ccur'=>$cur];
        }else{
            return ['code'=>-1,'msg'=>'删除失败'];
        }
    }
    function edit(){
        $id = input('id/d',0);
        if(!$id)
        {
            return $this->error('缺少参数');
        }
        $info = db('huodong')->find($id);
        $this->assign('info',$info);
        return $this->fetch();
        
    }
    function doEdit()
    {
        $data = input('post.');
        $rule =   [
            'activity_name'  => 'require',
            //'yuyue_money'   => 'require',
            'start_time'   => 'require|date|lt:end_time',
            'end_time' => 'require|date|gt:start_time',
            'desc'=>"require",
            'activity_logo'=>'require',
        ];
        $message  =   [
            'activity_name.require' => '活动名必须',
            'yuyue_money.require'     => '预约金额必须',
            'start_time.lt'=>'开始时间必须小于结束时间',
            'end_time.gt'=>'结束时间必须大于开始时间',
            'desc.require'     => '描述必须',
        ];
        $validate   = Validate::make($rule,$message);
        if (!$validate->check($data)) {
            return ['code'=>-1,'msg'=>$validate->getError()];
        }
        $data['start_time'] = strtotime($data['start_time']);
        $data['end_time'] = strtotime($data['end_time']);
        unset($data['logo_img']);
        $res = db('huodong')->update($data);
        if($res)
        {
            return ['code'=>1,'msg'=>'操作成功'];
        }else{
            return ['code'=>-1,'msg'=>'操作失败'];
        }
    
    
    
    }
    
    
    
    
    
    
    
    
    
}