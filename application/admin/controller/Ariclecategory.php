<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;
use think\Input;
use think\Loader;
use think\Url;

class Ariclecategory extends AdminBase
{
    /**
     * [index description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-06-06T10:39:15+0800
     * @return   [type]                   [description]
     */
    public function index()
    {
        $ariclecategoryModel = Loader::model('Ariclecategory');
        $ariclecategoryRows  = $ariclecategoryModel::listField()->where(['parent_id' => 0])->select();
        $this->assign('ariclecategoryRows', $ariclecategoryRows);
        return $this->fetch();
    }

    /**
     * [add description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-06-06T10:39:19+0800
     */
    public function add()
    {
        if (IS_AJAX) {
            $params = Input::param();

            if (loader::validate('Ariclecategory')->scene('add')->check($params) === false) {
                return ['status' => 0, 'data' => loader::validate('Ariclecategory')->getError()];
            }

            if (($ariclecategoryId = Loader::model('Ariclecategory')->ariclecategoryAdd($params)) === false) {
                return ['status' => 0, 'data' => Loader::model('Ariclecategory')->getError()];
            }

            Loader::model('BackstageLog')->record("添加文章分类页面：[{$ariclecategoryId}]");

            return ['status' => 1, 'url' => Url::build('admin/ariclecategory/index')];
        }

        $ariclecategoryModel = Loader::model('Ariclecategory');
        $ariclecategoryRows  = $ariclecategoryModel::selectField()->where(['parent_id' => 0])->select();
        $this->assign('ariclecategoryRows', $ariclecategoryRows);
        return $this->fetch();
    }

    /**
     * [edit description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-06-06T10:39:25+0800
     * @param    [type]                   $id [description]
     * @return   [type]                       [description]
     */
    public function edit($id)
    {

        if (IS_AJAX) {
            $params       = Input::param();
            $params['id'] = $id;
            if (loader::validate('Ariclecategory')->scene('edit')->check($params) === false) {
                return ['status' => 0, 'data' => loader::validate('Ariclecategory')->getError()];
            }

            if (($ariclecategoryId = Loader::model('Ariclecategory')->ariclecategoryEdit($params)) === false) {
                return ['status' => 0, 'data' => Loader::model('Ariclecategory')->getError()];
            }

            Loader::model('BackstageLog')->record("修改文章分类页面：[{$id}]");

            return ['status' => 1, 'url' => Url::build('admin/ariclecategory/index')];
        }

        $ariclecategoryModel = Loader::model('Ariclecategory');

        $ariclecategoryRow  = $ariclecategoryModel::get($id);
        $ariclecategoryRows = $ariclecategoryModel::selectField()->where(['parent_id' => 0])->select();
        $this->assign('ariclecategoryRows', $ariclecategoryRows);
        $this->assign('ariclecategoryRow', $ariclecategoryRow);
        return $this->fetch();
    }

    /**
     * [destroy description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-06-06T10:39:29+0800
     * @param    [type]                   $id [description]
     * @return   [type]                       [description]
     */
    public function destroy($id)
    {
        $ariclecategoryModel = Loader::model('Ariclecategory');

        if ($ariclecategoryModel->deleteAriclecategory($id) === false) {
            return ['status' => 0, 'data' => $ariclecategoryModel->getError()];
        }
        Loader::model('BackstageLog')->record("删除文章分类页面,ID:[{$id}]");

        return ['status' => 1, 'url' => Url::build('admin/ariclecategory/index')];
    }
}
