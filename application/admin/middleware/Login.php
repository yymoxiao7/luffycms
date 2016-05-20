<?php
namespace app\admin\middleware;

use think\response\Redirect;
use \think\Config;
use \think\Session;

class Login
{

    public function run(&$params)
    {
        if (Session::has(Config::get('login_session_identifier')) && ($user = Session::get(Config::get('login_session_identifier')))) {
            if (CONTROLLER_NAME == 'common') {
                if (IS_AJAX) {
                    return ['status' => 2, 'url' => '/admin/index/index'];
                } else {
                    (new Redirect('/admin/index/index'))->send();
                }

                exit;
            } else {
                if (Config::has('no_auth_controller_name') && ($noAuthControllerName = Config::get('no_auth_controller_name')) != '') {
                    $noAuthControllerNames = explode(',', $noAuthControllerName);
                    if (is_array(CONTROLLER_NAME, $noAuthControllerNames)) {
                        return true;
                    }
                }

                //通过user里的id 验证用户是否有操作的权限
                // echo '没有权限！';
                // exit;
            }
        } else if (CONTROLLER_NAME != 'common') {

            // 没有登录标识说明没登录 直接清除登录再跳转到登录页面
            Session::clear();
            if (IS_AJAX) {
                return ['status' => 2, 'url' => '/admin/index/index'];
            } else {
                (new Redirect('/admin/common/login'))->send();
            }

            exit;
        }

    }
}
