<?php
namespace app\admin\validate;

use \think\Validate;

class Rule extends Validate
{
    use \app\common\validate\Validate;

    protected $rule = [
        'name'      => ['require', 'unique:rule,name', 'length:3,25'],
        'title'     => ['require', 'length:3,25'],
        'parent_id' => ['require', 'exist:rule,id'],
        'islink'    => ['in:0,1'],
        'sort'      => ['number', 'between:0,255'],
        'icon'      => ['requireIf:islink,1'],
    ];

    protected $message = [
        'id'                => '权限&菜单不存在！',
        'name.require'      => '权限&菜单必须填写',
        'name.unique'       => '权限&菜单已存在',
        'name.length'       => '权限&菜单必须大于3个字符小于25个字符',
        'title.require'     => '权限菜单名称必须填写',
        'title.length'      => '权限菜单名称必须大于3个字符小于25个字符',
        'parent_id.require' => '上级菜单必须填写',
        'parent_id.exist'   => '上级菜单选值不正确',
        'islink.in'         => '是否菜单选值不正确',
        'sort.number'       => '排序只能是一个数字',
        'sort.between'      => '排序范围值只能在0-255之间',
        'icon.requireIf'    => '菜单必须添加图标文件',
    ];

    protected $scene = [
        'add'        => ['name', 'title', 'parent_id', 'islink', 'sort', 'icon'],
        'edit'       => ['name', 'parent_id', 'title', 'islink', 'sort', 'icon'],
        'editstatus' => ['sort'],
    ];

}
