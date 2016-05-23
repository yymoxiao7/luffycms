<?php
namespace app\admin\model;

use \think\Model;

class LoginErrorLog extends Model
{
    protected $autoWriteTimestamp = false;
    protected $updateTime         = 'create_time';
    protected $insert             = ['password', 'ip'];
    protected $dateFormat         = 'Y-m-d';

    /**
     * 设置登录用户所用的密码
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-17T10:25:00+0800
     * @param    [type]                   $password [description]
     */
    protected function setPasswordAttr($password)
    {
        return \app\common\tools\String::replaceToStar($password);
    }

    /**
     * 设置登录用户的ip
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-17T10:33:05+0800
     * @param    [type]                   $ip [description]
     */
    public function setIpAttr()
    {
        return \app\common\tools\Visitor::getIP();
    }
}
