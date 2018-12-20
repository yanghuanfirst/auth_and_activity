<?php
namespace app\admin\controller;
use think\Controller;
class Error extends Controller{
    
    function initialize()
    {
        parent::initialize();
        if(!session('userinfo'))
        {
            $this->redirect('login/index');
        }
        $admin_id = session('userinfo.id');
        $not_verify_name = config('public.not_verify_name');
        
        //不在不需要验证的用户名单里面的就需要获取相应用户的权限
        if(!in_array(session('userinfo.name'),$not_verify_name)){
            $rules = $this->getAuth($admin_id);
            if(!$this->checkAuth($admin_id,$rules))
            {
                return $this->error('你暂时没有权限，请联系管理员');
            }
        }else{
            $rules = $this->getAuth($admin_id,false);
        }
        //递归出所有菜单
        $nav_rules = getTree($rules);
       // print_r($nav_rules);die();
        //左侧菜单
       /// $left_nav = $this->leftNav($nav_rules);
        //print_r($nav_rules);die();
        $this->assign('nav_rules',$nav_rules);
        $this->assign('left_nav',$nav_rules);
        //$this->getAuth();
    }
    //验证用户是否有权限
    function checkAuth($admin_id,$rules)
    {
        $request = request();
        $controller = $request->controller(true);
        $action = $request->action(true);
        $rule = array_column($rules,'controller_action');
        $rule = array_map('strtolower',$rule);
        //print_r($rule);die();
        if(in_array($controller.'-'.$action,$rule))
        {
            return true;
        }else{
            return false;
        }
    }
    //左边菜单
    function leftNav($rules)
    {
         $left_nav = [];
         foreach($rules as $k=>$v)
         {
             $left_nav[] = $v;
         }
         return $left_nav;
    }
    
    //获取用户的权限
    /**
     * @param unknown $admin_id
     * @param (boolean) $is_verify 是否需要验证的，不需要就直接返回全部权限
     * @return unknown
     */
    function getAuth($admin_id,$is_verify = true)
    {
        //获取用户所属角色
        //$admin_id = $admin_id;
        if($is_verify)
        {
            $map['a.id'] = $admin_id;
            $rules = db('admin')
                     ->field('r.is_show,r.pid,r.controller_action_name,r.controller_action,r.id as id')
                     ->alias('a')
                     ->join('__ADMIN_ROLE__ ar','ar.admin_id = a.id')
                     ->join('__ROLE_RULE__ rr','rr.role_id = ar.role_id')
                     ->join('__RULE__ r','r.id = rr.rule_id')
                     ->where($map)
                     ->select();
        }else{
            $rules = db('rule')->field('id,is_show,pid,controller_action_name,controller_action')->where('is_show',1)->select();
        }
        return $rules;
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    function _empty()
    {
        return $this->error('访问的页面不存在');
    }
    
}