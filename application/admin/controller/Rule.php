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
     * @return [type] [description]
     */
    public function index()
    {
        $ruleModel = Loader::model('Rule');
        $lists     = $ruleModel->where('parent_id', 0)->order('sort', 'asc')->select();

        $this->assign('lists', $lists);

        return $this->fetch();
    }

    /**
     * 添加菜单
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-17T14:42:48+0800
     * @param string $value [description]
     */
    public function add()
    {
        if (IS_AJAX) {
            $params = Input::param();

            if (loader::validate('Rule')->scene('add')->check($params) === false) {
                return $this->error(loader::validate('Rule')->getError());
            }

            if (($userId = Loader::model('Rule')->save($params)) === false) {
                return $this->error(loader::model('Rule')->getError());
            }

            Loader::model('BackstageLog')->record("添加菜单,ID:[{$userId}]");

            return $this->success('菜单添加成功',Url::build('admin/rule/index'));
        }
        $ruleRows = Loader::model('Rule')->getMenusByParentId(0);
        $this->assign('ruleRows', $ruleRows);

        return $this->fetch();

    }

    /**
     * 编辑
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-18T10:27:08+0800
     * @param  string $value [description]
     * @return [type] [description]
     */
    public function edit($id)
    {
        $ruleModel = Loader::model('Rule');

        $ruleRow = $ruleModel::get($id);
        if ($ruleRow === false) {
            $this->error('没有找到对应的数据');
        }

        if (IS_AJAX) {
            $params   = Input::param();
            $params['id'] = $id;

            if (loader::validate('Rule')->scene('edit')->check($params) === false) {
                return $this->error(loader::validate('Rule')->getError());
            }
            if (Loader::model('Rule')->save($params,['id'=>$id]) === false) {
                return $this->error(loader::model('Rule')->getError());
            }
            Loader::model('BackstageLog')->record("修改菜单,ID:[{$id}]");

            return $this->success('菜单修改成功',Url::build('admin/rule/index'));
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
     * @param  [type] $id [description]
     * @return [type] [description]
     */
    public function destroy($id)
    {
        $ruleModel = Loader::model('Rule');

        if ($ruleModel->deleteRule($id) === false) {
            return $this->error($ruleModel->getError());
        }
        Loader::model('BackstageLog')->record("删除菜单,ID:[{$id}]");

        return $this->success('菜单删除成功',Url::build('admin/rule/index'));
    }
}
