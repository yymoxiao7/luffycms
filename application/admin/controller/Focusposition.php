<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;
use think\Input;
use think\Loader;
use think\Url;

/**
 *
 */
class Focusposition extends AdminBase
{
    /**
     * 位置列表
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-06-01T11:07:26+0800
     * @return   [type]                   [description]
     */
    public function index()
    {
        $positionModel = Loader::model('FocusPosition');
        $positionRows  = $positionModel::paginate(25);

        $this->assign('positionRows', $positionRows);
        $this->assign('pages', $positionRows->render());

        return $this->fetch();
    }

    /**
     * 添加位置
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-06-01T11:07:05+0800
     */
    public function add()
    {
        if (IS_AJAX) {
            $params = Input::param();

            if (loader::validate('FocusPosition')->check($params) === false) {
                return ['status' => 0, 'data' => loader::validate('FocusPosition')->getError()];
            }

            if (($positionId = Loader::model('FocusPosition')->positionAdd($params)) === false) {
                return ['status' => 0, 'data' => Loader::model('FocusPosition')->getError()];
            }

            Loader::model('BackstageLog')->record("添加焦点图位置：[{$positionId}]");

            return ['status' => 1, 'url' => Url::build('admin/focusposition/index')];
        }
    }

    /**
     * 修改位置
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-06-01T11:46:44+0800
     * @param    [type]                   $id [description]
     * @return   [type]                       [description]
     */
    public function edit($id)
    {
        if (IS_AJAX) {
            $params       = Input::param();
            $params['id'] = $id;

            if (loader::validate('FocusPosition')->check($params) === false) {
                return ['status' => 0, 'data' => loader::validate('FocusPosition')->getError()];
            }

            if (($positionId = Loader::model('FocusPosition')->positionEdit($params)) === false) {
                return ['status' => 0, 'data' => Loader::model('FocusPosition')->getError()];
            }
            Loader::model('BackstageLog')->record("修改焦点图位置：[{$id}]");

            return ['status' => 1, 'url' => Url::build('admin/focusposition/index')];
        }
        $positionModel = loader::model('FocusPosition');
        $positionRow   = $positionModel::get($id);
        $this->assign('positionRow', $positionRow);
        return $this->fetch();
    }

    /**
     * 删除位置
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-06-01T11:52:37+0800
     * @param    [type]                   $id [description]
     * @return   [type]                       [description]
     */
    public function destroy($id)
    {
        if (Loader::model('FocusPosition')->deletePosition($id) === false) {
            return ['status' => 0, 'data' => Loader::model('FocusPosition')->getError()];
        }
        Loader::model('BackstageLog')->record("删除焦点图位置,ID:[{$id}]");

        return ['status' => 1, 'url' => Url::build('admin/focusposition/index')];
    }
}
