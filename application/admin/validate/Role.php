<?php
namespace app\admin\validate;
use think\Validate;
class Role extends Validate{
    protected $rule = [
        'name'=>'require'
    ];
    protected $message = [
        'name.require'=>'用户名不能为空'
    ];
    
    
    
}