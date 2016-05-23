<?php
namespace app\admin\model;

use \think\Model;

class LoginSuccessLog extends Model
{
    protected $updateTime = 'create_time';
    protected $insert     = ['ip'];
    protected $dateFormat = 'Y-m-d';

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
