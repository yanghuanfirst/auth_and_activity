<?php
namespace app\admin\validate;
use think\Validate;
class Activity extends Validate
{
    protected $rule =   [
        'activity_name'  => 'require|max:25|min:2',
        'start_time'   => 'require|date|lt:end_time',
        'end_time' => 'require|date|gt:start_time',
    ];

    protected $message  =   [
        'activity_name.require' => '活动名称必须',
        'activity_name.max'     => '活动名称最多不能超过25个字符',
        'activity_name.min'     => '活动名称最小2个字符',
        'start_time.require'   => '开始时间必须',
        'start_time.date'   => '开始时间格式不对',
        'start_time.lt'   => '开始时间必须小于结束时间',
        'end_time.require'  => '结束时间必须',
        'end_time.date'  => '结束时间格式不对',
        'end_time.lt'   => '结束时间必须大于开始时间',
    ];

}