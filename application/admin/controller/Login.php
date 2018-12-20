<?php
namespace app\admin\controller;
use think\Controller;
class Login extends Controller{
    
    function index()
    {
        
        return $this->fetch();
    }
    function login(){
        $data['name'] = input('username/s','');
        $data['password'] = input('password/s','');
        $code = input('code/s','');
        if(!captcha_check($code)){
            $this->error('验证码错误');
        };
        if(!$data['name'] || !$data['password'])
        {
            $this->error('请先输入用户名和密码');
        }
        $data['password'] = md5(trim($data['password']));
        $user_info = db('admin')->field('id,name')->where($data)->find();
        if($user_info)
        {
           session('userinfo',$user_info);
           return $this->redirect('admin/index/index');
           
           //var_dump(session('userinfo'));
        }else{
           $this->error('用户名或者密码输入有误');
        }
    }
    function logout()
    {
        session('userinfo',null);
        return $this->redirect('login/index');
    }
    
    
    
}