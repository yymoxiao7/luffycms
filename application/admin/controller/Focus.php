<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;
use think\Db;
use think\Input;
use think\Loader;
use think\Url;

/**
 *
 */
class Focus extends AdminBase
{
    /**
     * 列表
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-06-01T14:34:49+0800
     * @return [type] [description]
     */
    public function index()
    {
        $focusModel = Loader::model('Focus');
        $focusRows  = $focusModel::paginate(25);

        $this->assign('focusRows', $focusRows);
        $this->assign('pages', $focusRows->render());

        return $this->fetch();
    }

    /**
     * [add description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-06-01T14:35:45+0800
     */
    public function add()
    {
        if (IS_AJAX) {
            $params = Input::param();

            if (loader::validate('Focus')->scene('add')->check($params) === false) {
                return $this->error(loader::validate('Focus')->getError());
            }

            if (($focusId = Loader::model('Focus')->focusAdd($params)) === false) {
                return $this->error(loader::model('Focus')->getError());
            }

            Loader::model('BackstageLog')->record("添加焦点图：[{$focusId}]");

            return $this->success('焦点图添加成功',Url::build('admin/focus/index'));
        }

        $this->assign('positionRows', Loader::model('FocusPosition')->select());
        $this->assign('default_image', Loader::model('Variable')->getValueBykey('default_image'));

        return $this->fetch();
    }

    /**
     * 修改
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-06-01T15:08:33+0800
     * @param  [type] $id [description]
     * @return [type] [description]
     */
    public function edit($id)
    {
        // $focus = Loader::model('Focus');
        if (IS_AJAX) {
            $params = Input::param();

            $params['id'] = $id;
            if (loader::validate('Focus')->scene('edit')->check($params) === false) {
                return $this->error(loader::validate('Focus')->getError());
            }

            if (($linksId = Loader::model('Focus')->focusEdit($params)) === false) {
                return $this->error(loader::model('Focus')->getError());
            }

            Loader::model('BackstageLog')->record("修改焦点图：[{$id}]");

            return $this->success('焦点图修改成功',Url::build('admin/focus/index'));
        }

        $focusRow = Db::table('focus')->find($id);
        $this->assign('focusRow', $focusRow);
        $this->assign('positionRows', Loader::model('FocusPosition')->select());
        $this->assign('default_image', Loader::model('Variable')->getValueBykey('default_image'));

        return $this->fetch();
    }

    /**
     * 删除
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-06-01T15:25:46+0800
     * @param  [type] $id [description]
     * @return [type] [description]
     */
    public function destroy($id)
    {
        if (Loader::model('Focus')->deleteFocus($id) === false) {
            return $this->error(loader::model('Focus')->getError());
        }
        Loader::model('BackstageLog')->record("删除焦点图,ID:[{$id}]");

        return $this->success('焦点图删除成功',Url::build('admin/focus/index'));
    }
}
