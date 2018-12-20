<?php
namespace app\admin\validate;
use think\Validate;
class Rule extends Validate{
    protected $rule = [
        'controller_action'=>'require',
        'controller_action_name'=>'require'
    ];
    protected $message = [
        'controller_action.require'=>'路径不能为空',
        'controller_action_name.require'=>'名称不能为空',
    ];
    
    
    
}
