<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;

class Personal extends AdminBase
{
    /**
     * 个人资料修改
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-23T15:26:15+0800
     * @return   [type]                   [description]
     */
    public function profile()
    {
        return $this->fetch();
    }
}
