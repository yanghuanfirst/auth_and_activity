<?php
namespace app\admin\controller;
use think\Db;
class Admin extends Error{
    
    function index()
    {
        
        return $this->fetch();
    }
    //列表
    function lists()
    {
        $limit = input('limit/d',1);
        $page = input('page/d',1);
        $map = [
            ['id', 'neq',1],
        ];
        $data['data'] = db('admin')->field('id,name')->where($map)->page($page)->limit($limit)->select();
        if($data['data'])
        {
            foreach($data['data'] as $k=>$v){
                $roles = db('role')
                        ->alias('r')
                        ->field('r.name')
                        ->join('__ADMIN_ROLE__ ar','ar.role_id=r.id')
                        ->where('ar.admin_id',$v['id'])
                        ->select();
                if($roles)
                {
                    $data['data'][$k]['self_role'] = implode(array_column($roles,'name'),'，');
                }else{
                    $data['data'][$k]['self_role'] = '无';
                }
            }
        }
        //print_r(array_column($data['data'], 'id'));
        $data['count'] = db('admin')->where($map)->count();
        $data['code'] = 0;
        return $data;
    }
    function add()
    {
        
        return $this->fetch();
    }
    function doAdd()
    {
        $data = input('post.');
        $validate = new \app\admin\validate\Admin;
        $err['code'] = 1;
        if (!$validate->check($data)) {
            $err['code'] = -1;
            $err['msg'] = $validate->getError();
            return $err;
        }
        $data['password'] = md5(trim($data['password']));
        $res = db('admin')->insert($data);
        if($res){
            $err['msg'] = '添加成功';
            return $err;
        }else{
            $err['code'] = -1;
            $err['msg'] = '添加失败';
            return $err;
        }    
        
    }
    
    
    
    //编辑
    function edit(){
        $id = input('id/d',0);
        if($id)
        {
            $info = db('admin')->find($id);
            $this->assign('info',$info);
            return $this->fetch();
        }
        
    }
    
    function doEdit()
    {
        $data = input('post.');
        $err['code'] = 1;
        if($data['password'])
        {
            $data['password'] = md5(trim($data['password']));
        }else{
            unset($data['password']);
        }
        $res = db('admin')->update($data);
        if($res){
            $err['msg'] = '修改成功';
            return $err;
        }else{
            $err['code'] = -1;
            $err['msg'] = '修改失败';
            return $err;
        }
        
        
    }
    function del()
    {
        $id = input('id/d',0);
        $page = input('page/d',1);
        $limit = input('limit/d',1);
        $err['code'] = 1;
        if(!$id)
        {
            $err['msg'] = '缺少参数';
            $err['code'] = -1;
            return $err;
        }
        $res = db('admin')->delete($id);
        
        if($res)
        {
            $is_have = db('admin')->page($page)->limit($limit)->select();
            $err['msg'] = '删除成功';
            $err['code'] = 1;
            $err['is_have'] = $is_have;
            return $err;
        }else{
            $err['msg'] = '删除失败';
            $err['code'] = -1;
            return $err;
        }
        
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
}