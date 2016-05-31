<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;
use \think\Db;
use \think\Input;
use \think\Loader;
use \think\Url;

class User extends AdminBase
{
    /**
     * 后台主面板
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-16T17:32:36+0800
     * @return   [type]                   [description]
     */
    public function index()
    {
        $userModel = Loader::model('User');
        $userRows  = $userModel::paginate(25);

        $this->assign('userRows', $userRows);
        $this->assign('pages', $userRows->render());
        return $this->fetch();
    }

    /**
     * [add description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-27T09:45:59+0800
     */
    public function add()
    {
        if (IS_AJAX) {

            $params    = Input::param();
            $userModel = Loader::model('User');

            if (loader::validate('User')->scene('add')->check($params) === false) {
                return ['status' => 0, 'data' => loader::validate('User')->getError()];
            }

            if (($userId = Loader::model('User')->userAdd($params)) === false) {
                return ['status' => 0, 'data' => Loader::model('User')->getError()];
            }

            Loader::model('BackstageLog')->record("添加后台用户：[{$userId}]");

            return ['status' => 1, 'url' => Url::build('admin/user/index')];
        }

        $roleModel = Loader::model('Role');
        $roleRows  = $roleModel::all();

        $this->assign('default_image', Loader::model('Variable')->getValueBykey('default_image'));
        $this->assign('roleRows', $roleRows);
        return $this->fetch();
    }

    /**
     * [edit description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-27T10:23:46+0800
     * @param    [type]                   $id [description]
     * @return   [type]                       [description]
     */
    public function edit($id)
    {
        if (IS_AJAX) {
            $params    = Input::param();
            $userModel = Loader::model('User');

            $params['id'] = (int) $id;
            if (loader::validate('User')->scene('edit')->check($params) === false) {
                return ['status' => 0, 'data' => loader::validate('User')->getError()];
            }

            if (Loader::model('User')->profileEdit($params) === false) {
                return ['status' => 0, 'data' => Loader::model('User')->getError()];
            }
            Loader::model('BackstageLog')->record("修改后台用户：[{$id}]");

            return ['status' => 1, 'url' => Url::build('admin/user/index')];

        }

        $roleModel = Loader::model('Role');
        $userRow   = Db::table('user')->find($id);
        $roleRows  = $roleModel::all();

        $this->assign('default_image', Loader::model('Variable')->getValueBykey('default_image'));
        $this->assign('roleRows', $roleRows);
        $this->assign('userRow', $userRow);
        return $this->fetch();
    }

    /**
     * [destroy description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-27T10:42:25+0800
     * @param    string                   $value [description]
     * @return   [type]                          [description]
     */
    public function destroy($id)
    {
        if (Loader::model('User')->deleteUser($id) === false) {
            return ['status' => 0, 'data' => Loader::model('User')->getError()];
        }

        Loader::model('BackstageLog')->record("删除后台用户：[{$id}]");
        return ['status' => 1, 'url' => Url::build('admin/user/index')];

    }
}
