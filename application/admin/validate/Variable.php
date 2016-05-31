<?php
namespace app\admin\validate;

use \think\Validate;

class Variable extends Validate
{
    use \app\common\validate\Validate;

    protected $rule = [
        'key'         => ['require', 'length:3,25'],
        'input_types' => ['require', 'exist:variable_type,type'],
    ];

    protected $message = [
        'key.require'        => '变量名称必须填写',
        'key.unique'         => '变量名称已存在',
        'key.length'         => '变量名称必须大于3个字符小于25个字符',
        'input_types.length' => '输入框类型必须大于3个字符小于25个字符',
    ];

    protected $scene = [
        'add'  => ['key', 'input_types'],
        'edit' => ['input_types'],
    ];

}
