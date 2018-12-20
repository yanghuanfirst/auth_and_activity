<?php
namespace app\admin\controller;
use think\Validate;
class Role extends Error{
    
    function index()
    {
        return $this->fetch();
    }
    //列表
    function lists()
    {
        $limit = input('limit/d',1);
        $page = input('page/d',1);
        $data['data'] = db('role')->field('id,name,status')->page($page)->limit($limit)->select();
        $data['count'] = db('role')->count();
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
        $validate = new \app\admin\validate\Role;
        $err['code'] = 1;
        if (!$validate->check($data)) {
            $err['code'] = -1;
            $err['msg'] = $validate->getError();
            return $err;
        }
        $res = db('role')->insert($data);
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
            $info = db('role')->find($id);
            $this->assign('info',$info);
            return $this->fetch();
        }
        
    }
    
    function doEdit()
    {
        $data = input('post.');
        $validate = new \app\admin\validate\Role;
        $err['code'] = 1;
        if (!$validate->check($data)) {
            $err['code'] = -1;
            $err['msg'] = $validate->getError();
            return $err;
        }
        $res = db('role')->update($data);
        if($res){
            $err['msg'] = '修改成功';
            return $err;
        }else{
            $err['code'] = -1;
            $err['msg'] = '修改失败';
            return $err;
        }
        
        
    }
    //删除角色也要把角色对应的权限给删除掉
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
        $res = db('role')->delete($id);
        db('role_rule')->where('role_id',$id)->delete();
        if($res)
        {
            $is_have = db('role')->page($page)->limit($limit)->select();
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
    //分配规则
    function Fenpei()
    {
        $role_id = input('id/d',0);
        if(!$role_id)
        {
            return $this->error('缺少参数');
        }
        $map['pid'] = 0;
        //$map['is_show'] = 1;
        $rules = db('rule')->where($map)->order('pid asc')->select();
        //$rule = db('rule')->select();
        $result = [];
        foreach ($rules as $k=>$v)
        {
            $first_rules = db('rule')->where('pid',$v['id'])->select();
            $rules[$k]['son'] = $first_rules;
            if($first_rules)
            {
                foreach($first_rules as $kk=>$vv)
                {
                    $yang = [];
                    //递归算出当前ID下的所有子级
                    getTreeSels(array(),$yang, $vv['id']);
                    //$second_rules = db('rule')->where('pid',$vv['id'])->select();
                    $first_rules[$kk]['son'] = $yang;
                }
                
                $rules[$k]['son'] = $first_rules;
            }
        }
        $role_rule = db('role_rule')->where('role_id',$role_id)->select();
        $allow_rules = [];
        if($role_rule)
        {
            $allow_rules = array_column($role_rule,'rule_id');
        }
        
        $this->assign('allow_rules',$allow_rules);
        $this->assign('rules',$rules);
        $this->assign('role_id',$role_id);
        return $this->fetch();
    }
    //执行分配
    function doFenpei(){
        $role_id = input('r_role_id/d',0);
        $role_ids = input('rule_id','');
        $err['code'] = 1;
        if(!$role_id || !$role_ids)
        {
            $err['code'] = -1;
            $err['msg'] = '缺少参数';
            return $err;
        }
        foreach($role_ids as $k=>$v)
        {
            $arr['role_id'] = $role_id;
            $arr['rule_id'] = $v;
            $data[] = $arr;
        }
        db('role_rule')->where('role_id',$role_id)->delete();
        $res = db('role_rule')->insertAll($data);
        if($res)
        {
            $err['msg'] = '分配成功';
            return $err;
        }else{
            $err['code'] = -1;
            $err['msg'] = '分配失败';
            return $err;
        }
        
        
    }
    
    
    
    
    
    
    
    
    
    
    
}