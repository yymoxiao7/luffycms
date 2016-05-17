<?php
namespace app\admin\model;

use think\Db;
use think\Model;

class Rule extends Model
{
    protected $type = [
        'id'        => 'integer',
        'parent_id' => 'integer',
        'islink'    => 'integer',
        'sort'      => 'integer',
    ];

    /**
     * 获取状态
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-04-19T16:00:40+0800
     * @param    string                   $value [description]
     * @return   [type]                          [description]
     */
    public function getIslinkTextAttr($islink, $data)
    {
        $islinks = [0 => '操作', 1 => '菜单'];
        return $islinks[$data['islink']];
    }

    /**
     * 通过用户组获取菜单
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-17T15:53:58+0800
     * @param    string                   $roleId 用户组ID
     * @return   [type]                          [description]
     */
    public function getMenusByRoleId($roleId)
    {
        $ruleRows = Db::table('role_rule')
            ->field('r.id, r.parent_id,r.name,r.title,r.icon')
            ->alias('rr')
            ->join('rule as r', 'rr.rule_id=r.id')
            ->where('rr.role_id', $roleId)
            ->where('r.islink', 1)
            ->order('r.parent_id ASC , r.sort ASC')
            ->select();

        if (empty($ruleRows)) {
            return [];
        }

        $ruleData = [];
        foreach ($ruleRows as $key => $ruleRow) {
            if ($ruleRow['parent_id'] == 0) {
                if (isset($ruleData[$ruleRow['id']])) {
                    $ruleData[$ruleRow['id']] = array_merge($ruleData[$ruleRow['id']], $ruleRow);
                } else {
                    $ruleData[$ruleRow['id']] = $ruleRow;
                }
            } else {
                $ruleData[$ruleRow['parent_id']]['sub'][$ruleRow['id']] = $ruleRow;
            }
        }

        return $ruleData;
    }

    /**
     * 通过parent_id获取菜单
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-17T16:36:34+0800
     * @param    integer                  $parentId [description]
     * @return   [type]                             [description]
     */
    public function getMenusByParentId($parentId = 0)
    {
        return Db::table('rule')
            ->field('id,title')
            ->where('parent_id', $parentId)
            ->where('islink', 1)
            ->order('parent_id ASC , sort ASC')
            ->select();
    }

}
