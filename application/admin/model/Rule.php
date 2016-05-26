<?php
namespace app\admin\model;

use think\Config;
use think\Db;
use think\Model;
use think\Session;

class Rule extends Model
{
    protected $autoWriteTimestamp = false;

    protected $type = [
        'id'        => 'integer',
        'parent_id' => 'integer',
        'islink'    => 'integer',
        'sort'      => 'integer',
    ];

    // 定义自动完成的属性
    protected $auto = ['sort', 'islink'];

    /**
     * [user description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-20T14:36:59+0800
     * @return   [type]                   [description]
     */
    public function parent()
    {
        return $this->hasMany('Rule', 'parent_id', 'id');
    }

    /**
     * 获取状态
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-04-19T16:00:40+0800
     * @param    string                   $value [description]
     * @return   [type]                          [description]
     */
    public function getIslinkAttr($islink, $data)
    {
        $islinks = [0 => '<span class="label label-success">操作</span>', 1 => '<span class="label label-info">菜单</span>'];
        return $islinks[$islink];
    }

    /**
     * 获取图标
     * @param  [type] $islink [description]
     * @param  [type] $data   [description]
     * @return [type]         [description]
     */
    public function getIconAttr($islink, $data)
    {
        return ($islink === '') ? '' : '<i class="' . $islink . '"></i>';
    }

    /**
     * 获取排序
     * @param  [type] $sort [description]
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public function getSortAttr($sort, $data)
    {
        return '<input type="text" value="' . $sort . '" class="sort"/>';
    }

    /**
     * 获取用户组所有的权限
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-19T17:11:06+0800
     * @param    [type]                   $roleId [description]
     * @return   [type]                           [description]
     */
    public function getRulesByRoleId($roleId)
    {
        return Db::table('role_rule')
            ->field('r.id,r.name,r.title')
            ->alias('rr')
            ->join('rule as r', 'rr.rule_id=r.id')
            ->where('rr.role_id', $roleId)
            ->order('r.parent_id ASC , r.sort ASC')
            ->select();
    }

    /**
     * 检查权限
     * @param  integer $roleId [description]
     * @param  [type]  $name   [description]
     * @return [type]          [description]
     */
    public function checkRule($roleId = 0, $name = '')
    {
        // 没有传role_id 获取登陆用户的用户组
        if ($roleId == 0) {
            if (Session::has(Config::get('login_session_identifier'))) {
                $roleId = Session::get(Config::get('login_session_identifier') . ".id");
            }
        }
        // 没有传auth地址获取当前
        if ($name = '') {
            $name = CONTROLLER_NAME . "/" . ACTION_NAME;
        }

        $rule = Db::table('role_rule')
            ->alias('rr')
            ->join('rule as r', 'rr.rule_id=r.id')
            ->where('rr.role_id', $roleId)
            ->where('r.islink', 1)
            ->where('r.name', $name)
            ->order('r.parent_id ASC , r.sort ASC')
            ->count('r.id');

        if ($rule > 0) {
            return true;
        } else {
            return false;
        }
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
     * 获取权限
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-19T12:36:05+0800
     * @param    string                   $value [description]
     */
    public function getAllRule()
    {
        $rules = $this->getMenusByParentId(0, false);

        foreach ($rules as $key => $rule) {
            $rules[$key]['sub'] = $this->getMenusByParentId($rule['id'], false);
        }

        return $rules;
    }

    /**
     * 通过parent_id获取菜单
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-17T16:36:34+0800
     * @param    integer                  $parentId [description]
     * @return   [type]                             [description]
     */
    public function getMenusByParentId($parentId = 0, $islink = true)
    {
        $ruleDb = Db::table('rule');
        if ($islink) {
            $ruleDb->where('islink', 1);
        }
        return $ruleDb
            ->field('id,title')
            ->where('parent_id', $parentId)
            ->order('parent_id ASC , sort ASC')
            ->select();
    }

    /**
     * [deleteRole description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-20T15:03:31+0800
     * @param    [type]                   $id [description]
     * @return   [type]                       [description]
     */
    public function deleteRole($id)
    {
        $ruleModel = $this->find($id);
        if ($ruleModel == false) {
            $this->error = '权限不存在，或者已删除！';
            return false;
        }

        if ($ruleModel->parent()->count() > 0) {
            $this->error = '权限下存在其他，不能删除！';
            return false;
        }

        return Db::transaction(function () use ($ruleModel) {
            // 先删除关联中间表的数据
            Db::table('role_rule')->where('rule_id', $ruleModel->id)->delete();

            $ruleModel->delete();
        });
    }
}
