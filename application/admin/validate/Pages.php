<?php
namespace app\admin\validate;

use \think\Validate;

class Pages extends Validate
{
    use \app\common\validate\Validate;

    protected $rule = [
        'parent_id' => ['require', 'existPid:pages'],
        'title'     => ['require', 'max:100'],
        'keyword'   => ['max:100'],
        'status'    => ['in:0,1'],
        'sort'      => ['require', 'integer'],
    ];

    protected $message = [
        'parent_id.require'  => '上级单页面必须填写',
        'parent_id.existPid' => '上级单页面不存在或者不能等于本身',
        'title.require'      => '标题必须填写',
        'title.max'          => '标题长度不能超来100个字符',
        'keyword.max'        => '关键词长度不能超来100个字符',
        'status.in'          => '状态值不可用',
        'sort.require'       => '排序必须填写',
        'sort.integer'       => '排序值不正确',

    ];

    protected $scene = [
        'add'  => ['parent_id', 'title', 'keyword', 'status', 'sort'],
        'edit' => ['parent_id', 'title', 'keyword', 'status', 'sort'],
    ];
}
