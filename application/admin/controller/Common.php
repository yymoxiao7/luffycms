<?php
namespace app\admin\controller;

use think\Config;
use think\Controller;
use think\Input;
use think\Loader;
use think\Session;
use think\Url;

/**
 *
 */
class Common extends Controller
{

    /**
     * 后台用户登录
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-16T17:32:23+0800
     * @return   [type]                   [description]
     */
    public function login()
    {
        if (IS_AJAX) {
            $data   = Input::param();
            $result = $this->validate($data, "User.login");

            if ($result !== true) {
                return ['status' => 0, 'data' => $result];
            }

            $userModel = Loader::model('User');

            $userRow = $userModel->login([
                'email'    => $data['email_login'],
                'password' => $data['password'],
            ]);

            if ($userRow === false) {
                return ['status' => 0, 'data' => $userModel->getError()];
            }

            Session::set(Config::get('login_session_identifier'), $userRow);

            return ['status' => 1, 'url' => Url::build('admin/index/index')];

        } else {
            return $this->fetch();
        }

    }

}
