<?php
namespace app\admin\controller;

use app\admin\model\Aricle as AricleModel;
use app\admin\model\Ariclecategory;
use app\common\controller\AdminBase;
use think\Loader;
use think\Request;
use think\Url;

class Aricle extends AdminBase
{
    /**
     * [index description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-06-07T10:40:30+0800
     * @return [type] [description]
     */
    public function index()
    {
        $aricleRows = AricleModel::paginate(25);

        $this->assign('aricleRows', $aricleRows);
        $this->assign('pages', $aricleRows->render());

        return $this->fetch();
    }

    /**
     * [add description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-06-07T14:45:21+0800
     */
    public function add()
    {
        $request = Request::instance();

        if ($request->isAjax()) {
            $params = $request->param();

            if (loader::validate('Aricle')->scene('add')->check($params) === false) {
                return $this->error(loader::validate('Aricle')->getError());
            }

            if (($aricleId = Loader::model('Aricle')->aricleAdd($params)) === false) {
                return $this->error(Loader::model('Aricle')->getError());
            }

            Loader::model('BackstageLog')->record("添加文章：[{$aricleId}]");

            return $this->success('文章添加成功', Url::build('admin/aricle/index'));
        }

        $ariclecategoryRows = Ariclecategory::selectField()->where(['parent_id' => 0])->select();
        $this->assign('default_image', Loader::model('Variable')->getValueBykey('default_image'));
        $this->assign('ariclecategoryRows', $ariclecategoryRows);

        return $this->fetch();
    }

    /**
     * [edit description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-06-12T10:17:12+0800
     * @param  [type] $id [description]
     * @return [type] [description]
     */
    public function edit($id)
    {
        $request = Request::instance();

        $aricleModel = Loader::model('Aricle');
        $aricleRow   = AricleModel::get($id);

        if ($aricleRow === false) {
            $this->error('文章不存在,或者已被删除');
        }

        if ($request->isAjax()) {
            $params       = $request->param();
            $params['id'] = $id;

            if (loader::validate('Aricle')->scene('edit')->check($params) === false) {
                return $this->error(loader::validate('Aricle')->getError());
            }

            if (($aricleId = $aricleModel->aricleEdit($params)) === false) {
                return $this->error($aricleModel->getError());
            }

            Loader::model('BackstageLog')->record("修改文章：[{$aricleId}]");

            return $this->success('文章修改成功', Url::build('admin/aricle/index'));

        }

        $ariclecategoryRows = Ariclecategory::selectField()->where(['parent_id' => 0])->select();
        $this->assign('default_image', Loader::model('Variable')->getValueBykey('default_image'));
        $this->assign('ariclecategoryRows', $ariclecategoryRows);
        $this->assign('aricleRow', $aricleRow);

        return $this->fetch();
    }

    /**
     * [destroy description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-06-07T17:45:42+0800
     * @param  [type] $id [description]
     * @return [type] [description]
     */
    public function destroy($id)
    {
        if (Loader::model('Aricle')->deleteAricle($id) === false) {
            return $this->error(Loader::model('Aricle')->getError());
        }
        Loader::model('BackstageLog')->record("删除文章,ID:[{$id}]");

        return $this->success('文章添加成功', Url::build('admin/aricle/index'));
    }
}
