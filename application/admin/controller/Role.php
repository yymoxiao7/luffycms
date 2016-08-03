<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;
use \think\Loader;
use \think\Request;
use \think\Url;

class Role extends AdminBase
{
    /**
     * [index description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-19T11:59:59+0800
     * @return [type] [description]
     */
    public function index()
    {
        $ruleModel = Loader::model('Role');
        $lists     = $ruleModel::paginate(20);

        $this->assign('lists', $lists);
        $this->assign('pages', $lists->render());

        return $this->fetch();
    }

    /**
     * [add description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-19T12:22:21+0800
     */
    public function add()
    {
        $request = Request::instance();
        if ($request->isAjax()) {
            $data      = $request->param();
            $roleModel = Loader::model('Role');

            if (loader::validate('Role')->scene('add')->check($data) === false) {
                return $this->error(loader::validate('Role')->getError());
            }

            if (($id = $roleModel->addRole($data)) !== false) {
                Loader::model('BackstageLog')->record("添加用户组,ID:[{$id}]");

                return $this->success('用户组添加成功', Url::build('admin/role/index'));
            }

            return $this->error(Loader::model('Role')->getError());

        }
        $this->assign('ruleRows', Loader::model('rule')->getMenusByParentId());

        return $this->fetch();
    }

    /**
     * [edit description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-19T12:22:26+0800
     * @param  [type] $id [description]
     * @return [type] [description]
     */
    public function edit($id)
    {
        $roleRow = Loader::model('Role')->find($id);

        if ($roleRow == false) {
            $this->error('没有找到对应的数据');
        }

        $request = Request::instance();
        if ($request->isAjax()) {
            $data = $request->param();

            if (loader::validate('Role')->scene('edit')->check($data) === false) {
                return $this->error(loader::validate('Role')->getError());
            }

            if ($roleRow->editRole($data) !== false) {
                Loader::model('BackstageLog')->record("修改用户组,ID:[{$id}]");

                return $this->success('用户组修改成功', Url::build('admin/role/index'));
            }

            return $this->error($roleRow->getError());
        }

        // 用户组所有权限
        $myRuleRows = array_column(Loader::model('Rule')->getRulesByRoleId($id), 'id');

        $this->assign('ruleRows', Loader::model('Rule')->getAllRule());
        $this->assign('roleRow', $roleRow);
        $this->assign('myRuleRows', $myRuleRows);

        return $this->fetch();
    }

    /**
     * [destroy description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-19T12:22:30+0800
     * @param  [type] $id [description]
     * @return [type] [description]
     */
    public function destroy($id)
    {
        $rouleModel = Loader::model('Role');

        if ($rouleModel->deleteRole($id) === false) {
            return $this->error($rouleModel->getError());
        }
        Loader::model('BackstageLog')->record("删除用户组,ID:[{$id}]");

        return $this->success('用户组删除成功', Url::build('admin/role/index'));
    }
}
