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
        $lists     = $ruleModel->where('parent_id', 0)->select();

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
                \think\Loader::model('BackstageLog')->record("添加菜单,ID:[{$result}]");
                return ['status' => 1, 'url' => Url::build('admin/rule/index')];
            }

            return ['status' => 0, 'data' => $ruleModel->getError()];

        }
        $ruleRows = Loader::model('Rule')->getMenusByParentId(0);
        $this->assign('ruleRows', $ruleRows);
        return $this->fetch();

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
        $ruleModel = Loader::model('Rule');

        $ruleRow = $ruleModel::get($id);
        if ($ruleRow === false) {
            $this->error('没有找到对应的数据');
        }

        if (IS_AJAX) {
            $data   = Input::param();
            $result = $ruleRow->validate('Rule.edit')->save($data);

            if (false !== $result) {
                \think\Loader::model('BackstageLog')->record("修改菜单,ID:[{$id}]");
                return ['status' => 1, 'url' => Url::build('admin/rule/index')];
            }
            return ['status' => 0, 'data' => $ruleModel->getError()];

        }

        $ruleRows = $ruleModel->getMenusByParentId(0);
        $this->assign('ruleRow', $ruleRow);
        $this->assign('ruleRows', $ruleRows);
        return $this->fetch();

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
        $ruleModel = Loader::model('Rule');

        if ($ruleModel->deleteRole($id) === false) {
            return ['status' => 0, 'data' => $ruleModel->getError()];
        }
        \think\Loader::model('BackstageLog')->record("删除菜单,ID:[{$id}]");

        return ['status' => 1, 'url' => Url::build('admin/rule/index')];
    }
}
