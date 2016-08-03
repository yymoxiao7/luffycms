<?php
namespace app\admin\validate;

use \think\Validate;

class Ariclecategory extends Validate
{
    use \app\common\validate\Validate;

    protected $rule = [
        'parent_id'   => ['require', 'existPid:ariclecategory'],
        'title'       => ['require', 'max:100'],
        'keyword'     => ['max:100'],
        'description' => ['max:255'],
        'sort'        => ['require', 'integer'],
    ];

    protected $message = [
        'parent_id.require'  => '上级单页面必须填写',
        'parent_id.existPid' => '上级单页面不存在或者不能等于本身',
        'title.require'      => '标题必须填写',
        'title.max'          => '标题长度不能超来100个字符',
        'keyword.max'        => '关键词长度不能超来100个字符',
        'description.max'    => '简介长度不能超来100个字符',
        'sort.require'       => '排序必须填写',
        'sort.integer'       => '排序值不正确',

    ];

    protected $scene = [
        'add'  => ['parent_id', 'title', 'keyword', 'sort'],
        'edit' => ['parent_id', 'title', 'keyword', 'sort'],
    ];
}
