<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;
use think\Input;
use think\Loader;
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
     * @return   [type]                   [description]
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
        if (IS_AJAX) {
            $params = Input::param();

            if (loader::validate('Pages')->scene('add')->check($params) === false) {
                return ['status' => 0, 'data' => loader::validate('Pages')->getError()];
            }

            if (($pageId = Loader::model('Pages')->pageAdd($params)) === false) {
                return ['status' => 0, 'data' => Loader::model('Pages')->getError()];
            }

            Loader::model('BackstageLog')->record("添加单页面：[{$pageId}]");

            return ['status' => 1, 'url' => Url::build('admin/page/index')];
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
     * @param    [type]                   $id [description]
     * @return   [type]                       [description]
     */
    public function edit($id)
    {
        if (IS_AJAX) {
            $params       = Input::param();
            $params['id'] = $id;
            if (loader::validate('Pages')->scene('edit')->check($params) === false) {
                return ['status' => 0, 'data' => loader::validate('Pages')->getError()];
            }

            if (($pageId = Loader::model('Pages')->pageEdit($params)) === false) {
                return ['status' => 0, 'data' => Loader::model('Pages')->getError()];
            }

            Loader::model('BackstageLog')->record("修改单页面：[{$id}]");

            return ['status' => 1, 'url' => Url::build('admin/page/index')];
        }

        $pageModel = Loader::model('Pages');

        $pageRow  = $pageModel::get($id);
        $pageRows = $pageModel::selectField()->where(['parent_id' => 0])->select();
        $this->assign('pageRows', $pageRows);
        $this->assign('pageRow', $pageRow);
        return $this->fetch();
    }
}
