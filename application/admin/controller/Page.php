<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;
use think\Loader;
use think\Request;
use think\Url;

/**
 *
 */
class Page extends AdminBase
{
    /**
     * [index description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-06-03T14:10:45+0800
     * @return [type] [description]
     */
    public function index()
    {
        $pageModel = Loader::model('Pages');
        $pageRows  = $pageModel::listField()->where(['parent_id' => 0])->select();

        $this->assign('pageRows', $pageRows);

        return $this->fetch();
    }

    /**
     * [add description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-06-03T14:32:24+0800
     */
    public function add()
    {
        $request = Request::instance();
        if ($request->isAjax()) {
            $params = $request->param();

            if (loader::validate('Pages')->scene('add')->check($params) === false) {
                return $this->error(loader::validate('Pages')->getError());
            }

            if (($pageId = Loader::model('Pages')->pageAdd($params)) === false) {
                return $this->error(Loader::model('Pages')->getError());
            }

            Loader::model('BackstageLog')->record("添加单页面：[{$pageId}]");

            return $this->success('单页面添加成功', Url::build('admin/page/index'));
        }

        $pageModel = Loader::model('Pages');
        $pageRows  = $pageModel::selectField()->where(['parent_id' => 0])->select();
        $this->assign('pageRows', $pageRows);

        return $this->fetch();
    }

    /**
     * [edit description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-06-03T16:32:52+0800
     * @param  [type] $id [description]
     * @return [type] [description]
     */
    public function edit($id)
    {
        $request = Request::instance();
        if ($request->isAjax()) {
            $params       = $request->param();
            $params['id'] = $id;
            if (loader::validate('Pages')->scene('edit')->check($params) === false) {
                return $this->error(loader::validate('Pages')->getError());
            }

            if (($pageId = Loader::model('Pages')->pageEdit($params)) === false) {
                return $this->error(Loader::model('Pages')->getError());
            }
            Loader::model('BackstageLog')->record("修改单页面：[{$id}]");

            return $this->success('单页面修改成功', Url::build('admin/page/index'));
        }

        $pageModel = Loader::model('Pages');

        $pageRow  = $pageModel::get($id);
        $pageRows = $pageModel::selectField()->where(['parent_id' => 0])->select();
        $this->assign('pageRows', $pageRows);
        $this->assign('pageRow', $pageRow);

        return $this->fetch();
    }

    /**
     * [destroy description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-06-06T17:27:00+0800
     * @param  string $value [description]
     * @return [type] [description]
     */
    public function destroy($id)
    {
        $pageModel = Loader::model('Pages');

        if ($pageModel->deletePage($id) === false) {
            return $this->error($pageModel->getError());
        }
        Loader::model('BackstageLog')->record("删除单页面,ID:[{$id}]");

        return $this->success('单页面删除成功', Url::build('admin/page/index'));
    }
}
