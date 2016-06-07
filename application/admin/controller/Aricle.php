<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;
use think\Input;
use think\Loader;
use think\Url;

class Aricle extends AdminBase
{
    /**
     * [index description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-06-07T10:40:30+0800
     * @return   [type]                   [description]
     */
    public function index()
    {
        $aricleModel = Loader::model('Aricle');
        $aricleRows  = $aricleModel::paginate(25);

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
        if (IS_AJAX) {
            $params = Input::param();

            if (loader::validate('Aricle')->scene('add')->check($params) === false) {
                return ['status' => 0, 'data' => loader::validate('Aricle')->getError()];
            }

            if (($aricleId = Loader::model('Aricle')->aricleAdd($params)) === false) {
                return ['status' => 0, 'data' => Loader::model('Aricle')->getError()];
            }

            Loader::model('BackstageLog')->record("添加单页面：[{$aricleId}]");

            return ['status' => 1, 'url' => Url::build('admin/aricle/index')];
        }

        $ariclecategoryModel = Loader::model('Ariclecategory');
        $ariclecategoryRows  = $ariclecategoryModel::selectField()->where(['parent_id' => 0])->select();
        $this->assign('default_image', Loader::model('Variable')->getValueBykey('default_image'));
        $this->assign('ariclecategoryRows', $ariclecategoryRows);
        return $this->fetch();
    }

    /**
     * [destroy description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-06-07T17:45:42+0800
     * @param    [type]                   $id [description]
     * @return   [type]                       [description]
     */
    public function destroy($id)
    {
        if (Loader::model('Aricle')->deleteAricle($id) === false) {
            return ['status' => 0, 'data' => Loader::model('Aricle')->getError()];
        }
        Loader::model('BackstageLog')->record("删除文章,ID:[{$id}]");

        return ['status' => 1, 'url' => Url::build('admin/aricle/index')];
    }
}
