<?php
namespace app\admin\validate;

use \think\Validate;

class Aricle extends Validate
{
    use \app\common\validate\Validate;

    protected $rule = [
        'category_id'      => ['require', 'exist:ariclecategory'],
        'title'            => ['require', 'max:255','unique:aricle,title'],
        'keyword'          => ['max:100'],
        'status'           => ['in:0,1'],
        'aricle-thumbnail' => ['max:255'],
        'description'      => ['max:255'],
        'sort'             => ['require', 'integer'],
    ];

    protected $message = [
        'category_id.require'  => '分类必须填写',
        'category_id.existPid' => '分类不存在或者不能等于本身',
        'title.require'        => '标题必须填写',
        'title.max'            => '标题长度不能超来100个字符',
        'title.unique'         => '标题已存在',
        'keyword.max'          => '关键词长度不能超来100个字符',
        'description.max'      => '简介长度不能超来100个字符',
        'status.in'            => '状态值不可用',
        'sort.require'         => '排序必须填写',
        'sort.integer'         => '排序值不正确',

    ];

    protected $scene = [
        'add'  => ['category_id', 'title', 'keyword', 'status', 'sort'],
        'edit' => ['category_id', 'title', 'keyword', 'status', 'sort'],
    ];
}
