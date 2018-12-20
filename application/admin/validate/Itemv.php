<?php
namespace app\admin\validate;
use think\Validate;
class Itemv extends Validate
{
    protected $rule =   [
        'username'  => 'require|max:4|min:2|chs',
        'title'   => 'require|max:30',
        'item_img'   => 'require',
        'tel' => 'require|regex:^1[35789]{1}\d{9}$|unique:item',
        'desc'=>"require"
    ];

    protected $message  =   [
        'username.require' => '用户名必须',
        'username.max'     => '用户名必须最多不能超过4个字符',
        'username.min'     => '用户名必须最小2个字符',
        'username.chs'     => '用户名必须是中文',
        'title.require'   => '标题必须',
        'title.max'   => '标题最多30个字',
        'tel.require'   => '电话必须输入',
        'tel.regex'=>'电话格式不对',
        'desc.require'  => '描述必须',
        'item_img.require'=>'logo必须传'
    ];

}





















