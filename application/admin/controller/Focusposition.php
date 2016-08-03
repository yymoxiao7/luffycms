<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;
use think\Loader;
use think\Request;
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
     * @return [type] [description]
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
        $request = Request::instance();
        if ($request->isAjax()) {
            $params = $request->param();

            if (loader::validate('FocusPosition')->check($params) === false) {
                return $this->error(loader::validate('FocusPosition')->getError());
            }

            if (($positionId = Loader::model('FocusPosition')->positionAdd($params)) === false) {
                return $this->error(loader::model('FocusPosition')->getError());
            }

            Loader::model('BackstageLog')->record("添加焦点图位置：[{$positionId}]");

            return $this->success('焦点图位置添加成功', Url::build('admin/focusposition/index'));
        }
    }

    /**
     * 修改位置
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-06-01T11:46:44+0800
     * @param  [type] $id [description]
     * @return [type] [description]
     */
    public function edit($id)
    {
        $request = Request::instance();
        if ($request->isAjax()) {
            $params       = $request->param();
            $params['id'] = $id;

            if (loader::validate('FocusPosition')->check($params) === false) {
                return $this->error(loader::validate('FocusPosition')->getError());
            }

            if (($positionId = Loader::model('FocusPosition')->positionEdit($params)) === false) {
                return $this->error(loader::model('FocusPosition')->getError());
            }
            Loader::model('BackstageLog')->record("修改焦点图位置：[{$id}]");

            return $this->success('焦点图位置修改成功', Url::build('admin/focusposition/index'));
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
     * @param  [type] $id [description]
     * @return [type] [description]
     */
    public function destroy($id)
    {
        if (Loader::model('FocusPosition')->deletePosition($id) === false) {
            return $this->error(loader::model('FocusPosition')->getError());
        }
        Loader::model('BackstageLog')->record("删除焦点图位置,ID:[{$id}]");

        return $this->success('焦点图位置删除成功', Url::build('admin/focusposition/index'));
    }
}
