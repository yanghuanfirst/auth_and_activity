<?php
namespace app\admin\validate;
use think\Validate;
class Admin extends Validate{
    protected $rule = [
        'name'=>'require',
        'password'=>'require|alphaDash|min:6|max:16'
    ];
    protected $message = [
        'name.require'=>'用户名不能为空',
        'password.require'=>'密码不能为空',
    ];
    
    
    
}