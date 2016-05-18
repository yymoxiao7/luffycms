<?php
namespace app\common\controller;

use think\Controller;
use think\Db;
use think\Session;

/**
 *
 */
class AdminBase extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->getBreadcrumb();
        // ajax请求返回json数据
        // Config::set('default_ajax_return', true);

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
        $rule       = CONTROLLER_NAME . '/' . ACTION_NAME;

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
