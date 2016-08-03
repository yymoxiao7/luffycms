<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;
use \think\Db;
use \think\Loader;
use \think\Request;
use \think\Url;

/**
 *
 */
class Links extends AdminBase
{
    /**
     * 友情链接列表
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-31T18:00:49+0800
     * @return [type] [description]
     */
    public function index()
    {
        $linksModel = Loader::model('Links');
        $linksRows  = $linksModel::paginate(25);

        $this->assign('linksRows', $linksRows);
        $this->assign('pages', $linksRows->render());

        return $this->fetch();
    }

    /**
     * 添加友情链接
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-06-01T09:32:15+0800
     */
    public function add()
    {
        $request = Request::instance();
        if ($request->isAjax()) {
            $params = $request->param();

            if (loader::validate('Links')->scene('add')->check($params) === false) {
                return $this->error(loader::validate('Links')->getError());
            }

            if (($linksId = Loader::model('Links')->linksAdd($params)) === false) {
                return $this->error(loader::model('Links')->getError());
            }

            Loader::model('BackstageLog')->record("添加友情链接：[{$linksId}]");

            return $this->success('友情链接添加成功', Url::build('admin/links/index'));
        }
        $this->assign('default_image', Loader::model('Variable')->getValueBykey('default_image'));

        return $this->fetch();
    }

    /**
     * 修改友情链接
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-06-01T09:58:49+0800
     * @param  [type] $id [description]
     * @return [type] [description]
     */
    public function edit($id)
    {
        $request = Request::instance();
        if ($request->isAjax()) {
            $params = $request->param();

            $params['id'] = $id;
            if (loader::validate('Links')->scene('edit')->check($params) === false) {
                return $this->error(loader::validate('Links')->getError());
            }

            if (($linksId = Loader::model('Links')->linksEdit($params)) === false) {
                return $this->error(loader::model('Links')->getError());
            }

            Loader::model('BackstageLog')->record("修改友情链接：[{$id}]");

            return $this->success('友情链接修改成功', Url::build('admin/links/index'));
        }

        $linksRow = Db::table('links')->find($id);
        $this->assign('default_image', Loader::model('Variable')->getValueBykey('default_image'));
        $this->assign('linksRow', $linksRow);

        return $this->fetch();
    }

    /**
     * 删除友情链接
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-06-01T10:16:48+0800
     * @param  [type] $id [description]
     * @return [type] [description]
     */
    public function destroy($id)
    {
        $linksModel = Loader::model('Links');

        if ($linksModel->deleteLinks($id) === false) {
            return $this->error($linksModel->getError());
        }
        Loader::model('BackstageLog')->record("删除菜单,ID:[{$id}]");

        return $this->success('友情链接删除成功', Url::build('admin/links/index'));
    }
}
