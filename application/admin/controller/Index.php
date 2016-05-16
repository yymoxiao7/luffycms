<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;

class Index extends AdminBase
{
    /**
     * 后台主面板
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-16T17:32:36+0800
     * @return   [type]                   [description]
     */
    public function index()
    {
        return $this->fetch();
    }
}
