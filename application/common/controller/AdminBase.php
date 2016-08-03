<?php
namespace app\common\controller;

use think\Config;
use think\Controller;
use think\Db;
use think\Request;
use think\Session;

/**
 *
 */
class AdminBase extends Controller
{
    protected $userRow = [];
    /**
     * [__construct description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-23T15:07:02+0800
     */
    public function __construct()
    {
        parent::__construct();

        // defined('IS_AJAX') or define('IS_AJAX', Request::instance()->isAjax());
        defined('STATIC_PATH') or define('STATIC_PATH', dirname(ROOT_PATH) . DS . 'static');

        // 当前位置
        $this->getBreadcrumb();
        //userRow赋值
        $this->userRow = Session::get(Config::get('login_session_identifier'));
    }

    /**
     * 退出登录
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-16T17:38:10+0800
     * @return   [type]                   [description]
     */
    public function logout()
    {
        Session::clear();

        return $this->success('退出成功！', '/admin/common/login');
    }

    /**
     * 获取当前位置
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-18T09:33:02+0800
     * @return   [type]                          [description]
     */
    protected function getBreadcrumb()
    {
        $breadcrumb = [];

        $request = Request::instance();
        $rule    = $request->controller() . '/' . $request->action();

        $isHere = Db::table('rule')
            ->field('parent_id,title,name')
            ->where('name', $rule)->find();

        if (empty($isHere)) {
            return false;
        }

        if ($isHere['parent_id'] !== 0) {
            $breadcrumb[] = Db::table('rule')
                ->field('parent_id,title,name')
                ->where('id', $isHere['parent_id'])->find();
        }

        $breadcrumb[] = $isHere;

        $this->assign('breadcrumb', $breadcrumb);
    }
}
