<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;
use \think\Input;
use \think\Loader;
use \think\Url;

class Rule extends AdminBase
{
    /**
     * 菜单列表
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-17T11:30:49+0800
     * @return   [type]                   [description]
     */
    public function index()
    {
        return $this->fetch();
    }

    /**
     * 添加菜单
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-05-17T14:42:48+0800
     * @param    string                   $value [description]
     */
    public function add()
    {
        if (IS_AJAX) {
            $data   = Input::param();
            $result = $this->validate($data, "Rule.add");

            if ($result !== true) {
                return ['status' => 0, 'data' => $result];
            }

            $userModel = Loader::model('Rule');

            $userModel->save($data);

            return ['status' => 1, 'url' => Url::build('admin/rule/index')];

        } else {
            $ruleRows = Loader::model('Rule')->getMenusByParentId(0);
            $this->assign('ruleRows', $ruleRows);
            return $this->fetch();
        }
    }
}
