<?php
namespace app\admin\controller;
use think\Validate;

class Item extends Error{
    
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
            $map[] = ['username','like','%'.$username.'%'];
        }
        $limit = input('limit/d',1);
        $page = input('page/d',1);
        $data['data'] = db('item')
                    ->alias('i')
                    ->join('huodong a','a.id=i.activity_id')
                    ->field('i.id,a.activity_name,i.username,i.tel,i.item_img,i.title,i.create_time,i.sex')
                    ->where($map)
                    ->page($page)
                    ->limit($limit)
                    ->select();
        $domain = request()->domain();
        foreach ($data['data'] as $k=>$v)
        {
            $v['item_img'] = $domain."/uploads/".$v['item_img'];
            $data['data'][$k] = $v;
        }
        $data['count'] = db('item')
                        ->alias('i')
                        ->join('huodong a','a.id=i.activity_id')
                        ->where($map)
                        ->count();
        $data['code'] = 0;
        return $data;
    }
    function add(){
        
        $activity = db('huodong')->field('id,activity_name')->where('status',2)->select();
        $this->assign('activity',$activity);
        return $this->fetch();
    }
    function doAdd()
    {
        $data = input('post.');
        $validate = new \app\admin\validate\Itemv();
        if (!$validate->check($data)) {
            return ['code'=>-1,'msg'=>$validate->getError()];
        }
        $map[] = ['tel','eq',$data['tel']];
        $map[] = ['activity_id','eq',$data['activity_id']];
        $is_joined = db('item')->where($map)->field('id')->find();
        if($is_joined)
        {
            return ['code'=>-1,'msg'=>'该手机号的用户已经参加过该活动，请勿重复添加'];
        }
        unset($data['logo_img']);
        $data['create_time'] = time();
        $res = db('item')->insert($data);
        if($res){
            return ['code'=>1,'msg'=>'操作成功'];
        }else{
            return ['code'=>-1,'msg'=>'操作失败'];
        }
        
    }
    //编辑
    function edit()
    {
        $id = input('id/d',0);
        if(!$id)
        {
          return $this->error('缺少参数');  
        }
        $activity = db('huodong')->field('id,activity_name')->where('status',2)->select();
        $info = db('item')->find($id);
        $this->assign(compact('info','activity'));
        return $this->fetch();
    }
    function doEdit()
    {
        $data = input('post.');
        $rule =   [
            'username'  => 'require|max:4|min:2|chs',
            'title'   => 'require|max:30',
            'item_img'   => 'require',
            'id'=>'require|number',
            'tel' => 'require|regex:^1[35789]{1}\d{9}$|unique:item,tel,'.$data['id'].',id',
            'desc'=>"require"
        ];
        $message  =   [
            'username.require' => '用户名必须',
            'username.max'     => '用户名必须最多不能超过4个字符',
            'username.min'     => '用户名必须最小2个字符',
            'username.chs'     => '用户名必须是中文',
            'title.require'   => '标题必须',
            'title.max'   => '标题最多30个字',
            'tel.require'   => '电话必须输入',
            'tel.regex'=>'电话格式不对',
            'desc.require'  => '描述必须',
            'item_img.require'=>'logo必须传',
            'tel.unique'=>'电话不能重复'
        ];
        $validate   = Validate::make($rule,$message);
        if (!$validate->check($data)) {
            return ['code'=>-1,'msg'=>$validate->getError()];
        }
        unset($data['logo_img']);
        $res = db('item')->update($data);
        if($res){
            return ['code'=>1,'msg'=>'操作成功'];
        }else{
            return ['code'=>-1,'msg'=>'操作失败'];
        }
        
        
        
        
        
        
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
        $res = db('item')->delete($id);
        if($res)
        {
            $is_have = db('item')->page($cur)->limit($limit)->field('id')->select();
            if(empty($is_have))
            {
                $cur = (($cur - 1))>0?($cur - 1):1;
            }
            return ['code'=>1,'msg'=>'删除成功','ccur'=>$cur];
        }else{
            return ['code'=>-1,'msg'=>'删除失败'];
        }
    }
    
    //上传logo
    function uploadLogo()
    {
        $res = upload('logo_img','desc');
        if($res['code'] == 1){
            $url = request()->domain().'/uploads/desc/'.$res['url'];
            $data_url = 'desc/'.$res['url'];
            return json(['error'=>0,'url'=>$url,'data_url'=>$data_url]);
        }else{
            return json(['error'=>-1,'msg'=>$res['msg']]);
        }
    }
    //上传描述里的图片
    function uploadImg(){
        
       $res = upload('desc_img','desc');
       if($res['code'] == 1){
           $url = request()->domain().'/uploads/desc/'.$res['url'];
           return json(['error'=>0,'url'=>$url]);
       }else{
           return json(['error'=>-1,'message'=>$res['msg']]);
       }
    }
    
    
    
}