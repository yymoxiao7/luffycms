<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;
use \think\Input;
use \think\Loader;
use \think\Url;

class Rule extends AdminBase
{
    /**
     * 菜单列表
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-17T11:30:49+0800
     * @return   [type]                   [description]
     */
    public function index()
    {
        $ruleModel = Loader::model('Rule');
        $lists     = $ruleModel::select();

        $this->assign('lists', $lists);
        return $this->fetch();
    }

    /**
     * 添加菜单
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-17T14:42:48+0800
     * @param    string                   $value [description]
     */
    public function add()
    {
        if (IS_AJAX) {
            $ruleModel = Loader::model('Rule');

            $result = $ruleModel->validate('Rule.add')->save(Input::param());

            if (false !== $result) {
                return ['status' => 1, 'url' => Url::build('admin/rule/index')];
            } else {
                return ['status' => 0, 'data' => $ruleModel->getError()];
            }

        } else {
            $ruleRows = Loader::model('Rule')->getMenusByParentId(0);
            $this->assign('ruleRows', $ruleRows);
            return $this->fetch();
        }
    }

    /**
     * 编辑
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-18T10:27:08+0800
     * @param    string                   $value [description]
     * @return   [type]                          [description]
     */
    public function edit($id)
    {
        $ruleRow = \think\Db::table('rule')->find($id);
        if (empty($ruleRow)) {
            $this->error('没有找到对应的数据');
        }

        if (IS_AJAX) {
            $data      = Input::param();
            $ruleModel = Loader::model('Rule');

            $data['id'] = $id;
            $result     = $ruleModel->validate('Rule.edit')->save($data, ['id' => $id]);

            if (false !== $result) {
                return ['status' => 1, 'url' => Url::build('admin/rule/index')];
            } else {
                return ['status' => 0, 'data' => $ruleModel->getError()];
            }
        } else {
            $ruleRows = Loader::model('Rule')->getMenusByParentId(0);

            $this->assign('ruleRow', $ruleRow);
            $this->assign('ruleRows', $ruleRows);
            return $this->fetch();
        }
    }

    /**
     * 删除
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-18T15:36:55+0800
     * @param    [type]                   $id [description]
     * @return   [type]                       [description]
     */
    public function destroy($id)
    {
        $ruleRow = \think\Db::table('rule')->find($id);
        if (empty($ruleRow)) {
            return ['status' => 0, 'data' => '没有找到对应的数据'];
        }

        if ($ruleRow['parent_id'] == 0) {
            if (\think\Db::table('rule')->where('parent_id', $ruleRow['id'])->find()) {
                return ['status' => 0, 'data' => '该菜单还有下级菜单,不能删除.'];
            }
        }
        // 先删除关联中间表的数据
        if (\think\Db::table('role_rule')->where('rule_id', $id)->delete() === false) {
            return ['status' => 0, 'data' => '删除失败.'];
        }

        if (\think\Db::table('rule')->delete($id) === false) {
            return ['status' => 0, 'data' => '删除失败.'];
        }

        return ['status' => 1, 'url' => Url::build('admin/rule/index')];
    }
}
