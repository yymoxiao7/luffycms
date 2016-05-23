<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;
use \think\Input;

class Upload extends AdminBase
{
    /**
     * 个人资料修改
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-23T15:26:15+0800
     * @return   [type]                   [description]
     */
    public function uploadpic()
    {
        $data               = Input::param();
        $data['defaultImg'] = '/static/admin/images/default_head.gif';

        $this->assign('data', $data);
        return $this->fetch();
    }
}
