<?php
namespace app\admin\controller;
class User extends Error{
    
    
    function index()
    {
        return $this->fetch();
    }
    //列表
    function lists()
    {
        $username = input('username/s','');
        $map = [];
        if($username)
        {
            $map = [['nickname','like','%'.$username.'%']];
        }
        $limit = input('limit/d',1);
        $page = input('page/d',1);
        $data['data'] = db('user')->where($map)->field('id,nickname,province,addtime')->page($page)->limit($limit)->select();
        $data['count'] = db('user')->where($map)->count();
        $data['code'] = 0;
        return $data;
    }
    
    //删除
    function del()
    {
        $id = input('id/d',0);
        $limit = input('limit/d',1);
        $cur = input('page/d',1);
        if(!$id)
        {
            return ['code'=>-1,'msg'=>'缺少参数'];
        }
        $res = db('user')->delete($id);
        if($res)
        {
            $is_have = db('user')->page($cur)->limit($limit)->field('id')->select();
            if(empty($is_have))
            {
                $cur = (($cur - 1))>0?($cur - 1):1;
            }
            return ['code'=>1,'msg'=>'删除成功','ccur'=>$cur];
        }else{
            return ['code'=>-1,'msg'=>'删除失败'];
        }
    }
    
    
}