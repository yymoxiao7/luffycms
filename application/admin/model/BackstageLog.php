<?php
namespace app\admin\model;

use \think\Config;
use \think\Model;
use \think\Session;

class BackstageLog extends Model
{
    protected $updateTime = 'create_time';
    protected $insert     = ['ip', 'user_id'];

    /**
     * 设置登录用户的ip
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-17T10:33:05+0800
     * @param    [type]                   $ip [description]
     */
    protected function setIpAttr()
    {
        return \app\common\tools\Visitor::getIP();
    }

    /**
     * [setUserId description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-23T14:27:19+0800
     * @param    string                   $value [description]
     */
    protected function setUserIdAttr()
    {
        $user_id = 0;
        if (Session::has(Config::get('login_session_identifier')) !== false) {
            $user_id = Session::get(Config::get('login_session_identifier') . '.id');
        }
        return $user_id;
    }

    /**
     * [record description]
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-23T14:25:32+0800
     * @param    [type]                   $remark [description]
     * @return   [type]                           [description]
     */
    public function record($remark)
    {
        $this->save(['remark' => $remark]);
    }

}
