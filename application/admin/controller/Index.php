<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;
use \think\Loader;

class Index extends AdminBase
{
    /**
     * 后台主面板
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-16T17:32:36+0800
     * @return [type] [description]
     */
    public function index()
    {
        $ruleData = Loader::model('Rule')->getMenusByRoleId($this->userRow['role_id']);

        $this->assign('userRow', $this->userRow);
        $this->assign('ruleData', $ruleData);

        return $this->fetch();
    }

    /**
     * 主面板
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-17T10:13:54+0800
     * @return [type] [description]
     */
    public function main()
    {
        return $this->fetch();
    }

    public function auth()
    {
        return "没有权限！";
    }
}
