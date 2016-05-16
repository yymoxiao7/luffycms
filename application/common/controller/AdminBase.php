<?php
namespace app\common\controller;

use think\Controller;
use think\Session;

/**
 *
 */
class AdminBase extends Controller
{
    public function __construct()
    {
        parent::__construct();

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
}
