<?php
namespace app\admin\controller;
use think\Db;
class AdminRole extends Error{
    
    
    function index(){
        $admin_id = input('id/d',0);
        $map['status'] = 1;
        $roles = db('role')->where($map)->select();
        $admin_role = db('admin_role')->where('admin_id',$admin_id)->select();
        $is_selected = [];
        if($admin_role)
        {
            foreach ($admin_role as $k=>$v)
            {
                array_push($is_selected,$v['role_id']);
            }
        }
        $this->assign('is_selected',$is_selected);
        $this->assign('admin_id',$admin_id);
        $this->assign('roles',$roles);
        return $this->fetch();    
    }
    //执行分配
    function doAdd()
    {
        $data = input('post.');
        $err['code'] = 1;
        if(!$data['admin_id'])
        {
            $err['code'] = -1;
            $err['msg'] = '缺少参数';
            return $err;
        }
       
        if(isset($data['role_id']) && $data['role_id'])
        {
            Db::startTrans();
            try {
                 $res = Db::name('admin_role')->where('admin_id',$data['admin_id'])->delete();
                $datas = [];
                foreach($data['role_id'] as $k=>$v)
                {
                    $datas[$k]['admin_id'] = $data['admin_id'];
                    $datas[$k]['role_id'] = $v;
                }
                $res1 = Db::name('admin_role')->insertAll($datas);
                if($res1)
                {
                    // 提交事务
                    Db::commit();
                }else{
                    $err['code'] = 0;
                }
            } catch (\Exception $e) {
                // 回滚事务
                Db::rollback();
            }
        }else{
           $res = Db::name('admin_role')->where('admin_id',$data['admin_id'])->delete();
           if(!$res)
           {
               $err['code'] = 0;
           }
        }
        if($err['code']){
            $err['msg'] = '分配成功';
            return $err;
        }else{
            $err['code'] = -1;
            $err['msg'] = '分配失败';
            return $err;
        }
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}