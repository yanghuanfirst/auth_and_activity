<?php
namespace app\admin\controller;
class Rule extends Error{
    
    function index()
    {
        return $this->fetch();
    }
    //列表
    function lists()
    {
        $limit = input('limit/d',1);
        $page = input('page/d',1);
        $data['data'] = db('rule')->page($page)->limit($limit)->select();
        if($data['data'])
        {
            foreach($data['data'] as $k=>&$v)
            {
                if($v['is_show'] == 1){
                    $v['is_show'] = '显示';
                }else{
                    $v['is_show'] = '不显示';
                }
            }
        }
        //print_r(array_column($data['data'], 'id'));
        $data['count'] = db('rule')->count();
        $data['code'] = 0;
        return $data;
    }
    function add()
    {
        $level = db('rule')->select();
        $tree = getTreeSel($level);
        $this->assign('level',$tree);
        return $this->fetch();
    }
    function doAdd()
    {
        $data = input('post.');
        $validate = new \app\admin\validate\Rule;
        $err['code'] = 1;
        if (!$validate->check($data)) {
            $err['code'] = -1;
            $err['msg'] = $validate->getError();
            return $err;
        }
        $data['create_time'] = time();
        if(isset($data['id']) && $data['id'])
        {
            $res = db('rule')->update($data);
        }else{
            $res = db('rule')->insert($data);
        }
        if($res){
            $err['msg'] = '操作成功';
            return $err;
        }else{
            $err['code'] = -1;
            $err['msg'] = '操作失败';
            return $err;
        }    
        
    }
    
    
    
    //编辑
    function edit(){
        $id = input('id/d',0);
        if($id)
        {
            $info = db('rule')->find($id);
            $level = db('rule')->select();
            $tree = getTreeSel($level);
            $this->assign('level',$tree);
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
        $res = db('rule')->update($data);
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
        $res = db('rule')->delete($id);
        
        if($res)
        {
            $is_have = db('rule')->page($page)->limit($limit)->select();
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